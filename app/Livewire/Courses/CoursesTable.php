<?php

namespace App\Livewire\Courses;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class CoursesTable extends Component
{
    use WithPagination;

    public $search = '';

    protected $listeners = [
        'coursesUpdated' => '$refresh',
    ];

    public function render()
    {
        $courses = Course::with('its')
            ->where('nome', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('livewire.courses.courses-table', compact('courses'));
    }

    public function edit($id)
    {
        return redirect()->route('courses.edit', $id);
    }
    public function store()
    {
        return redirect()->route('courses.store');
    }

    public function delete($id)
    {
        $course = Course::find($id);

        if ($course) {
            $course->delete();
            session()->flash('message', 'Corso eliminato correttamente.');
        } else {
            session()->flash('error', 'Corso non trovato.');
        }
    }
}
