<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class Materielcomp extends Component
{
    public function render()
    {
         Carbon::setLocale("fr");

        return view('livewire.materiel.index');
        
    }
}
