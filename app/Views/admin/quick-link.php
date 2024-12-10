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
                <form action="<?= base_url() ?>admin/quick-link" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="">Title<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="quicklink_title" required>
                    </div>
                    <div class="form-group">
                        <span for="">Web Page URL<span class="text-danger">*</span></span>
                        <input type="url" class="form-control form-control-sm" name="page_url" required>
                    </div>
                    <div class="form-group">
                        <span for="">Upload File(JPG,PNG,PDF)</span>
                        <input type="file" class="form-control form-control-sm" name="quicklink_file" accept=".jpg, .png, .pdf" required>
                    </div>
                    <!-- <div class="form-group">
                        <span for="quicklinkdesc">Result Description:</span>
                        <textarea name="quicklinkdesc" id="editor" class="form-control form-control-sm"></textarea>
                    </div> -->
                    <div class="form-group">
                        <span>Status<span class="text-danger">*</span></span>
                        <select name="status" id="status" class="form-control form-control-sm">
                            <option value="0" selected>Inactive</option>
                            <option value="1">Active</option>
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