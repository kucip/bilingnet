<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;
    protected $table = 'mspaket';
    protected $primaryKey = 'paketIdId';
    protected $fillable = ['compId','paketNama','paketHarga'];
}
