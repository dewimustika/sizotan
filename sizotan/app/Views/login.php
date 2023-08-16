<!-- app/Views/login.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card-body">
                    <center><img src="<?= base_url('img/logo.png') ?>" rel="stylesheet"></center>
                    <h3>Sistem Informasi Zona Rawan Kejahatan</h3>
                    <h2 class="card-title text-center mb-4">Login Admin</h2>
                    <?php if (isset($error)) : ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo base_url('auth/login'); ?>">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php if (isset($error)) : ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Waduh',
                text: '<?php echo $error; ?>',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        </script>
    <?php endif; ?>
</body>

</html>