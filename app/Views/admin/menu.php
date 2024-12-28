<!-- app/Views/recruiterdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php
    use App\Models\Employee_model;
    $employee_model = new Employee_model();
?>
<div class="row">
    <!-- Form Section for Adding <?= $title ?> -->
    <div class="col-lg-5">
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
                        <input type="text" name="menu_name" id="menu_name" class="form-control form-control-sm" required>
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
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Menu Name</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($menu_name as $key => $value) { ?>
                            <tr>
                                <td><?= $key+1 ?></td>
                                <td><?= $value['name'] ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                        <a href="#" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                        <a href="#" class="btn btn-danger waves-effect waves-light"><i class="far fa-trash-alt"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
    <div id="accordion" class="custom-accordion mb-4">
    <?php $heading = 1; $collapse = 1 ?>
    <?php foreach ($menu_name as $key => $value) { ?>
        
            <div class="card mb-2">
                <div class="card-header" id="heading<?= $heading ?>">
                    <h5 class="m-0 font-size-15">
                        <a class="d-block m-0 text-dark" data-toggle="collapse" href="#collapse<?= $collapse?>" aria-expanded="true" aria-controls="collapse<?= ++$key ?>">
                            <?= $value['name'] ?> <span class="float-right"><i class="mdi mdi-chevron-down accordion-arrow"></i></span>
                        </a>
                    </h5>
                </div>
                <div id="collapse<?= $collapse ?>" class="collapse" aria-labelledby="heading<?= $heading ?>" data-parent="#accordion">
                    <div class="card-body">
                        <form action="<?= base_url() ?>admin/menu-heading" method="post">
                            <input type="text" name="menu_id" value="<?= $value['id'] ?>">
                            <div class="input-group">
                                <input type="text" name="heading" id="heading" class="form-control form-control-sm" required>
                                <input type="url" name="custom_link" id="custom_link" class="form-control form-control-sm">
                            </div>

                            <div class="form-group">
                                <input type="submit" value="Save Heading" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end card-->
        
    <?php $heading++; $collapse++; } ?>
    </div> <!-- end custom accordions-->
    </div> <!-- end col -->



</div>
<?= $this->endSection() ?>