<?php require_once 'init.php'; ?>

<?php

    $photos = Photo::findAll();
?>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="photo-library" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Biblioteka Sistema Galerije</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">

                            <?php foreach ($photos as $photo): ?>

                                <div class="col-4">
                                    <a href="#" role="checkbox" aria-checked="false" tabindex="0" id="" class="">
                                        <img class="modal_thumbnails img-fluid img-thumbnail" src="<?php echo $photo->picturePath(); ?>" data="<?php echo $photo->id; ?>" alt="">
                                    </a>
                                    <div class="photo-id hidden"></div>
                                </div>

                            <?php endforeach; ?>

                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.col-md-8 -->
                    <div class="col-md-4">
                        <div id="modal_sidebar"></div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <div class="modal-footer">
                <div class="row">
                    <button id="set_user_image" type="button" class="btn btn-primary" disabled="true" data-dismiss="modal">Potvrdi selekciju</button>
                </div>
            </div>
        </div>
    </div>
</div>
