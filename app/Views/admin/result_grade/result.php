<!-- app/Views/resultdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<div class="row">
    <!-- Form Section for Adding Result Details -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add Result Details</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/result" method="post" enctype="multipart/form-data">
                    <!-- Result Description -->
                    <div class="form-group">
                        <span for="resultdesc">Result Description:</span>
                        <textarea name="resultdesc" id="editor" class="form-control form-control-sm" required ></textarea>
                    </div>

                    <div class="form-group">
                        <span for="Deptid">Department ID:</span>
                        <select name="Deptid" id="Deptid" class="form-control form-control-sm" required >
                            <option value="">Select Deparrtment</option>
                        <?php foreach ($department as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                        <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <span for="Progid">Program ID:</span>
                        <select name="Progid" id="Progid" class="form-control form-control-sm" required >
                            <option value="">Select Program</option>
                        </select>
                    </div>

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

                    <!-- Semester -->
                    <div class="form-group mt-3">
                        <span for="Semester">Semester:</span>
                        <input type="number" name="Semester" id="Semester" class="form-control form-control-sm" required min="1" max="12" >
                    </div>

                    <!-- Result File Upload -->
                    <div class="form-group mt-3">
                        <span for="Resultfileupload">Upload Result File:</span>
                        <input type="file" name="Resultfileupload" id="Resultfileupload" class="form-control form-control-sm" accept=".pdf,.doc,.docx,.jpg,.png" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Result Details (Optional) -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Result Details List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Result Description</td>
                                <td>Program-Dept Map ID</td>
                                <td>Semester</td>
                                <td>Result File</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dynamically populated rows go here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>

<script>
    $(document).ready(function(){
        // Fetch Programs based on Department
        $('#Deptid').change(function(){
            var dept_id = $(this).val();
            $.ajax({
                url: '<?= base_url() ?>fetch-programs',
                type: 'post',
                data: {dept_id: dept_id},
                success: function(response){
                    // console.log(response);
                    let dataList = $('#Progid');
                    dataList.empty();
                    dataList.append('<option value="">Select Program</option>');
                    $.each(response, function(index, item) {
                        dataList.append('<option value="'+ item.program_id +'">'+ item.program_name + "("+ item.batch_start + "-" + item.batch_end +")" +'</option>');
                    });
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>