$('#addRecordBtn').on('click', function () {
    Swal.fire({
        title: 'Add Counter Staff',
        html:
        `<div class="mb-3 text-start">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username">
        </div>
        <div class="mb-3 text-start">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password">
        </div>
        <div class="mb-3 text-start">
            <label for="confirmPassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirmPassword" >
        </div>`,
        confirmButtonText: 'Add',
        focusConfirm: false,
        preConfirm: () => {
        const username = Swal.getPopup().querySelector('#username').value.trim()
        const password = Swal.getPopup().querySelector('#password').value
        const confirmPassword = Swal.getPopup().querySelector('#confirmPassword').value

        if (!username || !password || !confirmPassword) {
            Swal.showValidationMessage('All fields are required')
        } else if (password !== confirmPassword) {
            Swal.showValidationMessage('Passwords do not match')
        }

        return { username, password }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: './../dbFunctions/counterAddDb.php',
                method: 'POST',
                data: {
                    username: result.value.username,
                    password: result.value.password
                },
                dataType: 'json', 
                success: function (res) {
                    console.log(res);
                    if (res.status === 'success') {
                        console.log(res.message);
                        Swal.fire('Success', res.message, 'success').then(() => {
                            location.reload(); 
                        });
                    } else {
                        Swal.fire('Error', res.message, 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error', 'Server error', 'error');
                }
            });   
        }
    })
});