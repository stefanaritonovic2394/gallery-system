<?php include 'includes/header.php'; ?>
<?php

    if (!$session->isSignedIn()) {
        redirect("login.php");
    }

?>

<?php

    $message = "";

    if (isset($_FILES['file'])) {

        $photo = new Photo();
        $photo->title = $_POST['title'];
        $photo->created = $_POST['created'];
        $photo->setFile($_FILES['file']);

        if ($photo->save()) {
            $message = "Slika uspešno otpremljena";
        } else {
            $message = join("<br>", $photo->errors);
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
                    Upload slika
                    <small></small>
                </h1>
                <hr>
                <div class="col-md-6">
                    <div class="row mb-4 bg-info">
                        <?php echo $message; ?>
                    </div>
                    <div class="row">
                        <form class="" action="upload.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="title">Naziv</label>
                                <input type="text" name="title" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="created">Datum</label>
                                <input type="date" name="created" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <input type="file" name="file" value="">
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Otpremi sliku">
                        </form>
                    </div>
                </div>
                <!-- /.col-md-6 -->
                <div class="row">
                    <div class="col-lg-12">
                        <form class="dropzone" action="upload.php" method="post">

                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

<?php include 'includes/footer.php'; ?>
