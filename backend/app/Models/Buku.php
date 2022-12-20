<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'judul',
        'sinopsis',
        'genre',
        'harga',
        'penerbit',
        'isbn',
        'penulis',
        'tgl_terbit',
        'stok',
        'cover'
    ];
    public static $rules = [
        "judul" => "required",
        "sinopsis" => "required",
        "genre" => "required",
        "harga" => "required",
        "penerbit" => "required",
        "isbn" => "required",
        "penulis" => "required",
        "tgl_terbit" => "required",
        "stok" => "required"
    ];
}
