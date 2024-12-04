<?= $this->extend("admin/layouts/master") ?>

<?= $this->section("body-content") ?>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Event Fees Details</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')) : ?>
                    <div class="alert alert-info">
                        <?= session()->getFlashdata('status') ?>
                    </div>
                <?php endif; ?>

                <form id="eventFeesForm">
                    <!-- Event ID -->
                    <div class="form-group">
                        <span>Event ID:</span>
                        <select name="event_id" class="form-control form-control-sm">
                            <option value="">Select Event</option>
                        </select>
                    </div>

                    <!-- Fee Type -->
                    <div class="form-group">
                        <span for="evtfeestype">Fee Type <span class="text-danger">*</span></span>
                        <select class="form-control form-control-sm" name="evtfeestype" id="evtfeestype" required>
                            <option value="">-- Select Fee Type --</option>
                            <option value="All">All</option>
                            <option value="Research Scholar">Research Scholar</option>
                            <option value="Post Doc.">Post Doc.</option>
                            <option value="Faculty">Faculty</option>
                            <option value="Graduate">Graduate</option>
                            <option value="Postgraduate">Postgraduate</option>
                            <option value="Govt. Affiliation">Govt. Affiliation</option>
                            <option value="Private Affiliation">Private Affiliation</option>
                            <option value="Industry Professionals">Industry Professionals</option>
                        </select>
                    </div>

                    <!-- Event Fees -->
                    <div class="form-group">
                        <span for="evtfees">Event Fees (in INR) <span class="text-danger">*</span></span>
                        <input type="number" class="form-control form-control-sm" name="evtfees" id="evtfees" placeholder="Enter Fees Amount" min="0" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary btn-sm" id="saveFeesBtn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Event Fees List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Event ID</td>
                                <td>Fee Type</td>
                                <td>Fees</td>
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