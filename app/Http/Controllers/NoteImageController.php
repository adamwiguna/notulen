<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\History;
use App\Models\Note_Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class NoteImageController extends Controller
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
        
        // dd($note->noteImages);

        return view('note.singlenote_images', [
            'notes' => $note,
            'images' => $note->noteImages->sortDesc(),
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
        $count = 1;
        
        
        $image = array();
        if ($images = $request->file('image')) {
            
            foreach ($images as $image) {
                $noteImage = new Note_Image;
                $image_name = $request->note_slug.'_'.$count.'_'.time();
                $ext = strtolower($image->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $upload_path = 'note_images/'.$request->note_slug.'/';
                $image_url = '/'.$upload_path.$image_full_name;
                $image->move($upload_path, $image_full_name);
                $noteImage->image_url = $image_url;
                $noteImage->note_id = $request->note_id;
                $noteImage->save();
                $count++;

            }

            $request->session()->flash('success', 'Berhasil menambahkan Foto');
        }
        // return redirect('/users');
        return redirect()->action(
            [NoteImageController::class, 'index'], 
            ['note' => $request->note_slug]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note_Image  $note_Image
     * @return \Illuminate\Http\Response
     */
    public function show(Note_Image $note_Image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note_Image  $note_Image
     * @return \Illuminate\Http\Response
     */
    public function edit(Note_Image $note_Image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note_Image  $note_Image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note_Image $note_Image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note_Image  $note_Image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note_Image $note_Image)
    {
        // dd($note_Image->id);

        $note = Note::find($note_Image->note_id);
        // dd($note);
	    File::delete(public_path($note_Image->image_url));
        //Storage::delete($note_Image->image_url);
        Note_Image::where('id', $note_Image->id)->delete();
        // $gambar = Gambar::where('id',$id)->first();

        return redirect()->action(
            [NoteImageController::class,'index'], 
            ['note' => $note->slug])
            ->with('success', 'Foto telah terhapus');
    }
}
