<?php include 'includes/init.php'; ?>
<?php

    if (!$session->isSignedIn()) {

        redirect("login.php");
    }

?>

<?php

    if (empty($_GET['id'])) {

        redirect("comments.php");
    }

    $comment = Comment::findById($_GET['id']);

    if ($comment) {

        $comment->delete();
        $session->message("Komentar sa id-em {$comment->id} je uspešno uklonjen");
        redirect("comments.php");
    } else {

        redirect("comments.php");
    }

?>
