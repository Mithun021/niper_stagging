<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Books_chapter_author;
use App\Models\Employee_model;
$employee_model = new Employee_model();
$books_chapter_author = new Books_chapter_author();
?>
<style>
    #addServicetable #coAuthorTbody #coAuthorRow:first-child td:last-child button {
        display: none;
    }
</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> </h4>
            </div>
            <div class="card-body">
                <?php
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>
                <form method="post" action="<?= base_url('admin/course-tought') ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <span for="Empid">Employee:</span>
                            <select name="Empid" id="Empid" class="form-control form-control-sm my-select" required>
                                <option value="">Select Employee</option>
                                <?php foreach ($employee as $value) { ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <span for="Empid">Department:</span>
                            <select name="department_id" id="department_id" class="form-control form-control-sm" required>
                                <option value="">Select Department</option>
                                <?php foreach ($department as $value) { ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-12 form-group">
                            <label for="course_name">Course Name<span class="text-danger">*</span></label>
                            <select class="form-control form-control-sm my-select2" name="course_name[]" id="course_name" multiple required>
                                
                            </select>
                        </div>
                        <div class="col-lg-12 form-group">
                            <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Employee</td>
                                <td>Course Name</td>
                                <td>Course Code</td>
                                <td>Upload By</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                         <?php foreach ($course_tought as $key => $value) { ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?php $emp = $employee_model->get($value['employee_id']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                <td><?= $value['course_name'] ?></td>
                                <td><?= $value['course_code'] ?></td>
                                <td><?php $emp = $employee_model->get($value['upload_by']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                        <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a>
                                        <a href="#" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                        <a href="#" class="btn btn-danger waves-effect waves-light"><i class="far fa-trash-alt"></i></a>
                                    </div>
                                </td>
                            </tr>
                         <?php } ?>   
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>
<div class="col-lg-6 form-group">
    <label for="department_id">Department:</label>
    <select name="department_id" id="department_id" class="form-control form-control-sm" required>
        <option value="">Select Department</option>
        <?php foreach ($department as $value) { ?>
            <option value="<?= $value['id'] ?>"><?= $value['name']; ?></option>
        <?php } ?>
    </select>
</div>

<div class="col-lg-12 form-group">
    <label for="course_name">Course Name<span class="text-danger">*</span></label>
    <select class="form-control form-control-sm my-select2" name="course_name[]" id="course_name" multiple required>
        <!-- Courses will be populated here -->
    </select>
</div>

<script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var selectedCourses = [];  // Array to keep track of selected courses
        
        // Track selected courses before changing the dropdown
        $('#course_name').on('change', function() {
            selectedCourses = $(this).val() || [];
        });

        // Change event on department selection
        $('#department_id').change(function() {
            var department_id = $(this).val();
            if (department_id) {
                $.ajax({
                    url: '<?= base_url('getCourseByDepartment') ?>',
                    type: 'post',
                    dataType: 'json',  // Ensure the response is parsed as JSON
                    data: {
                        department_id: department_id
                    },
                    success: function(response) {
                        // Store currently selected options
                        var currentSelection = selectedCourses;

                        // Empty the course select and set default option
                        $('#course_name').empty();
                        $('#course_name').append('<option value="" selected disabled>Select Course</option>');

                        // Check if response contains courses
                        if (response && response.length > 0) {
                            // Append courses to the select dropdown
                            $.each(response, function(key, value) {
                                var selected = currentSelection.includes(value.course_id) ? 'selected' : '';
                                $('#course_name').append('<option value="' + value.course_id + '" ' + selected + '>' + value.course_name + ' - ' + value.course_code + '</option>');
                            });
                        } else {
                            // If no courses available, show a message
                            $('#course_name').append('<option value="" disabled>No courses available</option>');
                        }
                        
                        // Re-initialize Select2 to reflect new options
                        $('#course_name').select2('destroy').select2({
                            placeholder: "--Select--",
                            allowClear: true,
                            width: '100%'
                        }).val(currentSelection).trigger('change');
                    },
                    error: function() {
                        // Handle error (e.g., if AJAX fails)
                        alert('Error fetching courses. Please try again.');
                    }
                });
            }
        });

        // Initialize Select2 for the course dropdown
        $('.my-select2').select2({
            placeholder: "--Select--",
            allowClear: true,
            width: '100%'
        });
    });
</script>

<?= $this->endSection() ?>