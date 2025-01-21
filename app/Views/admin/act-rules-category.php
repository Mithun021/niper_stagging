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
                <form method="post" action="<?= base_url() ?>admin/act-rules-category">
                    <div class="form-group">
                        <span for="">Category Name<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="category_name" required minlength="3">
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
                            <td>Category</td>
                            <td>Create at</td>
                            <td>Upload by</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($act_rules_category as $key => $value) { ?>
                        <tr>
                            <td> <?= ++$key ?></td>
                            <td> <?= $value['name'] ?></td>
                            <td> <?= date('d-m-Y', strtotime($value['created_at'])) ?></td>
                            <td><?php $emp = $employee_model->get($value['upload_by']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                            <td>
                                <a href="<?= base_url() ?>admin/bog-member/<?= $value['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="<?= base_url() ?>admin/bog-member/delete/<?= $value['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
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