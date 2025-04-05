$(document).ready(function () {
    $('.toggle-status').on('click', function (e) {
        e.preventDefault();

        const counterID = $(this).data('id');
        const currentStatus = $(this).data('status');
        const isBlocking = currentStatus == 1;
        const actionText = isBlocking ? 'Block' : 'Activate';
        const actionVerb = isBlocking ? 'blocked' : 'activated';
        const url = `./../dbFunctions/counterToggleStatus.php?id=${counterID}&status=${currentStatus}`;

        Swal.fire({
            title: `Confirm ${actionText}`,
            text: `Are you sure you want to ${actionText.toLowerCase()} this counter staff? They will be ${actionVerb} in the system.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: isBlocking ? '#d33' : '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: `Yes, ${actionText}`,
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
});