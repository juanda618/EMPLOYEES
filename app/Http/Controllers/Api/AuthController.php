<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationSuccess;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        //
    }

    /**
     * metodo para resgistrar.
     */
    public function register(Request $request)
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


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $employee = JWTAuth::user();

        $customClaims = [
            'id' => $employee->id,
            'name' => $employee->name,
            'last_name' => $employee->last_name,
            'position' => $employee->position,
            'date_of_birth' => $employee->date_of_birth
        ];
    
        $token = JWTAuth::claims($customClaims)->attempt($credentials);
    
        return response()->json([
            'token' => $token
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
