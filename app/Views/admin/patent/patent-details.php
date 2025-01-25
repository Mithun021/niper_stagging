<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Employee_model;

$employee_model = new Employee_model();
?>

<!-- Patent Details Form -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status'); ?>
                <?php endif; ?>
                <form method="post" action="<?= base_url() ?>admin/patent-details" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <span>Patent Title <span class="text-danger">*</span></span>
                            <textarea class="form-control form-control-sm" name="patent_title" id="editor2"></textarea>
                        </div>
                        <div class="col-lg-12 form-group">
                            <span>Patent Description</span>
                            <textarea id="editor" name="description"></textarea>
                        </div>
                        <div class="col-lg-6 form-group">
                            <span>IPR No <span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="ipr_number" placeholder="Enter IPR number" required>
                        </div>
                        <div class="col-lg-6 form-group">
                            <span>Patent Type</span>
                            <input type="text" class="form-control form-control-sm" name="patent_type" placeholder="Enter IPR number" required>
                        </div>
                        <div class="col-lg-3 form-group">
                            <span>Date of Filing <span class="text-danger">*</span></span>
                            <input type="date" class="form-control form-control-sm" name="filling_date" required>
                        </div>
                        <div class="col-lg-3 form-group">
                            <span>Field Grant Date </span>
                            <input type="date" class="form-control form-control-sm" name="grant_date" required>
                        </div>
                        <div class="col-lg-6 form-group">
                            <span>Current Status </span>
                            <input type="text" class="form-control form-control-sm" name="current_status" required>
                        </div>
                        <div class="col-lg-6 form-group">
                            <span>Upload File (PDF, JPG, PNG)</span>
                            <input type="file" class="form-control form-control-sm" name="patent_file" accept=".pdf,.jpg,.png" required>
                        </div>
                        <div class="col-lg-6 form-group">
                            <span>Employee ID <span class="text-danger">*</span></span>
                            <select class="form-control form-control-sm" name="emp_id" required>
                                <option value="">--Select--</option>
                                <?php foreach ($employees as $key => $value) { ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-12 form-group">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="addServicetable">
                                    <thead class="bg-light">
                                        <tr>
                                            <td scope="col">Author Details</td>
                                            <td scope="col"><button type="button" class="btn btn-sm btn-primary" id="addnewservicerow">+</button></td>
                                        </tr>

                                    </thead>
                                    <tbody id="stockTbody">
                                        <tr id="stockTrow">
                                            <td>
                                                <input type="text" class="form-control" id="author_name" name="author_name[]" placeholder="Enter Author Name">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger" id="removenewServicerow">-</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-4 form-group">
                            <span>Patent Status <span class="text-danger">*</span></span>
                            <select class="form-control form-control-sm" name="patent_status" required>
                                <option value="0">Draft</option>
                                <option value="1" selected>Active</option>
                            </select>
                        </div>
                        <div class="col-lg-12 form-group">
                            <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                        </div>
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
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>File</td>
                                <td>Title</td>
                                <td>Number</td>
                                <td>Patent Date</td>
                                <td>Status</td>
                                <td>Emp. ID</td>
                                <td>Uploaded by</td>
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

<?= $this->endSection(); ?>