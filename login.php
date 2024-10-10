<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "includes/cdnlinks.php" ?>
    </head>

<body class="d-flex flex-column min-vh-100">
    <?php include "includes/navbar.php" ?>

        <?php

            $logged_in = false;

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $filtered_username = filter_input(INPUT_POST, 'username');
                $filtered_password = filter_input(INPUT_POST, 'password');
                            
                $file = fopen("data/user_data.csv", "rb");

                if ($file === false) {
                    die("Error opening the file: $file");
                }

                while (!feof($file)) {
                    $user = fgetcsv($file);
                    if ($user === false) continue;
                    $users[] = $user;
                }

                foreach ($users as $user) {
                    if ($user[0] === $filtered_username) {
                        if ($user[1] === $filtered_password) {
                            $logged_in = true;
                        }
                    }
                }

                fclose($file);

                if ($logged_in) {
                    include "includes/games.php";
                } else {
                    echo("<script>alert('User does not exist or username and/or password are incorrect.')</script>");
                    include "includes/login-form.php";
                }

            } else {
                include "includes/login-form.php";
            }
            
        ?>
    <?php include "includes/foot.php" ?>
</body>
</html>