<?php

namespace App\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class MostrarVacante extends Component
{
    public $vacante;

    public function render(Vacante $vacante)
    {
        return view('livewire.mostrar-vacante');
    }
}
