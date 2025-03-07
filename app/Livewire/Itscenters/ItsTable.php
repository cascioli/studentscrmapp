<?php

namespace App\Livewire\Itscenters;

use App\Models\ItsCenter;
use Livewire\Component;
use Livewire\WithPagination;

class ItsTable extends Component
{
    use WithPagination;

    public $search = '';

    protected $listeners = [
        'itsCenterUpdated' => '$refresh',
    ];

    public function render()
    {
        $itscenters = ItsCenter::where('nome', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('livewire.itscenters.its-table', compact('itscenters'));
    }

    public function edit($id)
    {
        return redirect()->route('its.edit', $id);
    }
    public function store()
    {
        return redirect()->route('its.store');
    }

    public function delete($id)
    {
        $its = ItsCenter::find($id);

        if ($its) {
            $its->delete();
            session()->flash('message', 'ITS eliminato correttamente.');
        } else {
            session()->flash('error', 'ITS non trovato.');
        }
    }
}
