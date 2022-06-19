<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = 'mspelanggan';
    protected $primaryKey = 'pelId';
    protected $fillable = ['compId','pelNama','pelUserId','pelAlamat','pelNoHp','pelPeriodeBayar','pelPaket','pelAktif'];
}
