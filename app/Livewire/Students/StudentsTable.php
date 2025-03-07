<?php

namespace App\Livewire\Students;

use Livewire\Component;
use App\Models\Student;
use Illuminate\Support\Facades\Log;
use Livewire\WithPagination;

class StudentsTable extends Component
{
    use WithPagination;

    public $search = '';

    protected $listeners = [
        'studentUpdated' => '$refresh',
    ];

    public function render()
    {
        $students = Student::with('its')
            ->where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('livewire.students.students-table', compact('students'));
    }

    public function edit($id)
    {
        return redirect()->route('students.edit', $id);
    }
    public function store()
    {
        return redirect()->route('students.store');
    }

    public function delete($id)
    {
        $student = Student::find($id);

        if ($student) {
            $student->delete();
            session()->flash('message', 'Studente eliminato correttamente.');
        } else {
            session()->flash('error', 'Studente non trovato.');
        }
    }
}
