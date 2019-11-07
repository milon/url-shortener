@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <td>{{ __('Url') }}</td>
                                <td>{{ __('Shorten Link') }}</td>
                                <td>{{ __('Visitors') }}</td>
                                <td>{{ __('Created At') }}</td>
                                <td>{{ __('Details') }}</td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($links as $link)
                                <tr>
                                    <td>{{ $link->url }}</td>
                                    <td>{{ url($link->hash) }}</td>
                                    <td>{{ $link->visitors_count }}</td>
                                    <td>{{ $link->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ url("links/{$link->id}") }}">{{ __('Show') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $links->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
