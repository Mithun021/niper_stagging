<!-- app/Views/recruiterdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php
    use App\Models\Employee_model;
    $employee_model = new Employee_model();
?>
<div class="row">
    <!-- Form Section for Adding <?= $title ?> -->
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> Name</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

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
            <div class="card mb-0">
                <div class="card-header" id="headingOne">
                    <h5 class="m-0 font-size-15">
                        <a class="d-block m-0 text-dark" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Collapsible Group Item #1 <span class="float-right"><i class="mdi mdi-chevron-down accordion-arrow"></i></span>
                        </a>
                    </h5>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute,
                        non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                        tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil
                        anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan
                        excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt
                        you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                </div>
            </div> <!-- end card-->

            <div class="card mb-0">
                <div class="card-header" id="headingTwo">
                    <h5 class="m-0 font-size-15">
                        <a class="collapsed d-block m-0 text-dark" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Collapsible Group Item #2 <span class="float-right"><i class="mdi mdi-chevron-down accordion-arrow"></i></span>
                        </a>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute,
                        non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                        tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil
                        anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan
                        excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt
                        you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                </div>
            </div> <!-- end card-->

            <div class="card mb-0">
                <div class="card-header" id="headingThree">
                    <h5 class="m-0 font-size-15">
                        <a class="collapsed d-block m-0 text-dark" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Collapsible Group Item #3 <span class="float-right"><i class="mdi mdi-chevron-down accordion-arrow"></i></span>
                        </a>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute,
                        non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                        tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil
                        anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan
                        excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt
                        you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                </div>
            </div> <!-- end card-->
        </div> <!-- end custom accordions-->
    </div> <!-- end col -->



</div>
<?= $this->endSection() ?>