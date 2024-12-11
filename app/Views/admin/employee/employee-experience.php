<!-- app/Views/empexpdetails_form.php -->

<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<?php
    use App\Models\Employee_model;
    $employee_model = new Employee_model();
?>
<style>
    #clone_content #clone_employee_data:first-child button#remove-clone {
        display: none;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title; ?></h4>
            </div>

            <div class="card-body">
                <?php if (session()->getFlashdata('msg')): ?>
                    <?= session()->getFlashdata('msg') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/employee-experience" method="post">
                    <div class="card card-body mb-1">
                        <div class="row">
                            <div class="col-lg-12 form-group">
                                <span for="Empid">Employee:</span>
                                <select name="Empid" id="Empid" class="form-control form-control-sm" required >
                                    <option value="">Select Employee</option>
                                <?php foreach($employee as $value){ ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['first_name']." ".$value['middle_name']." ".$value['last_name'] ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Empid -->
                     <div id="clone_content">
                     <div class="card card-body" id="clone_employee_data">
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <span for="orgname">Organization Name:</span>
                            <input type="text" name="orgname" id="orgname" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-lg-3 form-group">
                            <span for="startdate">Start Date:</span>
                            <input type="date" name="startdate" id="startdate" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-lg-3 form-group">
                            <span for="enddate">End Date:</span>
                            <input type="date" name="enddate" id="enddate" class="form-control form-control-sm">
                        </div>
                        <div class="col-lg-12 form-group">
                            <span for="expdesc">Experience Description:</span>
                            <textarea name="expdesc" id="editor" class="form-control form-control-sm" rows="4"></textarea>
                        </div>
                        <div class="col-lg-6 form-group">
                            <span for="orgtype">Organization Type:</span>
                            <select name="orgtype" id="orgtype" class="form-control form-control-sm" required>
                                <option value="Central Government">Central Government</option>
                                <option value="State Government">State Government</option>
                                <option value="Autonomous">Autonomous</option>
                                <option value="PSU">PSU</option>
                                <option value="Private">Private</option>
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <span for="natureofwork">Nature of Work:</span>
                            <select name="natureofwork" id="natureofwork" class="form-control form-control-sm" required>
                                <option value="Teaching">Teaching</option>
                                <option value="Research">Research</option>
                                <option value="Administrative">Administrative</option>
                                <option value="Post Doc">Post Doc</option>
                            </select>
                        </div>
                        
                        
                    </div><!-- Close row -->
                        <button type="button" id="remove-clone" class="btn btn-danger" style="width: 120px;">Remove Clone</button>
                     </div>
                     </div>
                </form>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <button type="button" id="add-clone" class="btn btn-success">Add Clone</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>

    <!-- Table to display existing empexpdetails -->
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
                                <td>Employee</td>
                                <td>Org. Name</td>
                                <td>Start & End Date</td>
                                <td>Org. Type</td>
                                <td>Work Nature</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($employee_exp as $key => $value){ ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?php $emp = $employee_model->get($value['emplyee_id']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
                                <td><?= $value['organization_name'] ?></td>
                                <td><?= $value['start_date']. " - ".$value['end_date'] ?></td>
                                <td><?= $value['org_type'] ?></td>
                                <td><?= $value['work_nature'] ?></td>
                                <td><?= $value['upload_by'] ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                        <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a>
                                        <a href="#" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                        <a href="#" class="btn btn-danger waves-effect waves-light"><i class="far fa-trash-alt"></i></a>
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

<!-- jQuery Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $("#add-clone").click(function(e){
        e.preventDefault();
        var cloneCatrow = $('#clone_employee_data').clone().appendTo('#clone_content');
        $(cloneCatrow).find('input').val('');
    });

    $('#clone_content').on('click','#remove-clone', function(){
		$(this).closest('#clone_employee_data').remove();
	});
});
</script>

<?= $this->endSection() ?>