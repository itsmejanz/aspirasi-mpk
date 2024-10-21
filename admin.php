<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'pesan_anonymous';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menghapus pesan
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $deleteSql = "DELETE FROM pesan WHERE id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header('Location: admin.php?status=deleted');
    exit;
}

$sql = "SELECT * FROM pesan ORDER BY tanggal DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin MPK</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
</headASPIRAÇI>
<body class="container mt-5">
    <h1>ASPIRAÇI</h1>
    
    <script>
    // Show success alert if message is deleted
    <?php if (isset($_GET['status']) && $_GET['status'] === 'deleted'): ?>
        swal("Sukses!", "Pesan berhasil dihapus!", "success");
    <?php endif; ?>

    // Handle delete confirmation with SweetAlert
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const id = this.getAttribute('data-id');

                swal({
                    title: "Apakah Anda yakin?",
                    text: "Anda tidak dapat mengembalikan pesan ini setelah dihapus!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = 'admin.php?delete=' + id;
                    }
                });
            });
        });
    });
</script>

    
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Pesan</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['nama']); ?></td>
                <td><?php echo htmlspecialchars($row['pesan']); ?></td>
                <td><?php echo $row['tanggal']; ?></td>
                <td>
                    <a href="admin.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pesan ini?');">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</body>
</html>

<?php
$conn->close();
?>
