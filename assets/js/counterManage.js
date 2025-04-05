document.addEventListener('DOMContentLoaded', function () {
    // status update
    const toggleButtons = document.querySelectorAll('.toggle-status');

    toggleButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const counterID = this.getAttribute('data-id');
            const currentStatus = this.getAttribute('data-status');
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


    // edit button
    document.querySelectorAll('.edit-counter').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            const counterID = this.dataset.id;
            const username = this.dataset.username;
            const password = this.dataset.password;
            const status = this.dataset.status;

            Swal.fire({
                title: 'Edit Counter '+counterID,
                html: `
                    <div class="mb-3 text-start">
                        <label for="swal-counter-id" class="form-label">Counter ID</label>
                        <input id="swal-counter-id" class="form-control" value="${counterID}" readonly>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="swal-User Name" class="form-label">Username</label>
                        <input id="swal-username" class="form-control" value="${username}" placeholder="Enter username">
                    </div>
                    <div class="mb-3 text-start">
                        <label for="swal-password" class="form-label">Password</label>
                        <input id="swal-password" class="form-control" value="${password}" placeholder="Enter password">
                    </div>
                    <div class="mb-3 text-start">
                        <label for="swal-status" class="form-label">Status</label>
                        <select id="swal-status" class="form-select">
                            <option value="1" ${status == 1 ? 'selected' : ''}>Active</option>
                            <option value="0" ${status == 0 ? 'selected' : ''}>Blocked</option>
                        </select>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Update',
                preConfirm: () => {
                    const updatedUsername = document.getElementById('swal-username').value;
                    const updatedPassword = document.getElementById('swal-password').value;
                    const updatedStatus = document.getElementById('swal-status').value;

                    if (!updatedUsername || !updatedPassword) {
                        Swal.showValidationMessage('Username and Password are required');
                        return false;
                    }

                    return {
                        id: counterID,
                        username: updatedUsername,
                        password: updatedPassword,
                        status: updatedStatus
                    };
                }
            }).then(result => {
                if (result.isConfirmed) {
                    const data = result.value;

                    // Create AJAX request
                    const xhr = new XMLHttpRequest();
                    xhr.open("POST", "../dbFunctions/counterEdit.php", true);
                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                    const params = `id=${encodeURIComponent(data.id)}&username=${encodeURIComponent(data.username)}&password=${encodeURIComponent(data.password)}&status=${encodeURIComponent(data.status)}`;

                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            const response = xhr.responseText.trim();
                            if (response === "success") {
                                Swal.fire("Updated!", "Counter details updated successfully.", "success")
                                    .then(() => location.reload());
                            } else {
                                Swal.fire("No Change", "No data was updated.", "info");
                            }
                        } else if (xhr.readyState === 4) {
                            Swal.fire("Error", "Something went wrong!", "error");
                        }
                    };

                    xhr.send(params);
                }
            });
        });
    });
});
