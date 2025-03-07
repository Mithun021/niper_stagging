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
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php
                    if(session()->getFlashdata('status')){
                        echo session()->getFlashdata('status');
                    }
                ?>
                <form method="post" action="<?= base_url() ?>admin/flash-news" enctype="multipart/form-data">
                <div class="form-group">
                        <span>Facility Id</span>
                        <select name="facility_id" id="facility_id" class="form-control form-control-sm" required>
                            <option value="1">--Select--</option>
                        <?php foreach ($facility_page as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <span>Secton Id</span>
                        <select name="section_id" id="section_id" class="form-control form-control-sm" required>
                            <option value="1">--Select--</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <span for="">Title<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="title">
                    </div>
                    <div class="form-group">
                        <span for="">Description:</span>
                        <textarea name="description" id="editor" class="form-control form-control-sm"></textarea>
                    </div>
                    <div class="form-group">
                        <span for="">Upload Image(JPG,PNG)<span class="text-danger">*</span></span>
                        <input type="file" class="form-control form-control-sm" name="upload_file" accept=".jpg, .png, .jpeg" required>
                    </div>

                    <div class="form-group">
                        <span><input type="checkbox" name="carousal" id="" value="1">Carousel Status </span> <br>
                        <span><input type="checkbox" name="gallery" id="" value="1">Gallery View </span>
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
                            <td>Files</td>
                            <td>Title</td>
                            <td>Description</td>
                            <td>Publish Date</td>
                            <td>Status</td>
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

<script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#facility_id').change(function() {
            var facility_id = $(this).val();
            $.ajax({
                url: '<?= base_url() ?>getFacilitySection',
                type: 'post',
                data: {facility_id: facility_id},
                beforeSend: function() {
                    $('#section_id').empty();
                    $('#section_id').append('<option value="">Please wait...</option>');
                },
                success: function(response) {
                    $('#section_id').empty();
                    $('#section_id').append('<option value="">--Select--</option>');
                    $.each(response, function(index, value) {
                        $('#section_id').append('<option value="'+value.id+'">'+value.title+'</option>');
                    });
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>