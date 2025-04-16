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


    // edit counter button
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



    document.querySelectorAll('.assign-food-category').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const counterID = this.dataset.id;
    
            fetch(`../dbFunctions/counterCategoryHandler.php?counterID=${counterID}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        Swal.fire('No Categories', 'All categories are already assigned.', 'info');
                        return;
                    }
    
                    let html = '<form id="categoryForm">';
                    data.forEach(category => {
                        html += `
                            <div class="form-check text-start">
                                <input class="form-check-input" type="checkbox" name="categories" value="${category.foodCategoryID}" id="cat${category.foodCategoryID}">
                                <label class="form-check-label" for="cat${category.foodCategoryID}">${category.category}</label>
                            </div>
                        `;
                    });
                    html += '</form>';
    
                    Swal.fire({
                        title: 'Assign Food Categories',
                        html: html,
                        showCancelButton: true,
                        confirmButtonText: 'Assign',
                        preConfirm: () => {
                            const selected = [];
                            document.querySelectorAll('input[name="categories"]:checked').forEach(cb => {
                                selected.push(cb.value);
                            });
                            if (selected.length === 0) {
                                Swal.showValidationMessage('Please select at least one category.');
                                return false;
                            }
                            return selected;
                        }
                    }).then(result => {
                        if (result.isConfirmed) {
                            fetch(`../dbFunctions/counterCategoryHandler.php`, {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json' },
                                body: JSON.stringify({ counterID, categories: result.value })
                            })
                            .then(response => response.json())
                            .then(res => {
                                if (res.status === "success") {
                                    Swal.fire('Assigned!', 'Categories have been assigned successfully.', 'success')
                                        .then(() => location.reload());
                                } else {
                                    Swal.fire('Error!', res.message || 'Something went wrong.', 'error');
                                }
                            })
                            .catch(() => Swal.fire('Error!', 'Something went wrong while assigning.', 'error'));
                        }
                    });
                })
                .catch(() => Swal.fire('Error!', 'Could not fetch categories.', 'error'));
        });
    });

    // document.querySelectorAll('.edit-assigned-category').forEach(button => {
    //     button.addEventListener('click', function (event) {
    //         event.preventDefault();
    //         const counterID = this.dataset.id;
    
    //         // Fetch both assigned and all categories from server
    //         fetch(`../dbFunctions/counterCategoryHandler.php?counterID=${counterID}&editMode=1`)
    //             .then(response => response.json())
    //             .then(data => {
    //                 const allCategories = data.all;
    //                 const assignedCategories = data.assigned;
    
    //                 if (allCategories.length === 0) {
    //                     Swal.fire('No Categories', 'No categories available to assign.', 'info');
    //                     return;
    //                 }
    
    //                 let html = '<form id="editCategoryForm">';
    //                 allCategories.forEach(category => {
    //                     const isChecked = assignedCategories.includes(category.foodCategoryID.toString()) ? 'checked' : '';
    //                     html += `
    //                         <div class="form-check text-start">
    //                             <input class="form-check-input" type="checkbox" name="categories" value="${category.foodCategoryID}" id="editCat${category.foodCategoryID}" ${isChecked}>
    //                             <label class="form-check-label" for="editCat${category.foodCategoryID}">${category.category}</label>
    //                         </div>
    //                     `;
    //                 });
    //                 html += '</form>';
    
    //                 Swal.fire({
    //                     title: 'Edit Assigned Categories',
    //                     html: html,
    //                     showCancelButton: true,
    //                     confirmButtonText: 'Update',
    //                     preConfirm: () => {
    //                         const selected = [];
    //                         document.querySelectorAll('input[name="categories"]:checked').forEach(cb => {
    //                             selected.push(cb.value);
    //                         });
    //                         if (selected.length === 0) {
    //                             Swal.showValidationMessage('Please select at least one category.');
    //                             return false;
    //                         }
    //                         return selected;
    //                     }
    //                 }).then(result => {
    //                     if (result.isConfirmed) {
    //                         fetch(`../dbFunctions/counterCategoryHandler.php`, {
    //                             method: 'POST',
    //                             headers: { 'Content-Type': 'application/json' },
    //                             body: JSON.stringify({ counterID, categories: result.value, mode: "update" })
    //                         })
    //                         .then(response => response.json())
    //                         .then(res => {
    //                             if (res.status === "success") {
    //                                 Swal.fire('Updated!', 'Categories updated successfully.', 'success')
    //                                     .then(() => location.reload());
    //                             } else {
    //                                 Swal.fire('Error!', res.message || 'Update failed.', 'error');
    //                             }
    //                         })
    //                         .catch(() => Swal.fire('Error!', 'Something went wrong while updating.', 'error'));
    //                     }
    //                 });
    //             })
    //             .catch(() => Swal.fire('Error!', 'Could not fetch categories.', 'error'));
    //     });
    // });   
        
    document.querySelectorAll('.edit-assigned-category').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const counterID = this.dataset.id;
    
            // Fetch both assigned and all categories from server
            fetch(`../dbFunctions/counterCategoryHandler.php?counterID=${counterID}&editMode=1`)
                .then(response => response.json())
                .then(data => {
                    const allCategories = data.all;
                    let assignedCategories = data.assigned;
    
                    if (allCategories.length === 0) {
                        Swal.fire('No Categories', 'No categories available to assign.', 'info');
                        return;
                    }
    
                    // Ensure assignedCategories are numbers for accurate comparison
                    assignedCategories = assignedCategories.map(Number);
    
                    let html = '<form id="editCategoryForm">';
                    allCategories.forEach(category => {
                        const isChecked = assignedCategories.includes(Number(category.foodCategoryID)) ? 'checked' : '';
                        html += `
                            <div class="form-check text-start">
                                <input class="form-check-input" type="checkbox" name="categories" value="${category.foodCategoryID}" id="editCat${category.foodCategoryID}" ${isChecked}>
                                <label class="form-check-label" for="editCat${category.foodCategoryID}">${category.category}</label>
                            </div>
                        `;
                    });
                    html += '</form>';
    
                    Swal.fire({
                        title: 'Edit Assigned Categories',
                        html: html,
                        showCancelButton: true,
                        confirmButtonText: 'Update',
                        preConfirm: () => {
                            const selected = [];
                            document.querySelectorAll('input[name="categories"]:checked').forEach(cb => {
                                selected.push(cb.value);
                            });
                            if (selected.length === 0) {
                                Swal.showValidationMessage('Please select at least one category.');
                                return false;
                            }
                            return selected;
                        }
                    }).then(result => {
                        if (result.isConfirmed) {
                            fetch(`../dbFunctions/counterCategoryHandler.php`, {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json' },
                                body: JSON.stringify({ counterID, categories: result.value, mode: "update" })
                            })
                            .then(response => response.json())
                            .then(res => {
                                if (res.status === "success") {
                                    Swal.fire('Updated!', 'Categories updated successfully.', 'success')
                                        .then(() => location.reload());
                                } else {
                                    Swal.fire('Error!', res.message || 'Update failed.', 'error');
                                }
                            })
                            .catch(() => Swal.fire('Error!', 'Something went wrong while updating.', 'error'));
                        }
                    });
                })
                .catch(() => Swal.fire('Error!', 'Could not fetch categories.', 'error'));
        });
    });
    
    
});
