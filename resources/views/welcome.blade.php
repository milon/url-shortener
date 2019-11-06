@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="url" class="col-md-4 col-form-label text-md-right">{{ __('Long URL') }}</label>

                        <div class="col-md-6">
                            <input id="url" type="url" class="form-control @error('url') is-invalid @enderror" name="url" placeholder="Long URL goes here..." autocomplete="off" autofocus>

                            @error('url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Shorten URL') }}
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
