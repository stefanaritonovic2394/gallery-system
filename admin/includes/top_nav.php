<ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <a class="nav-link" href="../index.php">Početna</a>
    </li>

    <?php if($session->isSignedIn()): ?>

        <li class="nav-item">
            <a class="nav-link" href="logout.php">
                <i class="fa fa-fw fa-sign-out"></i>Izlogujte se
            </a>
        </li>

    <?php endif; ?>

</ul>
