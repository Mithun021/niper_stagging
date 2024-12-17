<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Department_model;
use App\Models\Designation_model;

    $department_model = new Department_model();
    $designation_model = new Designation_model();

    $designation = $designation_model->get();
?>

<style>
    .designation_data {
    display: flex;
    flex-wrap: wrap; /* Allows wrapping to a new line when needed */
}

.designation_data span {
    display: flex;
    justify-content: space-between; /* Distribute space between the two parts */
    width: 100%; /* Make each span take the full width */
    margin-bottom: 10px; /* Optional: space between the rows */
}

.designation_data input {
    flex: 0 1 auto; /* Makes the checkbox not grow or shrink */
}

.designation_data label {
    flex: 1; /* Makes the label part take remaining space */
}

</style>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title; ?> List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Emp. ID</td>
                                <td>Emp. Name</td>
                                <td>Emp. Phone</td>
                                <td>Additional Charge Details</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($employee as $key => $value) {?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $value['employee_unique_id'] ?></td>
                                <td><?= $value['first_name']." ".$value['middle_name']." ".$value['last_name'] ?></td>
                                <td><?php if($value['authority']!=="admin"){ ?> <?= $value['mobile_no'] ?>  <?php }else { echo "_____"; } ?></td>
                                <td>__</td>
                                <td><button type="button" class="btn btn-sm btn-dark" onclick="add_emp_charge_btn(<?= $value['id'] ?>)">Manage Charge</button></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="add_emp_charge_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Manage Additional Charge</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control" id="employee_id" name="employee_id">
        <div class="designation_data">
        <?php foreach ($$designation as $key => $value) { ?>
            <span><input type="checkbox" name="designation[]" id="designation" value="<?= $value['id'] ?>"><?= $value['name'] ?></span>
        <?php } ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<script>
    function add_emp_charge_btn(emp_id) { 
        $('#employee_id').val(emp_id);
        $('#add_emp_charge_modal').modal('show');
     }
</script>

<?= $this->endSection() ?>