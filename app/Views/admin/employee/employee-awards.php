<!-- app/Views/empawarddetails_form.php -->
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
    <!-- Form Section for Adding  Details -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
                <div>
                    <button type="button" class="btn btn-sm btn-danger">Export Emp. Sample</button>
                    <button class="btn btn-sm btn-primary" id="upload_emp_exp_btn">Import</button>
                </div>
            </div>
            <div class="card-body">
            <?php if (session()->getFlashdata('msg')): ?>
                <?= session()->getFlashdata('msg') ?>
            <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/employee-awards" method="post" enctype="multipart/form-data">
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
                <div id="clone_content">
                    <div class="card card-body" id="clone_employee_data">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Award Title -->
                        <div class="form-group">
                            <span for="Awardtitle">Award Title:</span>
                            <input type="text" name="Awardtitle" id="editor" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Award Photo Upload -->
                        <div class="form-group">
                            <span for="Awardphotoupload">Upload Award Photo:</span>
                            <input type="file" name="Awardphotoupload" id="Awardphotoupload" class="form-control form-control-sm" accept="image/*">
                        </div>
                    </div>
                    <div class="col-lg-6">
                         <!-- Award Year -->
                        <div class="form-group">
                            <span for="Awardyear">Award Year:</span>
                            <input type="number" name="Awardyear" id="Awardyear" class="form-control form-control-sm" min="1900" max="<?= date('Y') ?>" required value="<?= esc(old('Awardyear')) ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Award Date and Time -->
                        <div class="form-group">
                            <span for="Awarddatetime">Award Date and Time:</span>
                            <input type="datetime-local" name="Awarddatetime" id="Awarddatetime" class="form-control form-control-sm" required value="<?= esc(old('Awarddatetime')) ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Awarding Agency Type -->
                        <div class="form-group">
                            <span for="Awardingagencytype">Awarding Agency Type:</span>
                            <input type="text" name="Awardingagencytype" id="Awardingagencytype" class="form-control form-control-sm" required value="<?= esc(old('Awardingagencytype')) ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Awarding Agency Name -->
                        <div class="form-group">
                            <span for="Awardingagencyname">Awarding Agency Name:</span>
                            <input type="text" name="Awardingagencyname" id="Awardingagencyname" class="form-control form-control-sm" required value="<?= esc(old('Awardingagencyname')) ?>">
                        </div>
                    </div>
                </div>
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

    <!-- Table Section to Display Existing Awards (Optional) -->
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
                                <td>Photo</td>
                                <td>Employee</td>
                                <td>Award Title</td>
                                <td>Date & Time</td>
                                <td>Year</td>
                                <td>Agency Type</td>
                                <td>Agency Name</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($awards as $key => $value){ ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td>
                                    <a href="<?= base_url() ?>public/admin/uploads/awards/<?= $value['award_photo'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/awards/<?= $value['award_photo'] ?>" height="30px"></a>
                                </td>
                                <td><?php $emp = $employee_model->get($value['emplyee_id']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
                                <td><?= $value['award_title'] ?></td>
                                <td><?= $value['award_date_time'] ?></td>
                                <td><?= $value['award_year'] ?></td>
                                <td><?= $value['award_agency_type'] ?></td>
                                <td><?= $value['award_agency_name'] ?></td>
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

<div class="modal fade" tabindex="-1" role="dialog" id="upload_emp_exp_modal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload Employee Awards Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
      <div class="modal-body">
        <input type="file" class="dropify" data-height="300" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Upload</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
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

    $('#upload_emp_exp_btn').on('click',function (e) { 
        e.preventDefault();
        $('#upload_emp_exp_modal').modal('show');
     })


});
</script>

<?= $this->endSection() ?>