<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Employee_model;

$employee_model = new Employee_model();
?>
<style>

</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <form action="<?= base_url() ?>admin/job-result-stage-mapping" method="post" enctype="multipart/form-data" id="alumini-page-notification-form">
                <div class="card-body p-1">
                    <?php if (session()->getFlashdata('status')) {
                        echo session()->getFlashdata('status');
                    } ?>
                    <div class="form-group">
                        <span for="title">Job id</span>
                        <select class="form-control form-control-sm" name="job_id" required>
                            <option value="">--Select--</option>
                        <?php foreach ($job_details as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['job_title'] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <span for="title">Result Title</span>
                        <input type="text" class="form-control form-control-sm" name="result_title" id="job_title" placeholder="Enter Company Name" required>
                    </div>
                    <div class="form-group">
                        <span for="title">Result Description</span>
                        <textarea name="result_description" id="editor" class="form-control form-control-sm"></textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-8">
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