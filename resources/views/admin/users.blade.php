@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Users') }}</div>

                    <div class="card-body">

                        <table class="table">
                            <thead>
                            <tr>
                                <td>{{ __('Name') }}</td>
                                <td>{{ __('Email') }}</td>
                                <td>{{ __('Is Admin') }}</td>
                                <td>{{ __('Links') }}</td>
                                <td>{{ __('Created At') }}</td>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->isAdminLabel }}</td>
                                    <td>{{ $user->links_count }}</td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No links yet!</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        {{ $users->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
