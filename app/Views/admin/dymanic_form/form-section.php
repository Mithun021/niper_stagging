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
                <h4 class="card-title m-0">Add <?= $title ?> </h4>
            </div>
            <div class="card-body">
                <?php
                    if(session()->getFlashdata('msg')){
                        echo session()->getFlashdata('msg');
                    }
                ?>
                <form method="post" action="<?= base_url() ?>admin/designation">
                    <div class="form-group">
                        <span>Form Detail Id</span>
                        <select name="form_detail_id" id="form_detail_id" class="form-control form-control-sm">
                            <option value="1">--Select--</option>
                        <?php foreach ($form_details as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <span for="">Section Name<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="section_name" required minlength="3">
                    </div>
                    <div class="form-group">
                        <span for="">Desription</span>
                        <textarea id="editor" name="description"></textarea>
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
                <table class="table table-striped table-hover" id="basic-datatable">
                    <thead>
                        <tr>
                            <td>SN</td>
                            <td>Form Detail id</td>
                            <td>Name</td>
                            <td>Description</td>
                            <td>Upload by</td>
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