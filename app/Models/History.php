<?php

namespace App\Models;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class History extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function note()
    {
        return $this->belongsTo(Note::class, 'note_id');
    }
    public function noteWithTrashed()
    {
        return $this->belongsTo(Note::class, 'note_id')->withTrashed();
    }
}
