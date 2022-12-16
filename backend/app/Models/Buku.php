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
        'penerbit',
        'isbn',
        'penulis',
        'tgl_terbit',
        'stok',
        'cover'
    ];
    public static $rules = [
        "id" => "required",
        "judul" => "required",
        "sinopsis" => "required",
        "genre" => "required",
        "penerbit" => "required",
        "isbn" => "required",
        "penulis" => "required",
        "tgl_terbit" => "required",
        "stok" => "required"
    ];
}
