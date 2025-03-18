<!DOCTYPE html>

<html data-bs-theme="dark">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>404 - Page Not Found</title>
    </head>
    <body class="d-flex align-items-center justify-content-center vh-100">
        <div class="container">
            <div class="text-center">
                <h1 class="display-1 fw-bold text-danger">404</h1>
                <h2 class="fs-3">Oops! Page Not Found</h2>
                <p class="lead text-muted">The page you're looking for doesn't exist or was moved.</p>
                <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go Back Home</a>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </body>
</html>
