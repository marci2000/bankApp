@extends('layouts.app')

@section('content')
    <div class="flex min-h-full items-center justify-center py-12 px-4">
        <div class="w-full max-w-md space-y-8 bg-gray-50 rounded-lg shadow-lg">
                <div class="text-center pt-8 text-xl font-bold">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end pl-10">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                       class="ml-8 mb-5 border border-1 border-gray-200 hover:border-gray-400 shadow-lg h-10 w-4/5 rounded-md p-3 form-control @error('email') is-invalid @enderror ml-9 my-2 border" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                <div class="pl-10 pb-5">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end pl-10">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                       class="ml-8 mb-5 border border-1 border-gray-200 hover:border-gray-400 shadow-lg h-10 w-4/5 rounded-md p-3 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                <div class="pl-10 pb-5">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="col-md-8 offset-md-4 pb-10 flex items-center justify-center">
                                <button type="submit" class="text-white bg-zinc-600 hover:bg-yellow-400 font-medium rounded-lg text-sm w-full
                                sm:w-auto px-5 py-2.5 text-center">
                                    {{ __('Login') }}
                                </button>
                            </div>

                            <div class="ml-10 mb-5">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
