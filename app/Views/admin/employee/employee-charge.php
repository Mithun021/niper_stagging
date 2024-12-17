<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title; ?> List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Emp. ID</td>
                                <td>Emp. Name</td>
                                <td>EMp. Phone</td>
                                <td>Additional Charge Details</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($employee as $key => $value) {?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $value['employee_unique_id'] ?></td>
                                <td><?= $value['first_name']." ".$value['middle_name']." ".$value['last_name'] ?></td>
                                <td><?php if($value['authority']!=="admin"){ ?> <?= $value['mobile_no'] ?>  <?php }else { echo "_____"; } ?></td>
                                <td>__</td>
                                <td><button type="button" class="btn btn-sm btn-dark">Manage Charge</button></td>
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