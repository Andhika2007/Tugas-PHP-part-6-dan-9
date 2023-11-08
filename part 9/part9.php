<!DOCTYPE html>
<html>
<head>
    <title>Penyewaan Ruang Karaoke</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            border-collapse: collapse;
            width: 80%;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: red;
            color: #fff;
        }
    </style>
</head>
<body>
    <h1>Sewa Ruang Karaoke</h1>
    <h2>Daftar Ruang Karaoke</h2>
    <table>
        <tr>
            <th>Nama Ruang</th>
            <th>Harga per Jam</th>
            <th>Kapasitas</th>
            <th>Pesan</th>
            <th>Data Pemesanan</th>
        </tr>
        <?php
        // Koneksi ke database
        $mysqli = new mysqli("localhost", "root", "", "karaoke");

        // Periksa koneksi
        if ($mysqli->connect_error) {
            die("Koneksi ke database gagal: " . $mysqli->connect_error);
        }

        // Ambil data ruang karaoke dari database
        $query = "SELECT * FROM karaoke_rooms";
        $result = $mysqli->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["room_name"] . "</td>";
                echo "<td>Rp " . $row["price"] . "</td>";
                echo "<td>" . $row["capacity"] . " orang</td>";
                echo "<td><a href='part92.php?id=" . $row["id"] . "'>Pesan</a></td>";

                // Ambil data pemesanan yang sesuai dengan ruang saat ini
                $booking_query = "SELECT * FROM booking WHERE room_id = " . $row["id"];
                $booking_result = $mysqli->query($booking_query);

                echo "<td>";
                if ($booking_result->num_rows > 0) {
                    while ($booking_row = $booking_result->fetch_assoc()) {
                        echo "Nama Pemesan: " . $booking_row["nama"] . "<br>";
                        echo "Jam Mulai: " . $booking_row["jam_mulai"] . "<br>";
                        echo "Jam Selesai: " . $booking_row["jam_selesai"] . "<br><br>";
                    }
                } else {
                    echo "Tidak ada pemesanan";
                }
                echo "</td>";

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Tidak ada ruang karaoke yang tersedia.</td></tr>";
        }

        // Tutup koneksi database
        $mysqli->close();
        ?>
    </table>
</body>
</html>
