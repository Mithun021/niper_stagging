<!-- app/Views/convocationdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php
use App\Models\Employee_model;
$employee_model = new Employee_model();
?>

<div class="row">
    <!-- Form Section for Adding Convocation Details -->
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
                <form action="<?= base_url() ?>admin/convocation" method="post" enctype="multipart/form-data">

                    <!-- Convocation Number -->
                    <div class="form-group">
                        <span for="Convnumber">Convocation Title:<span class="text-danger">*</span></span>
                        <input type="text" name="conv_title" id="conv_title" class="form-control form-control-sm" required>
                    </div>

                    <div class="form-group">
                        <span for="Convnumber">Academic Session Start Year:<span class="text-danger">*</span></span>
                        <input type="text" name="academic_start_year" id="academic_start_year" class="form-control form-control-sm" required>
                    </div>

                    <div class="form-group">
                        <span for="Convnumber">Academic Session End Year:<span class="text-danger">*</span></span>
                        <input type="text" name="academic_end_year" id="academic_end_year" class="form-control form-control-sm" required>
                    </div>

                    <!-- Upload Awardee File -->
                    <div class="form-group mt-3">
                        <span for="Awardeefileupload">Upload Awardee File(.pdf):<span class="text-danger">*</span></span>
                        <input type="file" name="upload_file" id="upload_file" class="form-control form-control-sm" accept=".pdf" required>
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Convocation Details (Optional) -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>File</td>
                                <td>Convocation Title</td>
                                <td>Acadmic Year</td>
                                <td>Upload by</td>
                                <td>Created at</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($convocation as $key => $value) { ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td>
                                    <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/convocation/' . $value['upload_file'])): ?>
                                        <a href="<?= base_url() ?>public/admin/uploads/convocation/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                    <?php else: ?>
                                        <img src="<?= base_url() ?>public/admin/uploads/convocation/invalid_image.png" alt="" height="40px">
                                    <?php endif; ?>
                                </td>
                                <td><?= $value['title'] ?></td>
                                <td><?= date("d:M:Y", strtotime($value['academic_session_start'])) ?> - <?= date("d:M:Y", strtotime($value['academic_session_end'])) ?></td>
                                <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                        <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a>
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
</div>

<?= $this->endSection() ?>