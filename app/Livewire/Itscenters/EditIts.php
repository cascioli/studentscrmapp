<?php

namespace App\Livewire\Itscenters;

use App\Models\ItsCenter;
use Livewire\Component;

class EditIts extends Component
{
    public $its_id, $nome;

    protected $rules = [
        'nome'         => 'required|string|max:255',
    ];

    public function mount($id)
    {
        $itscenter = ItsCenter::findOrFail($id);
        $this->its_id = $itscenter->id;
        $this->nome = $itscenter->nome;
    }

    public function update()
    {
        $this->validate();

        $itscenter = ItsCenter::findOrFail($this->its_id);
        $itscenter->nome = $this->nome;
        $itscenter->save();

        session()->flash('message', 'ITS aggiornato con successo.');
    }

    public function render()
    {
        return view('livewire.itscenters.edit-its');
    }
}
