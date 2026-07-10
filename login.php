<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | EDU Track</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-header bg-success text-white text-center">
                    <h3>Student Login</h3>
                </div>

                <div class="card-body">

                    <form>

                        <div class="mb-3">
                            <label>Email</label>
                            <input
                                type="email"
                                class="form-control"
                                placeholder="student@iub.edu.bd">
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input
                                type="password"
                                class="form-control"
                                placeholder="********">
                        </div>

                        <button class="btn btn-success w-100">
                            Login
                        </button>

                    </form>

                    <div class="text-center mt-3">
                        Don't have an account?
                        <a href="register.php">Register</a>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>