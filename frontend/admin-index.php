<?php
session_start();

if (empty($_SESSION['is_admin'])) {
    header('Location: admin-login.php');
    exit;
}

require_once '../backend/conn.php';

$reservations = [];
$reservationError = '';
$result = $con->query(
    'SELECT name, reservation_date, reservation_time, guests
     FROM reservations
     ORDER BY reservation_date ASC, reservation_time ASC'
);

if ($result) {
    while ($reservation = $result->fetch_assoc()) {
        $reservations[] = $reservation;
    }
    $result->free();
} else {
    $reservationError = 'Unable to load reservations right now.';
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Café Bliss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <main class="container py-4 py-md-5">
        <section class="card shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                    <div>
                        <h1 class="h2 mb-1">Reservations</h1>
                        <p class="text-muted mb-0">All table reservations received by Café Bliss.</p>
                    </div>
                    <a class="btn btn-outline-secondary" href="admin-login.php">Back to Login</a>
                </div>

                <?php if ($reservationError !== ''): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlspecialchars($reservationError, ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                <?php elseif (count($reservations) === 0): ?>
                    <div class="alert alert-info mb-0" role="status">No reservations have been made yet.</div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Guests</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($reservations as $reservation): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($reservation['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($reservation['reservation_date'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($reservation['reservation_time'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars((string) $reservation['guests'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>
</body>

</html>