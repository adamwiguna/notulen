<?php

namespace App\Http\Livewire;


use App\Models\Note;
use App\Models\Division;
use Livewire\Component;
use Livewire\WithPagination;

class MyListNote extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $pageNumber = 10;
    public $search = "";

    public function render()
    {
        return view('livewire.my-list-note', [
            'notes' => Note::where('user_id', auth()->user()->id)
                          ->latest()
                          ->search($this->search)
                          ->paginate($this->pageNumber)
                          ->withQueryString(),
            'title' => 'Daftar Note',
            'nav' => 'notes',
            'breadcrumb1' => 'saya',
            'navnote' => 'my',
            'createNote' => 'notes',
        
        ]);
    }
}
