<!DOCTYPE html>
<html>
<head>
    <title>Notifications</title>
</head>
<body>
    <h1>Notifications</h1>
    <table>
        <thead>
            <tr>
                <th>Notification ID</th>
                <th>Email</th>
                <th>Message</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($notifications as $notification): ?>
                <tr>
                    <td><?= $notification->notification_id ?></td>
                    <td><?= $notification->email ?></td>
                    <td><?= $notification->message ?></td>
                    <td><?= $notification->created_at ?></td>
                    <td><?= $notification->updated_at ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
