<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NoteContents extends Component
{
    public $noteContents = [];

    public function mount()
    {
        (old('isi'))?
        // dd(old('isi.0'))
        $this->noteContents = old('isi')
        :
        $this->noteContents = [[],[]];
    }

    public function addContent(){
        $this->noteContents[] = [];
        // dd(old('isi'));
    }

    public function removeContent($index)
    {
        // dd($this->noteContents[$index]);
        unset($this->noteContents[$index]);
        $this->noteContents = array_values($this->noteContents);
    }

    public function render()
    {
        return view('livewire.note-contents');
    }
}
