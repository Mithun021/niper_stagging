<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<?php
use App\Models\Employee_model;
$employee_model = new Employee_model();
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/edit-employee-seminar-conference/<?= $employee_seminar_conference_id ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <span for="Empid">Employee:</span>
                            <select name="employee_id" id="employee_id" class="form-control form-control-sm my-select" required >
                                <option value="">Select Employee</option>
                            <?php foreach($employee as $value){ ?>
                                <option value="<?= $value['id'] ?>" <?php if($value['id'] == $employee_seminar_conference_data['employee_id']){ echo "selected"; } ?>><?= $value['first_name']." ".$value['middle_name']." ".$value['last_name'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Type of Activity</span>
                            <select class="form-control form-control-sm" name="type_of_activity" required>
                                <option value="">--Select--</option>
                                <option value="Seminar" <?php if($employee_seminar_conference_data['type_of_activity'] == "Seminar"){ echo "selected"; } ?>>Seminar</option>
                                <option value="Conference" <?php if($employee_seminar_conference_data['type_of_activity'] == "Conference"){ echo "selected"; } ?>>Conference</option>
                                <option value="Exhibition" <?php if($employee_seminar_conference_data['type_of_activity'] == "Exhibition"){ echo "selected"; } ?>>Exhibition</option>
                                <option value="Workshop" <?php if($employee_seminar_conference_data['type_of_activity'] == "Workshop"){ echo "selected"; } ?>>Workshop</option>
                                <option value="Webinar" <?php if($employee_seminar_conference_data['type_of_activity'] == "Webinar"){ echo "selected"; } ?>>Webinar</option>
                                <option value="Symposium" <?php if($employee_seminar_conference_data['type_of_activity'] == "Symposium"){ echo "selected"; } ?>>Symposium</option>
                                <option value="Other" <?php if($employee_seminar_conference_data['type_of_activity'] == "Other"){ echo "selected"; } ?>>Other</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 other_activity" style="display: none;">
                            <span>Other Activity</span>
                            <input type="text" class="form-control form-control-sm" name="other_activity" value="<?= $employee_seminar_conference_data['other_activity'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <span>Name </span>
                            <input type="text" class="form-control form-control-sm" name="seminar_name" value="<?= $employee_seminar_conference_data['seminar_name'] ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>From Date</span>
                            <input type="date" class="form-control form-control-sm" name="from_date" value="<?= $employee_seminar_conference_data['from_date'] ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>To Date</span>
                            <input type="date" class="form-control form-control-sm" name="to_date" value="<?= $employee_seminar_conference_data['to_date'] ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Role</span>
                            <select class="form-control form-control-sm" name="role" required>
                                <option value="">--Select--</option>
                                <option value="Attended" <?php if($employee_seminar_conference_data['role'] == "Seminar"){ echo "selected"; } ?>>Attended</option>
                                <option value="Organized" <?php if($employee_seminar_conference_data['role'] == "Seminar"){ echo "selected"; } ?>>Organized</option>
                                <option value="Presented" <?php if($employee_seminar_conference_data['role'] == "Seminar"){ echo "selected"; } ?>>Presented</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Designation</span>
                            <input type="text" class="form-control form-control-sm" name="designation" value="<?= $employee_seminar_conference_data['designation'] ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Level</span>
                            <select class="form-control form-control-sm" name="level" required>
                                <option value="">--Select--</option>
                                <option value="Internation" <?php if($employee_seminar_conference_data['level'] == "Internation"){ echo "selected"; } ?>>Internation</option>
                                <option value="National" <?php if($employee_seminar_conference_data['level'] == "National"){ echo "selected"; } ?>>National</option>
                                <option value="Internation within Country" <?php if($employee_seminar_conference_data['level'] == "Internation within Country"){ echo "selected"; } ?>>Internation within Country</option>
                                <option value="University/Institute" <?php if($employee_seminar_conference_data['level'] == "University/Institute"){ echo "selected"; } ?>>University/Institute</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Start Date</span>
                            <input type="date" class="form-control form-control-sm" name="start_date" value="<?= $employee_seminar_conference_data['start_date'] ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>End Date</span>
                            <input type="date" class="form-control form-control-sm" name="end_date" value="<?= $employee_seminar_conference_data['end_date'] ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>No of Participants</span>
                            <input type="number" class="form-control form-control-sm" name="no_of_participant"  value="<?= $employee_seminar_conference_data['no_of_participant'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <span>Funding Agency Name</span>
                            <input type="text" class="form-control form-control-sm" name="funding_agency_name" value="<?= $employee_seminar_conference_data['funding_agency_name'] ?>" >
                        </div>
                        <div class="form-group col-md-6">
                            <span>Fund Amount</span>
                            <input type="number" class="form-control form-control-sm" name="fund_amount" step="1" min="1" value="<?= $employee_seminar_conference_data['fund_amount'] ?>" >
                        </div>  
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Employee</td>
                                <td>Activity</td>
                                <td>Saminar Name</td>
                                <td>Date(From - To)</td>
                                <td>Designation</td>
                                <td>level</td>
                                <td>Start End Date</td>
                                <td>Participant no</td>
                                <td>Funding Agency Name</td>
                                <td>Fund Amount</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($employee_seminar_conference as $key => $value){ ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?php $emp = $employee_model->get($value['employee_id']); if($emp){ echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']; }  ?></td>
                                <td><?php if($value['type_of_activity'] == 'Other'){ echo $value['other_activity']; } else { echo $value['type_of_activity']; } ?></td>
                                <td><?= $value['seminar_name'] ?></td>
                                <td><?= $value['from_date']." - ".$value['to_date'] ?></td>
                                <td><?= $value['designation'] ?></td>
                                <td><?= $value['level'] ?></td>
                                <td><?= $value['start_date']." - ".$value['end_date'] ?></td>
                                <td><?= $value['no_of_participant'] ?></td>
                                <td><?= $value['funding_agency_name'] ?></td>
                                <td><?= $value['fund_amount'] ?></td>
                                <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                        <a href="<?= base_url() ?>admin/edit-employee-seminar-conference/<?= $value['id'] ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                        <a href="<?= base_url() ?>admin/delete-employee-seminar-conference/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure...!')"><i class="far fa-trash-alt"></i></a>
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
document.addEventListener('DOMContentLoaded', function () {
    const activitySelect = document.querySelector('[name="type_of_activity"]');
    const otherActivityDiv = document.querySelector('.other_activity');
    const otherActivityInput = otherActivityDiv.querySelector('input');

    function toggleOtherActivity() {
        if (activitySelect.value === 'Other') {
            otherActivityDiv.style.display = 'block';
            otherActivityInput.required = true;
        } else {
            otherActivityDiv.style.display = 'none';
            otherActivityInput.required = false;
            otherActivityInput.value = ''; // Optional: clear input
        }
    }

    // Initial state
    toggleOtherActivity();

    // Listen for changes
    activitySelect.addEventListener('change', toggleOtherActivity);
});
</script>


<?= $this->endSection() ?>