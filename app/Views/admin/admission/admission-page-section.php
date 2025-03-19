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
                <h4 class="card-title m-0">Admission Page Section</h4>
            </div>
            <div class="card-body p-2">
                <form method="post" action="<?= base_url() ?>admin/admission-page-section" enctype="multipart/form-data">
                    <div class="form-group">
                        <span>Section Title<span class="text-danger">*</span></span>
                        <input type="text" name="section_title" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <span>Section Description</span>
                        <textarea id="editor2" name="section_description"></textarea>
                    </div>
                    <div class="form-group">
                        <span>Section Image Upload</span>
                        <input type="file" class="form-control form-control-sm" name="section_image" accept=".jpg, .png" required>
                    </div>
                    <div class="form-group">
                        <span>Section Priority</span>
                        <input type="number" name="section_priority" class="form-control form-control-sm" required>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Admission Page Section List</h4>
            </div>
            <div class="card-body p-2">
                <table  class="table table-striped table-hover" id="basic-datatable">
                    <thead>
                        <tr>
                            <td>SN</td>
                            <td>Section Title</td>
                            <td>Section Description</td>
                            <td>Section Image</td>
                            <td>Priority</td>
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

<?= $this->endSection() ?>