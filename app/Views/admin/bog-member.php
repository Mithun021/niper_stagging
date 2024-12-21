<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')) : ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <form action="<?= base_url() ?>admin/bog-member" method="post">
                    
                    <div class="form-group">
                        <span for="membername">Member Name:</span>
                        <input type="text" name="membername" id="membername" class="form-control form-control-sm" required>
                    </div>

                    <div class="form-group">
                        <span for="affiliation">Affiliation:</span>
                        <input type="text" name="affiliation" id="affiliation" class="form-control form-control-sm" required>
                    </div>

                    <div class="form-group">
                        <span for="designation">Designation:</span>
                        <input type="text" name="designation" id="designation" class="form-control form-control-sm" required>
                    </div>

                    <div class="form-group">
                        <span for="termyearstart">Term Year Start:</span>
                        <input type="number" name="termyearstart" id="termyearstart" class="form-control form-control-sm" min="2000" required>
                    </div>

                    <div class="form-group">
                        <span for="termyearend">Term Year End:</span>
                        <input type="number" name="termyearend" id="termyearend" class="form-control form-control-sm" min="2000" required>
                    </div>

                    <div class="form-group text-left">
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
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
                                <td>Name</td>
                                <td>Affiliation</td>
                                <td>Designation</td>
                                <td>Term Year</td>
                                <td>Actions</td>
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
