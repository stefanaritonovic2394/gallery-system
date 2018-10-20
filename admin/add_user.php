<?php include 'includes/header.php'; ?>
<?php

    if (!$session->isSignedIn()) {
        redirect("login.php");
    }

?>

<?php

    $user = new User();

    if (isset($_POST['create'])) {

        if ($user) {

            $user->username = $_POST['username'];
            $user->first_name = $_POST['first_name'];
            $user->last_name = $_POST['last_name'];
            $user->password = $_POST['password'];

            $user->setFile($_FILES['user_image_upload']);
            $user->uploadPhoto();
            $session->message("Administrator je uspešno dodat");
            $user->save();
            redirect("users.php");
        }

    }

?>

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <?php include 'includes/side_nav.php'; ?>
    </nav>

    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <!-- <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">My Dashboard</li>
        </ol> -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header text-center mb-4">
                    Dodaj administratora
                    <small></small>
                </h1>
                <form class="" action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="form-group">
                                <input type="file" name="user_image_upload" class="form-control-file" value="">
                            </div>
                            <div class="form-group">
                                <label for="username">Korisničko ime</label>
                                <input type="text" name="username" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="first_name">Ime</label>
                                <input type="text" name="first_name" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Prezime</label>
                                <input type="text" name="last_name" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="password">Lozinka</label>
                                <input type="password" name="password" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="create" class="btn btn-success pull-right" value="Dodaj administratora">
                            </div>
                        </div>
                        <!-- /.col-md-6 -->
                    </div>
                    <!-- /.row -->
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

<?php include 'includes/footer.php'; ?>
