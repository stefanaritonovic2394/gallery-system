
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">Galerija Slika</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">

                <?php

                    $index_class = '';
                    $login_class = '';

                    $page_name = basename($_SERVER['PHP_SELF']);

                    switch ($page_name) {
                        case 'index.php':
                            $index_class = 'active';
                            $login_class = '';
                            break;

                        case 'login.php':
                            $login_class = 'active';
                            $index_class = '';
                            break;

                        default:
                            $index_class = '';
                            $login_class = '';
                            break;
                    }

                ?>

                <li class="nav-item">
                    <a class="nav-link <?php echo $index_class; ?>" href="index.php">Početna</a>
                </li>

                <?php if($session->isSignedIn()): ?>

                    <li class="nav-item">
                        <a class="nav-link" href="admin">Admin</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="admin/logout.php">Izlogujte se</a>
                    </li>

                <?php else: ?>

                    <li class="nav-item">
                        <a class="nav-link <?php echo $login_class; ?>" href="login.php">Logovanje</a>
                    </li>

                <?php endif; ?>

                <!-- <li class="nav-item active">
                    <a class="nav-link" href="index.php">Početna
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                </li> -->
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
