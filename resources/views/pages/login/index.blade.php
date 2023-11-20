@extends('layouts.auth', ['title' => 'Login'])

@section('content')
    <div class="card-body text-center mx-5">
        <h5 class="card-title mt-5">Buku Tamu</h5>
        <h5 class="card-title mb-5">PT. Semen Baturaja</h5>
        <form method="post" autocomplete="off">
            {{ csrf_field() }}
            @if ($errors->first('login'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('login') }}
                </div>
            @endif
            <div class="form-floating mb-3">
                <input name="email" type="text" id="email" class="form-control" placeholder="name@example.com">
                <label for="email">Email</label>
                @if ($errors->first('login'))
                    <small class="text-danger">{{ $errors->first('email') }}</small>
                @endif
            </div>
            <div class="form-floating mb-3">
                <input name="password" type="password" class="form-control" placeholder="Enter password" autocomplete="off">
                <label for="password">Kata Sandi</label>
                @if ($errors->first('login'))
                    <small class="text-danger">{{ $errors->first('password') }}</small>
                @endif
            </div>
            <button type="submit"class="btn btn-lg btn-primary w-100 mb-1">Login</button>
            <hr>
        </form>
    </div>
@endsection
