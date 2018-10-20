<div class="container-fluid">
    <!-- Breadcrumbs-->
    <!-- <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Kontrolna tabla</a>
        </li>
        <li class="breadcrumb-item active">Moja kontrolna tabla</li>
    </ol> -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Admin
                <small>Kontrolna tabla</small>
            </h1>
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6">
                    <div class="card bg-primary text-white">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-9 text-right">
                                    <div class='huge'><?php echo $session->count; ?></div>
                                    <div>Novi Pregledi</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="card-footer bg-light">
                                <span class="pull-left">Pregled Detalja</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card bg-success text-white">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-3">
                                    <i class="fa fa-image fa-5x"></i>
                                </div>
                                <div class="col-9 text-right">
                                    <div class='huge'><?php echo Photo::countAll(); ?></div>
                                    <div>Slike</div>
                                </div>
                            </div>
                        </div>
                        <a href="photos.php">
                            <div class="card-footer bg-light">
                                <span class="pull-left">Pregled Detalja</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card bg-warning text-white">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-9 text-right">
                                    <div class='huge'><?php echo User::countAll(); ?></div>
                                    <div>Administratori</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="card-footer bg-light">
                                <span class="pull-left">Pregled Detalja</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card bg-danger text-white">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-9 text-right">
                                    <div class='huge'><?php echo Comment::countAll(); ?></div>
                                    <div>Komentari</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="card-footer bg-light">
                                <span class="pull-left">Pregled Detalja</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row mb-4 -->
            <div class="row">

                <div id="piechart" style="width: 900px; height: 500px;"></div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
