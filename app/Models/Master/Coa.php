<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coa extends Model
{
    use HasFactory;
    protected $table = 'mscoa';
    protected $primaryKey = 'coaId';
    protected $fillable = ['compId','coaKode','coaNama'];
}
