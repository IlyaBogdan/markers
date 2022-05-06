@extends('../base')

@section('title')Login @endsection

@section('public')
<div class="public-form">
    <h1>Login</h1>
    <form method="POST" action="{{ route('user.login') }}">
        @csrf
        <div class="mb-3">
            <label for="login" class="form-label">Login</label>
            <input class="form-control" type="text" id="login" name="login" placeholder="Login">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input class="form-control" type="password" id="password" name="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-success">Sign in</button>
    </form>
</div>
@endsection