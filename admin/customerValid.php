<?php 
include_once "adminNavbar.php"; 
require_once "../dbFunctions/studentdb.php";
?>
<!-- Main Content -->
<section class="content w-100">
    <div class="row mt-3 ms-1 me-1">
        <h2 class="mb-4">Valid Customers</h2>

        <div class="col-md-12 border border-2 pt-1 shadow-sm rounded">
            <div class="row text-end">
                <div class="col-md-6 mb-3 mt-2 text-start">
                    <a class="btn btn-success text-center" href="./customerAdd.php"><i class="fa-solid fa-plus"></i> Add Records</a>
                </div>
                <div class="col-md-6 mb-3 mt-2 text-md-end">
                    <div class="d-flex justify-content-md-end align-items-center gap-2">
                        <label for="searchInput" style="font-weight: 500;">Search:</label>
                        <div style="position: relative;">
                            <i class="fas fa-search" style="
                                position: absolute;
                                top: 50%;
                                left: 10px;
                                transform: translateY(-50%);
                                color: #888;
                            "></i>
                            <input type="text" 
                                id="searchInput" 
                                class="form-control" 
                                placeholder="Search by SIC or Name"
                                style="
                                    padding-left: 30px;
                                    border: 1px solid #ccc;
                                    height: 38px;
                                    width: 250px;
                                ">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row ms-1">
                Total No. records: <?php echo totalNoOfSicEmail();?>
            </div>

            <div class="d-flex justify-content-between mt-1">
                <div style="max-height: 450px; overflow-y: auto; width: 100%;" class="mb-2"> 
                    <table class="table table-bordered table-responsive" id="myTable">
                        <thead class="table-light">
                            <tr>
                                <th>Sl No</th>
                                <th>SIC</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php
                                $sl = 1;
                                $result = getAllSicEmail();
                                while($std = $result->fetch_assoc()){
                                    ?>
                                    <tr>
                                        <td><?= $sl++?></td>
                                        <td class="sic"><?= $std['sic']?></td>
                                        <td class="email"><?= $std['email']?></td>
                                        <td>
                                            <a href="updateSicEmail.php?id=<?php echo $std['seID'] ?>" class="btn btn-success btn-sm"><i class="fa-solid fa-edit"></i> Edit</a>
                                            <!-- <a href="delete.php?id=<?php echo $std['seID'] ?>" class="btn btn-danger btn-sm" id="deleteStudent"><i class="fa-solid fa-trash"></i> Delete</a> -->
                                            <a class="btn btn-danger btn-sm delete-btn" data-id="<?= $std['seID'] ?>" data-sic="<?= $std['sic']?>" name="customerValidDeleteBtn">
                                                <i class="fa-solid fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                    <?php 
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Search bar
    document.getElementById("searchInput").addEventListener("input", function () {
        let searchQuery = this.value.toLowerCase(); 
        let tableRows = document.querySelectorAll("#myTable tbody tr");

        tableRows.forEach(row => {
            let sic = row.querySelector(".sic").textContent.toLowerCase();
            let email = row.querySelector(".email").textContent.toLowerCase();
            if (sic.includes(searchQuery) || email.includes(searchQuery)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });

    // Delete the records using sweetalert
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function () {
                let recordId = this.getAttribute("data-id"); // Get the record ID
                let sic = this.getAttribute("data-sic"); // Get the record ID

                Swal.fire({
                    title: `Are you sure want to delete ${sic}?`,
                    text: "This action cannot be undone!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch("../dbFunctions/studentAjax.php", {
                            method: "POST",
                            headers: { "Content-Type": "application/json" }, // JSON data
                            body: JSON.stringify({ id: recordId, message: "deleteSicEmail" }) // Sending data as JSON
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: data.message,
                                    icon: "success",
                                    timer: 2000, 
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire("Error!", data.message, "error");
                            }
                        })
                        .catch(error => {
                            Swal.fire("Error!", "Something went wrong.", "error");
                        });
                    }
                });
            });
        });
    });

</script>

<?php include_once "adminFooter.php"; ?>