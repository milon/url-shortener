@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Links Detail') }}</div>

                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>{{ __('URL') }}</td>
                                    <td>{{ $link->url }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Shorten Link') }}</td>
                                    <td>{{ secure_url($link->hash) }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Created At') }}</td>
                                    <td>{{ $link->created_at->diffForHumans() }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Is Private') }}</td>
                                    <td>{{ $link->isPrivateLabel }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Allowed Emails') }}</td>
                                    <td>{{ $link->allowedEmailLabel }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <h4>{{ __('Visitors') }}</h4>
                        <table class="table">
                            <thead>
                            <tr>
                                <td>{{ __('IP') }}</td>
                                <td>{{ __('OS') }}</td>
                                <td>{{ __('Browser') }}</td>
                                <td>{{ __('Device') }}</td>
                                <td>{{ __('Visited At') }}</td>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse ($visitors as $visitor)
                                <tr>
                                    <td>{{ $visitor->ip }}</td>
                                    <td>{{ $visitor->os }}</td>
                                    <td>{{ $visitor->browser }}</td>
                                    <td>{{ $visitor->device }}</td>
                                    <td>{{ $visitor->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No visitor yet!</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        {{ $visitors->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
