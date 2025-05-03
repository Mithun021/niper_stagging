<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Employee_model;

$employee_model = new Employee_model();
?>
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<style>

</style>
<!-- start page title -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body p-1">
                <?php if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                } ?>
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="eventModal" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="eventForm">
                <div class="modal-body">
                    <input type="text" id="event_date" class="form-control" name="date" readonly>
                    <div class="mb-3">
                        <label for="event_day" class="form-label">Day</label>
                        <input type="text" class="form-control" name="day" id="event_day" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <select class="form-control" name="department" required>
                            <option value="">--Select--</option>
                            <?php foreach ($department as $dept) { ?>
                                <option value="<?= $dept['id'] ?>"><?= $dept['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="instrument" class="form-label">Instrument Name</label>
                        <select class="form-control" name="instrument" required>
                            <option value="">--Select--</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            initialDate: new Date(),
            selectable: true,
            events: '/calendar/fetch-events',

            dateClick: function(info) {
                const dateStr = info.dateStr;
                const dayName = new Date(dateStr).toLocaleDateString('en-US', {
                    weekday: 'long'
                });

                $('#event_date').val(dateStr);
                $('#event_day').val(dayName);

                $('#modalTitle').text(`Add Event - ${dayName}, ${dateStr}`);
                const modal = new bootstrap.Modal(document.getElementById('eventModal'));
                modal.show();
            }
        });

        calendar.render();
    });
</script>

<?= $this->endSection() ?>