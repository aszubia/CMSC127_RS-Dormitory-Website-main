<?php
require('inc/essentials.php');
require('inc/db_config.php');

session_start();
session_regenerate_id(true);
if (isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true) {
    redirect('dashboard.php');
}

?>

<!DOCTYPE html>
<html Lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel</title>
    <?php require('inc/links.php'); ?>
    <style>
        /* admin log-in form */
        div.login-form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
        }

        .custom-bg {
            background-color: var(--teal);
            border: 1px solid var(--teal);
        }

        .custom-bg:hover {
            background-color: var(--teal-hover);
            border-color: var(--teal-hover);
        }

        .custom-alert {
            position: fixed;
            top: 25px;
            right: 25px;
        }
    </style>
</head>

<body class="bg-light">

    <div class="login-form text-center rounded bg-white shadow overflow-hidden">
        <form method="POST">
            <h4 class="bg-dark text-white py-3"> ADMIN LOGIN PANEL </h4>
            <div class="p-4">
                <div class="mb-3">
                    <input id="username" name="username" required type="text" class="form-control shadow-none text-center" placeholder="Admin Name">
                </div>

                <div class="mb-4">
                    <input id="password" name="password" required type="password" class="form-control shadow-none text-center" placeholder="Password">
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <button name="login" type="submit" class="btn text-white custom-bg shadow-none">LOGIN</button>
                    <a href="../index.php" class="text-secondary text-decoration-none">Log-In as User</a>
                </div>
            </div>
        </form>

        <?php
        # Login
        if (isset($_POST['login'])) {

            $frm_data = filteration($_POST);

            $query = "SELECT * FROM `admin_data` WHERE `username` = ? and `password` = ?";
            $values = [$frm_data['username'], $frm_data['password']];

            $res = select($query, $values, "ss");
            if ($res->num_rows == 1) {
                $row = mysqli_fetch_assoc($res);
                $_SESSION['adminLogin'] = true;
                redirect('dashboard.php');
            } else {
                alert('error', 'Login failed - Invalid Credentials!');
            }
        }
        ?>
    </div>

    <?php require('inc/scripts.php'); ?>

</body>

</html>