<?= $this->extend("admin/layouts/master") ?>

<?= $this->section("body-content"); ?>

<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title; ?></h4>
            </div>
            <div class="card-body">
                <?php
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>

                <form action="/aboutus/store" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <span for="aboutusbannerphoto">Title:</span>
                            <input type="text" name="about_title" id="about_title" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <span for="aboutusbannerphoto">Banner Photo Upload:</span>
                            <input type="file" name="aboutusbannerphoto" id="aboutusbannerphoto" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <span for="aboutus_description">About Us Description:</span>
                            <textarea name="aboutus_description" id="editor" class="form-control form-control-sm" rows="4" required><?= old('aboutus_description') ?></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <span for="vision">Vision:</span>
                            <textarea name="vision" id="editor2" class="form-control form-control-sm" rows="3" required><?= old('vision') ?></textarea>
                        </div>

                        <div class="col-md-6 form-group">
                            <span for="mission">Mission:</span>
                            <textarea name="mission" id="editor3" class="form-control form-control-sm" rows="3" required><?= old('mission') ?></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <span for="objective">Objective:</span>
                            <textarea name="objective" id="editor4" class="form-control form-control-sm" rows="3" required><?= old('objective') ?></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
