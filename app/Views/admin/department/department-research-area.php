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
    <div class="col-lg-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?> </h4>
            </div>
            <div class="card-body">
                <?php
                    if(session()->getFlashdata('msg')){
                        echo session()->getFlashdata('msg');
                    }
                ?>
                <form method="post" action="<?= base_url() ?>admin/departments-section" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="">Department Id</span>
                        <select name="department_id" class="form-control form-control-sm">
                            <option value="">--Select--</option>
                        <?php foreach ($department as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['name']; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <span for="">Department Name<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="dept_name" required minlength="5">
                    </div>
                    <div class="form-group">
                        <span for="">Desription</span>
                        <textarea id="editor" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <span for="">Status</span>
                        <select name="status" class="form-control form-control-sm">
                            <option value="0">Teaching</option>
                            <option value="1">Active</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                    
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
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
                            <td>Dept Name</td>
                            <td>HOD</td>
                            <td>Status</td>
                            <td>Upload by</td>
                            <td>Created at</td>
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

<?= $this->endSection() ?>