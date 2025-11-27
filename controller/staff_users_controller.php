<?php
include 'model/staff_users_model.php';

function users_index() {
    $data = get_all_users();
    include 'view/staff_users_view.php';
}

function users_insert() {
    if (isset($_POST["submit"])){
        $result = insert_data_users();
        if ($result > 0){
            echo "<script>
                alert('Data berhasil ditambahkan');
                document.location.href = 'index_users.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambahkan');
                document.location.href = 'insert_users.php';
            </script>";
        }
    }
    include 'view/staff_insert_users_view.php';
}
