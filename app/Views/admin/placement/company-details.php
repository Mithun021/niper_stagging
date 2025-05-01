<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Employee_model;

$employee_model = new Employee_model();
?>
<style>

</style>
<!-- start page title -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <form action="<?= base_url() ?>admin/placement-company-details" method="post" enctype="multipart/form-data" id="alumini-page-notification-form">
                <div class="card-body p-1">
                    <?php if (session()->getFlashdata('status')) {
                        echo session()->getFlashdata('status');
                    } ?>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <span for="title">Company Name</span>
                            <input type="text" class="form-control form-control-sm" name="copanty_name" id="copanty_name" placeholder="Enter Company Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Company Logo (jpeg, png, 500kb)</span>
                            <input type="file" class="form-control form-control-sm" name="company_logo" accept=".jpg,.png,.jpeg" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Company Photo (jpeg, png, 500kb)</span>
                            <input type="file" class="form-control form-control-sm" name="company_photo" accept=".jpg,.png,.jpeg">
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Company Profile</span>
                            <input type="text" name="company_profile" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Company Website link</span>
                            <input type="url" name="company_website" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Linkedin</span>
                            <input type="url" name="linkedin" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Facebook</span>
                            <input type="url" name="facebook" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Instagram</span>
                            <input type="url" name="instagram" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Twitter</span>
                            <input type="url" name="twitter" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Email 1</span>
                            <input type="email" name="email_1" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Email 2</span>
                            <input type="email" name="email_2" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Helpline number 1</span>
                            <input type="tel" name="helpline_number1" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Helpline number 2</span>
                            <input type="tel" name="helpline_number2" class="form-control form-control-sm" required>
                        </div>
                    </div>
                </div>
                <div class="card-footer p-2">
                    <input type="submit" class="btn btn-primary" value="Submit" id="submit">
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>