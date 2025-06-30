<?php
namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title',
        'token',
        'duration',
        'start_time',
        'end_time',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    protected $dates = ['deleted_at'];

    protected $casts = [
    'start_time' => 'datetime',
    'end_time' => 'datetime',
];

}
