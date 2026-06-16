@extends('layouts.log-res')

@section('content')
<section class="container">
    <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
        <div class="container">
            <div class="row gx-lg-5 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="my-5 display-3 fw-bold ls-tight">
                        Welcome<br />
                        <span class="text-primary">to our platform!</span>
                    </h1>
                    <p style="color: hsl(217, 10%, 50.8%)">
                        Let's start enhancing your skills <br>and making your dreams come true with us.
                    </p>
                </div>
        
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="card">
                        <div class="card-body py-5 px-md-5">
                            <div class="header fs-2">{{ __('Register') }}</div>

                            <br>

                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <!-- Email input -->
                                <div data-mdb-input-init class="form-outline mb-2">
                                    <label for="name" class="col-form-label text-md-end">{{ __('Name') }}</label>

                                    <div>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div data-mdb-input-init class="form-outline mb-2">
                                    <label for="email" class="col-form-label text-md-end">{{ __('Email Address') }}</label>

                                    <div>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                
                                <!-- Password input -->
                                <div data-mdb-input-init class="form-outline mb-2">
                                    <label for="password" class="col-form-label text-md-end">{{ __('Password') }}</label>

                                    <div class="">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label for="password-confirm" class="col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                    <div>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                <br>

                                <!-- Login button -->
                                <div class="row mb-0">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary w-100">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jumbotron -->
  </section>
@endsection
