<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<!-- Page title and form layout -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title; ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/collaboration" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="Collabtitle">Collaboration Title:<span class="text-danger">*</span></span>
                                <input type="text" name="Collabtitle" id="Collabtitle" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="Collabinstitutename">Institution Name:<span class="text-danger">*</span></span>
                                <input type="text" name="Collabinstitutename" id="Collabinstitutename" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <span for="Mediatitle">Description:</span>
                                <textarea id="editor" name="description"></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="Collaborationdatetime">Collaboration Date:<span class="text-danger">*</span></span>
                                <input type="date" name="Collaborationdatetime" id="Collaborationdatetime" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="Collabinstitutelogo">Institution Logo(PNG,JPG,JPEG):<span class="text-danger">*</span></span>
                                <input type="file" name="Collabinstitutelogo" id="Collabinstitutelogo" class="form-control form-control-sm" accept=".png,.jpg,.jpeg" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="Collabinstituelink">Institution Link:</span>
                                <input type="url" name="Collabinstituelink" id="Collabinstituelink" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="Collabfileupload">Collaboration File Upload(PDF):<span class="text-danger">*</span></span>
                                <input type="file" name="Collabfileupload" id="Collabfileupload" class="form-control form-control-sm" accept=".pdf">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="Collabenddatetime">Collaboration tenure year:<span class="text-danger">*</span></span>
                                <input type="number" name="Collabtenure" id="Collabtenure" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="Collabstatus">Collaboration Status:</span>
                                <select name="Collabstatus" id="Collabstatus" class="form-control form-control-sm" required>
                                    <option value="active">Active</option>
                                    <option value="expired">Expired</option>
                                    <option value="renewed">Renewed</option>
                                </select>
                            </div>
                        </div>

                        <!-- Renewal Date field, initially hidden -->
                        <div class="col-md-6" id="renewalDateField" style="display: none;">
                            <div class="form-group">
                                <label for="RenewalDate">Renewal Date:</label>
                                <input type="date" name="RenewalDate" id="RenewalDate" class="form-control form-control-sm">
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title; ?> List</h4>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Title</td>
                                <td>Institute</td>
                                <td>Picture</td>
                                <td>Collaboration Date and Time</td>
                                <td>Collaboration End Date and Time</td>
                                <td>Created At</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data to be dynamically populated -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('Collabstatus').addEventListener('change', function() {
        var renewalDateField = document.getElementById('renewalDateField');
        
        if (this.value === 'renewed') {
            renewalDateField.style.display = 'block'; // Show Renewal Date field
        } else {
            renewalDateField.style.display = 'none'; // Hide Renewal Date field
        }
    });
</script>

<?= $this->endSection() ?>