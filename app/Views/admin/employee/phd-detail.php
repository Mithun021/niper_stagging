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
                <h4 class="card-title m-0"><?= $title ?> </h4>
            </div>
            <div class="card-body">
                <?php
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>
                <form method="post" action="<?= base_url('admin/phd-detail') ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <span for="">Employee Id<span class="text-danger">*</span></span>
                            <select class="form-control form-control-sm" name="employee_id" required>
                                <option value="">--Select--</option>
                                <?php foreach ($employee as $key => $value) { ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="">Type of the Degree<span class="text-danger">*</span></span>
                            <input type="text" name="degree_type" id="" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Subjects Studied</span>
                            <input type="text" name="subject_studied" id="" class="form-control form-control-sm" >
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Title of the Ph.D thesis</span>
                            <input type="text" name="phd_thesis" id="" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Degree Status</span>
                            <input type="text" name="degree_status" id="" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Registration Date</span>
                            <input type="date" name="registration_date" id="" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Submission Date</span>
                            <input type="date" name="submission_date" id="" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Award Date</span>
                            <input type="date" name="award_date" id="" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">University</span>
                            <input type="text" name="university" id="" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">University(Country)</span>
                            <input type="text" name="university_country" id="" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">University(State/UT)</span>
                            <input type="text" name="university_state" id="" class="form-control form-control-sm">
                        </div>
<!--                         
                        <div class="form-group col-md-4">
                            <span for="">Document Upload (jpg,jpeg,pdf,png)</span>
                            <input type="file" name="document_file" id="" class="form-control form-control-sm" accept=".png,.jpg,.jpeg">
                        </div> -->
                        <div class="form-group col-md-12">
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
                                <td>Emp. ID</td>
                                <td>Student Name</td>
                                <td>Subject Title of the Thesis</td>
                                <td>University Name</td>
                                <td>Department</td>
                                <td>University (Country)</td>
                                <td>Role</td>
                                <td>Registration Date</td>
                                <td>Upload By</td>
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