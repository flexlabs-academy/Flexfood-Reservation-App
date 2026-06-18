<?php
require_once __DIR__ . '/config/database.php';

$successMessage = '';
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connection = getDatabaseConnection();

    // TODO 1: Ambil data dari form menggunakan $_POST.
    // Field yang dibutuhkan:
    // customer_name, phone, booking_date, booking_time, guests, table_area, special_request

    // TODO 2: Rapikan input menggunakan trim() dan escapeInput().

    // TODO 3: Buat validasi sederhana.
    // Contoh rule:
    // - nama wajib diisi
    // - phone wajib diisi
    // - tanggal wajib diisi
    // - jam wajib diisi
    // - guests wajib dipilih
    // - seating area wajib dipilih

    // TODO 4: Jika validasi lolos, buat query INSERT ke table reservations.
    // Status awal otomatis pending.

    // TODO 5: Jalankan query menggunakan mysqli_query().
    // Jika berhasil, tampilkan success message.
    // Jika gagal, tampilkan error message.

    $errorMessage = 'TODO: Lengkapi logic insert data reservasi di file index.php.';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlexFood Reservation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top">
        <div class="container py-2">
            <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
                <img src="assets/images/logo.png" alt="FlexFood Logo" class="app-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tables">Tables</a></li>
                    <li class="nav-item"><a class="nav-link" href="#booking">Booking</a></li>
                    <li class="nav-item ms-lg-2"><a class="btn btn-outline-primary rounded-pill px-4" href="admin.php"><i class="bi bi-speedometer2 me-1"></i> Admin</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section" id="home">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="badge rounded-pill text-bg-light border px-3 py-2 mb-3"><i class="bi bi-stars text-warning me-1"></i> Modern Table Reservation</span>
                    <h1 class="display-4 fw-bold mb-3">Reserve your favorite table with a smooth dining flow.</h1>
                    <p class="lead text-secondary mb-4">Choose your seating area, send your reservation request, and let the reservation desk confirm your table.</p>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <a href="#booking" class="btn btn-primary btn-lg rounded-pill px-4"><i class="bi bi-calendar-check me-2"></i>Reserve Now</a>
                        <a href="#tables" class="btn btn-light btn-lg rounded-pill px-4 border"><i class="bi bi-grid-1x2 me-2"></i>View Tables</a>
                    </div>
                    <div class="row g-3">
                        <div class="col-6 col-md-4">
                            <div class="mini-stat bg-white shadow-sm">
                                <i class="bi bi-shop text-primary"></i>
                                <strong>4</strong>
                                <span>Seating Areas</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="mini-stat bg-white shadow-sm">
                                <i class="bi bi-clock text-primary"></i>
                                <strong>10 AM</strong>
                                <span>Open Daily</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="mini-stat bg-white shadow-sm">
                                <i class="bi bi-heart text-primary"></i>
                                <strong>4.9</strong>
                                <span>Guest Rating</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-card shadow-lg">
                        <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1200&q=80" class="img-fluid hero-img" alt="Restaurant interior">
                        <div class="p-4 bg-white">
                            <div class="d-flex align-items-center justify-content-between gap-3 mb-2">
                                <h2 class="h4 fw-bold mb-0">FlexFood Bistro</h2>
                                <span class="badge text-bg-warning rounded-pill">Popular</span>
                            </div>
                            <p class="text-secondary mb-0">A warm place for family dinner, business lunch, and weekend celebration.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="py-5" id="tables">
        <div class="container">
            <div class="text-center mb-4">
                <span class="section-kicker">Choose Area</span>
                <h2 class="fw-bold">Find the right table for your occasion</h2>
                <p class="text-secondary mb-0">Select one area and it will automatically fill the booking form.</p>
            </div>
            <div class="row g-4">
                <?php
                $tables = [
                    ['name' => 'Window Seat', 'capacity' => '2-4 Pax', 'icon' => 'bi-window', 'desc' => 'Cozy table for quiet dinner and city view.'],
                    ['name' => 'Outdoor Garden', 'capacity' => '2-6 Pax', 'icon' => 'bi-flower1', 'desc' => 'Fresh outdoor atmosphere with warm evening lights.'],
                    ['name' => 'Center Hall', 'capacity' => '4-8 Pax', 'icon' => 'bi-grid-3x3-gap', 'desc' => 'Comfortable space for small groups and family meals.'],
                    ['name' => 'VIP Room', 'capacity' => '6-10 Pax', 'icon' => 'bi-door-closed', 'desc' => 'Private area for birthdays and business dinners.'],
                ];
                foreach ($tables as $table):
                ?>
                    <div class="col-md-6 col-xl-3">
                        <div class="card table-card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="table-icon mb-3"><i class="bi <?= $table['icon']; ?>"></i></div>
                                <div class="d-flex align-items-start justify-content-between gap-2 mb-2">
                                    <h3 class="h5 fw-bold mb-0"><?= $table['name']; ?></h3>
                                    <span class="badge rounded-pill text-bg-light border"><?= $table['capacity']; ?></span>
                                </div>
                                <p class="text-secondary small mb-4"><?= $table['desc']; ?></p>
                                <button type="button" class="btn btn-outline-primary w-100 rounded-pill choose-table-btn" data-table="<?= $table['name']; ?>">
                                    <i class="bi bi-check2-circle me-1"></i>Select Area
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="py-5 booking-section" id="booking">
        <div class="container">
            <div class="row g-4 align-items-start">
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm sticky-lg-top booking-info-card">
                        <div class="card-body p-4 p-lg-5">
                            <span class="section-kicker">Reservation Flow</span>
                            <h2 class="fw-bold mb-3">Send a request, then wait for confirmation.</h2>
                            <p class="text-secondary">Your reservation will enter the desk queue with pending status. The admin can confirm or cancel the request later.</p>
                            <div class="flow-list mt-4">
                                <div class="flow-item"><span>1</span><div><strong>Fill form</strong><p>Customer submits reservation details.</p></div></div>
                                <div class="flow-item"><span>2</span><div><strong>Save request</strong><p>System stores data into database.</p></div></div>
                                <div class="flow-item"><span>3</span><div><strong>Admin review</strong><p>Reservation desk checks and updates status.</p></div></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 p-lg-5">
                            <div class="d-flex flex-wrap align-items-start justify-content-between gap-2 mb-4">
                                <div>
                                    <span class="section-kicker">Booking Form</span>
                                    <h2 class="fw-bold mb-0">Reserve Your Table</h2>
                                </div>
                                <span class="badge rounded-pill text-bg-warning px-3 py-2"><i class="bi bi-hourglass-split me-1"></i>Pending Review</span>
                            </div>

                            <?php if ($successMessage): ?>
                                <div class="alert alert-success rounded-4"><i class="bi bi-check-circle me-2"></i><?= $successMessage; ?></div>
                            <?php endif; ?>

                            <?php if ($errorMessage): ?>
                                <div class="alert alert-danger rounded-4"><i class="bi bi-exclamation-triangle me-2"></i><?= $errorMessage; ?></div>
                            <?php endif; ?>

                            <form action="index.php#booking" method="POST" class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Guest Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input type="text" name="customer_name" class="form-control" placeholder="Your name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                        <input type="text" name="phone" class="form-control" placeholder="08xxxxxxxxxx">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Reservation Date</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                                        <input type="date" name="booking_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Reservation Time</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-clock"></i></span>
                                        <input type="time" name="booking_time" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Party Size</label>
                                    <select name="guests" class="form-select">
                                        <option value="">Select party size</option>
                                        <option value="2">2 Guests</option>
                                        <option value="4">4 Guests</option>
                                        <option value="6">6 Guests</option>
                                        <option value="8">8 Guests</option>
                                        <option value="10">10 Guests</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Seating Area</label>
                                    <select name="table_area" id="tableAreaSelect" class="form-select">
                                        <option value="">Select seating area</option>
                                        <option value="Window Seat">Window Seat</option>
                                        <option value="Outdoor Garden">Outdoor Garden</option>
                                        <option value="Center Hall">Center Hall</option>
                                        <option value="VIP Room">VIP Room</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Special Notes</label>
                                    <textarea name="special_request" class="form-control" rows="4" placeholder="Birthday setup, allergy notes, quiet corner, etc."></textarea>
                                </div>
                                <div class="col-12 d-flex flex-wrap gap-2 pt-2">
                                    <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="bi bi-send me-2"></i>Send Reservation</button>
                                    <button type="reset" class="btn btn-light border rounded-pill px-4"><i class="bi bi-arrow-counterclockwise me-2"></i>Reset</button>
                                    <a href="admin.php" class="btn btn-warning rounded-pill px-4"><i class="bi bi-speedometer2 me-2"></i>Open Admin</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-4 bg-white border-top">
        <div class="container text-center text-secondary small">
            FlexFood Reservation Starter • Customer Form → Database → Admin Desk
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
