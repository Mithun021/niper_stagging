<!-- app/Views/emppublicationdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<?php
    use App\Models\Employee_model;
    $employee_model = new Employee_model();
?>

<div class="row">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
            <?php if (session()->getFlashdata('msg')): ?>
                <?= session()->getFlashdata('msg') ?>
            <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/employee-publication" method="post" enctype="multipart/form-data">

                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>