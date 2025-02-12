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
                <form method="post" action="<?= base_url('admin/mphil-ug-pg-detail') ?>" enctype="multipart/form-data">
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
                            <span for="">Student Title<span class="text-danger">*</span></span>
                            <input type="text" name="student_title" id="" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Name of the Student</span>
                            <input type="text" name="student_name" id="" class="form-control form-control-sm" maxlength="4">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Student Category</span>
                            <select name="student_category" id="" class="form-control form-control-sm">
                                <option value="">--Select--</option>
                                <option value="OBC">OBC</option>
                                <option value="SC">SC</option>
                                <option value="ST">ST</option>
                                <option value="EWS">EWS</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Name of the Synopsis</span>
                            <input type="text" name="synopsis_name" id="" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Roll No</span>
                            <input type="text" name="roll_no" id="" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Semester</span>
                            <select name="semester" id="" class="form-control form-control-sm">
                                <option value="">--Select--</option>
                                <option value="I">I</option>
                                <option value="II">II</option>
                                <option value="III">III</option>
                                <option value="IV">IV</option>
                                <option value="V">V</option>
                                <option value="VI">VI</option>
                                <option value="VII">VII</option>
                                <option value="VIII">VIII</option>
                                <option value="IX">IX</option>
                                <option value="X">X</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Remarks</span>
                            <input type="text" name="remarks" id="" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Name of the University</span>
                            <input type="text" name="university_name" id="" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Registration Date</span>
                            <input type="date" name="registration_date" id="" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Document File(.jpg,.png,.jpeg,.pdf)</span>
                            <input type="file" name="documemt_file" id="" class="form-control form-control-sm" accept=".jpg,.png,.jpeg,.pdf">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Status </span>
                            <select name="status" id="status" class="form-control form-control-sm" onchange="toggleRegDateField()">
                                <option value="">--Select--</option>
                                <option value="Ongoing">Ongoing</option>
                                <option value="Submitted">Submitted</option>
                                <option value="Awarded">Awarded</option>
                            </select>
                        </div>
                        <div class="form-group reg_date col-md-4" style="display : none;">
                            <span for="">Submission/Award Date</span>
                            <input type="date" name="submission_date" id="" class="form-control form-control-sm">
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
                                <td>Emp. ID</td>
                                <td>Examination Type</td>
                                <td>Year of Passing</td>
                                <td>Conducted By</td>
                                <td>Roll No</td>
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

<script>
    function toggleRegDateField() {
        var status = document.getElementById("status").value;
        var regDateDiv = document.querySelector(".reg_date");
        if (status === "Ongoing" || status === "") {
            regDateDiv.style.display = "none";
        } else {
            regDateDiv.style.display = "block";
        }
    }
</script>

<?= $this->endSection() ?>