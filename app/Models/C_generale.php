<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class C_generale extends Model
{
    use HasFactory;

    protected $table = 'c_generales';

    protected $fillable = ['name', 'link_icon'];
}
