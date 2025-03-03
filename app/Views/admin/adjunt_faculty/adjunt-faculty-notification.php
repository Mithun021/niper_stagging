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
                <form method="post" action="<?= base_url('admin/adjunt-faculty-notification') ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="">Title<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="notification_title" required>
                    </div>
                    <div class="form-group">
                        <span for="">Description<span class="text-danger">*</span></span>
                        <textarea class="form-control form-control-sm" name="notification_description" id="editor"></textarea>
                    </div>
                    <div class="form-group">
                        <span for="">Date<span class="text-danger">*</span></span>
                        <input type="date" class="form-control form-control-sm" name="notification_date" required>
                    </div>
                    <div class="form-group">
                        <span for="">File Upload (PDF, Mandatory)<span class="text-danger">*</span></span>
                        <input type="file" class="form-control form-control-sm" name="notification_file" accept="application/pdf" required>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="notification_marquee" value="1">
                        <span for="">Display as Marquee</span>
                    </div>
                    
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
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
                    <table class="table table-striped table-hover" id="notification-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Title</td>
                                <td>Description</td>
                                <td>Date</td>
                                <td>File</td>
                                <td>Marquee</td>
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
