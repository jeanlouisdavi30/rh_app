<?php
// sql to delete a record

if(isset($_GET['dep_id'])){
    $dep_id = $_GET['dep_id'];

    $sql = "DELETE FROM dependants WHERE id = $dep_id";

    if (mysqli_query($con, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }

    mysqli_close($con);
}

if(isset($_GET['file_id'])){
    $file_id = $_GET['file_id'];

    $sql = "DELETE FROM files WHERE id = $file_id";

    if (mysqli_query($con, $sql)) {
        echo "<div class='alert alert-success' role='alert' id='alert' >Record deleted successfully ! </div>";
    } else {
        echo "<div class='alert alert-success' role='alert'>Error deleting record: </div>" . mysqli_error($con);
    }

    mysqli_close($con);
}

if(isset($_GET['del_emp_id'])){
    $emp_id = $_GET['del_emp_id'];

    $sql = "DELETE FROM employees WHERE id = $emp_id";

    if (mysqli_query($con, $sql)) {
        echo "<div class='alert alert-success' role='alert' id='alert' >Record deleted successfully ! </div>";
    } else {
        echo "<div class='alert alert-success' role='alert'>Error deleting record: </div>" . mysqli_error($con);
    }

    mysqli_close($con);
}

if(isset($_GET['del_mat_id'])){
    $mat_id = $_GET['del_mat_id'];

    $sql = "DELETE FROM materiels WHERE id = $mat_id";

    if (mysqli_query($con, $sql)) {
        echo "<div class='alert alert-success' role='alert' id='alert' >Record deleted successfully ! </div>";
    } else {
        echo "<div class='alert alert-success' role='alert'>Error deleting record: </div>" . mysqli_error($con);
    }

    mysqli_close($con);
}


?>