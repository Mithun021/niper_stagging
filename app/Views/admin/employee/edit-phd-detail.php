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
                <form method="post" action="<?= base_url('admin/edit-phd-detail/'.$phd_id) ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <span for="">Employee Id<span class="text-danger">*</span></span>
                            <select class="form-control form-control-sm" name="employee_id" required>
                                <option value="">--Select--</option>
                                <?php foreach ($employee as $key => $value) { ?>
                                    <option value="<?= $value['id'] ?>" <?php if($value['id'] == $phd_detail_data['employee_id']){ echo "selected"; } ?>><?= $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- <div class="form-group col-md-6">
                            <span for="">Type of the Degree<span class="text-danger">*</span></span>
                            <input type="text" name="degree_type" id="" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Subjects Studied</span>
                            <input type="text" name="subject_studied" id="" class="form-control form-control-sm" >
                        </div> -->
                        <div class="form-group col-md-6">
                            <span for="">Title of the Ph.D thesis</span>
                            <input type="text" name="phd_thesis" id="" class="form-control form-control-sm" value="<?= $phd_detail_data['phd_thesis'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <span for="">Degree Status</span>
                            <select name="degree_status" id="degree_status" class="form-control form-control-sm">
                                <option value="">--Select--</option>
                                <option value="Ongoing" <?php if($phd_detail_data['degree_status'] == "Ongoing"){ echo "selected"; } ?>>Ongoing</option>
                                <option value="Awarded" <?php if($phd_detail_data['degree_status'] == "Awarded"){ echo "selected"; } ?>>Awarded</option>
                                <option value="Submitted" <?php if($phd_detail_data['degree_status'] == "Submitted"){ echo "selected"; } ?>>Submitted</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4" id="registration_date_group" style="display: none;">
                            <span for="">Registration Date</span>
                            <input type="date" name="registration_date" id="registration_date" class="form-control form-control-sm"  value="<?= $phd_detail_data['registration_date'] ?>">
                        </div>

                        <div class="form-group col-md-4" id="submission_date_group" style="display: none;">
                            <span for="">Submission Date</span>
                            <input type="date" name="submission_date" id="submission_date" class="form-control form-control-sm" value="<?= $phd_detail_data['submission_date'] ?>">
                        </div>

                        <div class="form-group col-md-4" id="award_date_group" style="display: none;">
                            <span for="">Award Date</span>
                            <input type="date" name="award_date" id="award_date" class="form-control form-control-sm" value="<?= $phd_detail_data['award_date'] ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">University</span>
                            <input type="text" name="university" id="" class="form-control form-control-sm" value="<?= $phd_detail_data['university'] ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">University (Country)</span>
                            <select name="university_country" id="university_country" class="form-control form-control-sm">
                                <option value="">--Select--</option>
                            <?php foreach ($country as $key => $value) { ?>
                                <option value="<?= $value['country'] ?>" <?php if($value['country'] == $phd_detail_data['university_country']){ echo "selected"; } ?>><?= $value['country'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">University (State/UT)</span>
                            <select name="university_state" id="university_state" class="form-control form-control-sm">
                                <option value="">--Select--</option>
                            </select>
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
                                <td>Emp. ID</td>
                                <!-- <td>Degree Type</td>
                                <td>Subjects Studied</td> -->
                                <td>Title of the Ph.D thesis</td>
                                <td>Degree Status</td>
                                <td>Registration Date</td>
                                <td>Submission Date</td>
                                <td>Award Date</td>
                                <td>University</td>
                                <td>University(Country)</td>
                                <td>University(State/UT)</td>
                                <td>Upload By</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($phd_detail as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?php $emp = $employee_model->get($value['employee_id']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <!-- <td><?= $value['degree_type'] ?></td>
                                    <td><?= $value['subject_studied'] ?></td> -->
                                    <td><?= $value['phd_thesis'] ?></td>
                                    <td><?= $value['degree_status'] ?></td>
                                    <td><?= $value['registration_date'] ?></td>
                                    <td><?= $value['submission_date'] ?></td>
                                    <td><?= $value['award_date'] ?></td>
                                    <td><?= $value['university'] ?></td>
                                    <td><?= $value['university_country'] ?></td>
                                    <td><?= $value['university_state'] ?></td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            <a href="<?= base_url() ?>admin/edit-phd-detail/<?= $value['id'] ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                            <a href="<?= base_url() ?>admin/delete-phd-detail/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure..')"><i class="far fa-trash-alt"></i></a>
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


<!-- jQuery  -->
<script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>

<script>
    function toggleDateFields() {
        const degreeStatus = document.getElementById('degree_status').value;

        const registrationGroup = document.getElementById('registration_date_group');
        const submissionGroup = document.getElementById('submission_date_group');
        const awardGroup = document.getElementById('award_date_group');

        const registrationInput = document.getElementById('registration_date');
        const submissionInput = document.getElementById('submission_date');
        const awardInput = document.getElementById('award_date');

        // Default: hide all groups
        registrationGroup.style.display = 'none';
        submissionGroup.style.display = 'none';
        awardGroup.style.display = 'none';

        // Clear only if not shown below
        let showRegistration = false;
        let showSubmission = false;
        let showAward = false;

        if (degreeStatus === 'Onging') {
            showRegistration = true;
        } else if (degreeStatus === 'Submitted') {
            showRegistration = true;
            showSubmission = true;
        } else if (degreeStatus === 'Awarded') {
            showRegistration = true;
            showSubmission = true;
            showAward = true;
        }

        // Show and retain values
        if (showRegistration) {
            registrationGroup.style.display = 'block';
        } else {
            registrationInput.value = '';
        }

        if (showSubmission) {
            submissionGroup.style.display = 'block';
        } else {
            submissionInput.value = '';
        }

        if (showAward) {
            awardGroup.style.display = 'block';
        } else {
            awardInput.value = '';
        }
    }

    // Bind on change
    document.getElementById('degree_status').addEventListener('change', toggleDateFields);

    // Call on page load
    window.addEventListener('DOMContentLoaded', toggleDateFields);
</script>




<script>
    var selectedCountry = "<?= $phd_detail_data['university_country'] ?>";
    var selectedState = "<?= $phd_detail_data['university_state'] ?>";
    function loadStates(countryName, selectedState = '') {
        $.ajax({
            type: "post",
            url: "<?= base_url('getStates'); ?>",
            data: { country_name: countryName },
            dataType: "json",
            success: function (response) {
                var stateDropdown = $('#university_state');
                stateDropdown.empty(); 
                stateDropdown.append('<option value="">--Select--</option>');

                if (response.length > 0) {
                    $.each(response, function(index, state) {
                        var isSelected = (state.state === selectedState) ? 'selected' : '';
                        stateDropdown.append('<option value="' + state.state + '" ' + isSelected + '>' + state.state + '</option>');
                    });
                } else {
                    stateDropdown.append('<option value="">No states available</option>');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    }

    // On country change
    $('#university_country').on('change', function () {
        var countryName = $(this).val();
        loadStates(countryName);
    });

    // On page load: if selectedCountry exists, trigger state loading
    $(document).ready(function () {
        if (selectedCountry) {
            $('#university_country').val(selectedCountry);
            loadStates(selectedCountry, selectedState);
        }
    });

</script>


<?= $this->endSection() ?>