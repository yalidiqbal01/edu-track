<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container">

        <a class="navbar-brand" href="index.php">
            EDU Track
        </a>

        <button class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#menu">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="menu">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>

                <?php if(isset($_SESSION['user_id'])) { ?>

                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <span class="nav-link">
                            👋 <?php echo $_SESSION['full_name']; ?>
                        </span>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-warning" href="logout.php">Logout</a>
                    </li>

                <?php } else { ?>

                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>

                <?php } ?>

            </ul>

        </div>

    </div>

</nav>