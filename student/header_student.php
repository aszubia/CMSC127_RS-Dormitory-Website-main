<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top"> 
        <div class="container-fluid px-lg-4 mt-1">
            <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">RS Dormitory</a>

            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                    <a class="nav-link active me-2" aria-current="page" href="index.php">Home</a>
                    </li>

                    <li class="nav-item">
                    <a class="nav-link me-2" href="#">Dorms</a>
                    </li>

                    <li class="nav-item">
                    <a class="nav-link me-2" href="../contact.php">Contact Us</a>
                    </li>

                    <li class="nav-item">
                    <a class="nav-link me-2" href="../about.php">About</a>
                    </li>

                </ul>

                <div class="d-flex">
                    <?php
                    // Check if the user is logged in
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                    // Display a welcome message with the user's name
                    echo "Welcome, " . $_SESSION['first_name'] . "!";
                    } else {
                    // Redirect to the login page
                    }
                    ?>

                    <form method="post">
                        <button type="submit" name="logout" class="btn btn-primary">Logout</button>
                    </form>
                    <?php
                    if (isset($_POST['logout'])) {
                        session_destroy();
                        header('Location: ../index.php');
                      }
                      ?>
                </div>

            </div>
        </div>
    </nav>