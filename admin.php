<?php
require_once __DIR__ . '/config/database.php';

$successMessage = '';
$errorMessage = '';
$reservations = [];

$connection = getDatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $reservationId = $_POST['reservation_id'] ?? '';

    if ($action === 'update_status') {
        $newStatus = $_POST['status'] ?? '';

        // TODO 1: Validasi reservation_id dan status.
        // Status yang diizinkan: pending, confirmed, cancelled.

        // TODO 2: Buat query UPDATE untuk mengubah status berdasarkan id.
        // Contoh:
        // UPDATE reservations SET status = '$newStatus' WHERE id = $reservationId

        // TODO 3: Jalankan query dan tampilkan success/error message.

        $errorMessage = 'TODO: Lengkapi logic update status di file admin.php.';
    }

    if ($action === 'delete') {
        // TODO 1: Validasi reservation_id.

        // TODO 2: Buat query DELETE berdasarkan id.
        // Contoh:
        // DELETE FROM reservations WHERE id = $reservationId

        // TODO 3: Jalankan query dan tampilkan success/error message.

        $errorMessage = 'TODO: Lengkapi logic delete data di file admin.php.';
    }
}

// TODO 4: Ambil data reservation dari database menggunakan SELECT.
// Contoh:
// SELECT * FROM reservations ORDER BY booking_date ASC, booking_time ASC

// TODO 5: Simpan hasil query ke variable $reservations dalam bentuk array.

// Data dummy sementara agar tampilan admin bisa dilihat sebelum logic SELECT dibuat.
// Hapus bagian ini setelah SELECT dari database selesai dibuat.
if (!$reservations) {
    $reservations = [
        [
            'id' => 1,
            'customer_name' => 'Sample Customer',
            'phone' => '08123456789',
            'booking_date' => date('Y-m-d'),
            'booking_time' => '19:00:00',
            'guests' => 4,
            'table_area' => 'Window Seat',
            'special_request' => 'This is sample data. Replace with SELECT result.',
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s'),
        ],
    ];
}

function statusBadgeClass(string $status): string
{
    return match ($status) {
        'confirmed' => 'text-bg-success',
        'cancelled' => 'text-bg-danger',
        default => 'text-bg-warning',
    };
}

function formatDateDisplay(string $date): string
{
    return date('d M Y', strtotime($date));
}

