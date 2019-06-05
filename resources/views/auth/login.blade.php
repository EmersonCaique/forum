@extends('layouts.app')

@section('content')
<div class="container mx-auto">
        <div class="col-md-8">
            <div class="bg-white p-8 flex flex-col text-center shadow rounded">
                {{-- <div class="card-header">{{ __('Login') }}</div> --}}

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row  mb-2">
                            <div class="col-md-6">
                                <input
                                    id="email"
                                    type="email"
                                    class="px-2 py-3 border rounded @error('email') border border-red-500 @enderror"
                                    placeholder="JohnDoe@mail.com"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="email" autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> --}}

                            <div class="col-md-6">
                                <input
                                    id="password"
                                    type="password"
                                    placeholder="Password"
                                    class="px-2 py-3 border rounded @error('password') is-invalid @enderror"
                                    name="password"
                                    required
                                    autocomplete="current-password">


                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="bg-blue-200 px-8 py-2 rounded border mt-2">
                                    {{ __('Login') }}
                                </button>

                                {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
@endsection
