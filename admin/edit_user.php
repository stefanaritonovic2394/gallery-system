<?php include 'includes/header.php'; ?>
<?php include 'includes/photo_library_modal.php'; ?>
<?php

    if (!$session->isSignedIn()) {
        redirect("login.php");
    }

?>

<?php

    if (empty($_GET['id'])) {

        redirect("users.php");
    }

    $user = User::findById($_GET['id']);

    if (isset($_POST['update'])) {

        if ($user) {

            $user->username = $_POST['username'];
            $user->first_name = $_POST['first_name'];
            $user->last_name = $_POST['last_name'];

            if (!empty($_POST['password'])) {
                $user->password = $_POST['password'];
            }

            if (empty($_FILES['user_image_upload'])) {

                $user->save();
                redirect("users.php");
                $session->message("Administrator je uspešno ažuriran");
            } else {

                $user->setFile($_FILES['user_image_upload']);
                $user->uploadPhoto();
                $user->save();
                $session->message("Administrator je uspešno ažuriran");

                // redirect("edit_user.php?id={$user->id}");
                redirect("users.php");
            }

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
                <h1 class="page-header">
                    Ažuriraj administratora
                    <small></small>
                </h1>
                <form class="" action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 user_image_box">
                            <a href="#" data-toggle="modal" data-target="#photo-library"><img src="<?php echo $user->imagePathPlaceholder(); ?>" class="img-fluid" alt=""></a>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="file" name="user_image_upload" class="form-control-file" value="">
                            </div>
                            <div class="form-group">
                                <label for="username">Korisničko ime</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $user->username; ?>">
                            </div>
                            <div class="form-group">
                                <label for="first_name">Ime</label>
                                <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Prezime</label>
                                <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Lozinka</label>
                                <input type="password" name="password" class="form-control" value="<?php echo $user->password; ?>">
                            </div>
                            <div class="form-group">
                                <a id="user-id" href="delete_user.php?id=<?php echo $user->id; ?>" class="btn btn-danger">Ukloni</a>
                                <input type="submit" name="update" class="btn btn-success pull-right" value="Ažuriraj administratora">
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
