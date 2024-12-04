<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<style>
    /* Add any custom styles if needed */
</style>

<div class="row">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> Details</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')) : ?>
                    <div class="alert alert-info"><?= session()->getFlashdata('status') ?></div>
                <?php endif; ?>

                <form action="/bogpages/store" method="post">
                    <?= csrf_field() ?>

                    <!-- BoG Title -->
                    <div class="form-group">
                        <span for="bogtitle">BoG Title:</span>
                        <input
                            type="text"
                            name="bogtitle"
                            id="bogtitle"
                            class="form-control form-control-sm"
                            value="<?= old('bogtitle') ?>"
                            required>
                    </div>

                    <!-- BoG Description -->
                    <div class="form-group">
                        <span for="bogdesc">BoG Description:</span>
                        <textarea id="editor" name="content" class="form-control form-control-sm"></textarea>

                    </div>

                    <!-- BoG Status -->
                    <div class="form-group">
                        <span for="bogstatus">BoG Status:</span>
                        <select
                            name="bogstatus"
                            id="bogstatus"
                            class="form-control form-control-sm"
                            required>
                            <option value="Publish">Publish</option>
                            <option value="Draft">Draft</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>
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
                    <table class="table table-striped table-hover"  id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Title</td>
                                <td>Description</td>
                                <td>Status</td>
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