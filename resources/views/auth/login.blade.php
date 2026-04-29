<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anmelden | StepNow Rides Admin</title>

    {{-- Privacy-friendly font (was: fonts.googleapis.com) --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=source-sans-pro:300,400,400i,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/admin/css') }}/adminlte.min.css">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    {{--
        NOTE: Cloudflare Zaraz tracking script has been REMOVED from this
        view. Zaraz collects screen size, page URL, referrer, and writes
        _zaraz_* keys to localStorage — that is non-essential tracking
        and would require user consent under § 25 TDDDG. If you ever
        re-enable Zaraz at the Cloudflare dashboard level, gate it
        behind window.stepnowConsent.statistics === true.
    --}}
</head>

<body class="login-page" style="min-height: 496.781px;">
    <div class="login-box">
        <div class="login-logo">
            <img src="{{ $setting->logo ? asset($setting->logo) : asset('logo.png') }}" width="300px" alt="StepNow">
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Bitte melden Sie sich an</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <label for="email" class="visually-hidden">E-Mail</label>
                        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" autocomplete="email" autofocus required
                               placeholder="E-Mail">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <label for="password" class="visually-hidden">Passwort</label>
                        <input type="password" id="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" autocomplete="current-password" required
                               placeholder="Passwort">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <label>
                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    Angemeldet bleiben
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Anmelden</button>
                        </div>
                    </div>
                </form>

                @if (Route::has('password.request'))
                    <p class="mb-0 mt-3">
                        <a href="{{ route('password.request') }}">Passwort vergessen?</a>
                    </p>
                @endif
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
