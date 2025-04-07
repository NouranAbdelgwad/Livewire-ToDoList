<div class="container text-center">
    <h1>Form Data</h1>
    @if (session('success'))
    <div class="alert alert-success" role="alert">
        <strong>{{session('success')}}</strong>
    </div>
    @endif
    <form wire:submit="createNewUser">
        <input type="text" wire:model="name" placeholder="Name" class="form-control">
        @error('name')
            <p class="text-danger">{{$message}}</p>
        @enderror
        <input type="email" wire:model="email" placeholder="Email" class="form-control">
        @error('email')
            <p class="text-danger">{{$message}}</p>
        @enderror
        <input type="password" wire:model="password" placeholder="Password" class="form-control">
        @error('password')
            <p class="text-danger">{{$message}}</p>
        @enderror
        <button class="btn btn-warning mt-2">Send</button>
    </form>

    <hr>
    <table class="table-bordered" >
        @foreach ($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->password}}</td>
            </tr>
        @endforeach
    </table>

    {{$users->links()}}
</div>
