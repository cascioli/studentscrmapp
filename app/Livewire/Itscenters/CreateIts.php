<?php

namespace App\Livewire\Itscenters;

use App\Models\ItsCenter;
use Livewire\Component;

class CreateIts extends Component
{
    public $nome;

    protected $rules = ['nome' => 'required|string|max:255'];

    public function store()
    {
        $this->validate();

        $itscenter = new ItsCenter;
        $itscenter->nome = $this->nome;

        $itscenter->save();


        session()->flash('message', 'ITS creato con successo.');
        $this->reset(['nome']);

        redirect()->route('its.list');
    }

    public function render()
    {
        return view('livewire.itscenters.create-its');
    }
}
