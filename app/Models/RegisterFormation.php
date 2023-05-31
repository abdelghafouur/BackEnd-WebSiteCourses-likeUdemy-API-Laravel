<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterFormation extends Model
{
    use HasFactory;
    protected $fillable = [
        'formation_id',
        'compte_id',
        'certificate',
        'date',
    ];
    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'compte_id');
    }
}
