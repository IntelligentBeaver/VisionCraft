<?php

namespace App\Livewire;
use App\Models\User;

use Livewire\Component;

class Clicker extends Component
{

    public function render()
    {
        $title = "Test";
        $total = User::all();
        return view('livewire.clicker',[
        'title'=> $title,
        'total'=>$total,
    ]);
    }
}