<?= $this->extend("admin/layouts/master") ?>
<?=  $this->section("body-content"); ?>
<?php
    use App\Models\Employee_model;
    use App\Models\Facility_page_model;
    $employee_model = new Employee_model();
    $facility_page_model = new Facility_page_model();
?>
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
                <form method="post" action="<?= base_url() ?>admin/facility-section" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="">Arrange Page<span class="text-danger">*</span></span>
                        <select class="form-control form-control-sm" name="page_name" required>
                            <option value="">--Select--</option>
                            <option value="Facility Services">Facility Services</option>
                            <option value="Facility Notification">Facility Notification</option>
                            <option value="Facility Banner">Facility Banner</option>
                            <option value="Facility Instruments">Facility Instruments</option>
                            <option value="Facility Section File">Facility Section File</option>
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
                <table class="table table-striped table-hover" id="basic-datatable" style="width: 120%;">
                    <thead>
                        <tr>
                            <td>SN</td>
                            <td>Facility Id</td>
                            <td>Arranged Page No</td>
                            <td>Uploaded By</td>
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