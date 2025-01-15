<?= $this->extend("admin/layouts/master") ?>
<?=  $this->section("body-content"); ?>
<?php

    use App\Models\Research_publication_gallery_model;
    use App\Models\Employee_model;
    $employee_model = new Employee_model();
    $research_publication_gallery_model = new Research_publication_gallery_model();
?>
<style>
    
</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Research & Publication </h4>
            </div>
            <div class="card-body">
                <?php
                    if(session()->getFlashdata('status')){
                        echo session()->getFlashdata('status');
                    }
                ?>
                <form method="post" action="<?= base_url() ?>admin/research-publication" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="">Title<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="title">
                    </div>
                    <div class="form-group">
                        <span for="">Upload Thumbnail(JPG,PNG)</span>
                        <input type="file" class="form-control form-control-sm" name="thumbnail" accept=".jpg, .png" required>
                    </div>
                    <div class="form-group">
                        <span for="">Upload Gallery(JPG,PNG)</span>
                        <input type="file" class="form-control form-control-sm" name="gallery_file[]" accept=".jpg, .png" multiple required>
                    </div>
                    <div class="form-group">
                        <span for="">Description</span>
                        <textarea id="editor" name="description"></textarea>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                    
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Research & Publication List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-striped table-hover" id="basic-datatable">
                    <thead>
                        <tr>
                            <td>SN</td>
                            <td>Files</td>
                            <td>Title</td>
                            <td>Gallery</td>
                            <td>Create at</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($research_publication as $key => $value) { ?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td>
                                <?php if (!empty($value['thumbnail']) && file_exists('public/admin/uploads/research_publication/' . $value['thumbnail'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/research_publication/<?= $value['thumbnail'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/research_publication/<?= $value['thumbnail'] ?>" alt="" height="30px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/research_publication/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php $gallery = $research_publication_gallery_model->getByResearch($value['id']); 
                                    if(isset($gallery)){
                                        foreach ($gallery as $key => $image) {
                                ?>
                                    <?php if (!empty($image['files']) && file_exists('public/admin/uploads/research_publication/' . $image['files'])): ?>
                                        <a href="<?= base_url() ?>public/admin/uploads/research_publication/<?= $image['files'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/research_publication/<?= $image['thumbnail'] ?>" alt="" height="30px"></a>
                                    <?php else: ?>
                                        <img src="<?= base_url() ?>public/admin/uploads/research_publication/invalid_image.png" alt="" height="40px">
                                    <?php endif; ?>
                                <?php
                                        }
                                    }
                                ?>
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