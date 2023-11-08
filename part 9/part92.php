<?php
// Mulai sesi PHP

// Periksa apakah parameter "id" ada dalam URL dan valid
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    // Jika valid, definisikan variabel $room_id
    $room_id = $_GET["id"];
} else {
    // Jika tidak valid, tampilkan pesan kesalahan atau alihkan pengguna
    echo "Parameter ID tidak valid.";
    // Atau alihkan pengguna ke halaman kesalahan atau tampilkan pesan kesalahan yang sesuai.
    exit; // Keluar dari skrip PHP
}

// Lanjutkan dengan operasi lain yang membutuhkan $room_id
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Pemesanan Ruang Karaoke</title>
</head>
<body>
    <h1>Pesan Ruang Karaoke</h1>
    <?php

    // Koneksi ke database
    $mysqli = new mysqli("localhost", "root", "", "karaoke");

    // Periksa koneksi
    if ($mysqli->connect_error) {
        die("Koneksi ke database gagal: " . $mysqli->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        $nama = $_POST["nama"];
        $jam_mulai = $_POST["jam_mulai"];
        $jam_selesai = $_POST["jam_selesai"];

        if (!isset($room_id)) {
            echo "Variable \$room_id is not defined.";
            // Atau, alihkan pengguna ke halaman lain atau tampilkan pesan kesalahan yang sesuai.
            // Contoh: header("Location: halaman_error.php");
            exit; // Keluar dari skrip PHP
        }

        // Selipkan data pemesanan ke dalam database
        $query = "INSERT INTO booking (room_id, nama, jam_mulai, jam_selesai) VALUES ('$room_id', '$nama', '$jam_mulai', '$jam_selesai')";

        if ($mysqli->query($query) === TRUE) {
            echo "<p>Pemesanan berhasil.</p>";
        } else {
            echo "<p>Error: " . $query . "<br>" . $mysqli->error . "</p>";
        }
    }

    $pesan_berhasil = ""; // Inisialisasi pesan ke kosong
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        // ... (kode sebelumnya)

        if ($mysqli->query($query) === TRUE) {
            $pesan_berhasil = "Pemesanan berhasil.";
        } else {
            $pesan_error = "Error: " . $query . "<br>" . $mysqli->error;
        }
    }
    // Tutup koneksi database
    $mysqli->close();
    ?>

    <?php
    // Tampilkan formulir jika pesan belum berhasil
    if (empty($pesan_berhasil)) {
    ?>
<form method="post" action="part92.php?id=<?php echo $room_id; ?>">
        Nama Anda: <input type="text" name="nama" required><br>
        Jam Mulai: <input type="time" name="jam_mulai" required pattern="[0-9]{2}:[0-9]{2}"><br>
        Jam Selesai: <input type="time" name="jam_selesai" required pattern="[0-9]{2}:[0-9]{2}"><br> 
        <input type="submit" name="submit" value="Pesan">
    </form>
    <?php
    }

    // Menampilkan pesan pesanan berhasil atau pesan error
    if (isset($pesan_berhasil)) {
        echo "<p style='color: green;'>$pesan_berhasil</p>";
        echo $_POST["jam_selesai"];
    } elseif (isset($pesan_error)) {
        echo "<p style='color: red;'>$pesan_error</p>";
    }
    ?>
</body>
</html>
