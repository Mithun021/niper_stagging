<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php
    use App\Models\Employee_model;
    $employee_model = new Employee_model();
?>

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Admission Page</h4>
            </div>
            <div class="card-body p-2">
                <?php
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>
                <form method="post" action="<?= base_url() ?>admin/admission" enctype="multipart/form-data">
                    <div class="form-group">
                        <span>Title<span class="text-danger">*</span></span>
                        <input type="text" name="title" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <span>Description</span>
                        <textarea id="editor" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <span>Banner Image Upload</span>
                        <input type="file" class="form-control form-control-sm" name="banner_image" accept=".jpg, .png" required>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>