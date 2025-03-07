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
                <form method="post" action="<?= base_url() ?>admin/flash-news" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="">Title<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="title">
                    </div>
                    <div class="form-group">
                        <span for="">Upload Image(JPG,PNG)<span class="text-danger">*</span></span>
                        <input type="file" class="form-control form-control-sm" name="flash_photo" accept=".jpg, .png, .jpeg" required>
                    </div>
                    <div class="form-group">
                        <span for="">Upload File(PDF)</span>
                        <input type="file" class="form-control form-control-sm" name="flash_file" accept=".pdf">
                    </div>
                    <div class="form-group">
                        <span for="">Description:</span>
                        <textarea name="flashdesc" id="editor" class="form-control form-control-sm"></textarea>
                    </div>

                    <div class="form-group">
                        <span>Publish Date<span class="text-danger">*</span></span>
                        <input type="date" name="publish_date" class="form-control form-control-sm" required>
                    </div>

                    <div class="form-group">
                        <span>Web Link<span class="text-danger">*</span></span>
                        <input type="url" name="web_link" class="form-control form-control-sm" required>
                    </div>

                    <div class="form-group">
                        <span>Status</span>
                        <select name="status" class="form-control form-control-sm">
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
                            <td>Files</td>
                            <td>Title</td>
                            <td>Description</td>
                            <td>Publish Date</td>
                            <td>Status</td>
                            <td>Uploaded By</td>
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