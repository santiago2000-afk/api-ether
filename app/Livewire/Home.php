<?php

namespace App\Livewire;

use Livewire\Component;

class Home extends Component
{
    public $currentPage = 'home';

    public function render()
    {
        return view('livewire.home');
    }

    public function changePage($page)
    {
        $this->currentPage = $page;
    }
}
