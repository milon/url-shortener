@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <td>Url</td>
                                <td>Shorten Link</td>
                                <td>Visits</td>
                                <td></td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($links as $link)
                                <tr>
                                    <td>{{ $link->url }}</td>
                                    <td>{{ url($link->hash) }}</td>
                                    <td>{{ $link->counter }}</td>
                                    <td></td>
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
