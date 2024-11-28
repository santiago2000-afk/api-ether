<?php

namespace App\Livewire;

use Livewire\Component;

class Address extends Component
{
    public $active = 'home';

    public function setActive($section)
    {
        $this->active = $section;
    }

    public function render()
    {
        return view('livewire.address');
    }
}
