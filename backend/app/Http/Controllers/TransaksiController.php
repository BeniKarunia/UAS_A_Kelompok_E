<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = Transaksi::get();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Transaksi',
            'data' => $transaksi
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['tanggal'] = date('Y-m-d');
        
        //Validate data
        $validate = Validator::make($data, Transaksi::$rules);

        // if validate fail
        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'data' => $validate->errors()
            ], 400);
        }

        $transaksi = Transaksi::create($data);
        $details = $transaksi->details()->createMany($data['details']);

        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Transaksi',
            'data' => $transaksi
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        $transaksi = Transaksi::find($transaksi->id);

        if (!$transaksi) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Data Transaksi',
            'data' => $transaksi
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
    }
}
