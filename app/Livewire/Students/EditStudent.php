<?php

namespace App\Livewire\Students;

use App\Models\ItsCenter;
use Livewire\Component;
use App\Models\Student;

class EditStudent extends Component
{
    public $student_id, $name, $email, $email_verified_at, $password, $its_id;
    public $itsOptions = [];

    protected $rules = [
        'name'         => 'required|string|max:255',
        'email'        => 'required|email|max:255',
        'its_id' => 'required|exists:its_centers,id',
    ];

    public function mount($id)
    {
        $student = Student::findOrFail($id);
        $this->student_id = $student->id;
        $this->name = $student->name;
        $this->email = $student->email;
        $this->email_verified_at = $student->email_verified_at ? $student->email_verified_at->format('Y-m-d\TH:i') : null;
        $this->its_id = $student->its_id;

        $this->itsOptions = ItsCenter::all();
    }

    public function update()
    {
        $this->validate();

        $student = Student::findOrFail($this->student_id);
        $student->name = $this->name;
        $student->email = $this->email;
        $student->email_verified_at = $this->email_verified_at;
        if ($this->password) {
            $student->password = bcrypt($this->password);
        }
        $student->its_id = $this->its_id;
        $student->save();

        session()->flash('message', 'Studente aggiornato con successo.');
    }

    public function render()
    {
        return view('livewire.students.edit-student');
    }
}
