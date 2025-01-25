<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<?php

use App\Models\Employee_model;

$employee_model = new Employee_model();
?>

<!-- Copyright Details Form -->
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
                <form method="post" action="<?= base_url() ?>admin/copyright-details" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <span>Copyright Title <span class="text-danger">*</span></span>
                            <textarea class="form-control form-control-sm" name="Copyright_title" id="editor2"></textarea>
                        </div>
                        <div class="col-lg-12 form-group">
                            <span>Copyright Description</span>
                            <textarea id="editor" name="description"></textarea>
                        </div>
                        <div class="col-lg-6 form-group">
                            <span>Copyright Dairy No <span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="Copyright_number" placeholder="Enter Copyright number" required>
                        </div>
                        <!-- <div class="col-md-6">
                        <div class="form-group">
                            <span for="">Copyright start datetime<span class="text-danger">*</span></span>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" name="copyright_start_date"  placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                <input type="text" class="form-control form-control-sm" name="copyright_start_time"  placeholder="End Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <span for="">Copyright end datetime<span class="text-danger">*</span></span>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" name="copyright_end_date"  placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                <input type="text" class="form-control form-control-sm" name="copyright_end_time"  placeholder="End Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                            </div>
                        </div>
                    </div> -->

                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Submission Date</span>
                                <input type="date" name="submission_date" id="" class="form-control form-control-sm">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">field Grant Date </span>
                                <input type="date" name="grant_date" id="" class="form-control form-control-sm">
                            </div>
                        </div>

                        <div class="col-lg-6 form-group">
                            <span>Current Status <span class="text-danger">*</span></span>
                            <select class="form-control form-control-sm" name="current_status" required>
                                <option value="Granted">Granted</option>
                                <option value="In Process">In Process</option>
                                <option value="Submitted">Submitted</option>
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <span>Upload File (PDF, JPG, PNG)</span>
                            <input type="file" class="form-control form-control-sm" name="Copyright_file" accept=".pdf,.jpg,.png" required>
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
                        <div class="col-lg-6 form-group">
                            <span>Copyright Status <span class="text-danger">*</span></span>
                            <select class="form-control form-control-sm" name="Copyright_status" required>
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
                                <td>Start Date</td>
                                <td>End Date</td>
                                <td>Emp. ID</td>
                                <td>Status</td>
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