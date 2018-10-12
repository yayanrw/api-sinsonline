<?php

namespace App\Http\Controllers;

use App\KesiapanKerja;
use Illuminate\Http\Request;

class KesiapanKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // where departemen & hari
        $departemen = 'SINS';
        $tanggal = date('Y-m-d');
        $kesiapankerja = KesiapanKerja::with(['user' => function ($q) use ($departemen) {
            $q->where('departemen', $departemen);
        }, 'p5m'])
        ->where('status', '1')
        ->whereHas('p5m', function ($q) use ($tanggal) {
            $q->where('tanggal', $tanggal);
        })
        ->get();
        $response = [
            'msg' => 'List of all kesiapankerja',
            'data' => $kesiapankerja
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
            'user_id'        => $request->user_id,
            'p5m_id'         => $request->p5m_id,
            'jamtidur'       => $request->jamtidur,
            'jambangun'      => $request->jambangun,
            'minepermit'     => $request->minepermit,
            'masalahpribadi' => $request->masalahpribadi,
            'rompi'          => $request->rompi,
            'sepatu'         => $request->sepatu,
            'helm'           => $request->helm,
            'kacamata'       => $request->kacamata,
            'loto'           => $request->loto,
            'siap'           => $request->siap,
            'status'         => $request->status
        ];
        KesiapanKerja::create($object);
        $response = [
            'msg' => 'KesiapanKerja created',
            'data' => $object
        ];
        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KesiapanKerja  $kesiapanKerja
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kesiapankerja = KesiapanKerja::find($id);
        if (!$kesiapankerja) {
            return response()->json([
                'msg' => 'KesiapanKerja not found'
            ], 404);
        }
        else {
            $response = [
                'msg' => 'Detail of kesiapankerja',
                'data' => $kesiapankerja
            ];
            return response()->json($response);
        }
    }

    public function showByP5mId($id)
    {
        $kesiapankerja = KesiapanKerja::with(['user'])->where('p5m_id', $id)->get();
        if (!$kesiapankerja) {
            return response()->json([
                'msg' => 'KesiapanKerja not found'
            ], 404);
        }
        else {
            $response = [
                'msg' => 'Detail of kesiapankerja',
                'data' => $kesiapankerja
            ];
            return response()->json($response);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KesiapanKerja  $kesiapanKerja
     * @return \Illuminate\Http\Response
     */
    public function edit(KesiapanKerja $kesiapanKerja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KesiapanKerja  $kesiapanKerja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kesiapankerja = KesiapanKerja::find($id);
        if (!$kesiapankerja) {
            return response()->json([
                'msg' => 'Update failed, kesiapankerja not found'
            ], 404);
        }
        else {
            $object = [
                'user_id'        => $request->user_id,
                'p5m_id'         => $request->p5m_id,
                'jamtidur'       => $request->jamtidur,
                'jambangun'      => $request->jambangun,
                'minepermit'     => $request->minepermit,
                'masalahpribadi' => $request->masalahpribadi,
                'rompi'          => $request->rompi,
                'sepatu'         => $request->sepatu,
                'helm'           => $request->helm,
                'kacamata'       => $request->kacamata,
                'loto'           => $request->loto,
                'siap'           => $request->siap,
                'status'         => $request->status
            ];
            $kesiapankerja->update($object);
            $response = [
                'msg' => 'KesiapanKerja updated',
                'data' => $object
            ];
            return response()->json($response, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KesiapanKerja  $kesiapanKerja
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kesiapankerja = KesiapanKerja::find($id);
        if (!$kesiapankerja) {
            return response()->json([
                'msg' => 'KesiapanKerja not found'
            ], 404);
        }
        else {
            $kesiapankerja->delete();
            $response = [
                'msg' => 'KesiapanKerja deleted',
                'data' => $kesiapankerja
            ];
            return response()->json($response, 200);
        }
    }
}
