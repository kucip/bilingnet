<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bendahara extends Model
{
    use HasFactory;
    protected $table = 'msbendahara';
    protected $primaryKey = 'bendId';
    protected $fillable = ['compId','bendNama'];
}
