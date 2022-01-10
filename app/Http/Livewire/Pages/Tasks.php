<?php

namespace App\Http\Livewire\Pages;

use App\Models\Task;
use Livewire\Component;

class Tasks extends Component
{

    public $name;
    public $search;
    public $task;

    public function save()
    {
        if (empty($this->task)) {
            Task::create([
                'name' => $this->name,
            ]);

        } else {

            Task::where('id', $this->task->id)->update([
                'name' => $this->name
            ]);

            $this->reset('task');
        }

        // reseta a variavel para o valor declarado após o submit
        $this->reset('name');
    }
    

    public function edit($id)
    {
        $this->task = Task::find($id);
        $this->name = $this->task->name;
    }


    public function delete($id)
    {
        Task::find($id)->delete();
    }


    public function done($id)
    {
        Task::find($id)->update([
            'done' => true
        ]);

    }

    
    public function cancel()
    {
        $this->reset();
    }


    public function render()
    {
        // trazendo todas as tasks do banco de dados
        // return view('livewire.pages.tasks', [
        //     'tasks' => Task::all()
        // ]);

        // trazendo as tasks de acordo com o input search
        return view('livewire.pages.tasks', [
            'tasks' => Task::when('search', function ($query) {
                return $query->where('name', 'like', "%$this->search%");
            })->get()
        ]);
    }
}
