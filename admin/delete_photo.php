<?php include 'includes/init.php'; ?>
<?php

    if (!$session->isSignedIn()) {

        redirect("login.php");
    }

?>

<?php

    if (empty($_GET['id'])) {

        redirect("photos.php");
    }

    $photo = Photo::findById($_GET['id']);

    if ($photo) {

        $photo->deletePhoto();
        $session->message("Slika {$photo->filename} je uspešno uklonjena");
        redirect("photos.php");
    } else {

        redirect("photos.php");
    }

?>
