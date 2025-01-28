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
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> </h4>
            </div>
            <div class="card-body">
                <?php
                    if(session()->getFlashdata('status')){
                        echo session()->getFlashdata('status');
                    }
                ?>
                <form action="<?= base_url() ?>admin/images" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="">Image Title<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="image_title">
                    </div>
                    <div class="form-group">
                        <span for="">Upload File(JPG,PNG,PDF)</span>
                        <input type="file" class="form-control form-control-sm" name="image_file" accept=".jpg, .png, .pdf" required>
                    </div>
                    <div class="form-group">
                        <span for="">Event Date<span class="text-danger">*</span></span>
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" name="event_start_date"  placeholder="Start Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                            <input type="text" class="form-control form-control-sm" name="event_start_date"  placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                    
                </form>
            </div>
        </div>
    </div>
    
</div>

<?= $this->endSection() ?>