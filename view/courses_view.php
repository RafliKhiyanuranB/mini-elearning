<!DOCTYPE html>
<html>
<head>
    <title>Data Courses</title>
</head>
<body>

<h2>Data Courses</h2>

<table border="1" cellpadding="6">
    <tr>
        <th>Courses ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Published</th>
        <th>Created</th>
    </tr>

    <?php foreach ($data as $row): ?>
        <tr>
            <td><?= $row['course_id'] ?></td>
            <td><?= $row['title'] ?></td>
            <td><?= $row['description'] ?></td>
            <td><?= $row['is_published'] ?></td>
            <td><?= $row['created_at'] ?></td>
        </tr>
    <?php endforeach; ?>

</table>

</body>
</html>
