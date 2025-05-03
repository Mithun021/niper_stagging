<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php use App\Models\Employee_model; ?>

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<!-- Page Title -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body p-1">
                <?php if (session()->getFlashdata('status')) echo session()->getFlashdata('status'); ?>
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="eventModal" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Slot Booking</h5>
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="eventForm">
                <div class="modal-body">
                    <input type="text" id="event_date" name="booking_slot_date" readonly>
                    <input type="text" id="booking_slot_day" name="booking_slot_day" readonly>

                    <div class="form-group">
                        <label for="department_id">Department</label>
                        <select class="form-control" name="department_id" id="department_id" required>
                            <option value="">--Select--</option>
                            <?php foreach ($department as $dept): ?>
                                <option value="<?= $dept['id'] ?>"><?= $dept['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="instrument_id">Instrument Name</label>
                        <select class="form-control" name="instrument_id" id="instrument_id" required>
                            <option value="">--Select--</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>User Type</label>
                        <select class="form-control" name="user_type" required>
                            <option value="">--Select--</option>
                            <option value="External Student / Faculty">External Student / Faculty</option>
                            <option value="Internal">Internal</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Booking Time</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="booking_start_time" placeholder="Start Time" onfocus="this.type='time'" onblur="this.type='text'" required>
                            <input type="text" class="form-control" name="booking_end_time" placeholder="End Time" onfocus="this.type='time'" onblur="this.type='text'" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Number of Slots</label>
                        <input type="number" class="form-control" name="number_of_slots" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>
<script>
$(document).ready(function () {
    // Load instruments on department change
    $('#department_id').change(function () {
        var department_id = $(this).val();
        $.ajax({
            url: '<?= base_url('fetch-instrument-by-department') ?>',
            type: 'POST',
            data: { department_id: department_id },
            dataType: 'json',
            beforeSend: function () {
                $('#instrument_id').html('<option value="">--Please Wait--</option>');
            },
            success: function (data) {
                $('#instrument_id').html('<option value="">--Select--</option>');
                $.each(data, function (index, instrument) {
                    $('#instrument_id').append('<option value="' + instrument.id + '">' + instrument.title + '</option>');
                });
            }
        });
    });

    // Initialize calendar
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        selectable: true,
        events: '<?= base_url('fetch-instrument-slots') ?>',

        dateClick: function (info) {
            var dateStr = info.dateStr;
            var dayName = new Date(dateStr).toLocaleDateString('en-US', { weekday: 'long' });

            $('#event_date').val(dateStr);
            $('#booking_slot_day').val(dayName);

            $('#eventModal').modal('show'); // Correct for Bootstrap 4
        }
    });

    calendar.render();

    // Form submission
    $('#eventForm').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: '<?= base_url('create-instrument-slots') ?>',
            method: 'POST',
            data: $(this).serialize(),
            success: function (res) {
                $('#eventModal').modal('hide');
                calendar.addEvent({
                    title: $('[name="user_type"]').val() + ' [' + $('[name="booking_start_time"]').val() + ' - ' + $('[name="booking_end_time"]').val() + ']',
                    start: $('#event_date').val(),
                    allDay: true
                });
                alert("Slot booked successfully!");
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    alert("Validation error: Please fill all required fields.");
                } else {
                    alert("Failed to save event.");
                }
            }
        });
    });
});
</script>

<?= $this->endSection() ?>