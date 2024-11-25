<?php

namespace App\Livewire;

use Livewire\Component;

class Navbar extends Component
{
    public $active = 'home'; // Para manejar la sección activa

    public function setActive($section)
    {
        $this->active = $section; // Cambiar la sección activa
    }

    public function render()
    {
        return view('livewire.navbar');
    }
}
