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
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>
                <form method="post" action="<?= base_url() ?>admin/policy-details" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <span for="">Title<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="title">
                        </div>
                        <div class="form-group col-lg-6">
                            <span for="">Policy Type<span class="text-danger">*</span></span>
                            <select class="form-control form-control-sm" name="upload_image" required>
                                <option value="">--Select--</option>
                                <option value="privacy-policy">Privacy Policy</option>
                                <option value="terms-conditions"> Terms & Conditions</option>
                                <option value="refund-policy">Refund Policy</option>
                                <option value="cancelation-policy">Cancelation Policy</option>
                            </select>
                        </div>
                      	<div class="form-group col-lg-6">
                            <span for="">Upload File(PDF)<span class="text-danger">*</span></span>
                            <input type="file" class="form-control form-control-sm" name="upload_file" accept=".pdf" required>
                        </div>
                        <div class="form-group col-lg-12">
                            <span for="">Description:</span>
                            <textarea name="description" id="editor" class="form-control form-control-sm"></textarea>
                        </div>

                        <div class="form-group col-lg-12">
                            <span>Web Link</span>
                            <input type="url" name="web_url" id="" class="form-control form-control-sm">
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Files</td>
                                <td>Title</td>
                                <td>Description</td>
                                <td>Start Month & Year</td>
                                <td>End Month & Year</td>
                                <td>Uploaded By</td>
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