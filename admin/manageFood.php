<?php include_once "adminNavbar.php";?>
<!-- Main Content -->
<section class="content w-100">
    <div class="row">
        <div class="col">
            <span class="text-dark fs-5">Food > <span class="text-secondary">Manage Food</span></span>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12 border p-4 shadow-sm rounded">
            <button class="btn btn-success mb-3">Add Categories</button>
            <div class="d-flex justify-content-between mb-2">
                <div>
                Show 
                    <select class="form-select d-inline-block w-auto">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                    entries
                </div>
                <div>
                    Search: <input type="text" class="form-control d-inline-block w-auto">
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