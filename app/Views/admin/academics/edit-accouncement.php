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
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Announcement </h4>
            </div>
            <div class="card-body p-2">
                <?php
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>
                <form method="post" action="<?= base_url() ?>admin/edit-accouncement/<?= $announcement_id ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="">Anouncement Date<span class="text-danger">*</span></span>
                        <input type="date" id="annoncement_date" name="annoncement_date" class="form-control form-control-sm" value="<?= $announcement_data['announcement_date'] ?>" required>
                    </div>
                    <div class="form-group">
                        <span for="">Title<span class="text-danger">*</span></span>
                        <textarea id="editor2" name="title"><?= $announcement_data['announcement_title'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <span for="">Upload File(JPG,PNG,PDF)</span>
                        <input type="file" class="form-control form-control-sm" name="announcement_file" accept=".jpg, .png, .pdf">
                        <?php if (!empty($announcement_data['upload_file']) && file_exists('public/admin/uploads/announcement/' . $announcement_data['upload_file'])): ?>
                            <a href="<?= base_url() ?>public/admin/uploads/announcement/<?= $announcement_data['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/folder.png" alt="" height="30px"></a>
                        <?php else: ?>
                            <img src="<?= base_url() ?>public/admin/uploads/announcement/invalid_image.png" alt="" height="40px">
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <span for="">Desription</span>
                        <textarea id="editor" name="description"><?= $announcement_data['announcement_desc'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <span>Announcement Status</span>
                        <select name="status" id="status" class="form-control form-control-sm">
                            <option value="1" <?php if($announcement_data['announcement_desc'] == 1){ echo "selected"; } ?>>Publish</option>
                            <option value="2" <?php if($announcement_data['announcement_desc'] == 2){ echo "selected"; } ?>>Archive</option>
                            <option value="0" <?php if($announcement_data['announcement_desc'] == 0){ echo "selected"; } ?>>Draft</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <span>Marquee Status</span>
                        <select name="Marqueestatus" id="Marqueestatus" class="form-control form-control-sm">
                            <option value="1" <?php if($announcement_data['announcement_desc'] == 1){ echo "selected"; } ?>>Active</option>
                            <option value="0" <?php if($announcement_data['announcement_desc'] == 0){ echo "selected"; } ?>>Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>

                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Announcement List</h4>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Files</td>
                                <td>Title</td>
                                <td>Ann. Date</td>
                                <td>Staus /marquee</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($announcement as $key => $value) { ?>
                            <tr>
                                <td><?php echo $key+1; ?></td>
                                <td>
                                    <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/announcement/' . $value['upload_file'])): ?>
                                        <a href="<?= base_url() ?>public/admin/uploads/announcement/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/folder.png" alt="" height="30px"></a>
                                    <?php else: ?>
                                        <img src="<?= base_url() ?>public/admin/uploads/announcement/invalid_image.png" alt="" height="40px">
                                    <?php endif; ?>
                                </td>
                                <td><?= $value['announcement_title'] ?></td>
                                <td><?= date("d:M:Y", strtotime($value['announcement_date'])) ?></td>
                                <td>
                                    <?= 
                                        ($value['announcement_status'] == "0") ? "<span class='badge badge-danger badge-pill'>Draft</span>" : 
                                        (($value['announcement_status'] == "1") ? "<span class='badge badge-success badge-pill'>Active</span>" : 
                                        (($value['announcement_status'] == "2") ? "<span class='badge badge-warning badge-pill'>Archive</span>" : ""))
                                    ?> /
                                    <?= ($value['marquee_status'] == "0") ? "<span class='badge badge-danger badge-pill'>Marquee Inactive</span>" : (($value['marquee_status'] == "1") ? "<span class='badge badge-success badge-pill'>Marquee Active</span>" : "") ?>
                                </td>
                                <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                        <a href="<?= base_url() ?>admin/edit-accouncement/<?= $value['id'] ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                        <a href="<?= base_url() ?>admin/delete-accouncement/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure...!')"><i class="far fa-trash-alt"></i></a>
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