<!-- app/Views/rankingdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<div class="row">
    <!-- Form Section for Adding Ranking Details -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add Ranking Details</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <div class="alert alert-success">
                        <?= esc(session()->getFlashdata('status')) ?>
                    </div>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="/rankingdetails/store" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Rank Year -->
                        <div class="form-group">
                            <span for="Rankyear">Rank Year:</span>
                            <input type="number" name="Rankyear" id="Rankyear" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Rank Source -->
                        <div class="form-group">
                            <span for="Ranksource">Rank Source:</span>
                            <select name="Ranksource" id="Ranksource" class="form-control form-control-sm" required>
                                <option value="" disabled selected>Select Rank Source</option>
                                <option value="NIRF">NIRF</option>
                                <option value="ARIIA">ARIIA</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                         <!-- Rank Source Other Description -->
                        <div class="form-group" id="Ranksourceotherdesc-group">
                            <span for="Ranksourceotherdesc">Other Rank Source Description:</span>
                            <input type="text" name="Ranksourceotherdesc" id="Ranksourceotherdesc" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Rank Number -->
                        <div class="form-group">
                            <span for="Ranknumber">Rank Number:</span>
                            <input type="number" name="Ranknumber" id="Ranknumber" class="form-control form-control-sm" required min="1">
                        </div>
                    </div>
                    <div class="col-lg-6">
                         <!-- Rank File Upload -->
                        <div class="form-group">
                            <span for="Rankfileupload">Upload Rank File:(.pdf,.doc,.docx,.jpg,.png,.xls,.xlsx)</span>
                            <input type="file" name="Rankfileupload" id="Rankfileupload" class="form-control-file" accept=".pdf,.doc,.docx,.jpg,.png,.xls,.xlsx" required>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <!-- Data Submitted Pharmacy -->
                        <div class="form-group">
                            <span for="Datasubmittedpharmacy">Data Submitted for Pharmacy:</span>
                            <select name="Datasubmittedpharmacy" id="Datasubmittedpharmacy" class="form-control form-control-sm" required>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <!-- Data Submitted Overall -->
                        <div class="form-group">
                            <span for="Datasubmittedoverall">Data Submitted Overall:</span>
                            <select name="Datasubmittedoverall" id="Datasubmittedoverall" class="form-control form-control-sm" required>
                                <option value="Yes">Yes</option>
                                <option value="No" >No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12"><!-- Submit Button -->
                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </div>
                </div>
                    
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Ranking Details (Optional) -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Ranking Details List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Rank Year</td>
                                <td>Rank Source</td>
                                <td>Rank Number</td>
                                <td>Rank File</td>
                                <td>Pharmacy Data Submitted</td>
                                <td>Overall Data Submitted</td>
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

<?= $this->endSection() ?>