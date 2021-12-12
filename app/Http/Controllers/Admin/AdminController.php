<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\AdminRegisterRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRegisterRequest $request)
    {
        $request->validated();

        $admin = Admin::create([
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ]);

        $token = $admin->createToken("adminToken")->plainTextToken;

        $response = [
            "admin" => $admin,
            "token" => $token
        ];

        return response($response, 201);
    }

    public function login(AdminLoginRequest $request)
    {
        $request->validated();

        $admin = Admin::where('username', $request->input('username'))->first();

        if(!$admin || !Hash::check($request->input('password'), $admin->password))
        {
            return response([
                "message" => "Invalid credentials",

            ],  400);
        }

        $token = $admin->createToken('myapptoken', ['role:admin'])->plainTextToken;

        $response = [
            'user' => $admin,
            'token' => $token,
            'isAdmin' => true
        ];

        return response($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
