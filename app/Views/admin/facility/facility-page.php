<?= $this->extend("admin/layouts/master") ?>
<?=  $this->section("body-content"); ?>
<?php
    use App\Models\Employee_model;
    $employee_model = new Employee_model();
?>
<style>
    
</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php
                    if(session()->getFlashdata('status')){
                        echo session()->getFlashdata('status');
                    }
                ?>
                <form method="post" action="<?= base_url() ?>admin/facility-page" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="">Name<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <span for="">Description:</span>
                        <textarea name="description" id="editor" class="form-control form-control-sm"></textarea>
                    </div>
                    <div class="form-group">
                        <span>Department</span>
                        <select name="department_id" class="form-control form-control-sm" required>
                            <option value="">--Select--</option>
                        <?php foreach ($departments as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <span>Status</span>
                        <select name="status" class="form-control form-control-sm" required>
                            <option value="1">Active</option>
                            <option value="0">Draft</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                    
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-striped table-hover" id="basic-datatable" style="width: 120%;">
                    <thead>
                        <tr>
                            <td>SN</td>
                            <td>Name</td>
                            <td>Description</td>
                            <td>Status</td>
                            <td>Uploaded By</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($facility_page as $key => $value) { ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td><?= $value['name'] ?></td>
                            <td><?= $value['description'] ?></td>
                            <td><?= $value['status'] == 1 ? 'Active' : 'Draft' ?></td>
                            <td><?php $emp = $employee_model->get($value['upload_by']); if($emp){ echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']; }  ?></td>
                            <td>
                                <a href="<?= base_url() ?>admin/edit-facility-page/<?= $value['id'] ?>" class="btn btn-sm btn-primary"><i class="fas fa-pen"></i></a>
                                <a href="<?= base_url() ?>admin/delete-facility-page/<?= $value['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure...!')"><i class="far fa-trash-alt"></i></a>
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

<?= $this->endSection() ?>