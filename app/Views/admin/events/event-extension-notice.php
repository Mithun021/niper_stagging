<?= $this->extend("admin/layouts/master") ?>
<?=  $this->section("body-content"); ?>
<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> </h4>
            </div>
            <div class="card-body">
                <?php
                    if(session()->getFlashdata('status')){
                        echo session()->getFlashdata('status');
                    }
                ?>
                <form method="post" action="<?= base_url() ?>admin/event-extension-notice" enctype="multipart/form-data">

                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>