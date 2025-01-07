<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<?php
    use App\Models\Employee_model;
    $employee_model = new Employee_model();
?>

<!-- Copyright Details Form -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status'); ?>
                <?php endif; ?>
                <form method="post" action="<?= base_url() ?>admin/copyright-details" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-6 form-group">
                        <span>Copyright Title <span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="Copyright_title" placeholder="Enter Copyright title" required>
                    </div>
                    <div class="col-lg-6 form-group">
                        <span>Copyright Number <span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="Copyright_number" placeholder="Enter Copyright number" required>
                    </div>
                    <div class="col-lg-12 form-group">
                        <span>Copyright Description</span>
                        <textarea id="editor" name="description"></textarea>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <span for="">Copyright start datetime<span class="text-danger">*</span></span>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" name="copyright_start_date"  placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                <input type="text" class="form-control form-control-sm" name="copyright_start_time"  placeholder="End Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <span for="">Copyright end datetime<span class="text-danger">*</span></span>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" name="copyright_end_date"  placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                <input type="text" class="form-control form-control-sm" name="copyright_end_time"  placeholder="End Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <span>Upload File (PDF, JPG, PNG)</span>
                        <input type="file" class="form-control form-control-sm" name="Copyright_file" accept=".pdf,.jpg,.png" required>
                    </div>
                    <div class="col-lg-6 form-group">
                        <span>Employee ID <span class="text-danger">*</span></span>
                        <select class="form-control form-control-sm" name="emp_id" required>
                            <option value="">--Select--</option>
                        <?php foreach ($employees as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['first_name']." ".$value['middle_name']." ".$value['last_name'] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-6 form-group">
                        <span>Author Name <span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="author_name" required>
                    </div>
                    <div class="col-lg-6 form-group">
                        <span>Copyright Status <span class="text-danger">*</span></span>
                        <select class="form-control form-control-sm" name="Copyright_status" required>
                            <option value="Draft">Draft</option>
                            <option value="Active">Active</option>
                        </select>
                    </div>
                    <div class="col-lg-12 form-group">
                        <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                    </div>
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
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>File</td>
                                <td>Title</td>
                                <td>Number</td>
                                <td>Start Date</td>
                                <td>End Date</td>
                                <td>Emp. ID</td>
                                <td>Status</td>
                                <td>Uploaded by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($copyright as $key => $value) { ?>
                            <tr>
                                <td><?= $key+1 ?></td>
                                <td>
                                <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/copyright/' . $value['upload_file'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/copyright/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/folder.png" alt="" height="30px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/copyright/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>
                                </td>
                                <td><?= $value['copyright_title'] ?></td>
                                <td><?= $value['copyright_number'] ?></td>
                                <td><?= date("d:M:Y", strtotime($value['copyright_start_date'])) ?> <?= date("h:i A", strtotime($value['copyright_start_time'])) ?></td>
                                <td><?= date("d:M:Y", strtotime($value['copyright_end_date'])) ?> <?= date("h:i A", strtotime($value['copyright_end_time'])) ?></td>
                                <td><?php $emp = $employee_model->get($value['employee_id']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
                                <td><?= $value['status'] == 0 ? '<span class="badge badge-danger badge-pill">Draft</span>' : '<span class="badge badge-success badge-pill">Active</span>' ?></td>
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

<?= $this->endSection(); ?>
