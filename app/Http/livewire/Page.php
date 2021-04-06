<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Page extends Component
{
    public $title, $page;
    public function mount($title)
    {
        $this->title= $title;

    }
    public function render()
    {

        $this->page = \App\Models\Page::where('user_id', Auth::user()->id)
            ->where('title', '=', $this->title)
            ->get();
        return view('livewire.page');

    }
}
