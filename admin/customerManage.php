<?php 
include_once "adminNavbar.php"; 
require_once "../dbFunctions/studentdb.php";
?>
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
                            <th>DOB</th>
                            <th>Status</th>
                            <th>Password</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sl = 1;
                            $result = getAllStudents();
                            while($std = $result->fetch_assoc()){
                                ?>
                                <tr>
                                    <td><?= $sl++?></td>
                                    <td><?= $std['sic']?></td>
                                    <td><?= $std['name']?></td>
                                    <td><?= date('d M Y', strtotime($std['dob'])) ?></td>
                                    <td>
                                        <span 
                                            class="d-inline-block rounded-circle me-2" 
                                            style="height: 10px; width: 10px; background-color: <?= $std['isActive'] ? 'rgb(11, 218, 11)' : 'rgb(243, 64, 64)' ?>;">
                                        </span>
                                        <?= $std['isActive'] ? 'Active' : 'Block' ?>
                                    </td>
                                    <td><?= $std['password']?></td>
                                    <td>
                                        <a href="details.php?id=<?php echo $std['studentID'] ?>" class="btn btn-success btn-sm"><i class="fa-solid fa-edit"></i></a>
                                        <a href="delete.php?id=<?php echo $std['studentID'] ?>" class="btn btn-danger btn-sm" id=""deleteStudent><i class="fa-solid fa-ban"></i></a>
                                    </td>
                                </tr>
                                <?php 
                            }
                        ?>
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
