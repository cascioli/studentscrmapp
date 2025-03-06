<?php

namespace App\Livewire\Students;

use Livewire\Component;
use App\Models\Student;
use Livewire\WithPagination;

class StudentsTable extends Component
{
    use WithPagination;

    protected $listeners = [
        'studentUpdated' => '$refresh',
    ];

    public function render()
    {
        $students = Student::orderBy('id', 'asc')
            ->paginate(10);

        return view('livewire.students.students-table', compact('students'));
    }

    public function edit($id)
    {
        return redirect()->route('students.edit', $id);
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
