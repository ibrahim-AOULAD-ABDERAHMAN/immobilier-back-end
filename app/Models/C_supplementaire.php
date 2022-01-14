<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class C_supplementaire extends Model
{
    use HasFactory;

    protected $table = 'c_supplementaires';

    protected $fillable = ['name', 'link_icon'];
}
