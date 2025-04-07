<div>
    <h4><b>Create New Todo</b></h4>
    <form wire:submit="createTask">
        <h6>*Todo</h6>
        <input type="text" placeholder="Task.." wire:model="name" class="form-control">
        @error('name')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="mt-2 d-flex align-items-center">
            <button class="btn btn-primary">Create+ </button>
            @if (session("success"))
            <p class="btn text-success">{{session("success")}}</p>
            @endif
        </div>
    </form>
    <hr>
</div>
