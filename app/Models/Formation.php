<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'price',
        'duration',
        'date',
        'image',
        'time',
        'location',
        'capacity',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function objectives()
    {
        return $this->hasMany(Objective::class);
    }
    public function register_formations()
    {
        return $this->hasMany(RegisterFormation::class);
    }
}
