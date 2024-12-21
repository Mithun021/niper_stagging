<?= $this->extend("admin/layouts/master") ?>

<?=  $this->section("body-content"); ?>
<style>
    
</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php
                    if(session()->getFlashdata('status')){
                        echo session()->getFlashdata('status');
                    }
                ?>
                <form method="post" action="<?= base_url() ?>admin/media" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="">Media Title<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="media_title">
                    </div>
                    <div class="form-group">
                        <span for="">Upload Image(JPG,PNG)<span class="text-danger">*</span></span>
                        <input type="file" class="form-control form-control-sm" name="media_photo" accept=".jpg, .png, .jpeg" required>
                    </div>
                    <div class="form-group">
                        <span for="">Upload File(PDF)</span>
                        <input type="file" class="form-control form-control-sm" name="media_file" accept=".pdf" required>
                    </div>
                    <div class="form-group">
                        <span for="resultdesc">Result Description:</span>
                        <textarea name="mediadesc" id="editor" class="form-control form-control-sm"></textarea>
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
                            <td>Title</td>
                            <td>Files</td>
                            <td>Uploaded By</td>
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