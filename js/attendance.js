$('#event').select2();
$('#select_event').select2();
$('#memo_for').select2();

/**
 * Shows the user all of the users marked as present for a given event.
 */
function view_attendance() {
    window.location.href = '/index.php/attendance/attendees/' + $('#event').val();
}