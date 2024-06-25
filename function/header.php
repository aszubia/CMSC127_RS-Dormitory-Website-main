<style>
    * {
        font-family: 'Poppins', sans-serif;
    }

    .h-font {
        font-family: 'Merienda', cursive;
    }
</style>

<div class="container-fluid bg-dark text-light p-3 d-flex align-items-center justify-content-between sticky-top">
    <h3 class="mb-0 h-font">RS DORMITORY</h3>
    <a href="../admin/logout.php" class="btn btn-light btn-sm">LOG OUT</a>
</div>

<div class="col-lg-2 bg-dark border-top border-3 border-secondary" style="position: fixed; height: 100%;">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid flex-lg-column align-items-stretch">
            <h4 class="mt-2 text-light">ADMIN PANEL</h4>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#adminDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="adminDropdown">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../admin/dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../function/searchRoom.php">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../function/searchStudent.php">Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../function/searchLog.php">Logs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../function/searchPay.php">Payment</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
</div>