<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Books_chapter_author;
use App\Models\Employee_model;
$employee_model = new Employee_model();
$books_chapter_author = new Books_chapter_author();
?>
<style>
    
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
                <form method="post" action="<?= base_url('admin/edit-book-chapter/'.$book_chapter_id) ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-4 form-group">
                            <span for="Empid">Employee:</span>
                            <select name="Empid" id="Empid" class="form-control form-control-sm" required>
                                <option value="">Select Employee</option>
                                <?php foreach ($employee as $value) { ?>
                                    <option value="<?= $value['id'] ?>" <?php if($value['id'] == $books_chapter_data['emplyee_id']){ echo "selected"; } ?>><?= $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-4 form-group">
                            <span for="">Book Chapter Paper<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="book_chapter" value="<?= $books_chapter_data['book_chapter'] ?>" required>
                        </div>

                        <div class="col-lg-4 form-group">
                            <span for="">Title<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="title" value="<?= $books_chapter_data['title'] ?>" required>
                        </div>

                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="addServicetable">
                                    <thead class="bg-light">
                                        <tr>
                                            <td scope="col">Author Details</td>
                                            <td scope="col"><button type="button" class="btn btn-sm btn-primary" onclick="openAuthormodal(<?= $book_chapter_id ?>)">+</button></td>
                                        </tr>

                                    </thead>
                                    <tbody id="stockTbody">
                                    <?php foreach($books_chapter_authors as $authors){ ?>
                                        <tr>
                                            <td>
                                                <h6><?= $authors['author_name'] ?></h6>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger" id="removenewServicerow">-</button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="addServicetable">
                                    <thead class="bg-light">
                                        <tr>
                                            <td scope="col" width="80%">Co-Author Details</td>
                                            <td scope="col"><button type="button" class="btn btn-sm btn-primary" onclick="openCoauthormodal(<?= $book_chapter_id ?>)">+</button></td>
                                        </tr>

                                    </thead>
                                    <tbody>
                                    <?php foreach($books_chapter_coauthors as $coauthors){ ?>
                                        <tr>
                                            <td width="80%"><h6><?= $coauthors['coauthor_name'] ?></h6></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger" id="removeCoAuthorrow">-</button>
                                            </td>
                                        </tr>
                                    <?php } ?>   
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-lg-4 form-group">
                            <span for="">Publisher<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="publisher" value="<?= $books_chapter_data['publisher'] ?>" required>
                        </div>
                        <div class="col-lg-4 form-group">
                            <span for="">Level</span>
                            <select class="form-control form-control-sm" name="level">
                                    <option value="">--Select--</option>
                                    <option value="National" <?php if($books_chapter_data['level'] == "National"){ echo "selected"; } ?>>National</option>
                                    <option value="International" <?php if($books_chapter_data['level'] == "International"){ echo "selected"; } ?>>International</option>
                            </select>
                        </div>
                        <div class="col-lg-4 form-group">
                            <span for="">Total no. of pages/Page Range</span>
                            <input type="number" class="form-control form-control-sm" name="total_pages" value="<?= $books_chapter_data['total_pages'] ?>">
                        </div>
                        <div class="col-lg-4 form-group">
                            <span for="">Published Date Online<</span>
                            <input type="date" class="form-control form-control-sm" name="publich_date_online" value="<?= $books_chapter_data['publich_date_online'] ?>">
                        </div>
                        <div class="col-lg-4 form-group">
                            <span for="">Published Date Print</span>
                            <input type="date" class="form-control form-control-sm" name="publich_date_print" value="<?= $books_chapter_data['publich_date_print'] ?>">
                        </div>
                        <div class="col-lg-4 form-group">
                            <span for="">Date Of Acceptance</span>
                            <input type="date" class="form-control form-control-sm" name="acceptance_date" value="<?= $books_chapter_data['acceptance_date'] ?>">
                        </div>

                        <div class="col-lg-4 form-group">
                            <span for="">Date of Communication</span>
                            <input type="date" class="form-control form-control-sm" name="communication_date" value="<?= $books_chapter_data['communication_date'] ?>">
                        </div>

                        <!-- <div class="col-lg-4 form-group">
                            <span for="">Month<span class="text-danger">*</span></span>
                            <input type="month" class="form-control form-control-sm" name="month">
                        </div> -->

                        <!-- <div class="col-lg-4 form-group">
                        <span for="">Year<span class="text-danger">*</span></span>
                        <input type="year" class="form-control form-control-sm" name="year" required>
                    </div> -->

                        <div class="col-lg-4 form-group">
                            <span for="">ISBN</span>
                            <input type="text" class="form-control form-control-sm" name="isbn" value="<?= $books_chapter_data['isbn'] ?>">
                        </div>

                        <div class="col-lg-4 form-group">
                            <span for="">ISSN No.</span>
                            <input type="text" class="form-control form-control-sm" name="issn_no" value="<?= $books_chapter_data['issn_no'] ?>">
                        </div>

                        <div class="col-lg-4 form-group">
                            <span for="">Digital Object Identify</span>
                            <input type="text" class="form-control form-control-sm" name="doi" value="<?= $books_chapter_data['doi'] ?>">
                        </div>

                        <div class="col-lg-4 form-group">
                            <span for="">Web Link</span>
                            <input type="url" class="form-control form-control-sm" name="web_link" value="<?= $books_chapter_data['web_link'] ?>">
                        </div>

                        <div class="col-lg-4 form-group">
                            <span for="">Upload File(.pdf)</span>
                            <input type="file" class="form-control form-control-sm" name="upload_file" accept=".pdf">
                            <?php if (!empty($books_chapter_data['upload_file']) && file_exists('public/admin/uploads/books/' . $books_chapter_data['upload_file'])): ?>
                                <a href="<?= base_url() ?>public/admin/uploads/books/<?= $books_chapter_data['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                            <?php else: ?>
                                <img src="<?= base_url() ?>public/admin/uploads/books/invalid_image.png" alt="" height="40px">
                            <?php endif; ?>
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
                                <td>File</td>
                                <td>Book Title</td>
                                <td>Book Chapter</td>
                                <td>Published Date</td>
                                <td>Employee</td>
                                <td>Author</td>
                                <td>ISBN/ISSN no</td>
                                <td>DOI</td>
                                <td>Upload By</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($books_chapter as $key => $value) { ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td>
                                        <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/books/' . $value['upload_file'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/books/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/books/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $value['title'] ?></td>
                                    <td><?= $value['book_chapter'] ?></td>
                                    <td><?= $value['publich_date_online'] ?></td>
                                    <td><?php $emp = $employee_model->get($value['emplyee_id']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <td>
                                        <?php $auth = $books_chapter_author->get_all_by_books_chapter_id($value['id']); ?>
                                        <ul id="tableList">
                                        <?php foreach ($auth as $key => $value2) { ?>
                                            <li><?= $value2['author_name'] ?></li>
                                        <?php } ?>
                                        </ul>
                                    </td>
                                    <td><?= $value['isbn'] ?> / <?= $value['issn_no'] ?></td>
                                    <td><?= $value['doi'] ?></td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            <a href="<?= base_url() ?>admin/edit-book-chapter/<?= $value['id'] ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                            <a href="<?= base_url() ?>admin/delete-book-chapter/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure...!')"><i class="far fa-trash-alt"></i></a>
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

<!-- Modal -->
<div class="modal fade" id="authorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Author</h5>
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Woohoo, you're reading this text in a modal!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary waves-effect waves-light">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="coauthorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Co-Author</h5>
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Woohoo, you're reading this text in a modal!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary waves-effect waves-light">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>
<script>
    function openAuthormodal(book_chapter_id){
        $('#authorModal').modal('show');
    }
    function openCoauthormodal(book_chapter_id){
        $('#coauthorModal').modal('show');
    }
    $(document).ready(function() {
       

    });
</script>

<?= $this->endSection() ?>