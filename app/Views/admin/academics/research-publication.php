<?= $this->extend("admin/layouts/master") ?>

<?=  $this->section("body-content"); ?>
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
                    
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>