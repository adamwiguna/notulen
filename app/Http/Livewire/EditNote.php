<?php

namespace App\Http\Livewire;

use App\Models\Note;
use Livewire\Component;
use App\Models\NoteDetail;

class EditNote extends Component
{
    public Note $note;
    public $noteContents = [];
    public $judul;
    public $pemimpin;
    public $keterangan;
    public $tanggal;

    public function mount($note)
    {
        $this->note = $note;
        // foreach ($note->notedetail as $notedetail) {
        //     $this->noteContents[] = $notedetail->isi_note;
        // }

        $this->judul = old('judul', $note->judul);
        $this->pemimpin = old('pemimpin', $note->pemimpin);
        $this->keterangan = old('keterangan', $note->keterangan);
        $this->tanggal = old('tanggal', $note->tanggal);
        
        if(old('isi')){
            $this->noteContents = old('isi');
        }else{
            foreach ($note->notedetail as $notedetail) {
                $this->noteContents[] = $notedetail->isi_note;
            }
        };
        
        
    }

    public function addContent(){
        $this->noteContents[] = '';
    }

    public function removeContent($index)
    {
        // dd($this->noteContents[$index]);
        unset($this->noteContents[$index]);
        $this->noteContents = array_values($this->noteContents);
    }

    public function render()
    {
        return view('livewire.edit-note');
    }
}
