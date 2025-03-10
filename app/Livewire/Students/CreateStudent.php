<?php

namespace App\Livewire\Students;

use App\Models\Course;
use App\Models\Student;
use App\Models\ItsCenter;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;

class CreateStudent extends Component
{
    public $name, $email, $password, $password_confirmation, $its_id;
    public $itsOptions = [];
    public $courses = [];
    public $selectedCourses = [];

    public function mount()
    {
        $this->itsOptions = ItsCenter::all();

        if ($this->its_id != null) {
            $this->courses = Course::where('its_id', $this->its_id)->get();
        }
    }

    public function updatedItsId($value)
    {
        $this->courses = Course::where('its_id', $value)->get();
        $this->selectedCourses = [];
    }

    public function store()
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . Student::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'its_id'  => ['required', 'exists:its_centers,id'],
        ]);

        /* $student = new Student;
        $student->name = $this->name;
        $student->email = $this->email;
        //$student->email_verified_at = $this->email_verified_at;
        $student->password = Hash::make($this->password);
        $student->its_id = $this->its_id;
        //$student->save(); */

        $validated['password'] = Hash::make($this->password);

        session()->flash('message', 'Studente creato con successo.');
        //$this->reset(['name', 'email', 'password', 'its_id']);

        event(new Registered(($student = Student::create($validated))));

        $student->courses()->sync($this->selectedCourses);

        redirect()->route('students.list');
    }

    public function render()
    {
        return view('livewire.students.create-student');
    }
}
