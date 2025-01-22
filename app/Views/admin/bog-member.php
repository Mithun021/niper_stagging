<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Employee_model;

$employee_model = new Employee_model();
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')) : ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <form action="<?= base_url() ?>admin/bog-member" method="post">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="membername">Member Name:</span>
                                <input type="text" name="membername" id="membername" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="affiliation">Affiliation:</span>
                                <input type="text" name="affiliation" id="affiliation" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="designation">Designation:</span>
                                <input type="text" name="designation" id="designation" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="termyearstart">Term Year Start:</span>
                                <input type="number" name="termyearstart" id="termyearstart" class="form-control form-control-sm" min="2000" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="termyearend">Term Year End:</span>
                                <input type="number" name="termyearend" id="termyearend" class="form-control form-control-sm" min="2000" required>
                            </div>
                        </div>
                    </div>










                    <div class="form-group text-left">
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover bog_table" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Name</td>
                                <td>Affiliation</td>
                                <td>Designation</td>
                                <td>Term Year</td>
                                <td>Upload by</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bog_members as $key => $value) { ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $value['member_name'] ?></td>
                                    <td><?= $value['affiliation'] ?></td>
                                    <td><?= $value['designation'] ?></td>
                                    <td><?= $value['term_start_year'] . ' - ' . $value['term_end_year'] ?></td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>admin/bog-member/<?= $value['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="<?= base_url() ?>admin/bog-member/delete/<?= $value['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
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

<script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>

<script>
    
</script>


<?= $this->endSection() ?>