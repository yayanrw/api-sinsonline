<?php

namespace App\Http\Controllers;

use App\P5m;
use Illuminate\Http\Request;

class P5mController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departemen = 'SINS';
        $p5m = P5m::with(['user' => function ($q) use ($departemen) {
            $q->where('departemen', $departemen);
        }])->orderBy('tanggal', 'asc')
        ->get();
        $response = [   
            'msg' => 'List of all p5m',
            'data' => $p5m
        ];
        return response()->json($response, 200);
    }

    public function qrcode()
    {
        $departemen = 'SINS';
        $date = date('Y-m-d');
        $p5m = P5m::with(['user' => function ($q) use ($departemen) {
            $q->where('departemen', $departemen);
        }])
        ->where('tanggal', $date)
        ->first();
        $response = [
            'msg' => 'List of all p5m',
            'data' => $p5m
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
        $this->validate($request, [
            'pembahasan' => 'required',
            'tanggal' => 'required',
            'user_id' => 'required'
        ]);
        $object = [
            'qrcode' => substr($request->pembahasan, 0, -3) . $request->tanggal . $request->user_id,
            'pembahasan' => $request->pembahasan,
            'materi' => '',
            'tanggal' => $request->tanggal,
            'user_id' => $request->user_id
        ];
        P5m::create($object);
        $response = [
            'msg' => 'P5m created',
            'data' => $object
        ];
        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\P5m  $p5m
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $p5m = P5m::with(['user'])
        ->find($id);
        if (!$p5m) {
            return response()->json([
                'msg' => 'P5m not found'
            ], 404);
        }
        else {
            $response = [
                'msg' => 'Detail of p5m',
                'data' => $p5m
            ];
            return response()->json($response);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\P5m  $p5m
     * @return \Illuminate\Http\Response
     */
    public function edit(P5m $p5m)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\P5m  $p5m
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $p5m = P5m::find($id);
        if (!$p5m) {
            return response()->json([
                'msg' => 'Update failed, p5m not found'
            ], 404);
        }
        else {
            $object = [
                'pembahasan' => $request->pembahasan,
                'materi'     => $request->materi,
                'tanggal'    => $request->tanggal,
                'user_id'    => $request->user_id
            ];
            $p5m->update($object);
            $response = [
                'msg' => 'P5m updated',
                'data' => $object
            ];
            return response()->json($response, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\P5m  $p5m
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p5m = P5m::find($id);
        if (!$p5m) {
            return response()->json([
                'msg' => 'P5m not found'
            ], 404);
        }
        else {
            $p5m->delete();
            $response = [
                'msg' => 'P5m deleted',
                'data' => $p5m
            ];
            return response()->json($response, 200);
        }
    }
}
