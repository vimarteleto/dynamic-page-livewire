<?php

namespace App\Http\Livewire\Pages;

use App\Models\Task;
use Livewire\Component;

class Tasks extends Component
{

    // public $name = 'Vinicius Marteleto';
    public $name;

    public function save()
    {
        Task::create([
            'name' => $this->name,
        ]);
    }

    public function render()
    {
        return view('livewire.pages.tasks', [
            'tasks' => Task::all()
        ]);
    }
}


/* 
* VIDEO PAUSADO EM 00:41:26
*/

