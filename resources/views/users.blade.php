<!DOCTYPE html>
<html>
<head>
    <title>User Data</title>
</head>
<body>
    <h1>User Data</h1>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Profile Picture</th>
                <th>Phone Number</th>
                <th>Email Verified</th>
                <th>Phone Number Verified</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user): ?>
                <tr>
                    <td><?= $user->username ?></td>
                    <td><?= $user->email ?></td>
                    <td><?= $user->profile_picture ?></td>
                    <td><?= $user->phone_number ?></td>
                    <td><?= $user->email_verified ?></td>
                    <td><?= $user->phone_number_verified ?></td>
                    <td><?= $user->created_at ?></td>
                    <td><?= $user->updated_at ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>