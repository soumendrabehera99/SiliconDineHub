$(document).ready(function() {
    $('.summernote').summernote({
        height: 150
    });

    fetchAnnouncements();

    function fetchAnnouncements() {
        $.ajax({
            url: "../dbFunctions/announcementDb.php",
            type: "POST",
            data: {operation: "fetch"},
            dataType: "json",
            success: function(response) {
                let html = '';
                let count = 1
    
                if (response.length === 0) {
                    html = `
                        <tr>
                            <td colspan="6" class="text-center">No announcements available at the moment.</td>
                        </tr>
                    `;
                } else {
                    $.each(response, function(index, data) {
                        html += `
                            <tr>
                                <td>${count++}</td>
                                <td>${data.title}</td>
                                <td class="text-wrap w-50">${data.message}</td>
                                <td>${new Date(data.from_date).toLocaleDateString('en-GB', {
                                    day: '2-digit',
                                    month: 'short',
                                    year: 'numeric'
                                    })}
                                </td>

                                <td>${new Date(data.to_date).toLocaleDateString('en-GB', {
                                    day: '2-digit',
                                    month: 'short',
                                    year: 'numeric'
                                    })}
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info editBtn" data-id="${data.id}">Edit</button>
                                    <button class="btn btn-sm btn-danger deleteBtn" data-id="${data.id}">Delete</button>
                                </td>
                            </tr>
                        `;
                    });
                }
    
                $('#announcementData').html(html);
            }
        });
    }
    

    // Add / Edit Announcement
    $('#announcementForm').submit(function(e) {
        e.preventDefault();

        // Validation
        let message = $('#message').summernote('code');
        let fromDate = new Date($('#from_date').val());
        let toDate = new Date($('#to_date').val());
        let today = new Date();
        today.setHours(0,0,0,0); // Remove time portion for exact comparison

        // Check for image/video tags
        if (/<(img|video)/i.test(message)) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Content!',
                text: 'Images or Videos are not allowed in the message.',
                showConfirmButton: true
            });
            return; // Stop submission
        }

        // Check if From Date is today or later
        if (fromDate < today) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid From Date!',
                text: 'From Date cannot be earlier than today.',
                showConfirmButton: true
            });
            return;
        }

        // Check if To Date is greater than From Date
        if (toDate <= fromDate) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid To Date!',
                text: 'To Date must be later than From Date.',
                showConfirmButton: true
            });
            return;
        }

        let operation = $('#id').val() == '' ? 'add' : 'edit';

        $.ajax({
            url: "../dbFunctions/announcementDb.php",
            type: "POST",
            data: {
                id: $('#id').val(),
                title: $('#title').val(),
                message: message,
                from_date: $('#from_date').val(),
                to_date: $('#to_date').val(),
                operation: operation
            },
            dataType: "json",
            success: function(response) {
                Swal.fire({
                    icon: response.success ? 'success' : 'error',
                    title: response.message,
                    timer: 1500,
                    showConfirmButton: false
                });
                if (response.success) {
                    $('#announcementForm')[0].reset();
                    $('#id').val('');
                    $('.summernote').summernote('reset');
                    $('#submitBtn').text('Add Announcement');
                    $('#cancelEdit').hide();
                    fetchAnnouncements();
                }
            }
        });
    });

    // Edit Button Click
    $(document).on('click', '.editBtn', function() {
        let id = $(this).data('id');

        $.ajax({
            url: "../dbFunctions/announcementDb.php",
            type: "POST",
            data: {id: id, operation: "get"},
            dataType: "json",
            success: function(data) {
                $('#id').val(data.id);
                $('#title').val(data.title);
                $('#message').summernote('code', data.message);
                $('#from_date').val(data.from_date);
                $('#to_date').val(data.to_date);
                $('#submitBtn').text('Update Announcement');
                $('#cancelEdit').show();
            }
        });
    });

    // Cancel Edit
    $('#cancelEdit').click(function() {
        $('#announcementForm')[0].reset();
        $('#id').val('');
        $('.summernote').summernote('reset');
        $('#submitBtn').text('Add Announcement');
        $(this).hide();
    });

    // Delete Button Click
    $(document).on('click', '.deleteBtn', function() {
        let id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "../dbFunctions/announcementDb.php",
                    type: "POST",
                    data: {id: id, operation: "delete"},
                    dataType: "json",
                    success: function(response) {
                        Swal.fire({
                            icon: response.success ? 'success' : 'error',
                            title: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                        if (response.success) {
                            fetchAnnouncements();
                        }
                    }
                });
            }
        });
    });
});
