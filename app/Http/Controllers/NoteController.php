<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\History;
use App\Models\Division;
use App\Models\Attendance;
use App\Models\NoteDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\NoteController;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\Console\Input\Input;

class NoteController extends Controller
{
    private $pageNumber = 10;

    public static function countNewNotes()
    {
        return count(Note::whereDoesntHave('histories', function(Builder $query){
            $query->where('user_id', auth()->user()->id);
            $query->where('is_read', true);
            $query->where('status', 'telah membaca');
        })->get());
    }

    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAllNotes', Note::class)) {
            return redirect()->action([NoteController::class, 'listMyNote']);
        }
        return view('note', [
            'notes' => Note::with(['user', 
                                   'notedetail', 
                                   'readHistories' => function ($query) { //query untuk mengambil note yang dibaca berdasarkan user yang login
                                                            $query->where('user_id', auth()->user()->id);}, //memberikan tambahan kondisi pada orm
                                   'updateHistories' => function ($query) { //query untuk mengambil note yang dibaca berdasarkan user yang login
                                                            $query->where('user_id', auth()->user()->id); //memberikan tambahan kondisi pada orm
                       }])->latest()
                          ->filter(request(['cari']))
                          ->paginate($this->pageNumber)
                          ->withQueryString(),
            'title' => 'Daftar Note',
            'nav' => 'notes',
            'breadcrumb1' => 'semua',
            'createNote' => 'notes',
            'navnote' => 'all',
            'divisions' => Division::all(),
        ]);
    }

    public function listNew(Request $request)
    {
        if ($request->user()->cannot('viewNewNotes', Note::class)) {
            return redirect()->action([NoteController::class, 'listMyNote']);
        }
        return view('note', [
            'notes' => Note::whereDoesntHave('histories', function(Builder $query){
                $query->where('user_id', auth()->user()->id);
                $query->where('is_read', true);
                $query->where('status', 'telah membaca');
            })->latest()->paginate($this->pageNumber),
            'countNewNotes' => $this->countNewNotes(),
            'title' => 'Daftar Note',
            'breadcrumb1' => 'baru',
            'nav' => 'notes',
            'navnote' => 'new',
            'createNote' => 'notes',
        ]);
    }

    public function listMyNote(Request $request)
    {
       $note = Note::where('user_id', auth()->user()->id)->get();
        return view('note', [
            'notes' => Note::where('user_id', auth()->user()->id)->latest()->paginate($this->pageNumber),
            'title' => 'Daftar Note',
            'nav' => 'notes',
            'breadcrumb1' => 'saya',
            'navnote' => 'my',
            'createNote' => 'notes',
            'countNewNotes' => $this->countNewNotes(),
        ]);
    }

    public function listDivisionNote(Request $request)
    {
        if ($request->user()->cannot('viewNotesByDivision', Note::class)) {
            return redirect()->action([NoteController::class, 'listMyNote']);
        }

        return view('note', [
        'notes' => Note::with(['user', 
                               'notedetail', 
                               'readHistories' => function ($query) { //query untuk mengambil note yang dibaca berdasarkan user yang login
                                                        $query->where('user_id', auth()->user()->id);}, //memberikan tambahan kondisi pada orm
                               'updateHistories' => function ($query) { //query untuk mengambil note yang dibaca berdasarkan user yang login
                                                        $query->where('user_id', auth()->user()->id); //memberikan tambahan kondisi pada orm
                   }])->latest()
                      ->where('division_id', auth()->user()->division_id)
                      ->filter(request(['cari']))
                      ->paginate($this->pageNumber)
                      ->withQueryString(),
        'title' => 'Daftar Note',
        'nav' => 'notes',
        'breadcrumb1' => auth()->user()->division->name,
        'navnote' => 'division',
        'createNote' => 'notes',
        'countNewNotes' => $this->countNewNotes(),
        ]);
    }

    public function listNoteByDivisions($id, Request $request)
    {
        if ($request->user()->cannot('viewAllNotes', Note::class)) {
            return redirect()->action([NoteController::class, 'listMyNote']);
        }
        $division = Division::where('id', $id)->first();
        return view('note', [
            'notes' => Note::with(['user', 
                                'notedetail', 
                                'readHistories' => function ($query) { //query untuk mengambil note yang dibaca berdasarkan user yang login
                                                            $query->where('user_id', auth()->user()->id);}, //memberikan tambahan kondisi pada orm
                                'updateHistories' => function ($query) { //query untuk mengambil note yang dibaca berdasarkan user yang login
                                                            $query->where('user_id', auth()->user()->id); //memberikan tambahan kondisi pada orm
                    }])->latest()
                        ->where('division_id', $id)
                        ->paginate($this->pageNumber)
                        ->withQueryString(),
            'title' => 'Daftar Note',
            'nav' => 'notes',
            'navnote' => 'all',
            'breadcrumb1' => $division->name,
            'navnotebydivision' => $id,
            'createNote' => 'notes',
            'divisions' => Division::all(),
            
        ]);
    }

    public function listTrashNote()
    {
        return view('note', [
            'notes' => Note::onlyTrashed()->where('user_id', auth()->user()->id)->latest()->paginate(5),
            'title' => 'Daftar Note',
            'nav' => 'notes',
            'navnote' => 'trash',
            'createNote' => 'notes',
            'countNewNotes' => $this->countNewNotes(),
        ]);
    }

    public function listAllTrashNote()
    {
        return view('note', [
            'notes' => Note::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate($this->pageNumber),
            'title' => 'Daftar Note',
            'nav' => 'notes',
            'navnote' => 'alltrash',
            'countNewNotes' => $this->countNewNotes(),
        ]);
    }

    public function show($note)
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

        return view('singlenote', [
            'notes' => $note,
            'isi' => $note->notedetail,
            'title' => $note->judul,
            'breadcrumb1' => Str::words($note->judul,7),
            'nav' => 'notes',
            'downloadNote' => 'download',
        ]);
    }

    public function formCreate()
    {
        return view('note.formcreate', [
            'title' => 'Buat Note',
            'active' => 'notes',
            'nav' => 'notes',
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|max:255',
            'keterangan' => 'required',
            'tanggal' => 'required',
            'pemimpin' => 'required',
            'hadir' => 'required',
        ]);

        $note = new Note;
        $note->judul = $validatedData[('judul')];
        $note->keterangan = $validatedData[('keterangan')];
        $note->tanggal = $validatedData[('tanggal')];
        $note->pemimpin = $validatedData[('pemimpin')];
        $note->hadir = $validatedData[('hadir')];
        $note->user_id = $request['penulis'];
        $note->slug =  Str::random(20);
        $note->division_id =  auth()->user()->division_id;
        $note->save();

        $attendance = new Attendance;
        $attendance->note_id = $note->id;
        $attendance->nama = $validatedData[('pemimpin')];
        $attendance->save();

        $attendance = new Attendance;
        $attendance->note_id = $note->id;
        $attendance->nama = $validatedData[('hadir')];
        $attendance->instansi = 'Diskominfo';
        $attendance->save();

        if ($request['isi1']) {
            $noteDetail = new NoteDetail;
            $noteDetail->isi_note = $request['isi1'];
            $noteDetail->note_id = $note->id;
            $noteDetail->save();
        }
        if ($request['isi2']) {
            $noteDetail = new NoteDetail;
            $noteDetail->isi_note = $request['isi2'];
            $noteDetail->note_id = $note->id;
            $noteDetail->save();
        }
        if ($request['isi3']) {
            $noteDetail = new NoteDetail;
            $noteDetail->isi_note = $request['isi3'];
            $noteDetail->note_id = $note->id;
            $noteDetail->save();
        }
        if ($request['isi4']) {
            $noteDetail = new NoteDetail;
            $noteDetail->isi_note = $request['isi4'];
            $noteDetail->note_id = $note->id;
            $noteDetail->save();
        }
        if ($request['isi5']) {
            $noteDetail = new NoteDetail;
            $noteDetail->isi_note = $request['isi5'];
            $noteDetail->note_id = $note->id;
            $noteDetail->save();
        }

        // Update di Tabel Histories
        $history = new History([
            'user_id' => $request['penulis'],
            'note_id' =>$note->id,
            'status' => 'telah membaca',
            'is_created' => true,
            'is_read' => true,
        ]);
        $history->save();
    
        $history = new History(
            [
                'user_id' => $request['penulis'],
                'note_id' =>$note->id,
                'status' => 'created',
                'is_created' => true,
                
            ]);
        $history->save();
      

        $request->session()->flash('success', 'Berhasil menambahkan Note');
        // return redirect('/users');
        return redirect()->action([AttendanceController::class, 'index'], [$note]);
    }

    public function edit(Request $request, Note $note)
    {
        // $this->authorize('update', $note);
        if ($request->user()->cannot('update', $note)) {
            abort(403);
        }

        //dd($note->notedetail[0]->isi_note);
        return view('note.formedit', [
            'title' => 'Edit Note',
            'note' => $note,
            'active' => 'notes',
            'nav' => 'notes',
        ]);
    }

    public function update(Request $request, Note $note)
    {
        if ($request->user()->cannot('update', $note)) {
            abort(403);
        }

        $validatedData = $request->validate([
            'judul' => 'required|max:255',
            'keterangan' => 'required',
            'tanggal' => 'required',
            'pemimpin' => 'required',
            'hadir' => 'required',
        ]);

        $note->judul = $validatedData[('judul')];
        $note->keterangan = $validatedData[('keterangan')];
        $note->tanggal = $validatedData[('tanggal')];
        $note->save();

        NoteDetail::where('note_id', $note->id)->delete();

        if ($request['isi1']) {
            $noteDetail = new NoteDetail;
            $noteDetail->isi_note = $request['isi1'];
            $noteDetail->note_id = $note->id;
            $noteDetail->save();
        }
        if ($request['isi2']) {
            $noteDetail = new NoteDetail;
            $noteDetail->isi_note = $request['isi2'];
            $noteDetail->note_id = $note->id;
            $noteDetail->save();
        }
        if ($request['isi3']) {
            $noteDetail = new NoteDetail;
            $noteDetail->isi_note = $request['isi3'];
            $noteDetail->note_id = $note->id;
            $noteDetail->save();
        }
        if ($request['isi4']) {
            $noteDetail = new NoteDetail;
            $noteDetail->isi_note = $request['isi4'];
            $noteDetail->note_id = $note->id;
            $noteDetail->save();
        }
        if ($request['isi5']) {
            $noteDetail = new NoteDetail;
            $noteDetail->isi_note = $request['isi5'];
            $noteDetail->note_id = $note->id;
            $noteDetail->save();
        }

        $history = new History([
            'user_id' => auth()->user()->id,
            'note_id' => $note->id,
            'status' => 'telah mengedit',
            'is_created' => true,
            'is_read' => true,
            'is_updated' => true,
        ]);
        
        $history->save();

        $request->session()->flash('success', 'Berhasil mengedit Note');
        // return redirect('/users');
        return redirect()->action([NoteController::class, 'listMyNote']);
    }


    public function delete(Request $request, Note $note)
    {
        if ($request->user()->cannot('update', $note)) {
            abort(403);
        }
        $history = new History([
            'user_id' => auth()->user()->id,
            'note_id' => $note->id,
            'status' => 'telah menghapus',
            'is_created' => true,
            'is_read' => true,
            'is_deleted' => true,
        ]);
        $history->save();
        
        // dd($note);

        Note::where('id', $note->id)->delete();
        
        return redirect()->action([NoteController::class, 'listMyNote'])->with('success', 'Note telah terhapus');
    }

    public function restore($note)
    {
        $note1 = Note::where('slug', $note)->withTrashed()->first();
        $history = new History([
            'user_id' => auth()->user()->id,
            'note_id' => $note1->id,
            'status' => 'telah mengembalikan',
            'is_created' => true,
            'is_read' => true,
            'is_deleted' => false,
        ]);
        $history->save();

        Note::where('slug', $note)->restore();
        return redirect()->action([NoteController::class, 'index'])->with('success', 'Note telah dikembalikan');
    }

    public function forceDelete($note)
    {   
        $note = Note::where('slug', $note)->withTrashed()->first();
        $history = new History([
            'user_id' => auth()->user()->id,
            'note_id' => $note->id,
            'status' => 'telah menghapus permanen',
            'is_created' => true,
            'is_read' => true,
            'is_deleted' => true,
        ]);
        $history->save();

        $note->forceDelete();
        NoteDetail::where('note_id', $note->id)->delete();
        return redirect()->action([NoteController::class, 'listMyNote'])->with('success', 'Note telah dihapus permanen');
    }

    public function wordExport($id)     
    {
        // dd($id);
        $note = Note::where('id', $id)->first();
        //dd(count($note->notedetail));

        if(count($note->notedetail)==1){
            $templateProcessing = new TemplateProcessor('word-template/note1.docx');
        }elseif (count($note->notedetail)==2) {
            $templateProcessing = new TemplateProcessor('word-template/note2.docx');
        }elseif (count($note->notedetail)==3) {
            $templateProcessing = new TemplateProcessor('word-template/note3.docx');
        }elseif (count($note->notedetail)==4) {
            $templateProcessing = new TemplateProcessor('word-template/note4.docx');
        }elseif (count($note->notedetail)==5) {
            $templateProcessing = new TemplateProcessor('word-template/note5.docx');
        }elseif (count($note->notedetail)==0) {
            $templateProcessing = new TemplateProcessor('word-template/note0.docx');
        };
        $templateProcessing->setValue('id', $note->id);
        $templateProcessing->setValue('judul', strtoupper($note->judul));
        $templateProcessing->setValue('keterangan', $note->keterangan);
        $templateProcessing->setValue('pemimpin', $note->pemimpin);
        $templateProcessing->setValue('hadir', $note->hadir);
        $templateProcessing->setValue('tanggal', $this->tanggal_indo($note->tanggal, true));
        
        if (!$note->user) {
            $templateProcessing->setValue('penulis', 'Anonim');
        } else {
            $templateProcessing->setValue('penulis', $note->user->name);
        }

        $no = 1;

        foreach ($note->notedetail as $notedetail) {
            $templateProcessing->setValue('notedetail'. $no, $notedetail->isi_note);
            $no++;
        }

        $fileName = $note->judul.'_'.$note->pemimpin.'_'.$note->slug.'-['.$note->tanggal.']';

        $templateProcessing->saveAs($fileName . '.docx');
        $history = new History([
            'user_id' => auth()->user()->id,
            'note_id' => $note->id,
            'status' => 'telah mendownload',
            'is_created' => true,
            'is_read' => true,
            'is_deleted' => false,
        ]);
        $history->save();

        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }

    public static function tanggal_indo($tanggal, $cetak_hari = false)
    {
        $hari = array ( 1 =>    'Senin',
                    'Selasa',
                    'Rabu',
                    'Kamis',
                    'Jumat',
                    'Sabtu',
                    'Minggu'
                );
                
        $bulan = array (1 =>   'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                );
        $split 	  = explode('-', $tanggal);
        $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
        
        if ($cetak_hari) {
            $num = date('N', strtotime($tanggal));
            return $hari[$num] . ', ' . $tgl_indo;
        }
        return $tgl_indo;
    }

}
