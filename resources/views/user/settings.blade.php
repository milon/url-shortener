@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                @include('user._profile')
            </div>
            <div class="col-md-6">
                @include('user._api_key')
            </div>
        </div>
    </div>
@endsection
