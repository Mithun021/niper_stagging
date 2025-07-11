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
                <form action="<?= base_url() ?>admin/edit-employee-talk-poster/<?= $employee_talk_poster_id ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <span for="Empid">Employee:</span>
                            <select name="employee_id" id="employee_id" class="form-control form-control-sm my-select" required >
                                <option value="">Select Employee</option>
                            <?php foreach($employee as $value){ ?>
                                <option value="<?= $value['id'] ?>" <?php if($value['id'] == $employee_talk_poster_data['employee_id']){ echo "selected"; } ?>><?= $value['first_name']." ".$value['middle_name']." ".$value['last_name'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Name of Event</span>
                            <input type="text" class="form-control form-control-sm" name="event_name" value="<?= $employee_talk_poster_data['event_name'] ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Location</span>
                            <select class="form-control form-control-sm" name="location" required>
                                <option value="">--Select--</option>
                                <option value="Internation" <?php if($employee_talk_poster_data['location'] == "Internation"){ echo "selected"; } ?>>Internation</option>
                                <option value="National" <?php if($employee_talk_poster_data['location'] == "National"){ echo "selected"; } ?>>National</option>
                                <option value="Internation within Country" <?php if($employee_talk_poster_data['location'] == "Internation within Country"){ echo "selected"; } ?>>Internation within Country</option>
                                <option value="University/Institute" <?php if($employee_talk_poster_data['location'] == "University/Institute"){ echo "selected"; } ?>>University/Institute</option>
                            </select>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <span>Organizing Institute Name</span>
                            <input type="text" class="form-control form-control-sm" name="organizing_institute_name" value="<?= $employee_talk_poster_data['organizing_institute_name'] ?>" required>
                        </div>

                        <div class="form-group col-md-6">
                            <span>Role</span>
                            <select class="form-control form-control-sm" name="role" required>
                                <option value="">--Select--</option>
                                <option value="Keynote Speaker" <?php if($employee_talk_poster_data['role'] == "Keynote Speaker"){ echo "selected"; } ?>>Keynote Speaker</option>
                                <option value="Expert Talk" <?php if($employee_talk_poster_data['role'] == "Expert Talk"){ echo "selected"; } ?>>Expert Talk</option>
                                <option value="Others" <?php if($employee_talk_poster_data['role'] == "Others"){ echo "selected"; } ?>>Others</option>
                            </select>
                        </div>
                        
                        <div class="form-group col-md-6 other_role" style="display: none;">
                            <span>Role Input field for Other type</span>
                            <input type="text" class="form-control form-control-sm" name="other_role" value="<?= $employee_talk_poster_data['other_role'] ?>" required>
                        </div>
                       
                        <div class="form-group col-md-6">
                            <span>Start Date</span>
                            <input type="date" class="form-control form-control-sm" name="start_date" value="<?= $employee_talk_poster_data['start_date'] ?>" required>
                        </div>

                        <div class="form-group col-md-6">
                            <span>End Date</span>
                            <input type="date" class="form-control form-control-sm" name="end_date" value="<?= $employee_talk_poster_data['end_date'] ?>" required>
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
                                <td>Event Name</td>
                                <td>Location</td>
                                <td>Organizing Institute Name</td>
                                <td>Role</td>
                                <td>Start Date - End Date</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($employee_talk_poster as $key => $value){ ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?php $emp = $employee_model->get($value['employee_id']); if($emp){ echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']; }  ?></td>
                                <td><?= $value['event_name'] ?></td>
                                <td><?= $value['location'] ?></td>
                                <td><?= $value['organizing_institute_name'] ?></td>
                                <td><?= $value['role'] ?> <?= ($value['other_role']) ? " - ".$value['other_role'] : '' ?></td>
                                <td><?= $value['start_date'] ?> -<?= $value['end_date'] ?></td>
                                <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                        <a href="<?= base_url() ?>admin/edit-employee-talk-poster/<?= $value['id'] ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                        <a href="<?= base_url() ?>admin/delete-employee-talk-poster/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure..!')"><i class="far fa-trash-alt"></i></a>
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
    const roleSelect = document.querySelector('[name="role"]');
    const otherRoleDiv = document.querySelector('.other_role');
    const otherRoleInput = otherRoleDiv.querySelector('input');

    function toggleOtherRole() {
        if (roleSelect.value === 'Others') {
            otherRoleDiv.style.display = 'block';
            otherRoleInput.required = true;
        } else {
            otherRoleDiv.style.display = 'none';
            otherRoleInput.required = false;
            otherRoleInput.value = ''; // Optional: clear input
        }
    }

    toggleOtherRole(); // Set initial state
    roleSelect.addEventListener('change', toggleOtherRole);
});

</script>



<?= $this->endSection() ?>