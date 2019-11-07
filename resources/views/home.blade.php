@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <td>Url</td>
                                <td>Shorten Link</td>
                                <td>Visits</td>
                                <td>Created At</td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($links as $link)
                                <tr>
                                    <td>{{ $link->url }}</td>
                                    <td>{{ url($link->hash) }}</td>
                                    <td>{{ $link->counter }}</td>
                                    <td>{{ $link->created_at->diffForHumans() }}</td>
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
