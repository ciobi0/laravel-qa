<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = ['body', 'question_id', 'user_id'];
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }

    public static function boot() {
        parent::boot();
        static::created(function ($answer) {
            $answer->question->increment('answers_count');
            $answer->question->save();
        });
    }

        public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
