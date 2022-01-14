<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $fillable = [
    'title',
    'descrption',
    'image'
    ];

    public function scopeSearch($query, $data)
    {
        return $query->where('title', 'LIKE', "%{$data}%");
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
