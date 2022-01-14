<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class C_interieur extends Model
{
    use HasFactory;

    protected $table = 'c_interieurs';

    protected $fillable = ['name', 'link_icon'];
}
