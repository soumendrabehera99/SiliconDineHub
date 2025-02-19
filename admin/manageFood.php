<?php include_once "adminNavbar.php";?>
<!-- Main Content -->
<section class="content w-100">

    <div class="row mt-3 ms-1 me-1">
        <h2>Manage Food</h2>
        <div class="col-12 border p-4 shadow-sm rounded">
            <div class="col-md-12">
                <div class="d-flex justify-content-end mb-2">
                    <div class="d-flex align-items-center gap-1">
                        <input type="text" class="form-control d-inline-block w-auto" id="searchFoodInput" placeholder="Search Category">
                        <!-- <input type="submit" value="Search" class="btn btn-success search-btn" id="foodSearchBtn"> -->
                        <button type="submit" class="btn btn-success d-flex align-items-center gap-1 search-btn" id="foodSearchBtn">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-responsive">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Food name</th>
                        <th>Categories Name</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Rasgulla</td>
                        <td>Sweet</td>
                        <td>Rs 10</td>
                        <td>Available</td>
                        <td>
                            <button aria-label="Search" class="btn btn-success btn-sm"><i class="fa-solid fa-edit"></i></button>
                            <button aria-label="Search" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Rasgulla</td>
                        <td>Sweet</td>
                        <td>Rs 10</td>
                        <td>Available</td>
                        <td>
                            <button aria-label="Search" class="btn btn-success btn-sm"><i class="fa-solid fa-edit"></i></button>
                            <button aria-label="Search" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Rasgulla</td>
                        <td>Sweet</td>
                        <td>Rs 10</td>
                        <td>Available</td>
                        <td>
                            <button aria-label="Search" class="btn btn-success btn-sm"><i class="fa-solid fa-edit"></i></button>
                            <button aria-label="Search" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Rasgulla</td>
                        <td>Sweet</td>
                        <td>Rs 10</td>
                        <td>Available</td>
                        <td>
                            <button aria-label="Search" class="btn btn-success btn-sm"><i class="fa-solid fa-edit"></i></button>
                            <button aria-label="Search" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Rasgulla</td>
                        <td>Sweet</td>
                        <td>Rs 10</td>
                        <td>Available</td>
                        <td>
                            <button aria-label="Search" class="btn btn-success btn-sm"><i class="fa-solid fa-edit"></i></button>
                            <button aria-label="Search" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</sction>
<?php include_once "adminFooter.php";?>