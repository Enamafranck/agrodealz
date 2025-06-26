<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class Utilisateurs extends Component
{
    use WithPagination;
    public $layout = 'layouts.master';

    public function render()
    {
        $users = User::paginate();

        return view('livewire.utilisateurs', compact('users'));
               
    }

    public bool $isBtnAddClicked = false;
    public $newUser = ["nom_complet"=>"valeur",];

    public function goToAddUser()
    {
    $this->isBtnAddClicked = true;
   }

}
