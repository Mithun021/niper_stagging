<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Employee_model;

$employee_model = new Employee_model();
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
                <form method="post" action="<?= base_url('admin/organisation-type') ?>">
                    <div class="row">
                        <div class="col-lg-4 form-group">
                            <span for="">Book Chapter Paper<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="book_chapter" required>
                        </div>

                        <div class="col-lg-4 form-group">
                            <span for="">Title<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="title" required>
                        </div>

                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="addServicetable">
                                    <thead class="bg-light">
                                        <tr>
                                            <td scope="col">Author Details</td>
                                            <td scope="col"><button type="button" class="btn btn-sm btn-primary" id="addnewservicerow">+</button></td>
                                        </tr>

                                    </thead>
                                    <tbody id="stockTbody">
                                        <tr id="stockTrow">
                                            <td>
                                                <input type="text" class="form-control" id="author_name" name="author_name[]" placeholder="Enter Author Name">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger" id="removenewServicerow">-</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="addServicetable">
                                    <thead class="bg-light">
                                        <tr>
                                            <td scope="col">Co-Author Details</td>
                                            <td scope="col"><button type="button" class="btn btn-sm btn-primary" id="addnewCoAuthor">+</button></td>
                                        </tr>

                                    </thead>
                                    <tbody id="coAuthorTbody">
                                        <tr id="coAuthorRow">
                                            <td>
                                                <input type="text" class="form-control" id="co_author_name" name="co_author_name[]" placeholder="Enter Author Name">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger" id="removeCoAuthorrow">-</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-lg-4 form-group">
                            <span for="">Publisher<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="publisher" required>
                        </div>

                        <div class="col-lg-4 form-group">
                            <span for="">Month<span class="text-danger">*</span></span>
                            <input type="month" class="form-control form-control-sm" name="month" required>
                        </div>

                        <!-- <div class="col-lg-4 form-group">
                        <span for="">Year<span class="text-danger">*</span></span>
                        <input type="year" class="form-control form-control-sm" name="year" required>
                    </div> -->

                        <div class="col-lg-4 form-group">
                            <span for="">ISBN<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="isbn" required>
                        </div>

                        <div class="col-lg-4 form-group">
                            <span for="">ISSN No.<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="issn_no" required>
                        </div>

                        <div class="col-lg-4 form-group">
                            <span for="">Digital Object Identify<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="doi" required>
                        </div>

                        <div class="col-lg-4 form-group">
                            <span for="">Web Link<span class="text-danger">*</span></span>
                            <input type="url" class="form-control form-control-sm" name="web_link" required>
                        </div>

                        <div class="col-lg-4 form-group">
                            <span for="">Upload File</span>
                            <input type="file" class="form-control form-control-sm" name="upload_file" required>
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
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Organization Type</td>
                                <td>Upload By</td>
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
        var cloneLimit = 10;
        var currentClones = 0;
        $("#addnewCoAuthor").click(function(e) {
            e.preventDefault();
            if (currentClones < cloneLimit) {
                currentClones++;
                var cloneCatrow = $('#coAuthorRow').clone().appendTo('#coAuthorTbody');
                $(cloneCatrow).find('input').val('');
            }

        });

        $('#coAuthorTbody').on('click', '#removeCoAuthorrow', function() {
            $(this).closest('tr').remove();
        });

    });
</script>

<?= $this->endSection() ?>