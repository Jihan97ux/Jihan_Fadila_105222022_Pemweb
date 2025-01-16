<script type="text/javascript">
    $(document).ready(function () {
    $('.table-schedule').DataTable({
        language: {
            paginate: {
                next: '<i class="bi bi-arrow-right"></i>',
                previous: '<i class="bi bi-arrow-left"></i>',
            },
            emptyTable: "Data tidak ditemukan",
        },
    });

    $(document).on('click', '.btn-edit', function () {
    const scheduleId = $(this).data('id');
    const url = `/events/${scheduleId}`;

    $.ajax({
        url: url,
        method: 'GET',
        success: function (response) {
            if (response) {
                // Isi form modal dengan data event
                $('#editId').val(response.id);
                $('#editTitle').val(response.event_name);
                $('#editStart').val(response.start_time.replace(' ', 'T')); // Format datetime
                $('#editEnd').val(response.end_time.replace(' ', 'T'));
                $('#editModal').modal('show');
            } else {
                alert('Data tidak ditemukan');
            }
        },
        error: function (xhr) {
            console.error('Error:', xhr);
            alert('Gagal mengambil data. Silakan coba lagi.');
        },
    });
});


    // Event edit form submission
    $('#editEventForm').on('submit', function (e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.ajax({
            url: '/events/update',
            method: 'POST',
            data: formData,
            headers: {
        		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    		},
            success: function (response) {
                alert(response.success);
                $('#editEventModal').modal('hide');
                location.reload();
            },
            error: function (xhr) {
                console.error('Error:', xhr);
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    alert(xhr.responseJSON.error);
                } else {
                    alert('Gagal memperbarui event. Periksa data Anda.');
                }
            },
        });
    });
});
</script>