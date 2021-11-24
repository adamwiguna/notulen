<?php

namespace App\Http\Livewire;

use App\Models\Note;
use App\Models\Division;
use Livewire\Component;
use Livewire\WithPagination;


class ListNote extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $pageNumber = 10;
    public $search = "";

    public function mount()
    {
        (request('cari'))?
        $this->search = request('cari')
        :
        $this->search ="";
    }

    public function render()
    {
        return view('livewire.list-note', [
            'notes' => Note::with(['user', 
                                   'notedetail', 
                                   'readHistories' => function ($query) { //query untuk mengambil note yang dibaca berdasarkan user yang login
                                                            $query->where('user_id', auth()->user()->id);}, //memberikan tambahan kondisi pada orm
                                   'updateHistories' => function ($query) { //query untuk mengambil note yang dibaca berdasarkan user yang login
                                                            $query->where('user_id', auth()->user()->id); //memberikan tambahan kondisi pada orm
                       }])->latest()
                        //   ->where('judul', 'like', '%'. $this->search.'%')
                        //   ->orWhere('keterangan', 'like', '%'. $this->search.'%')
                        //   ->orWhere('user_id', 'like', '%'. $this->search.'%')
                        
                          ->search($this->search)
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
}
