<?php

namespace App\Livewire\Courses;

use App\Models\Course;
use App\Models\ItsCenter;
use Livewire\Component;

class EditCourse extends Component
{
    public $course_id, $nome, $citta, $inizio_corso, $fine_corso, $its_id;
    public $itsOptions = [];

    protected $rules = [
        'nome' => 'required|string|max:255',
        'its_id'  => ['required', 'exists:its_centers,id'],
        'inizio_corso'  => 'required|date',
        'fine_corso'    => 'required|date|after:inizio_corso',
    ];

    public function mount($id)
    {
        $course = Course::findOrFail($id);
        $this->course_id = $course->id;
        $this->nome = $course->nome;
        $this->citta = $course->citta;
        $this->inizio_corso = $course->inizio_corso;
        $this->fine_corso = $course->fine_corso;
        $this->its_id = $course->its_id;

        $this->itsOptions = ItsCenter::all();
    }

    public function update()
    {
        $this->validate();

        $course = Course::findOrFail($this->course_id);
        $course->id = $this->course_id;
        $course->nome = $this->nome;
        $course->citta = $this->citta;
        $course->inizio_corso = $this->inizio_corso;
        $course->fine_corso = $this->fine_corso;
        $course->its_id = $this->its_id;
        $course->save();

        session()->flash('message', 'Corso aggiornato con successo.');
    }

    public function render()
    {
        return view('livewire.courses.edit-course');
    }
}
