<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;
    protected $table = 'msperiode';
    protected $primaryKey = 'periodId';
    protected $fillable = ['compId','periodNama'];
}
