<div class="card">
    <div class="card-header">{{ __('API Token') }}</div>

    <div class="card-body">

        <div class="form-group row">
            <label for="api-token" class="col-md-4 col-form-label text-md-right">{{ __('API Token') }}</label>

            <div class="col-md-8">
                <input id="api-token" type="text" class="form-control " value="{{ $user->api_token }}" readonly>
            </div>
        </div>

    </div>
</div>

<br>

<div class="card">
    <div class="card-header">{{ __('Generate New API Token') }}</div>

    <div class="card-body">

        <form method="POST" action="{{ url('/generate-token') }}">
            @csrf

            <div class="form-group row mb-0">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Generate New API Token') }}
                    </button>

                    <small class="form-text text-muted">
                        <p>Generating new API key will invalidate old API key. Make sure you want to do that.</p>
                    </small>
                </div>
            </div>

        </form>

    </div>
</div>
