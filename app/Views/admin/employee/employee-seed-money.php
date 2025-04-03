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
            <form action="<?= base_url() ?>admin/employee-seed-money" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <span>Amount of Seed Money Received</span>
                    <input type="number" class="form-control form-control-sm" name="received_money" required>
                </div>
                <div class="form-group">
                    <span>Year</span>
                    <select name="years" class="form-control form-control-sm" required>
                        <option value="">--Select--</option>
                    <?php for ($i=2000; $i <= date('Y') ; $i++) { ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <span>Duration of Grant</span>
                    <input type="number" class="form-control form-control-sm" name="grant_duration" required>
                </div>
                <div class="form-group">
                    <span>Status </span>
                    <select class="form-control form-control-sm" name="received_money" required>
                        <option value="0">Ongoing</option>
                        <option value="1">Complete</option>
                    </select>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>