<?php

namespace App\Livewire\Students;

use App\Models\Course;
use App\Models\ItsCenter;
use Livewire\Component;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class EditStudent extends Component
{
    public $student_id, $name, $email, $email_verified_at, $password, $its_id;
    public Student $student;
    public $itsOptions = [];
    public $courses = [];
    public $selectedCourses = [];

    protected $rules = [
        'name'         => 'required|string|max:255',
        'email'        => 'required|email|max:255',
        'its_id' => 'required|exists:its_centers,id',
    ];

    public function mount($id)
    {
        $student = Student::findOrFail($id);
        $this->student = $student;
        $this->student_id = $student->id;
        $this->name = $student->name;
        $this->email = $student->email;
        $this->email_verified_at = $student->email_verified_at ? $student->email_verified_at->format('Y-m-d\TH:i') : null;
        $this->its_id = $student->its_id;

        $this->itsOptions = ItsCenter::all();
        $this->courses = Course::where('its_id', $student->its_id)->get();

        $this->selectedCourses = $student->courses->pluck('id')->toArray();
    }

    public function update()
    {
        $this->validate();

        $student = Student::findOrFail($this->student_id);
        $student->name = $this->name;
        $student->email = $this->email;
        $student->email_verified_at = $this->email_verified_at;
        if ($this->password) {
            $student->password = Hash::make($this->password);
        }

        if ($student->its_id != $this->its_id) {
            $student->courses()->detach();
        }

        $student->its_id = $this->its_id;
        $student->save();

        $student->courses()->sync($this->selectedCourses);

        session()->flash('message', 'Studente aggiornato con successo.');
    }

    public function updatedItsId($value)
    {
        $this->courses = Course::where('its_id', $value)->get();

        $this->selectedCourses = [];
    }

    public function removeCourse($courseId)
    {
        $this->student->courses()->detach($courseId);

        $this->selectedCourses = $this->student->courses->pluck('id')->toArray();

        session()->flash('success', 'Corso rimosso correttamente!');
    }

    public function render()
    {
        return view('livewire.students.edit-student');
    }
}
