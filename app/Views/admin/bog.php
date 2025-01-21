<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<style>
    /* Add any custom styles if needed */
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> Details</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')) : ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <form action="<?= base_url() ?>admin/bog" method="post">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- BoG Title -->
                            <div class="form-group">
                                <span for="bogtitle">BoG Title:</span>
                                <input
                                    type="text"
                                    name="bogtitle"
                                    id="bogtitle"
                                    class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <!-- BoG Description -->
                            <div class="form-group">
                                <span for="bogdesc">BoG Description:</span>
                                <textarea id="editor" name="bog_description" class="form-control form-control-sm"></textarea>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" name="bog_file" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" name="bog_gallery" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- BoG Status -->
                            <div class="form-group">
                                <span for="bogstatus">BoG Status:</span>
                                <select
                                    name="bogstatus"
                                    id="bogstatus"
                                    class="form-control form-control-sm"
                                    required>
                                    <option value="1" >Publish</option>
                                    <option value="0">Draft</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>