<?php require_once 'includes/header.php'; ?>

<?php

    if ($session->isSignedIn()) {

        redirect("admin");
    }

    if (isset($_POST['submit'])) {

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $user_found = User::verifyUser($username, $password);

        if ($user_found) {

            $session->login($user_found);
            redirect("admin");
        } else {

            $the_message = "Vaše korisničko ime ili lozinka nisu tačni";
        }

    } else {

        $the_message = "";
        $username = "";
        $password = "";
    }

?>

    <!-- Navigation-->
    <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <?php // include 'includes/side_nav.php'; ?>
    </nav> -->

    <div class="col-md-6 offset-md-3">

        <h1 class="text-center mt-4 mb-4">Logovanje</h1>
        <h4 class="text-center bg-warning"><?php echo $the_message; ?></h4>

        <form class="" action="" method="post" id="login-form">
            <div class="form-group">
                <label for="username">Korisničko ime</label>
                <input type="text" class="form-control" name="username" value="<?php echo htmlentities($username); ?>" placeholder="Unesite Vaše korisničko ime">
            </div>
            <div class="form-group">
                <label for="password">Lozinka</label>
                <input type="password" class="form-control" name="password" value="<?php echo htmlentities($password); ?>" placeholder="Unesite Vašu lozinku">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-lg btn-block" name="submit" value="Ulogujte se">
            </div>
        </form>

    </div>

    <?php include 'includes/footer.php'; ?>
