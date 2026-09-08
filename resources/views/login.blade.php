<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AdminLTE | Login</title>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
</head>

<body class="login-page bg-body-secondary">

    <main class="login-box">

        <h1 class="login-logo">
            <a href="#">
                <b>Admin</b>LTE
            </a>
        </h1>

        <div class="card">
            <div class="card-body login-card-body">

                <p class="login-box-msg">
                    Sign in to start your session
                </p>

                <!-- Login Form -->
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <!-- Email -->
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>

                        <div class="input-group-text">
                            <span class="bi bi-envelope"></span>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="input-group mb-3">
                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Password"
                            required>

                        <div class="input-group-text">
                            <span class="bi bi-lock-fill"></span>
                        </div>
                    </div>

                    <!-- Remember + Sign In -->
                    <div class="row">
                        <div class="col-8">
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="remember"
                                    id="remember">

                                <label class="form-check-label" for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    Sign In
                                </button>
                            </div>
                        </div>
                    </div>

                </form>

                <!-- Error Message -->
                @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    {{ $errors->first() }}
                </div>
                @endif

            </div>
        </div>

    </main>

    <!-- AdminLTE JS -->
    <script src="{{ asset('js/adminlte.js') }}"></script>

</body>

</html>