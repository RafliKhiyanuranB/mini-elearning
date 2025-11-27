<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <h2>Daftar Users</h2>
    <a href="tambah_users.php">Tambah User</a>
    <table border="1" colspan="5" >
        <tr>
            <td>No</td>
            <td>Nama</td>
            <td>Email</td>
            <td>Role</td>
            <td>Action</td>
        </tr>
        <?php 
        $num = 1;
        foreach ($data as $dt):?>
        <tr>
            <td><?= $num ?></td>
            <td><?= $dt["name"] ?></td>
            <td><?= $dt["email"] ?></td>
            <td><?= $dt["role"] ?></td>
            <td>
                <a href="#">Edit</a>
                <a href="#">Delete</a>
            </td>
        </tr>
        <?php
        $num++;
        endforeach; ?>
    </table>
</body>
</html>