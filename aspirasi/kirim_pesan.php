<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $pesan = $_POST['pesan'];

    // Assume you have already set up your database connection
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = 'pesan_anonymous';

    $conn = new mysqli($host, $user, $password, $dbname);
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }


    // Insert the message into the database
    $stmt = $conn->prepare("INSERT INTO pesan (nama, pesan) VALUES (?, ?)");
    $stmt->bind_param("ss", $nama, $pesan);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    // Redirect back to the form with a success status
    header('Location: index.php?status=success');
    exit;
}
?>
