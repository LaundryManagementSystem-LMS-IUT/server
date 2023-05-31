<!DOCTYPE html>
<html>
<head>
    <title>Customer Data</title>
</head>
<body>
    <h1>Customer Data</h1>
    <table>
        <thead>
            <tr>
                <th>Email</th>
                <th>Address</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($customers as $customer): ?>
                <tr>
                    <td><?= $customer->email ?></td>
                    <td><?= $customer->address ?></td>
                    <td><?= $customer->created_at ?></td>
                    <td><?= $customer->updated_at ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
