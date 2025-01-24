<!-- app/Views/progdeptstudentmap_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<?php

use App\Models\Employee_model;

$employee_model = new Employee_model();
?>

<style>
    .student-details {
        position: relative;
    }

    .student-details span {
        float: left;
        width: 32%;
        margin-bottom: 10px;
    }
</style>

<div class="row">
    <!-- Form Section for Adding  -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/assignCourseList" method="post">

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span for="Deptid">Department ID:</span>
                                <select name="Deptid" id="Deptid" class="form-control form-control-sm" required>
                                    <option value="">Select Deparrtment</option>
                                    <?php foreach ($department as $key => $value) { ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Program ID -->
                            <div class="form-group">
                                <span for="Progid">Program ID:</span>
                                <select name="Progid" id="Progid" class="form-control form-control-sm" required>
                                    <option value="">Select Program</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <!-- Semester -->
                            <div class="form-group">
                                <span for="semester">Semester:</span>
                                <select name="semester" id="semester" class="form-control form-control-sm" required>
                                    <option value="I">I</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                    <option value="VI">VI</option>
                                    <option value="VII">IVI</option>
                                    <option value="VIII">VIII</option>
                                    <option value="IX">IX</option>
                                    <option value="X">X</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <h3 class="mb-2">Course Details:</h3>
                                <div class="student-details">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover" id="basic-datatable">
                                            <thead>
                                                <tr>
                                                    <td>#</td>
                                                    <td>Course Details</td>
                                                    <td>Credits</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($courses as $key => $value) { ?>
                                                <tr>
                                                    <td><span><input type="checkbox" name="course_id" value="<?= $value['id'] ?>"></span></td>
                                                    <td><?= $value['course_name'] ?> - <?= $value['course_code'] ?></td>
                                                    <td><input type="number" class="form-control form-control-sm" name="credit_score[]"></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary mt-4">Submit</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Mappings (Optional) -->
    <div class="col-lg-12">
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
                                <td>Student</td>
                                <td>Department</td>
                                <td>Program</td>
                                <td>Semester</td>
                                <td>Upload by</td>
                                <td>Upload Date</td>
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
        // Fetch Programs based on Department
        $('#Deptid').change(function() {
            var dept_id = $(this).val();
            $.ajax({
                url: '<?= base_url() ?>fetch-programs',
                type: 'post',
                data: {
                    dept_id: dept_id
                },
                success: function(response) {
                    // console.log(response);
                    let dataList = $('#Progid');
                    dataList.empty();
                    dataList.append('<option value="">Select Program</option>');
                    $.each(response, function(index, item) {
                        dataList.append('<option value="' + item.program_id + '">' + item.program_name + "(" + item.batch_start + "-" + item.batch_end + ")" + '</option>');
                    });
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>