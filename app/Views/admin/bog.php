<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<style>
    /* Add any custom styles if needed */
</style>

<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> Details</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')) : ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <form action="<?= base_url() ?>admin/bog" method="post">
                    <!-- BoG Title -->
                    <div class="form-group">
                        <span for="bogtitle">BoG Title:</span>
                        <input
                            type="text"
                            name="bogtitle"
                            id="bogtitle"
                            class="form-control form-control-sm"
                            value="<?= $bog['title'] ?>"
                            required>
                    </div>

                    <!-- BoG Description -->
                    <div class="form-group">
                        <span for="bogdesc">BoG Description:</span>
                        <textarea id="editor" name="bog_description" class="form-control form-control-sm"><?= $bog['description'] ?></textarea>

                    </div>

                    <!-- BoG Status -->
                    <div class="form-group">
                        <span for="bogstatus">BoG Status:</span>
                        <select
                            name="bogstatus"
                            id="bogstatus"
                            class="form-control form-control-sm"
                            required>
                            <option value="1" <?php if($bog['status'] == 1){ echo "selected"; } ?>>Publish</option>
                            <option value="0"<?php if($bog['status'] == 0){ echo "selected"; } ?>>Draft</option>
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
    
</div>
<?= $this->endSection() ?>