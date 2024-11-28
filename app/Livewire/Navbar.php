<?php

namespace App\Livewire;

use Livewire\Component;

class Navbar extends Component
{
    public $currentPage = 'home';

    public function changePage($page)
    {
        $this->currentPage = $page;
    }

    public function render()
    {
        return view('livewire.navbar')->layout('layouts.app');
    }
}
