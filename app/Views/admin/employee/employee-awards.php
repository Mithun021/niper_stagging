<!-- app/Views/empawarddetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<div class="row">
    <!-- Form Section for Adding  Details -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('msg')): ?>
                    <?= esc(session()->getFlashdata('msg')) ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/employee-awards" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Employee ID -->
                        <div class="form-group">
                            <span for="Empid">Employee:</span>
                            <select name="Empid" id="Empid" class="form-control form-control-sm" required >
                                <option value="">Select Employee</option>
                            <?php foreach($employee as $value){ ?>
                                <option value="<?= $value['id'] ?>"><?= $value['first_name']." ".$value['middle_name']." ".$value['last_name'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Award Title -->
                        <div class="form-group">
                            <span for="Awardtitle">Award Title:</span>
                            <input type="text" name="Awardtitle" id="Awardtitle" class="form-control form-control-sm" required value="<?= esc(old('Awardtitle')) ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Award Photo Upload -->
                        <div class="form-group">
                            <span for="Awardphotoupload">Upload Award Photo:</span>
                            <input type="file" name="Awardphotoupload" id="Awardphotoupload" class="form-control form-control-sm" accept="image/*">
                        </div>
                    </div>
                    <div class="col-lg-6">
                         <!-- Award Year -->
                        <div class="form-group">
                            <span for="Awardyear">Award Year:</span>
                            <input type="number" name="Awardyear" id="Awardyear" class="form-control form-control-sm" min="1900" max="<?= date('Y') ?>" required value="<?= esc(old('Awardyear')) ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Award Date and Time -->
                        <div class="form-group">
                            <span for="Awarddatetime">Award Date and Time:</span>
                            <input type="datetime-local" name="Awarddatetime" id="Awarddatetime" class="form-control form-control-sm" required value="<?= esc(old('Awarddatetime')) ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Awarding Agency Type -->
                        <div class="form-group">
                            <span for="Awardingagencytype">Awarding Agency Type:</span>
                            <input type="text" name="Awardingagencytype" id="Awardingagencytype" class="form-control form-control-sm" required value="<?= esc(old('Awardingagencytype')) ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Awarding Agency Name -->
                        <div class="form-group">
                            <span for="Awardingagencyname">Awarding Agency Name:</span>
                            <input type="text" name="Awardingagencyname" id="Awardingagencyname" class="form-control form-control-sm" required value="<?= esc(old('Awardingagencyname')) ?>">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Awards (Optional) -->
    <div class="col-lg-12">
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
                                <td>Award Title</td>
                                <td>Description</td>
                                <td>Year</td>
                                <td>Agency Name</td>
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