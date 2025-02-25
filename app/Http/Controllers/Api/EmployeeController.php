<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Tymon\JWTAuth\Facades\JWTAuth; 
use App\Mail\RegistrationSuccess;
use Illuminate\Support\Facades\Mail;


class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['store']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'email' => 'required|string|email|max:255|unique:employees',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $employee = Employee::create([
            'name' => $validatedData['name'],
            'last_name' => $validatedData['last_name'],
            'position' => $validatedData['position'],
            'date_of_birth' => $validatedData['date_of_birth'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Mail::to($employee->email)->send(new RegistrationSuccess($employee));

        $token = JWTAuth::fromUser($employee);

        return response()->json(['token' => $token], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
        ]);

        
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Empleado no encontrado'], 404);
        }

        
        $employee->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'position' => $request->position,
            'date_of_birth' => $request->date_of_birth,
        ]);

        if (auth()->id() == $employee->id) {
            $newToken = JWTAuth::fromUser($employee);
            return response()->json([
                'message' => 'Perfil actualizado correctamente',
                'employee' => $employee,
                'token' => $newToken 
            ], 200);
        }
    
        return response()->json([
            'message' => 'Empleado actualizado correctamente',
            'employee' => $employee
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json(['message' => 'Empleado no encontrado'], 404);
        }
        $employee->delete();
    
        return response()->json(['message' => 'Empleado eliminado correctamente'], 200);
    }


}
