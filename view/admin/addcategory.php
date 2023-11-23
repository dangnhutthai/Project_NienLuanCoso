<div class="container-fluid">
    <div class="row">
        <h1 class="mt-2 text-center">Add Category</h1>
        <div class="col-6 offset-3">
            <table class="table table-striped table-bordered table-info text-center">
                <form action="../model/categories/handle.php" method="POST">
                    <tr>
                        <td scope="col">Name category</td>
                        <td><input class="w-100" type="text" name="category" placeholder="Name category"></td>
                    </tr>
            </table>
            <div class="d-flex float-end">
                <button type="submit" name="addcategory" class="btn btn-primary"><i class="fa-solid fa-plus" style="color: #ffffff;"></i> Add brand</button>
            </div>
        </form>
    </div>
    </div>
</div>