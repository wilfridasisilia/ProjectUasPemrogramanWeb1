<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
{
    $validate = $request->validate([
        'name'  => 'required',
        'email' => 'required|email',
        'password'  => 'required',
        'password_confirmation' => 'required|same:password'
    ]);

    $validate['password'] = bcrypt($request->password);

    $user = User::create($validate);
    $success['token'] = $user->createToken('MDPApp')->plainTextToken;
    $success['name'] = $user->name;

    return response()->json($success, Response::HTTP_CREATED);
}
    public function login(Request $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $user = Auth::user();

            
            if ($user->role == 'A') { 
                $abilities = [
                    'create-buku', 'read-buku', 'update-buku', 'delete-buku',
                    'create-mahasiswa', 'read-mahasiswa', 'update-mahasiswa', 'delete-mahasiswa',
                    'create-petugas', 'read-petugas', 'update-petugas', 'delete-petugas',
                    'create-peminjaman', 'read-peminjaman', 'update-peminjaman', 'delete-peminjaman'
                ];
            } else { 
                $abilities = [
                    'read-buku',
                    'read-mahasiswa',
                    'read-petugas',
                    'read-peminjaman'
                ];
            }

            
            $success['token'] = $user->createToken('MDPApp', $abilities)->plainTextToken;
            $success['name'] = $user->name;


            return response()->json($success, 201);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
