@extends('../base')

@section('title')Registration @endsection

@section('public')
<div class="public-form">
    <h1>Registration</h1>
    <form method="POST" action="{{ route('user.registration') }}">
        @csrf
        <div class="mb-3">
            <label for="login" class="form-label">Login</label>
            <input class="form-control" type="text" id="login" name="login" placeholder="Login">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input class="form-control" type="password" id="password" name="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-success">Sign up</button>
    </form>
</div>
@endsection