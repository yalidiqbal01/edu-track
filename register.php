<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration | EDU Track</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header bg-primary text-white text-center">
                    <h3>Student Registration</h3>
                </div>

                <div class="card-body">

                    <form>

                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Enter your full name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Student ID</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="2210XXXX">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input
                                type="email"
                                class="form-control"
                                placeholder="student@iub.edu.bd">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input
                                type="password"
                                class="form-control"
                                placeholder="********">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input
                                type="password"
                                class="form-control"
                                placeholder="********">
                        </div>

                        <button class="btn btn-primary w-100">
                            Register
                        </button>

                    </form>

                    <div class="text-center mt-3">
                        Already have an account?

                        <a href="login.php">
                            Login
                        </a>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>