<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>


<style>
    .designation_data {
        position: relative;
        width: 100%;
    }
    .designation_data span{
        float: left;
        width: 30%;
    }


</style>

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
                                <td>Emp. Phone</td>
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
                                <td><button type="button" class="btn btn-sm btn-dark" onclick="add_emp_charge_btn(<?= $value['id'] ?>)">Manage Charge</button></td>
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
<div class="modal fade" id="add_emp_charge_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Manage Additional Charge</h5>
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="employee_id" name="employee_id">
                <div class="designation_data">
                <?php foreach ($designation as $key => $value) { ?>
                    <span><input type="checkbox" name="designation[]" id="designation" value="<?= $value['id'] ?>"><?= htmlspecialchars($value['name']) ?></span>
                <?php } ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary waves-effect waves-light">Save changes</button>
            </div>
        </div>
    </div>
</div>


<script>
    function add_emp_charge_btn(emp_id) { 
        $('#employee_id').val(emp_id);
        $('#add_emp_charge_modal').modal('show');
     }
</script>

<?= $this->endSection() ?>