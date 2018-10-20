<?php include 'includes/header.php'; ?>
<?php

    if (!$session->isSignedIn()) {
        redirect("login.php");
    }

?>

<?php

    if (empty($_GET['id'])) {

        redirect("photos.php");
    } else {

        $photo = Photo::findById($_GET['id']);

        if (isset($_POST['update'])) {

            if ($photo) {

                $photo->title = $_POST['title'];
                $photo->caption = $_POST['caption'];
                $photo->alternate_text = $_POST['alternate_text'];
                $photo->created = $_POST['created'];
                $photo->description = $_POST['description'];

                $photo->save();
            }
        }

    }

    // $photos = Photo::findAll();

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
                    Izmeni sliku
                    <small></small>
                </h1>
                <form class="" action="" method="post">
                    <div class="row">
                        <div class="col col-md-8">
                            <div class="form-group">
                                <a href="#"><img class="img-fluid img-thumbnail" src="<?php echo $photo->picturePath(); ?>" alt=""></a>
                            </div>
                            <div class="form-group">
                                <label for="title">Naslov</label>
                                <input type="text" name="title" class="form-control" value="<?php echo $photo->title; ?>">
                            </div>
                            <div class="form-group">
                                <label for="caption">Natpis</label>
                                <input type="text" name="caption" class="form-control" value="<?php echo $photo->caption; ?>">
                            </div>
                            <div class="form-group">
                                <label for="alternate_text">Alternativni tekst</label>
                                <input type="text" name="alternate_text" class="form-control" value="<?php echo $photo->alternate_text; ?>">
                            </div>
                            <div class="form-group">
                                <label for="created">Datum</label>
                                <input type="date" name="created" class="form-control" value="<?php echo $photo->created; ?>">
                            </div>
                            <div class="form-group">
                                <label for="description">Opis</label>
                                <textarea class="form-control" name="description" rows="8" cols="80"><?php echo $photo->description; ?></textarea>
                            </div>
                        </div>
                        <!-- /.col col-md-8 -->
                        <div class="col-8 col-md-4">
                            <div class="card photo-info-box">
                                <div class="card-header info-box-header">
                                    <h4 class="">Detalji <span id="toggle" class="fa fa-chevron-up pull-right"></span></h4>
                                </div>
                                <div class="card-body inside">
                                    <div class="box-inner">
                                        <p class="card-text">
                                            <span class="fa fa-calendar" aria-hidden="true"></span> Upload-ovana datuma: <?php echo $photo->created; ?>
                                        </p>
                                        <p class="card-text">
                                            Id slike: <span class="data photo_id_box"><?php echo $photo->id; ?></span>
                                        </p>
                                        <p class="card-text">
                                            Ime fajla: <span class="data"><?php echo $photo->filename; ?></span>
                                        </p>
                                        <p class="card-text">
                                            Tip fajla: <span class="data"><?php echo $photo->type; ?></span>
                                        </p>
                                        <p class="card-text">
                                            Veličina fajla: <span class="data"><?php echo $photo->size; ?></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="card-footer inside info-box-footer clearfix">
                                    <div class="info-box-delete pull-left">
                                        <a href="delete_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger btn-lg">Ukloni</a>
                                    </div>
                                    <div class="info-box-update pull-right ">
                                        <input type="submit" name="update" value="Ažuriraj" class="btn btn-primary btn-lg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-8 col-md-4 -->
                    </div>
                    <!-- /.row -->
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

<?php include 'includes/footer.php'; ?>
