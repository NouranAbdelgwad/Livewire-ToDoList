<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class Clicker extends Component
{
    use WithPagination;

    #[Rule("required|min:8")]
    public $password;

    #[Validate("required")]
    public $name;

    #[Rule("required|unique:users|email")]
    public $email;

    public function createNewUser(){
        $this->validate();
        User::create([
            "name"=>$this->name,
            "email"=>$this->email,
            "password"=>$this->password
        ]);
        $this->reset(['name', 'email', 'password']);
        request()->session()->flash("success", "data sent successfully");
    }
    public function render()
    {
        $users = User::simplePaginate(5);
        return view('livewire.clicker', ["users"=>$users]);
    }
}
