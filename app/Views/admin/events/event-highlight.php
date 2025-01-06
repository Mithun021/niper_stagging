<?= $this->extend("admin/layouts/master") ?>

<?= $this->section("body-content") ?>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Event Highlights</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')) : ?>
                    <div class="alert alert-info">
                        <?= session()->getFlashdata('status') ?>
                    </div>
                <?php endif; ?>

                <form id="eventHighlightsForm">
                    <!-- Event ID -->
                    <div class="form-group">
                        <span>Event ID:</span>
                        <select name="event_id" class="form-control form-control-sm">
                            <option value="">Select Event</option>
                        </select>
                    </div>

                    <!-- Highlight Title -->
                    <div class="form-group">
                        <span for="evthightitle">Highlight Title <span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="evthightitle" id="evthightitle" placeholder="Enter Highlight Title" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary btn-sm" id="saveHighlightBtn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Event Highlights List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Event ID</td>
                                <td>Highlight Title</td>
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