<?php

namespace App\Livewire;

use App\Models\Todo;
use Exception;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class ToDoList extends Component
{
    use WithPagination;
    #[Rule("required|min:3")]
    public $name;
    public $search;
    public $task;
    public $selectedName;
    public $selectedID;
    public function createTask(){
        //validate
        $this->validateOnly("name");
        //create
        Todo::create([
            "name"=>$this->name,
        ]);
        //clear the input
        $this->reset(["name"]);
        //flash message
        session()->flash("success", "Created.");

        //back to page one
        $this->resetPage();
    }
    public function deleteTask($todoID){
        try{
        Todo::findOrFail($todoID)->delete();
        }catch(Exception $e){
            session()->flash("failed", "This Task has been deleted before");
        }
    }
    public function editTask(Todo $todo){
        $this->task = $todo;
        $this->selectedName = $todo->name;
        $this->selectedID = $todo->id;
    }
    public function updateTask(){
        $todo = Todo::findOrFail($this->selectedID);
        $todo->update([
            "name" => $this->selectedName
        ]);
        $this->redirect(request()->header('Referer'));


    }
    public function toggle(Todo $todo){
        $todo->completed = !$todo->completed;
        $todo->save();
    }
    public function render()
    {
        $todos = Todo::latest()->where("name", "like", "%{$this->search}%")->simplePaginate(5);
        return view('livewire.to-do-list', ['todos'=> $todos]);
    }
}
