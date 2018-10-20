<?php include 'includes/header.php'; ?>
<?php

    if (!$session->isSignedIn()) {

        redirect("../login.php");
    }

?>

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <?php include 'includes/side_nav.php'; ?>
    </nav>

    <?php include 'includes/admin_content.php'; ?>

<?php include 'includes/footer.php'; ?>
