<!-- app/Views/recruiterdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php
    use App\Models\Employee_model;
    $employee_model = new Employee_model();
?>
<style>
    .ui-state-highlight {
        background-color: #ffeb3b;
        height: 40px;
        line-height: 40px;
    }
    .mytable{
        width: 100%;
        border-collapse: collapse;
    }
    .mytable tr td, tr th{
        border: 1px solid #ddd;
        padding: 5px;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <?php if (session()->getFlashdata('status')): ?>
            <?= session()->getFlashdata('status') ?>
        <?php endif; ?>
    </div>
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> Name</h4>
            </div>
            <div class="card-body">
                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/menu" method="post">
                    <!-- Recruiter Title -->
                    <div class="form-group">
                        <span for="Recruitertitle">Menu Title<span class="text-danger">*</span>:</span>
                        <input type="text" name="menu_name" id="menu_name" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Save Menu" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h4 class="card-title m-0"><?= $title ?> Details</h4></div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Menu Name</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($menu_name as $key => $value) { ?>
                            <tr>
                                <td><?= $key+1 ?></td>
                                <td><?= $value['name'] ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
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

    <div class="col-lg-7">
    <div id="accordion" class="custom-accordion mb-4">
    <?php $heading = 1; $collapse = 1 ?>
    <?php foreach ($menu_name as $key => $value) { ?>
        
            <div class="card mb-2">
                <div class="card-header" id="heading<?= $heading ?>">
                    <h5 class="m-0 font-size-15">
                        <a class="d-block m-0 text-dark" data-toggle="collapse" href="#collapse<?= $collapse?>" aria-expanded="true" aria-controls="collapse<?= ++$key ?>">
                            <?= $value['name'] ?> <span class="float-right"><i class="mdi mdi-chevron-down accordion-arrow"></i></span>
                        </a>
                    </h5>
                </div>
                <div id="collapse<?= $collapse ?>" class="collapse" aria-labelledby="heading<?= $heading ?>" data-parent="#accordion">
                    <div class="card-body">
                        <form action="<?= base_url() ?>admin/menu-heading" method="post">
                            <input type="hidden" name="menu_id" value="<?= $value['id'] ?>" class="form-control form-control-sm">
                            <div class="input-group">
                                <input type="text" name="heading" id="heading" class="form-control form-control-sm" placeholder="Menu Heading *" required>
                                <input type="url" name="custom_link" id="custom_link" class="form-control form-control-sm" placeholder="Custom Link">
                            </div>

                            <div class="form-group">
                                <input type="submit" value="Save Heading" class="btn btn-sm btn-primary">
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="mytable" id="sortableTable<?= $collapse ?>">
                                <thead>
                                    <tr>
                                        <td>SN</td>
                                        <td>Heading</td>
                                        <td colspan="2"><span class="d-flex justify-content-between"><span>Pages</span><span><i class="fa fa-plus" aria-hidden="true"></i></span></span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($menu_heading as $key2 => $pages) { ?>
                                    <?php if ($value['id'] == $pages['menu_id']) { ?>
                                    <tr>
                                        <td><?= ++$key2 ?></td>
                                        <td><?= $pages['heading'] ?></td>
                                        <td>
                                            <table class="mytable">
                                                <tr>
                                                    <td>Page Name</td>
                                                    <td><i class="fa fa-trash" aria-hidden="true"></i></td>
                                                </tr>
                                                <tr>
                                                    <td>Page Name</td>
                                                    <td><i class="fa fa-trash" aria-hidden="true"></i></td>
                                                </tr>
                                                <tr>
                                                    <td>Page Name</td>
                                                    <td><i class="fa fa-trash" aria-hidden="true"></i></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                <?php } } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div> <!-- end card-->
        
    <?php $heading++; $collapse++; } ?>
    </div> <!-- end custom accordions-->
    </div> <!-- end col -->
</div>

<!-- jQuery Library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery UI Library (must be loaded after jQuery) -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<!-- jQuery UI Stylesheet (for sortable styling) -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<!-- jQuery UI Sortable Script -->
<script>
    $(document).ready(function() {
        // Make the table rows sortable for each accordion section
        <?php for ($i = 1; $i <= count($menu_name); $i++) { ?>
            $("#sortableTable<?= $i ?> tbody").sortable({
                placeholder: "ui-state-highlight", // Placeholder when dragging
                handle: "td", // Optionally set a specific handle to drag the rows
                update: function(event, ui) {
                    // This will be triggered whenever the order of rows is changed
                    console.log("Table order updated!");
                }
            });
        <?php } ?>

        // Make the nested tables inside each row also sortable
        $(".mytable").each(function() {
            $(this).sortable({
                placeholder: "ui-state-highlight", // Placeholder for nested tables
                handle: "td",  // You can make it draggable by clicking on any td
                update: function(event, ui) {
                    console.log("Nested table order updated!");
                }
            });
        });
    });
</script>



<?= $this->endSection() ?>