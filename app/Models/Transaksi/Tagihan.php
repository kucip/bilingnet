<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;
    protected $table = 'trtagihan';
    protected $primaryKey = 'tagId';
    protected $fillable = ['compId','tagPeriode','tagBulan','tagBulanNama','tagTahun','tagPelanggan','tagPelangganNama','tagPaket','tagTagihan','tagBayar','tagSisa'];
}
