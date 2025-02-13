<?php include_once "adminNavbar.php"; ?>
<!-- Main Content -->
<section class="content w-100">
    <div class="row mt-2 ms-1 me-1">
        <h4 class="mb-3">Manage Customer</h4>

        <div class="col-md-12 border border-2 pt-1 shadow-sm rounded">
            <div class="row text-end">
                <div class="mb-2 mt-2">
                    <div>
                        Search: <input type="text" class="form-control d-inline-block w-auto" >
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <table class="table table-bordered table-responsive" id="myTable">
                    <thead class="table-light">
                        <tr>
                            <th>Sl No</th>
                            <th>SIC</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>23mmci31</td>
                            <td>Customer 1</td>
                            <td><span class="d-inline-block rounded-circle me-2" style="height: 10px; width: 10px; background-color: rgb(11, 218, 11)"></span>Active</td>
                            <td>
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editCategory"><i class="fa-solid fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteCategory"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>23mmci32</td>
                            <td>Customer 2</td>
                            <td><span class="d-inline-block rounded-circle me-2" style="height: 10px; width: 10px; background-color: rgb(243, 64, 64)"></span>Inactive</td>
                            <td>
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editCategory"><i class="fa-solid fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteCategory"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>23mmci33</td>
                            <td>Customer 3</td>
                            <td><span class="d-inline-block rounded-circle me-2" style="height: 10px; width: 10px; background-color: rgb(11, 218, 11)"></span>Active</td>
                            <td>
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editCategory"><i class="fa-solid fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteCategory"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>23mmci34</td>
                            <td>Customer 4</td>
                            <td><span class="d-inline-block rounded-circle me-2" style="height: 10px; width: 10px; background-color: rgb(243, 64, 64)"></span>Inactive</td>
                            <td>
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editCategory"><i class="fa-solid fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteCategory"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>23mmci35</td>
                            <td>Customer 5</td>
                            <td><span class="d-inline-block rounded-circle me-2" style="height: 10px; width: 10px; background-color: rgb(11, 218, 11)"></span>Active</td>
                            <td>
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editCategory"><i class="fa-solid fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteCategory"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>23mmci36</td>
                            <td>Customer 6</td>
                            <td><span class="d-inline-block rounded-circle me-2" style="height: 10px; width: 10px; background-color: rgb(243, 64, 64)"></span>Inactive</td>
                            <td>
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editCategory"><i class="fa-solid fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteCategory"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>23mmci37</td>
                            <td>Customer 7</td>
                            <td><span class="d-inline-block rounded-circle me-2" style="height: 10px; width: 10px; background-color: rgb(11, 218, 11)"></span>Active</td>
                            <td>
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editCategory"><i class="fa-solid fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteCategory"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>23mmci38</td>
                            <td>Customer 8</td>
                            <td><span class="d-inline-block rounded-circle me-2" style="height: 10px; width: 10px; background-color: rgb(243, 64, 64)"></span>Inactive</td>
                            <td>
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editCategory"><i class="fa-solid fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteCategory"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>23mmci39</td>
                            <td>Customer 9</td>
                            <td><span class="d-inline-block rounded-circle me-2" style="height: 10px; width: 10px; background-color: rgb(11, 218, 11)"></span>Active</td>
                            <td>
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editCategory"><i class="fa-solid fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteCategory"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>23mmci30</td>
                            <td>Customer 10</td>
                            <td><span class="d-inline-block rounded-circle me-2" style="height: 10px; width: 10px; background-color: rgb(243, 64, 64)"></span>Inactive</td>
                            <td>
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editCategory"><i class="fa-solid fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteCategory"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>

            <!-- Pagination Controls -->
            <nav>
                <ul class="pagination justify-content-center" id="pagination">
                    <!-- Prev and Next buttons will be dynamically updated -->
                </ul>
            </nav>

            <!-- Pagination Script -->
            <script>
                const rowsPerPage = 8; // Number of rows per page
                const rows = document.querySelectorAll("#myTable tbody tr"); // All the rows in the table
                const totalPages = Math.ceil(rows.length / rowsPerPage); // Total number of pages based on rowsPerPage
                let currentPage = 1; // Set the initial page

                // Function to update the table display and pagination
                function updatePagination() {
                    const start = (currentPage - 1) * rowsPerPage;
                    const end = currentPage * rowsPerPage;

                    // Show or hide rows based on the current page
                    rows.forEach((row, index) => {
                        row.style.display = (index >= start && index < end) ? "" : "none";
                    });

                    // Update page links
                    generatePagination();
                }

                // Function to create pagination buttons dynamically
                function generatePagination() {
                    const paginationContainer = document.getElementById("pagination");
                    paginationContainer.innerHTML = ''; // Clear previous pagination links

                    // Add the "Prev" button
                    const prevButton = `
                        <li class="page-item ${currentPage === 1 ? 'disabled' : ''}" id="prevPage">
                            <a class="page-link" href="#">Prev</a>
                        </li>`;
                    paginationContainer.innerHTML += prevButton;

                    // Add page number buttons
                    for (let i = 1; i <= totalPages; i++) {
                        const pageLink = `
                            <li class="page-item ${currentPage === i ? 'active' : ''}" id="page${i}">
                                <a class="page-link" href="#">${i}</a>
                            </li>`;
                        paginationContainer.innerHTML += pageLink;
                    }

                    // Add the "Next" button
                    const nextButton = `
                        <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}" id="nextPage">
                            <a class="page-link" href="#">Next</a>
                        </li>`;
                    paginationContainer.innerHTML += nextButton;

                    // Add event listeners for "Prev", "Next" and page numbers
                    document.getElementById("prevPage").addEventListener("click", function () {
                        if (currentPage > 1) {
                            currentPage--;
                            updatePagination();
                        }
                    });

                    document.getElementById("nextPage").addEventListener("click", function () {
                        if (currentPage < totalPages) {
                            currentPage++;
                            updatePagination();
                        }
                    });

                    // Add click event for page numbers
                    for (let i = 1; i <= totalPages; i++) {
                        document.getElementById(`page${i}`).addEventListener("click", function () {
                            currentPage = i;
                            updatePagination();
                        });
                    }
                }

                // Initial page load
                updatePagination();
            </script>

        </div>
    </div>
</section>

<?php include_once "adminFooter.php"; ?>
