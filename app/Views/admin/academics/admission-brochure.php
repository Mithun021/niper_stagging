<?= $this->extend("admin/layouts/master") ?>

<?= $this->section("body-content"); ?>
<?php

use App\Models\Department_model;
use App\Models\Employee_model;

$employee_model = new Employee_model();
$department_model = new Department_model();
?>
<style>

</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?> </h4>
            </div>
            <div class="card-body">
                <?php
                if (session()->getFlashdata('msg')) {
                    echo session()->getFlashdata('msg');
                }
                ?>
                <form method="post" action="<?= base_url() ?>admin/department-research-area" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <span for="">Title<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="title" required minlength="5">
                        </div>
                        <div class="form-group col-lg-6">
                            <span for="">Research area image upload (jpegjpgpng)</span>
                            <input type="file" class="form-control form-control-sm" name="upload_image">
                        </div>
                        <div class="form-group col-lg-6">
                            <span for="">Short desc</span>
                            <textarea id="editor" name="description"></textarea>
                        </div>
                        <div class="form-group col-lg-6">
                            <span for="">Btach Start year</span>
                            <select class="form-control form-control-sm" name="start_year" required>
                            <?php  for ($i=2000; $i <= date('Y'); $i++) { ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php }?>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <span for="">Batch End Year</span>
                            <select class="form-control form-control-sm" name="end_year" required>
                            <?php for ($i=2000; $i <= date('Y') + 5; $i++) { ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php }?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>

                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Files</td>
                                <td>Dept Name</td>
                                <td>Title</td>
                                <td>Desc</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>