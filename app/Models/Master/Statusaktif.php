<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statusaktif extends Model
{
    use HasFactory;
    protected $table = 'msstatus';
    protected $primaryKey = 'statId';
    protected $fillable = ['compId','statNama'];
}
