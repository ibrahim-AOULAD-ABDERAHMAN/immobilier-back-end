<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeDeBien extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'type_de_biens';

    protected $fillable = ['name'];
}
