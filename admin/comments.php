<?php include 'includes/header.php'; ?>
<?php

    if (!$session->isSignedIn()) {
        redirect("login.php");
    }

?>

<?php

    $comments = Comment::findAll();

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
                    Svi komentari
                </h1>
                <p class="bg-success">
                    <?php echo $message; ?>
                </p>
                <div class="col-md-12">
                    <div class="row">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Autor</th>
                                    <th>Komentar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($comments as $comment) : ?>

                                    <tr>
                                        <td><?php echo $comment->id; ?></td>
                                        <td>
                                            <?php echo $comment->author; ?>
                                            <div class="action_links">
                                                <a href="delete_comment.php?id=<?php echo $comment->id; ?>">Ukloni</a>
                                            </div>
                                        </td>
                                        <td><?php echo $comment->body; ?></td>
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
