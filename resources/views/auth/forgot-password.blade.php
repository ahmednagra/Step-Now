<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Passwort vergessen | StepNow Rides Admin</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=source-sans-pro:300,400,400i,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/admin/css') }}/adminlte.min.css">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    {{-- Cloudflare Zaraz removed; see auth/login.blade.php for context. --}}
</head>

<body class="login-page" style="min-height: 496.781px;">
    <div class="login-box">
        <div class="login-logo">
            <img src="{{ $setting->logo ? asset($setting->logo) : asset('logo.png') }}" width="300px" alt="StepNow">
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Bitte geben Sie Ihre E-Mail-Adresse ein</p>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <label for="email" class="visually-hidden">E-Mail</label>
                        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                               placeholder="E-Mail">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary btn-block">
                                Passwort-Reset-Link senden
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/adminlte.min.js') }}"></script>

    <style>
        .visually-hidden {
            position: absolute !important; width: 1px; height: 1px;
            padding: 0; margin: -1px; overflow: hidden;
            clip: rect(0,0,0,0); white-space: nowrap; border: 0;
        }
    </style>
</body>

</html>
