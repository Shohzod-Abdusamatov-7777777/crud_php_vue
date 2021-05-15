<?php
// connect to mysql
$conn = new mysqli("crud-vue-php", "root", "root", "vue_crud");
if ($conn->connect_error) {
    die("connection Failed" . $conn->connect_error);
}

$result = array('error' => false);
$action = '';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

// read  user
if ($action == "read") {
    $sql = $conn->query("SELECT * FROM users");
    $users = array();
    while ($row = $sql->fetch_assoc()) {
        array_push($users, $row);
    }
    $result['users'] = $users;
    echo json_encode($result);

};

// create new user
if ($action == "create") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $country = $_POST['country'];
    $sql = $conn->query("INSERT INTO users (name,age,country) VALUES('$name','$age','$country')");

    if ($sql) {
        $result['msg'] = "User added successfully!";
    } else {
        $result['error'] = true;
        $result['err_msg'] = "Failed to add user!";
    }
    echo json_encode($result);

}

// update
if ($action == "update") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $country = $_POST['country'];
    $sql = $conn->query("UPDATE users SET name='$name', age='$age',country='$country' WHERE id='$id' ");

    if ($sql) {
        $result['msg'] = "User update successfully!";
    } else {
        $result['error'] = true;
        $result['err_msg'] = "Failed to update user!";
    }
    echo json_encode($result);

}

// delete
if ($action == "delete") {
    $id = $_POST['id'];
    $sql = $conn->query("DELETE FROM users WHERE id='$id' ");

    if ($sql) {
        $result['msg'] = "User delete successfully!";
    } else {
        $result['error'] = true;
        $result['err_msg'] = "Failed to delete user!";
    }
    echo json_encode($result);

}
?>


