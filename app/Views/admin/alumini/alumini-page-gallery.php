<?= $this->extend("admin/layouts/master") ?>
<?=  $this->section("body-content"); ?>
<?php
    use App\Models\Employee_model;
    $employee_model = new Employee_model();
?>
<style>
    
</style>
<!-- start page title -->
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <form action="<?= base_url() ?>admin/alumini-page-gallery" method="post" enctype="multipart/form-data" id="alumini-page-notification-form">
                <div class="card-body p-1">
                    <?php if (session()->getFlashdata('status')) {
                        echo session()->getFlashdata('status');
                    } ?>
                    <div class="form-group">
                        <span for="title">Gallery Title</span>
                        <input type="text" class="form-control form-control-sm" name="title" id="title" placeholder="Enter Title" required>
                    </div>
                    <div class="form-group">
                        <span for="title">Description</span>
                        <textarea name="description" id="editor"></textarea>
                    </div>
                    <div class="form-group">
                        <span for="title">Date</span>
                        <input type="date" name="gallery_date" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <span for="title">Section image (Multiple image option )</span>
                        <input type="file" class="form-control form-control-sm" name="file_upload[]" accept=".jpg,.png,.jpeg" multiple required>
                    </div>
                </div>
                <div class="card-footer p-2">
                    <input type="submit" class="btn btn-primary" value="Submit" id="submit">
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>