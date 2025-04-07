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
                <?php if (session()->getFlashdata('msg')): ?>
                    <?= session()->getFlashdata('msg') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/employee-collaboration" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <span for="Empid">Employee:</span>
                            <select name="employee_id" id="employee_id" class="form-control form-control-sm my-select" required >
                                <option value="">Select Employee</option>
                            <?php foreach($employee as $value){ ?>
                                <option value="<?= $value['id'] ?>"><?= $value['first_name']." ".$value['middle_name']." ".$value['last_name'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Type of Activity</span>
                            <select class="form-control form-control-sm" name="type_of_activity" required>
                                <option value="">--Select--</option>
                                <option value="Seminar">Seminar</option>
                                <option value="Conference">Conference</option>
                                <option value="Exhibition">Exhibition</option>
                                <option value="Workshop">Workshop</option>
                                <option value="Webinar">Webinar</option>
                                <option value="Symposium">Symposium</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 other_activity" style="display: none;">
                            <span>Other Activity</span>
                            <input type="text" class="form-control form-control-sm" name="other_activity">
                        </div>
                        <div class="form-group col-md-6">
                            <span>Name </span>
                            <input type="text" class="form-control form-control-sm" name="seminar_name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>From Date</span>
                            <input type="date" class="form-control form-control-sm" name="from_date" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>To Date</span>
                            <input type="date" class="form-control form-control-sm" name="to_date" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Role</span>
                            <select class="form-control form-control-sm" name="role" required>
                                <option value="">--Select--</option>
                                <option value="Attended">Attended</option>
                                <option value="Organized">Organized</option>
                                <option value="Presented">Presented</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Designation</span>
                            <input type="text" class="form-control form-control-sm" name="designation" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Level</span>
                            <select class="form-control form-control-sm" name="level" required>
                                <option value="">--Select--</option>
                                <option value="Internation">Internation</option>
                                <option value="National">National</option>
                                <option value="Internation within Country">Internation within Country</option>
                                <option value="University/Institute">University/Institute</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Start Date</span>
                            <input type="date" class="form-control form-control-sm" name="start_date" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>End Date</span>
                            <input type="date" class="form-control form-control-sm" name="end_date" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>No of Participants</span>
                            <input type="text" class="form-control form-control-sm" name="no_of_participant" >
                        </div>
                        <div class="form-group col-md-6">
                            <span>Funding Agency Name</span>
                            <input type="text" class="form-control form-control-sm" name="funding_agency_name" >
                        </div>
                        <div class="form-group col-md-6">
                            <span>Fund Amount</span>
                            <input type="text" class="form-control form-control-sm" name="fund_amount" >
                        </div>  
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        </div>
                    </div>
                </form>
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