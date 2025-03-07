<?php

namespace App\Livewire\Courses;

use App\Models\Course;
use App\Models\ItsCenter;
use Livewire\Component;

class CreateCourse extends Component
{
    public $nome, $citta, $inizio_corso, $fine_corso, $its_id;
    public $itsOptions = [];

    protected $rules = [
        'nome' => 'required|string|max:255',
        'its_id'  => ['required', 'exists:its_centers,id'],
        'inizio_corso'  => 'required|date',
        'fine_corso'    => 'required|date|after:inizio_corso',
    ];

    public function mount()
    {
        $this->itsOptions = ItsCenter::all();
    }

    public function store()
    {

        $course = new Course;
        $course->nome = $this->nome;
        $course->citta = $this->citta;
        $course->inizio_corso = $this->inizio_corso;
        $course->fine_corso = $this->fine_corso;
        $course->its_id = $this->its_id;

        $course->save();

        session()->flash('message', 'Corso creato con successo.');

        redirect()->route('courses.list');
    }

    public function render()
    {
        return view('livewire.courses.create-course');
    }
}
