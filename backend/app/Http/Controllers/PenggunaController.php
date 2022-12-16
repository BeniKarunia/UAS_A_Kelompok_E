<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    /**
     * index
     * 
     * @return void
     */
    public function index(){
        $pengguna = Pengguna::get();
        
        return view('pengguna.index', compact('pengguna'));
    }
}
