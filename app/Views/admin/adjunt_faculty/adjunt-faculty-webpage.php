<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

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
                <form method="post" action="<?= base_url('admin/adjunct-faculty-webpage') ?>">
                    <div class="form-group">
                        <span for="">Section Title<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="section_title" required>
                    </div>
                    <div class="form-group">
                        <span for="">Section Description<span class="text-danger">*</span></span>
                        <textarea class="form-control form-control-sm" name="section_description" id="editor"></textarea>
                    </div>
                    <div class="form-group">
                        <span for="">Section Priority<span class="text-danger">*</span></span>
                        <input type="number" class="form-control form-control-sm" name="section_priority" required>
                    </div>
                    
                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                    
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Section List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Section Title</td>
                                <td>Section Description</td>
                                <td>Priority</td>
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
