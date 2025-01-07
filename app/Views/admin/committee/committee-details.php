<!-- app/Views/committee_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

    use App\Models\Committee_model;
    use App\Models\Employee_model;
    $committee_model = new Committee_model();
    $employee_model = new Employee_model();
?>
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title; ?></h4>
            </div>

            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/committee-details" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="Committeetitle">Committee Title:</span>
                        <input type="text" name="Committeetitle" id="Committeetitle" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <span for="Committeetitle">Parent Committee:</span>
                        <select name="subcommitteeid" id="subcommitteeid" class="form-control form-control-sm">
                            <option value="">--Select Committee--</option>
                        <?php foreach ($committee as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <span for="Committeedesc">Committee Description:</span>
                        <textarea id="editor" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <span for="Committeefileupload">File Upload(pdf):</span>
                        <input type="file" name="Committeefileupload" id="Committeefileupload" class="form-control form-control-sm" accept=".pdf">
                    </div>
                    <div class="form-group">
                        <span for="Committeestatus">Status:</span>
                        <select class="form-control form-control-sm" name="committee_status" required>
                            <option value="0">Draft</option>
                            <option value="1">Active</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Display Committees in a Table -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title; ?> List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>File</td>
                                <td>Comm. name</td>
                                <td>Parent Comm.</td>
                                <td>Status</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($committee as $key => $value) { ?>
                            <tr>
                                <td><?= $key+1 ?></td>
                                <td>
                                    <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/events/' . $value['upload_file'])): ?>
                                        <a href="<?= base_url() ?>public/admin/uploads/committee/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                    <?php else: ?>
                                        <img src="<?= base_url() ?>public/admin/uploads/events/invalid_image.png" alt="" height="40px">
                                    <?php endif; ?>
                                </td>
                                <td><?= $value['title'] ?></td>
                                <td><?php $sub_comm = $committee_model->get($value['sub_committee']); echo $sub_comm['title']; ?></td>
                                <td><?= ($value['status'] == "0") ? "<span class='badge badge-danger badge-pill'>Draft</span>" : (($value['status'] == "1") ? "<span class='badge badge-success badge-pill'>Active</span>" : "") ?></td>
                                
                                <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name'] ?></td>
                                <td>
                                    <a href="<?= base_url() ?>admin/committee-details/<?= $value['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="<?= base_url() ?>admin/committee-details/<?= $value['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
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