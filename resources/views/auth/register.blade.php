@extends('layouts.app')

@section('content')
    <div class="flex min-h-full items-center justify-center py-12 px-4">
        <div class="w-full max-w-md space-y-8 bg-gray-50 rounded-lg shadow-lg">
            <div class="text-center pt-8 text-xl font-bold">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end pl-10">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="ml-8 mb-5 border border-1 border-gray-200 hover:border-gray-400 shadow-lg h-10 w-4/5 rounded-md p-3 form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end pl-10">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="ml-8 mb-5 border border-1 border-gray-200 hover:border-gray-400 shadow-lg h-10 w-4/5 rounded-md p-3 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end pl-10">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="ml-8 mb-5 border border-1 border-gray-200 hover:border-gray-400 shadow-lg h-10 w-4/5 rounded-md p-3 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end pl-10">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="ml-8 mb-5 border border-1 border-gray-200 hover:border-gray-400 shadow-lg h-10 w-4/5 rounded-md p-3 form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4 flex justify-center mb-10">
                                <button type="submit" class="text-white bg-zinc-600 hover:bg-yellow-400 font-medium rounded-lg text-sm w-full
                                sm:w-auto px-5 py-2.5 text-center">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
