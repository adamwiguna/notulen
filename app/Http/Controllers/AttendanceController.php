<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\History;
use App\Models\Attendance;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($note)
    {
        //dd($note);
        $note = Note::where('slug', $note)->withTrashed()->first();
        // dd($note->id);
        $readNoteHistoryByThisUser = History::where('user_id', auth()->user()->id)
                                            ->where('status', 'telah membaca')
                                            ->where('note_id', $note->id)
                                            ->where('is_read', true)
                                            ->get();

        if (count($readNoteHistoryByThisUser ) == 0) {
            $history = new History([
                'user_id' => auth()->user()->id,
                'note_id' =>$note->id,
                'status' => 'telah membaca',
                'is_read' => true,
                'is_created' => true,
            ]);
            $history->save();
        }   
        
        // dd($note->attendances);

        return view('note.singlenote_attendances', [
            'notes' => $note,
            'attendances' => $note->attendances,
            'title' => $note->judul,
            'breadcrumb1' => Str::words($note->judul,7),
            'nav' => 'notes',
            'downloadNote' => 'download',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // if (!$request->nama) {
        //     return redirect()->back();
        // }

        $request->validate([
            'nama' => 'required',
        ]);

        $attendance = new Attendance;
        $attendance->note_id = $request->note_id;
        $attendance->nama = $request->nama;
        $attendance->instansi = $request->instansi;
        $attendance->save();

        $request->session()->flash('success', 'Berhasil menambahkan Peserta');

        return  redirect()->action(
            [AttendanceController::class, 'index'], 
            ['note' => $request->note_slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        $note = Note::find($attendance->note_id);
        Attendance::where('id', $attendance->id)->delete();

        return redirect()->action(
            [AttendanceController::class,'index'], 
            ['note' => $note->slug])
            ->with('success', 'Peserta telah terhapus');
    }
}
