<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <title>crud with php and vue</title>
    <script src="https://unpkg.com/vue@next"></script>
</head>

<body>
    <?php include("process.php") ?>
    <div id="app">
        <div class="container-fluid bg-dark text-light p-2 text-center">
            CRUD WITH VUE AND PHP
        </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-6 col-10">
                    <h3 class="text-primary">Register User</h3>
                </div>
                <div class="col-sm-6 col-10">
                    <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addUserModal"><i class="fa fa-user"></i>&nbsp;Add
                        User
                    </button>
                </div>
                <hr class="text-primary mt-2">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped text-center ">
                            <thead class="bg-primary text-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Country</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody v-if="users.length>0">
                                <tr v-for="user in users">
                                    <td>{{user.id}}</td>
                                    <td>{{user.name}}</td>
                                    <td>{{user.age}}</td>
                                    <td>{{user.country}}</td>
                                    <td class="text-success">
                                        <i class="fa fa-edit" @click="currentUser=user" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#editUserModal"></i>
                                    </td>
                                    <td class="text-danger">
                                        <i class="far fa-trash-alt" @click="currentUser=user" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteUserModal"></i>
                                    </td>
                                </tr>

                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="6">Malumot topilmadi!</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- add user modal -->
        <div class="modal fade" tabindex="-1" id="addUserModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New User</h5>
                        <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" v-model="newUser.name" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="age">Age:</label>
                                <input type="number" name="age" v-model="newUser.age" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="country">Country:</label>
                                <input type="text" name="country" v-model="newUser.country" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" @click="addUser" name="save" class="btn btn-primary w-100">Add
                                User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- add user modal end -->

        <!-- edit user modal -->
        <div class="modal fade" tabindex="-1" id="editUserModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" v-model="currentUser.name" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="age">Age:</label>
                                <input type="number" v-model="currentUser.age" name="age" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="country">Country:</label>
                                <input type="text" v-model="currentUser.country" name="country" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success w-100" @click="editUser">
                                Save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- edit user modal end -->
        <!-- delete user modal -->
        <div class="modal fade" tabindex="-1" id="deleteUserModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-danger">Are sure want to delete this user?</h4>
                        <strong>You are deleting "{{currentUser.name}}"</strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="deleteUser(currentUser.id)">Yes</button>
                        <button type="button" class="btn btn-success" @click='closeModal()'>No</button>

                    </div>
                </div>
            </div>
        </div>
        <!-- delete user modal end -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.js" integrity="sha512-otOZr2EcknK9a5aa3BbMR9XOjYKtxxscwyRHN6zmdXuRfJ5uApkHB7cz1laWk2g8RKLzV9qv/fl3RPwfCuoxHQ==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./main.js"></script>
</body>

</html>