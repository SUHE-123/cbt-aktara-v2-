<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login CBT AKTARA V2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            background: url("<?= base_url('assets/img/wisuda.jpg') ?>") no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            position: relative;
        }

        /* Layer blur */
        .bg-blur {
            backdrop-filter: blur(7px);
            background-color: rgba(0, 0, 0, 0.4);
            position: absolute;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
        }

        .login-container {
            position: relative;
            z-index: 2;
        }

        .login-card {
            background-color: rgba(255, 255, 255, 0.92);
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>

<!-- Blur Background Layer -->
<div class="bg-blur"></div>

<!-- Login Box -->
<div class="container login-container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="col-md-4">
        <div class="card login-card">
            <div class="card-header bg-dark text-white text-center">
                <h5 class="mb-0">Login CBT AKTARA V2</h5>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                <form action="<?= base_url('login') ?>" method="post">
                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
