<!-- app/Views/actrulesdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<div class="row">
    <!-- Form Section for Adding Act Rules Details -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add Act Rules Details</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <div class="alert alert-success">
                        <?= esc(session()->getFlashdata('status')) ?>
                    </div>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="/actrulesdetails/store" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <!-- Act Rules Type -->
                    <div class="form-group">
                        <span for="Actrulestype">Act Rules Type:</span>
                        <select name="Actrulestype" id="Actrulestype" class="form-control form-control-sm" required>
                            <option value="" disabled selected>Select Act Rules Type</option>
                            <option value="NIPER Act">NIPER Act</option>
                            <option value="Statues">Statues</option>
                            <option value="Ordinance">Ordinance</option>
                            <option value="Recruitment Rules">Recruitment Rules</option>
                            <option value="RTI Rules">RTI Rules</option>
                        </select>
                    </div>

                    <!-- Act Rules Title -->
                    <div class="form-group">
                        <span for="Actrulestitle">Act Rules Title:</span>
                        <input type="text" name="Actrulestitle" id="Actrulestitle" class="form-control form-control-sm" required>
                    </div>

                    <!-- Act Rules Description -->
                    <div class="form-group">
                        <span for="Actrulesdesc">Act Rules Description:</span>
                        <textarea name="Actrulesdesc" id="editor" class="form-control form-control-sm" rows="4" required></textarea>
                    </div>

                    <!-- Act Rules File Upload -->
                    <div class="form-group">
                        <span for="Actrulesfileupload">Upload Act Rules File:(.pdf,.doc,.docx,.xls,.xlsx,.jpg,.png)</span>
                        <input type="file" name="Actrulesfileupload" id="Actrulesfileupload" class="form-control form-control-sm" accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.png" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Act Rules Details (Optional) -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Act Rules Details List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Act Rules Type</td>
                                <td>Act Rules Title</td>
                                <td>Act Rules File</td>
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

<?= $this->endSection() ?>