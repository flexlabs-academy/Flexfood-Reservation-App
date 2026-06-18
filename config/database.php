<?php
/**
 * FlexFood Reservation - Database Starter
 * -------------------------------------------------
 * File ini sengaja dibuat sebagai starter untuk live coding.
 * Lengkapi bagian TODO saat sesi praktik.
 */

$databaseHost = 'localhost';
$databaseUser = 'root';
$databasePassword = '';
$databaseName = 'flexfood_reservation';

function getDatabaseConnection(): ?mysqli
{
    global $databaseHost, $databaseUser, $databasePassword, $databaseName;

    // TODO 1: Buat koneksi ke database menggunakan mysqli_connect.
    // Contoh:
    // $connection = mysqli_connect($databaseHost, $databaseUser, $databasePassword, $databaseName);

    // TODO 2: Cek apakah koneksi gagal.
    // Jika gagal, return null.

    // TODO 3: Set charset ke utf8mb4.
    // mysqli_set_charset($connection, 'utf8mb4');

    // TODO 4: Return koneksi database.

    return null;
}

function escapeInput(?mysqli $connection, string $value): string
{
    if (!$connection) {
        return trim($value);
    }

    return mysqli_real_escape_string($connection, trim($value));
}
