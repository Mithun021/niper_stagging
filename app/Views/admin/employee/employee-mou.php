<!-- app/Views/emppublicationdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<?php

use App\Models\Employee_model;

$employee_model = new Employee_model();
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('msg')): ?>
                    <?= session()->getFlashdata('msg') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/employee-mou" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <span for="Empid">Employee:</span>
                            <select name="employee_id" id="employee_id" class="form-control form-control-sm my-select" required >
                                <option value="">Select Employee</option>
                            <?php foreach($employee as $value){ ?>
                                <option value="<?= $value['id'] ?>"><?= $value['first_name']." ".$value['middle_name']." ".$value['last_name'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <span>Title of MoU</span>
                            <input type="text" class="form-control form-control-sm" name="mou_title" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Name of Institution</span>
                            <input type="text" class="form-control form-control-sm my-select" name="institution_name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Year of Entering MoU</span>
                            <select name="entring_mou_year" class="form-control form-control-sm" required>
                                <option value="">--Select--</option>
                                <?php for ($i = 2000; $i <= date('Y'); $i++) { ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Duration</span>
                            <input type="text" class="form-control form-control-sm my-select" name="duration" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Status </span>
                            <select class="form-control form-control-sm" name="status" required>
                                <option value="0">Expired</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0">List of <?= $title ?></h4>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Employee</td>
                                <td>Title of MoU</td>
                                <td>Name of Institution</td>
                                <td>Year of Entering MoU</td>
                                <td>Duration</td>
                                <td>Status</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employee_mou as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?php $emp = $employee_model->get($value['employee_id']); if($emp){ echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']; }  ?></td>
                                    <td><?= $value['mou_title'] ?></td>
                                    <td><?= $value['institution_name'] ?></td>
                                    <td><?= $value['entring_mou_year'] ?></td>
                                    <td><?= $value['duration'] ?></td>
                                    <td><?php
                                        if ($value['status'] == 0) {
                                            echo "<span class='badge badge-warning badge-pill'>Expired</span>";
                                        } elseif ($value['status'] == 1) {
                                            echo "<span class='badge badge-success badge-pill'>Active</span>";
                                        }
                                    ?></td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            <!-- <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a> -->
                                            <a href="<?= base_url() ?>admin/edit-employee-mou/<?= $value['id'] ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                            <a href="<?= base_url() ?>admin/delete-employee-mou/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure...!!')"><i class="far fa-trash-alt"></i></a>
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

</div>
<?= $this->endSection() ?>