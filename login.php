<?php include("includes/header.php"); ?>
<?php include("includes/navbar.php"); ?>

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

<?php include("includes/footer.php"); ?>