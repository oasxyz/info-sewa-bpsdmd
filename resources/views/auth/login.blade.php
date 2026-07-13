<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin-login.css') }}">

</head>

<body>

<div class="login-page">

    <!-- HEADER -->
    <header class="top-header">

        <div class="container d-flex align-items-center">

            <img src="{{ asset('images/logo-jateng.png') }}" class="header-logo">

            <div class="ms-3">

                <h4>SISTEM INFORMASI PEMESANAN GEDUNG</h4>

                <p>BPSDMD Provinsi Jawa Tengah</p>

            </div>

        </div>

    </header>

    <!-- LOGIN -->
    <div class="login-container">

        <img src="{{ asset('images/logo-jateng.png') }}" class="login-logo">

        <h5>Masuk Sebagai Admin</h5>

        <div class="divider"></div>

        <form action="{{ url('/admin/login') }}" method="POST">

            @csrf

            <div class="mb-3">

                <label>Username</label>

                <input
                    type="text"
                    name="username"
                    class="form-control">

            </div>

            <div class="mb-4">

                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    class="form-control">

            </div>

            <button type="submit" class="btn-login">

                Masuk

            </button>

        </form>

    </div>

    <!-- FOOTER -->
    <footer class="footer">

        <div class="container">

            <div class="row">

                <div class="col-md-4">

                    <h5>BPSDMD <br> PROVINSI JAWA TENGAH</h5>

                    <p>
                        Jl. Setiabudi No.201 A Semarang 50263
                        <br>
                        Telepon : 024-7460666
                        <br>
                        Faksimile : 7473701
                        <br>
                        Email : bpsdmd@jatengprov.go.id
                    </p>

                </div>

                <div class="col-md-4">

                    <h5>Link Terkait</h5>

                    <a href="#">Website BPSDMD</a>

                    <br>

                    <a href="#">PPID BPSDMD</a>

                </div>

                <div class="col-md-4 text-md-end">

                    <h5>Follow Us</h5>

                    <i class="bi bi-instagram fs-4"></i>

                    <i class="bi bi-facebook fs-4 ms-2"></i>

                    <i class="bi bi-twitter-x fs-4 ms-2"></i>

                </div>

            </div>

        </div>

    </footer>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>