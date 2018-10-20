<?php include 'includes/header.php'; ?>
<?php

    require_once 'admin/includes/init.php';

    if (empty($_GET['id'])) {

        redirect("index.php");
    }

    $photo = Photo::findById($_GET['id']);

    if (isset($_POST['submit'])) {

        $author = trim($_POST['author']);
        $body = trim($_POST['body']);

        $new_comment = Comment::createComment($photo->id, $author, $body);

        if ($new_comment && $new_comment->save()) {

            redirect("photo.php?id={$photo->id}");
        } else {

            $message = "Desila se greška prilikom kreiranja komentara";
        }

    } else {

        $author = "";
        $body = "";
    }

    $comments = Comment::findComments($photo->id);

?>

    <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-12">

            <!-- Title -->
            <h1 class="mt-4"><?php echo $photo->title; ?></h1>

            <!-- Author -->
            <!-- <p class="lead">
                by
                <a href="#">Stefan Aritonovic</a>
            </p> -->

            <hr>

            <!-- Date/Time -->
            <p>Datum postavljanja: <?php echo $photo->created; ?></p>

            <hr>

            <!-- Preview Image -->
            <img class="img-fluid rounded" src="admin/<?php echo $photo->picturePath(); ?>" alt="">

            <hr>

            <!-- Post Content -->
            <p class="lead"><?php echo $photo->caption; ?></p>

            <p><?php echo $photo->description; ?></p>

            <hr>

            <!-- Comments Form -->
            <div class="card my-4">
                <h5 class="card-header">Ostavi Komentar:</h5>
                <div class="card-body">
                    <form role="form" method="post">
                        <div class="form-group">
                            <label for="author">Autor</label>
                            <input type="text" name="author" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="body">Vaš komentar</label>
                            <textarea name="body" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Pošalji</button>
                    </form>
                </div>
            </div>

            <?php foreach ($comments as $comment) : ?>

                <!-- Single Comment -->
                <div class="media mb-4">
                    <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                    <div class="media-body">
                        <h5 class="mt-0"><?php echo $comment->author; ?></h5>
                        <?php echo $comment->body; ?>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>

        <!-- <div class="col-md-4"> -->

            <!-- Sidebar Widgets Column -->
            <?php // include 'includes/sidebar.php'; ?>

    </div>
    <!-- /.row -->

    <?php include 'includes/footer.php'; ?>
