<?php

namespace App\Livewire;

use Livewire\Component;

class MyWalles extends Component
{
    public $currentPage = 'myWalles';

    public function render()
    {
        return view('livewire.my-walles');
    }

    public function changePage($page)
    {
        $this->currentPage = $page;
    }
}
