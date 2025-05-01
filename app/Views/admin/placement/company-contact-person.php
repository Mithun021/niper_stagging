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
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <form action="<?= base_url() ?>admin/company-contact-person" method="post" enctype="multipart/form-data" id="alumini-page-notification-form">
                <div class="card-body p-1">
                    <?php if (session()->getFlashdata('status')) {
                        echo session()->getFlashdata('status');
                    } ?>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <span for="title">Company Name</span>
                            <select class="form-control form-control-sm" name="company_name" required>
                                <option value="">--Select--</option>
                            <?php foreach ($company_details as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>"><?= $value['company_name'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Contact Name</span>
                            <input type="text" class="form-control form-control-sm" name="contact_name" id="contact_name" placeholder="Enter Company Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Contact Designation</span>
                            <input type="text" name="contact_designation" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Linkedin</span>
                            <input type="url" name="linkedin" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <span for="title">Facebook</span>
                            <input type="url" name="facebook" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <span for="title">Instagram</span>
                            <input type="url" name="instagram" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
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