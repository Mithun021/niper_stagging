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
                <form method="post" action="<?= base_url('admin/edit-ongoing-phd/'.$ongoing_phd_id) ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <span for="">Employee Id<span class="text-danger">*</span></span>
                            <select class="form-control form-control-sm my-select" name="employee_id" required>
                                <option value="">--Select--</option>
                                <?php foreach ($employee as $key => $value) { ?>
                                    <option value="<?= $value['id'] ?>" <?php if($value['id'] == $ongoing_php_data['employee_id']){ echo "selected"; } ?>><?= $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="">Name of the Student<span class="text-danger">*</span></span>
                            <input type="text" name="student_name" id="" class="form-control form-control-sm" value="<?= $ongoing_php_data['student_name'] ?>" required>
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Subject Title of the Thesis</span>
                            <input type="text" name="subject_thesis" id="" class="form-control form-control-sm" value="<?= $ongoing_php_data['subject_thesis'] ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Name of the University</span>
                            <input type="text" name="university_name" id="" class="form-control form-control-sm" value="<?= $ongoing_php_data['university_name'] ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Department</span>
                            <select name="department" id="" class="form-control form-control-sm my-select">
                                <option value="">--Select--</option>
                                <?php foreach ($department as $key => $value) { ?>
                                    <option value="<?= $value['id'] ?>" <?php if($value['id'] == $ongoing_php_data['department']){ echo "selected"; } ?>><?= $value['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">University (Country)</span>
                            <input type="text" name="university_country" id="" class="form-control form-control-sm" value="<?= $ongoing_php_data['university_country'] ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Role</span>
                            <select name="role" id="" class="form-control form-control-sm">
                                <option value="">--Select--</option>
                                <option value="Supervisor" <?php if($ongoing_php_data['role'] == "Supervisor"){ echo "selected"; } ?>>Supervisor</option>
                                <option value="Co-superviser" <?php if($ongoing_php_data['role'] == "Co-superviser"){ echo "selected"; } ?>>Co-superviser</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Registration Date</span>
                            <input type="date" name="registration_date" id="" class="form-control form-control-sm" value="<?= $ongoing_php_data['registration_date'] ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Document Upload (jpg,jpeg,pdf,png)</span>
                            <input type="file" name="document_file" id="" class="form-control form-control-sm" accept=".png,.jpg,.jpeg">
                            <?php if (!empty($ongoing_php_data['document_file']) && file_exists('public/admin/uploads/employee/' . $ongoing_php_data['document_file'])): ?>
                                <a href="<?= base_url() ?>public/admin/uploads/employee/<?= $ongoing_php_data['document_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/folder.png" alt="" height="30px"></a>
                            <?php else: ?>
                                <img src="<?= base_url() ?>public/admin/uploads/employee/invalid_image.png" alt="" height="30px">
                            <?php endif; ?>
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Status </span>
                            <select name="status" id="status" class="form-control form-control-sm" onchange="toggleRegDateField()">
                                <option value="">--Select--</option>
                                <option value="Ongoing" <?php if($ongoing_php_data['status'] == "Ongoing"){ echo "selected"; } ?>>Ongoing</option>
                                <option value="Submitted" <?php if($ongoing_php_data['status'] == "Submitted"){ echo "selected"; } ?>>Submitted</option>
                                <option value="Awarded" <?php if($ongoing_php_data['status'] == "Awarded"){ echo "selected"; } ?>>Awarded</option>
                            </select>
                        </div>
                        <div class="form-group submission_date col-md-4" style="display : none;">
                            <span for="">Submission Date</span>
                            <input type="date" name="submission_date" id="" class="form-control form-control-sm" value="<?= $ongoing_php_data['submission_date'] ?>">
                        </div>
                        
                        <div class="form-group col-md-4 award_date" style="display : none;">
                            <span for="">Award Date</span>
                            <input type="date" name="award_date" id="" class="form-control form-control-sm" value="<?= $ongoing_php_data['award_date'] ?>">
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
                                <td>Student Name</td>
                                <td>Subject Title of the Thesis</td>
                                <td>University Name</td>
                                <td>Department</td>
                                <td>University (Country)</td>
                                <td>Role</td>
                                <td>Registration Date</td>
                                <td>Status</td>
                                <td>Upload By</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ongoing_php as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td>
                                        <?php if (!empty($value['document_file']) && file_exists('public/admin/uploads/employee/' . $value['document_file'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/employee/<?= $value['document_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/folder.png" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/employee/invalid_image.png" alt="" height="30px">
                                        <?php endif; ?>
                                    </td>
                                    <td><?php $emp = $employee_model->get($value['employee_id']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <td><?= $value['student_name'] ?></td>
                                    <td><?= $value['subject_thesis'] ?></td>
                                    <td><?= $value['university_name'] ?></td>
                                    <td><?= $department_model->get($value['department'])['name'] ?? '' ?></td>
                                    <td><?= $value['university_country'] ?></td>
                                    <td><?= $value['role'] ?></td>
                                    <td><?= $value['registration_date'] ?></td>
                                    <td><?= $value['status'] ?> <?php if($value['submission_date']!=="0000-00-00"){ echo $value['submission_date']; }else{ echo ""; } ?></td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            <a href="<?= base_url() ?>admin/edit-ongoing-phd/<?= $value['id'] ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                            <a href="<?= base_url() ?>admin/delete-ongoing-phd/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure...!')"><i class="far fa-trash-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
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
        var submissionDateField = document.querySelector(".submission_date");
        var awardDateField = document.querySelector(".award_date");
        var submissionInput = submissionDateField.querySelector('input[name="submission_date"]');
        var awardInput = awardDateField.querySelector('input[name="award_date"]');

        // Hide both and clear values
        submissionDateField.style.display = "none";
        awardDateField.style.display = "none";

        // Show based on status and keep existing value
        if (status === "Submitted") {
            submissionDateField.style.display = "block";
        } else {
            submissionInput.value = "";
        }

        if (status === "Awarded") {
            awardDateField.style.display = "block";
        } else {
            awardInput.value = "";
        }
    }

    // Call after the page is loaded
    document.addEventListener("DOMContentLoaded", function () {
        toggleRegDateField();
    });
</script>


<?= $this->endSection() ?>