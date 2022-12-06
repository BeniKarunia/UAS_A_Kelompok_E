<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * index
     * 
     * @return void
     */
    public function index(){
        $buku = Buku::get();
        
        return view('buku.index', compact('buku'));
    }
}
