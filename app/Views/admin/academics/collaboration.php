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
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('status') ?>
                    </div>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="/collaboration/store" method="post" enctype="multipart/form-data">
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <span for="Collabtitle">Collaboration Title:</span>
                        <input type="text" name="Collabtitle" id="Collabtitle" class="form-control form-control-sm" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <span for="Collabinstitutename">Institution Name:</span>
                        <input type="text" name="Collabinstitutename" id="Collabinstitutename" class="form-control form-control-sm" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <span for="Mediatitle">Description:</span>
                        <textarea id="editor" name="content"></textarea>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <span for="Collaborationdatetime">Collaboration Date and Time:</span>
                        <input type="datetime-local" name="Collaborationdatetime" id="Collaborationdatetime" class="form-control form-control-sm" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <span for="Collabinstitutelogo">Institution Logo:</span>
                        <input type="file" name="Collabinstitutelogo" id="Collabinstitutelogo" class="form-control form-control-sm" accept="image/*">
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
                        <span for="Collabfileupload">Collaboration File Upload:</span>
                        <input type="file" name="Collabfileupload" id="Collabfileupload" class="form-control form-control-sm" accept=".pdf,.docx,.zip">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <span for="Collabenddatetime">Collaboration End Date and Time:</span>
                        <input type="datetime-local" name="Collabenddatetime" id="Collabenddatetime" class="form-control form-control-sm" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <span for="Collabstatus">Status:</span>
                        <select name="Collabstatus" id="Collabstatus" class="form-control form-control-sm" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
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
            <div class="card-body">
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

<?= $this->endSection() ?>
