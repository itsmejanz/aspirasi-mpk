<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pesan Anonim</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
</head>
<body class="container mt-5">
 <h1 style="color: #878249;">ASPIRAÇI</h1>
    <form action="kirim_pesan.php" method="post">
        <div class="form-group">
            <label for="nama">Nama (Opsional):</label>
            <input type="text" id="nama" name="nama" class="form-control">
        </div>
        <div class="form-group">
            <label for="pesan">Pesan:</label>
            <textarea id="pesan" name="pesan" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Pesan</button>
    </form>

    <script>
        // Show success alert if message was sent successfully
        <?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
            swal("Terimakasih!", "Aspirasi Anda telah kami terima", "success");
        <?php endif; ?>
    </script>
</body>
</html>
