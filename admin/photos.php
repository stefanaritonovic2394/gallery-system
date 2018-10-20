<?php include 'includes/header.php'; ?>
<?php

    if (!$session->isSignedIn()) {
        redirect("login.php");
    }

?>

<?php

    $photos = Photo::findAll();

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
                    Slike
                    <small></small>
                </h1>
                <p class="bg-success">
                    <?php echo $message; ?>
                </p>
                <div class="col-md-12">
                    <div class="row">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Slika</th>
                                    <th>Id</th>
                                    <th>Ime fajla</th>
                                    <th>Naziv</th>
                                    <th>Veličina</th>
                                    <th>Komentari</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($photos as $photo) : ?>

                                    <tr>
                                        <td>
                                            <img src="<?php echo $photo->picturePath(); ?>" class="rounded img-fluid admin-photo-thumbnail" alt="">
                                            <div class="action_links">
                                                <a class="delete_link" href="delete_photo.php?id=<?php echo $photo->id; ?>">Ukloni</a>
                                                <a href="edit_photo.php?id=<?php echo $photo->id; ?>">Izmeni</a>
                                                <a href="../photo.php?id=<?php echo $photo->id; ?>">Pregledaj</a>
                                            </div>
                                        </td>
                                        <td><?php echo $photo->id; ?></td>
                                        <td><?php echo $photo->filename; ?></td>
                                        <td><?php echo $photo->title; ?></td>
                                        <td><?php echo $photo->size; ?></td>
                                        <td>
                                            <a href="comment_photo.php?id=<?php echo $photo->id; ?>">
                                                <?php
                                                    $comments = Comment::findComments($photo->id);
                                                    echo count($comments);
                                                ?>
                                            </a>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

<?php include 'includes/footer.php'; ?>
