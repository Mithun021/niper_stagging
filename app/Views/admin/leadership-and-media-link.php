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
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?> </h4>
            </div>
            <div class="card-body">
                <?php
                    if(session()->getFlashdata('status')){
                        echo session()->getFlashdata('status');
                    }
                ?>
                <form method="post" action="<?= base_url() ?>admin/leadership-and-media-link" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="">Name<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="leadership_name" minlength="3" required>
                    </div>
                    <div class="form-group">
                        <span for="">Designation<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="leadership_designation" minlength="3" required>
                    </div>
                    <div class="form-group">
                        <span for="">Upload File(JPG,PNG)</span>
                        <input type="file" class="form-control form-control-sm" name="leadership_file" accept=".jpg, .png, .jpeg" required>
                    </div>

                    <div class="form-group">
                        <span for="">Description/Message</span>
                        <textarea id="editor" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <span for="">Link URL</span>
                        <input type="url" class="form-control form-control-sm" name="link_url">
                    </div>
                    <div class="form-group">
                        <span for="">Facebook</span>
                        <input type="url" class="form-control form-control-sm" name="facebook_url">
                    </div>
                    <div class="form-group">
                        <span for="">Instagram</span>
                        <input type="url" class="form-control form-control-sm" name="instagram_url">
                    </div>
                    <div class="form-group">
                        <span for="">Twitter</span>
                        <input type="url" class="form-control form-control-sm" name="twitter_url">
                    </div>
                    <div class="form-group">
                        <span for="">Youtube</span>
                        <input type="url" class="form-control form-control-sm" name="youtube_url">
                    </div>
                    <div class="form-group">
                        <span for="">Linkedin</span>
                        <input type="url" class="form-control form-control-sm" name="linkedin_url">
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                    
                </form>
            </div>
        </div>
    </div>
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
                            <td>Image</td>
                            <td>Name</td>
                            <td>Designation</td>
                            <td>Upload by</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($leadership_media_link as $key => $value) { ?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td>
                                <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/leader/' . $value['upload_file'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/leader/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/leader/<?= $value['upload_file'] ?>" alt="" height="30px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/leader/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>
                            </td>
                            <td><?= $value['name'] ?></td>
                            <td><?= $value['designition'] ?></td>
                            <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
                            <td>
                            <a href="<?= base_url() ?>admin/leadership-and-media-link/<?= $value['id'] ?>" class="btn btn-sm btn-danger">View</a>
                                <a href="<?= base_url() ?>admin/leadership-and-media-link/<?= $value['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="<?= base_url() ?>admin/leadership-and-media-link/<?= $value['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
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