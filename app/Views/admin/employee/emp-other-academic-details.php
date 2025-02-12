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
                <h4 class="card-title m-0"><?= $title ?> </h4>
            </div>
            <div class="card-body">
                <?php
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>
                <form method="post" action="<?= base_url('admin/emp-other-academic-details') ?>" enctype="multipart/form-data">
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
                            <span for="">Examination Type<span class="text-danger">*</span></span>
                            <input type="text" name="examination_type" id="" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="">Year of Passing</span>
                            <input type="number" name="passing_year" id="" class="form-control form-control-sm" maxlength="4">
                        </div>
                        <div class="form-group col-md-6">
                            <span for="">Conducted By</span>
                            <input type="text" name="conduct_by" id="" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Roll No</span>
                            <input type="text" name="roll_no" id="" class="form-control form-control-sm">
                        </div>
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
                                <td>Degree Type</td>
                                <td>Degree Name</td>
                                <td>Subject Studied</td>
                                <td>Marking Scheme(%/CGPA)</td>
                                <td>Obtained Result</td>
                                <td>Passing Year</td>
                                <td>University</td>
                                <td>University (Country)</td>
                                <td>University (State/UT)</td>
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