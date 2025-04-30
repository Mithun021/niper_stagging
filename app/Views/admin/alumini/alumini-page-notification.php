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
            <form action="<?= base_url() ?>admin/alumini-page-notification" method="post" enctype="multipart/form-data" id="alumini-page-notification-form">
            <div class="card-body p-1">
                <?php if(session()->getFlashdata('status')){
                        echo session()->getFlashdata('status');
                } ?>
                <div class="form-group">
                    <span for="title">Title</span>
                    <input type="text" class="form-control form-control-sm" name="title" id="title" placeholder="Enter Title" required>
                </div>
                <div class="form-group">
                    <span for="title">Description</span>
                    <textarea name="description" id="editor"></textarea>
                </div>
                <div class="form-group">
                    <span for="title">File Upload</span>
                    <input type="file" class="form-control form-control-sm" name="file_upload" accept=".pdf" required>
                </div>
                <div class="form-group">
                    <span for="title"><input type="checkbox" name="marquee-status"> Marquee Status</span>
                </div>
            </div>
            <div class="card-footer">
                <input type="submit" class="btn btn-primary" value="Submit" id="submit">
            </div>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body p-1">
                
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>