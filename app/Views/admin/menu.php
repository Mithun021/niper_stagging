<!-- app/Views/recruiterdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php
    use App\Models\Employee_model;
    $employee_model = new Employee_model();
?>
<div class="row">
    <!-- Form Section for Adding <?= $title ?> -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> Name</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/menu" method="post">
                    <!-- Recruiter Title -->
                    <div class="form-group">
                        <span for="Recruitertitle">Menu Title<span class="text-danger">*</span>:</span>
                        <input type="text" name="researchtitle" id="researchtitle" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Save Menu" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h4 class="card-title m-0"><?= $title ?> Details</h4></div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Menu Name</td>
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