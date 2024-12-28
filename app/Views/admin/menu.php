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
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/private-research-labs" method="post" enctype="multipart/form-data">
                    <!-- Recruiter Title -->
                    <div class="form-group">
                        <span for="Recruitertitle">Research Lab Title<span class="text-danger">*</span>:</span>
                        <input type="text" name="researchtitle" id="researchtitle" class="form-control form-control-sm" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>