function formatTimeDisplay(string $time): string
{
    return date('H:i', strtotime($time));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Desk - FlexFood</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="admin-body">
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top">
        <div class="container-fluid px-lg-4 py-2">
            <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
                <img src="assets/images/logo.png" alt="FlexFood Logo" class="app-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    <li class="nav-item"><a class="nav-link" href="index.php"><i class="bi bi-house-door me-1"></i>Customer Page</a></li>
                    <li class="nav-item"><a class="btn btn-primary rounded-pill px-4" href="admin.php"><i class="bi bi-arrow-clockwise me-1"></i>Refresh Desk</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container-fluid px-lg-4 py-4">
        <div class="row g-4 mb-4">
            <div class="col-lg-8">
                <div class="admin-hero card border-0 shadow-sm">
                    <div class="card-body p-4 p-lg-5">
                        <span class="section-kicker">Reservation Desk</span>
                        <h1 class="fw-bold mb-2">Manage incoming table requests.</h1>
                        <p class="text-secondary mb-0">Review reservations, confirm available tables, cancel invalid requests, or remove old data.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h2 class="h5 fw-bold mb-3"><i class="bi bi-info-circle text-primary me-2"></i>Admin Flow</h2>
                        <ol class="text-secondary mb-0 ps-3 small lh-lg">
                            <li>Read reservation request.</li>
                            <li>Check date, time, and area.</li>
                            <li>Confirm or cancel status.</li>
                            <li>Delete data only when needed.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($successMessage): ?>
            <div class="alert alert-success rounded-4"><i class="bi bi-check-circle me-2"></i><?= $successMessage; ?></div>
        <?php endif; ?>

        <?php if ($errorMessage): ?>
            <div class="alert alert-danger rounded-4"><i class="bi bi-exclamation-triangle me-2"></i><?= $errorMessage; ?></div>
        <?php endif; ?>

        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="stat-card card border-0 shadow-sm">
                    <div class="card-body p-4 d-flex align-items-center gap-3">
                        <span class="stat-icon bg-warning-subtle text-warning"><i class="bi bi-hourglass-split"></i></span>
                        <div>
                            <div class="text-secondary small">Pending</div>
                            <div class="h3 fw-bold mb-0">
                                <?= count(array_filter($reservations, fn($item) => $item['status'] === 'pending')); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card card border-0 shadow-sm">
                    <div class="card-body p-4 d-flex align-items-center gap-3">
                        <span class="stat-icon bg-success-subtle text-success"><i class="bi bi-check2-circle"></i></span>
                        <div>
                            <div class="text-secondary small">Confirmed</div>
                            <div class="h3 fw-bold mb-0">
                                <?= count(array_filter($reservations, fn($item) => $item['status'] === 'confirmed')); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card card border-0 shadow-sm">
                    <div class="card-body p-4 d-flex align-items-center gap-3">
                        <span class="stat-icon bg-danger-subtle text-danger"><i class="bi bi-x-circle"></i></span>
                        <div>
                            <div class="text-secondary small">Cancelled</div>
                            <div class="h3 fw-bold mb-0">
                                <?= count(array_filter($reservations, fn($item) => $item['status'] === 'cancelled')); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 p-4 d-flex flex-wrap justify-content-between align-items-center gap-2">
                <div>
                    <h2 class="h5 fw-bold mb-1">Reservation List</h2>
                    <p class="text-secondary small mb-0">Data shown here should come from the reservations table.</p>
                </div>
                <span class="badge rounded-pill text-bg-light border px-3 py-2"><i class="bi bi-database me-1"></i>reservations</span>
            </div>
            <div class="table-responsive">
                <table class="table align-middle table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Guest</th>
                            <th>Date & Time</th>
                            <th>Party</th>
                            <th>Area</th>
                            <th>Status</th>
                            <th>Notes</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservations as $reservation): ?>
                            <tr>
                                <td>
                                    <div class="fw-bold"><?= htmlspecialchars($reservation['customer_name']); ?></div>
                                    <div class="text-secondary small"><i class="bi bi-telephone me-1"></i><?= htmlspecialchars($reservation['phone']); ?></div>
                                </td>
                                <td>
                                    <div class="fw-semibold"><?= formatDateDisplay($reservation['booking_date']); ?></div>
                                    <div class="text-secondary small"><i class="bi bi-clock me-1"></i><?= formatTimeDisplay($reservation['booking_time']); ?></div>
                                </td>
                                <td><?= (int) $reservation['guests']; ?> Guests</td>
                                <td><span class="badge rounded-pill text-bg-light border"><?= htmlspecialchars($reservation['table_area']); ?></span></td>
                                <td><span class="badge rounded-pill <?= statusBadgeClass($reservation['status']); ?>"><?= ucfirst($reservation['status']); ?></span></td>
                                <td class="text-secondary small note-cell"><?= htmlspecialchars($reservation['special_request'] ?: '-'); ?></td>
                                <td>
                                    <div class="d-flex justify-content-end gap-2 flex-wrap">
                                        <form action="admin.php" method="POST" class="d-inline">
                                            <input type="hidden" name="action" value="update_status">
                                            <input type="hidden" name="reservation_id" value="<?= (int) $reservation['id']; ?>">
                                            <input type="hidden" name="status" value="confirmed">
                                            <button type="submit" class="btn btn-sm btn-success rounded-pill"><i class="bi bi-check2"></i></button>
                                        </form>
                                        <form action="admin.php" method="POST" class="d-inline">
                                            <input type="hidden" name="action" value="update_status">
                                            <input type="hidden" name="reservation_id" value="<?= (int) $reservation['id']; ?>">
                                            <input type="hidden" name="status" value="cancelled">
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill"><i class="bi bi-x-lg"></i></button>
                                        </form>
                                        <form action="admin.php" method="POST" class="d-inline delete-form">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="reservation_id" value="<?= (int) $reservation['id']; ?>">
                                            <button type="submit" class="btn btn-sm btn-light border rounded-pill"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
