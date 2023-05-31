<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
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
        'certificate',
        'language',
        'rating',
        'lessons',
        'linkIntro',
        'compte_id',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'compte_id');
    }
    public function purchased_courses()
    {
        return $this->hasMany(Purchased_courses::class);
    }
    public function objectives()
    {
        return $this->hasMany(Objective::class);
    }
    public function videos()
    {
        return $this->hasMany(Video::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function tests()
    {
        return $this->hasMany(Test::class);
    }
    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
