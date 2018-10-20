<?php include 'includes/header.php'; ?>
<?php

    if (!$session->isSignedIn()) {
        redirect("login.php");
    }

?>

<?php

    $users = User::findAll();

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
                    Administratori
                </h1>
                <p class="bg-success">
                    <?php echo $message; ?>
                </p>
                <a href="add_user.php" class="btn btn-primary mb-2">Dodaj administratora</a>
                <div class="col-md-12">
                    <div class="row">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Slika</th>
                                    <th>Korisničko ime</th>
                                    <th>Ime</th>
                                    <th>Prezime</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user) : ?>

                                    <tr>
                                        <td><?php echo $user->id; ?></td>
                                        <td><img src="<?php echo $user->imagePathPlaceholder(); ?>" class="img-fluid admin-user-thumbnail" alt=""></td>
                                        <td>
                                            <?php echo $user->username; ?>
                                            <div class="action_links">
                                                <a href="delete_user.php?id=<?php echo $user->id; ?>">Ukloni</a>
                                                <a href="edit_user.php?id=<?php echo $user->id; ?>">Izmeni</a>
                                            </div>
                                        </td>
                                        <td><?php echo $user->first_name; ?></td>
                                        <td><?php echo $user->last_name; ?></td>
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
