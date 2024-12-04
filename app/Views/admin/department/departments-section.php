<?= $this->extend("admin/layouts/master") ?>

<?=  $this->section("body-content"); ?>
<style>
    
</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?> </h4>
            </div>
            <div class="card-body">
                <?php
                    if(session()->getFlashdata('msg')){
                        echo session()->getFlashdata('msg');
                    }
                ?>
                <form method="post" action="<?= base_url() ?>admin/departments-section" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="">Department Name<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="dept_name" required minlength="5">
                    </div>
                    <div class="form-group">
                        <span for="">Desription</span>
                        <textarea id="editor" name="description"></textarea>
                    </div>

                    <!-- <div class="form-group">
                        <span for="Empid">Dept. Head Employee: <span class="text-danger">*</span></span>
                        <select name="Empid" id="Empid" class="form-control form-control-sm" required >
                            <option value="">Select Employee</option>
                        </select>
                    </div> -->

                    <div class="form-group">
                        <span for="Deptid">Dept. Program ID: <span class="text-danger">*</span></span>
                        <select name="program_id" id="program_id" class="form-control form-control-sm" >
                            <option value="">--Select Program--</option>
                            <?php foreach ($program as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <span for="Awardphotoupload">Dept. Upload  Photo(.jpg,.jpeg,.png):</span>
                        <input type="file" name="photoupload" id="photoupload" class="form-control form-control-sm" accept=".jpg,.jpeg,.png" required>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                    
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
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
                            <td>Dept Name</td>
                            <td>Program</td>
                            <td>Photo</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($department as $key => $value) { ?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $value['name'] ?></td>
                            <td><?= $value['program_id'] ?></td>
                            <td><a href="<?= base_url() ?>public/admin/uploads/department/<?= $value['files'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/department/<?= $value['files'] ?>" alt="" height="40px"></a></td>
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

<?= $this->endSection() ?>