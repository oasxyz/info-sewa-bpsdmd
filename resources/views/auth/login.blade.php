<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin-login.css') }}">
</head>
<body>

<div class="login-page">
    <header class="top-header">
        <div class="container d-flex align-items-center">
            <img src="{{ asset('images/logo-jateng.png') }}" class="header-logo">
            <div class="ms-3">
                <h4>SISTEM INFORMASI PEMESANAN GEDUNG</h4>
                <p>BPSDMD Provinsi Jawa Tengah</p>
            </div>
        </div>
    </header>

    <div class="login-container">
        <img src="{{ asset('images/logo-jateng.png') }}" class="login-logo">
        <h5>Masuk Sebagai Admin</h5>
        <div class="divider"></div>

        @if(session('error'))
            <div class="alert alert-danger py-2 text-center" style="font-size: 0.9rem;">
                {{ session('error') }}
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success py-2 text-center" style="font-size: 0.9rem;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.login.proses') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-4">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn-login">Masuk</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>