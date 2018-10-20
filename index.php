<?php include 'includes/header.php'; ?>

<?php

    $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
    $items_per_page = 8;
    $items_total_count = Photo::countAll();

    $paginate = new Paginate($page, $items_per_page, $items_total_count);

    $sql = "SELECT * FROM photos ";
    $sql .= "LIMIT {$items_per_page} ";
    $sql .= "OFFSET {$paginate->offset()}";

    $photos = Photo::findByQuery($sql);

    // $photos = Photo::findAll();
?>

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-12 mt-4">

            <div class="row">

                <?php foreach ($photos as $photo): ?>

                    <div class="col-6 col-md-3 mb-4">
                        <a href="photo.php?id=<?php echo $photo->id; ?>">
                            <img src="admin/<?php echo $photo->picturePath(); ?>" class="img-fluid img-thumbnail" alt="">
                        </a>
                    </div>

                <?php endforeach; ?>

            </div>

            <div class="">

                <ul class="pagination justify-content-center">

                    <?php

                        if ($paginate->pageTotal() > 1) {

                            if ($paginate->hasNext()) {

                                echo "<li class='page-item'><a class='page-link' href='index.php?page={$paginate->next()}'>Sledeća</a></li>";
                            }

                            for ($i = 1; $i <= $paginate->pageTotal(); $i++) {

                                if ($i == $paginate->current_page) {

                                    echo "<li class='page-item active'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
                                } else {

                                    echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
                                }

                            }

                            if ($paginate->hasPrevious()) {

                                echo "<li class='page-item'><a class='page-link' href='index.php?page={$paginate->previous()}'>Prethodna</a></li>";
                            }

                        }

                    ?>

                </ul>

            </div>

        </div>

        <!-- <div class="col-md-4"> -->

            <!-- Sidebar Widgets Column -->
            <?php // include 'includes/sidebar.php'; ?>

    </div>
    <!-- /.row -->

    <?php include 'includes/footer.php'; ?>
