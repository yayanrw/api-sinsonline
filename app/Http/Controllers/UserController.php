<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $response = [
            'msg' => 'List all user',
            'data' => $user 
        ];
        return response()->json($response, 200);
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
    public function store(Request $request)
    {
        $object = [
            'nama' => $request->nama,
            'nrp' => $request->nrp,
            'departemen' => $request->departemen,
            'password' => bcrypt($request->password)
        ];
        User::create($object);
        $response = [
            'msg' => 'User created',
            'data' => $object
        ];
        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('nrp', '=', $id)
        ->first();
        if (!$user) {
            return response()->json([
                'msg' => 'User not found'
            ], 404);
        }
        else {
            $response = [
                'msg' => 'Detail of user',
                'data' => $user
            ];
            return response()->json($response);
        }
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
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'msg' => 'Update failed, user not found'
            ], 404);
        }
        else {
            $object = [
                'nama' => $request->nama,
                'nrp' => $request->nrp,
                'departemen' => $request->departemen,
                'password' => bcrypt($request->password)
            ];
            $user->update($object);
            $response = [
                'msg' => 'User updated',
                'data' => $object
            ];
            return response()->json($response, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('nrp', $id)->first();
        if (!$user) {
            return response()->json([
                'msg' => 'User not found'
            ], 404);
        }
        else {
            $user->delete();
            $response = [
                'msg' => 'User deleted',
                'data' => $user
            ];
            return response()->json($response, 200);
        }
    }
}
