<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    protected $fillable = [
        'quiz_id',
        'user_id',
        'score',
        'correct',
        'wrong',
        'answers', // jika menyimpan jawaban dalam bentuk json/text
    ];
}
