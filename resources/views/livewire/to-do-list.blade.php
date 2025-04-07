<div>
    <h1>Todo List</h1>
    <hr>

    <div class="container">
        @if (session("failed"))
        <div class="alert alert-danger" role="alert">
            <strong>{{session("failed")}}</strong>
        </div>
        @endif
        <x-todo.create-to-do-box></x-todo.create-to-do-box>
        <x-todo.search></x-todo.search>
        <x-todo.edit-box :task="$task"></x-todo.edit-box>

        @foreach ($todos as $task)
        <div class="card shadow-sm my-2">
            <div class="row px-4 py-2">
                <div class="col-1">
                    @if ($task->completed)
                        <input wire:click="toggle({{$task->id}})" class="form-check-input" type="checkbox" id="checkDefault" checked>
                    @else
                        <input wire:click="toggle({{$task->id}})" class="form-check-input" type="checkbox" id="checkDefault">
                    @endif
                </div>
                <div class="col-6">
                    <h6>{{$task->name}}</h6>
                    <p class="text-secondary">{{$task->created_at}}</p>
                </div>
                <div class="col-5 text-end">
                    <button type="button" class="bg-transparent border " wire:click="editTask({{$task->id}})" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bi bi-pencil-square text-success"></i>
                    </button>
                    <button class="bg-transparent border" data-bs-toggle="modal" data-bs-target="#edit" wire:click="deleteTask({{$task->id}})"><i class="bi bi-trash text-danger" ></i></button>
                </div>
            </div>
        </div>
        @endforeach


        <div class="d-flex justify-content-center mt-3">
            {{$todos->links()}}
        </div>


    </div>
</div>
