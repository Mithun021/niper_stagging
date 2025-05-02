<?= $this->extend("admin/layouts/master") ?>
<?=  $this->section("body-content"); ?>
<?php
use App\Models\Employee_model;
use App\Models\Placement_job_details_model;
$employee_model = new Employee_model();
$placement_job_result_model = new Placement_job_details_model();
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
            <form action="<?= base_url() ?>admin/job-result-stage-mapping" method="post" enctype="multipart/form-data" id="alumini-page-notification-form">
                <div class="card-body p-1">
                    <?php if (session()->getFlashdata('status')) {
                        echo session()->getFlashdata('status');
                    } ?>
                    <div class="form-group">
                        <span for="title">Job id</span>
                        <select class="form-control form-control-sm my-select" name="job_id" id="job_id" required>
                            <option value="">--Select--</option>
                        <?php foreach ($job_details as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['job_title'] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <span for="title">Job Stage</span>
                        <select class="form-control form-control-sm" name="job_stage" id="job_stage" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <span for="title">Student ID</span>
                        <select class="form-control form-control-sm my-select" name="student_id" id="" required>
                            <option value="">--Select--</option>
                        <?php foreach ($student_details as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['first_name']." ".$value['middle_name']." ".$value['last_name'] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <span for="title">Result</span>
                        <input type="text" class="form-control form-control-sm" name="result" required>
                    </div>
                </div>
                <div class="card-footer p-2">
                    <input type="submit" class="btn btn-primary" value="Submit" id="submit">
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('#job_id').on('change', function() {
            var job_id = $(this).val();
            if (job_id) {
                $.ajax({
                    url: '<?= base_url() ?>get-job-restult-stage/' + job_id,
                    type: "GET",
                    dataType: "json",
                    beforeSend: function() {
                        $('#job_stage').html('<option value="">Select Stage</option>');
                    },
                    success: function(response) {
                        $('#job_stage').empty();
                        if (response.length > 0) {
                            $.each(response, function(index, stage) {
                                $('#job_stage').append('<option value="' + stage.id + '">' + stage.result_title + '</option>');
                            });
                        } else {
                            $('#job_stage').html('<option value="">No stage available</option>');
                        }
                    }
                });
            } else {
                $('#job_stage"]').empty();
            }
        });
    });
</script>
<?= $this->endSection() ?>