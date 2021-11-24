<?php

namespace App\Models;

use App\Models\User;
use App\Models\History;
use App\Models\Attendance;
use App\Models\Note_Image;
use App\Models\NoteDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [''];

    public function scopeFilter($query, array $filters)
    {
       
        $query->when($filters['cari'] ?? false, function($query, $cari){
            return $query->where('judul', 'like', '%'. $cari.'%')
                         ->orWhere('keterangan', 'like', '%'. $cari.'%');
        });
    }

    public function scopeSearch($query, $term)
    {
        $term= "%$term%";
        $query->where(function ($query) use ($term){
            $query->where('judul', 'like', $term)
                  ->orWhere('keterangan', 'like', $term)
                  ->orWhere('pemimpin', 'like', $term)
                  ->orWhereHas('user', function($query) use ($term){
                      $query->where('name', 'like', $term);
                  });
        });
    }

    public static function allNotesWithHistoriesStatusRead($userId)
    {
        $readHistoriesByUserId = DB::table('histories')
        ->where('user_id', $userId)
                               ->where('status', 'telah membaca');

        return DB::table('notes')
                ->LeftJoinSub($readHistoriesByUserId, 'histories', function ($join) {
                    $join->on('notes.id', '=', 'histories.note_id');
                })->get();
    }

    public function myNotes($id)
    {
        return $this->where($id);
    }

    public function notedetail()
    {
        return $this->hasMany(NoteDetail::class);
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function noteImages()
    {
        return $this->hasMany(Note_Image::class);
    }

    public function readHistories()
    {
        return $this->hasMany(History::class)->where('status', 'telah membaca')->where('is_read', true);
    }

    public function scopeUser($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }

    public function readHistoriesByThisUser($id)
    {
        return $this->hasMany(History::class)->where('status', 'telah membaca')->where('user_id', $id)->where('is_read', true);
    }
    
    public function updateHistories()
    {
        return $this->hasMany(History::class)->where('status', 'telah mengedit')->where('is_updated', true);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function unReadNotes()
    {
        $allNotes = $this->readHistories;
    }
}
