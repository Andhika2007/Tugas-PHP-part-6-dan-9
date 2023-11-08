<!DOCTYPE html>
<html>
<head>
    <title>Penjualan Produk Sekolah</title>
    <style>
        img {
            width: 200px;
            height: 300px;
        }
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #333;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #3498db;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .total {
            background-color: #3498db;
            color: #fff;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php
    $salam = "Selamat datang di toko";
    $nama = "Jajang Surajang";
    $barang = array("Pulpen", "Pensil", "Penghapus", "Penggaris", "Kortep", "Label");
    $pulpen = 8000;
    $pensil = 4000;
    $peng = 3000;
    $garis = 6000;
    $kortep = 12000;
    $label = 10000;
    $diskon = 2000;
    ?>
    <h1>Penjualan Produk</h1>

    <form method="post">
        <table width="80%">
            <tr>
                <td colspan="7"><?php echo "{$salam} {$nama}" ?></td>
            </tr>
            <tr>
                <th>Produk</th>
                <th>Gambar</th>
                <th>Harga</th>
                <th>Diskon</th>
                <th>Jumlah Beli</th>
            </tr>
            <tr>
                <td><?php echo $barang[0] ?></td>
                <td><img src="4/download.jpg" alt="Produk B"></td>
                <td><?php echo $pulpen ?></td>
                <td><?php echo $diskon ?></td>
                <td><input type="number" name="pulpenQty" value="0"></td>
            </tr>
            <tr>
                <td><?php echo $barang[1] ?></td>
                <td><img src="4/images.jpg" alt="Produk B"></td>
                <td><?php echo $pensil ?></td>
                <td><?php echo $diskon ?></td>
                <td><input type="number" name="pensilQty" value="0"></td>
            </tr>
            <tr>
                <td><?php echo $barang[2] ?></td>
                <td><img src="4/download (1).jpg" alt="Produk B"></td>
                <td><?php echo $peng ?></td>
                <td><?php echo $diskon ?></td>
                <td><input type="number" name="pengQty" value="0"></td>
            </tr>
            <tr>
                <td><?php echo $barang[3] ?></td>
                <td><img src="4/download (2).jpg" alt="Produk B"></td>
                <td><?php echo $garis ?></td>
                <td><?php echo $diskon ?></td>
                <td><input type="number" name="garisQty" value="0"></td>
            </tr>
            <tr>
                <td><?php echo $barang[4] ?></td>
                <td><img src="4/download (3).jpg" alt="Produk B"></td>
                <td><?php echo $kortep ?></td>
                <td><?php echo $diskon ?></td>
                <td><input type="number" name="kortepQty" value="0"></td>
            </tr>
            <tr>
                <td><?php echo $barang[5] ?></td>
                <td><img src="4/download (4).jpg" alt="Produk B"></td>
                <td><?php echo $label ?></td>
                <td><?php echo $diskon ?></td>
                <td><input type="number" name="labelQty" value="0"></td>
            </tr>
            <tr>
                <td>Masukkan Jumlah Uang yang Dibayar: <input type="number" name="uangSibayar"></td>
                <td colspan="6"><input type="submit" name="submit" value="Submit"></td>
            </tr>
            <?php
            if (isset($_POST['submit'])) {
                $total = 0;

                $pulpenQty = isset($_POST['pulpenQty']) ? (int)$_POST['pulpenQty'] : 0;
                $pensilQty = isset($_POST['pensilQty']) ? (int)$_POST['pensilQty'] : 0;
                $pengQty = isset($_POST['pengQty']) ? (int)$_POST['pengQty'] : 0;
                $garisQty = isset($_POST['garisQty']) ? (int)$_POST['garisQty'] : 0;
                $kortepQty = isset($_POST['kortepQty']) ? (int)$_POST['kortepQty'] : 0;
                $labelQty = isset($_POST['labelQty']) ? (int)$_POST['labelQty'] : 0;

                $total += $pulpenQty * ($pulpen - $diskon);
                $total += $pensilQty * ($pensil - $diskon);
                $total += $pengQty * ($peng - $diskon);
                $total += $garisQty * ($garis - $diskon);
                $total += $kortepQty * ($kortep - $diskon);
                $total += $labelQty * ($label - $diskon);

                $uangSibayar = isset($_POST['uangSibayar']) ? (int)$_POST['uangSibayar'] : 0;

                if ($uangSibayar < $total) {
                    echo "<tr><td colspan='7'>Jumlah uang yang dibayar kurang dari total harga.</td></tr>";
                } else {
                    echo "<tr><td colspan='7'>Barang yang dibeli:</td></tr>";
                    if ($pulpenQty > 0) {
                        echo "<tr><td colspan='7'>$pulpenQty Pulpen</td></tr>";
                    }
                    if ($pensilQty > 0) {
                        echo "<tr><td colspan='7'>$pensilQty Pensil</td></tr>";
                    }
                    if ($pengQty > 0) {
                        echo "<tr><td colspan='7'>$pengQty Penghapus</td></tr>";
                    }
                    if ($garisQty > 0) {
                        echo "<tr><td colspan='7'>$garisQty Penggaris</td></tr>";
                    }
                    if ($kortepQty > 0) {
                        echo "<tr><td colspan='7'>$kortepQty Kortep</td></tr>";
                    }
                    if ($labelQty > 0) {
                        echo "<tr><td colspan='7'>$labelQty Label</td></tr>";
                    }

                    echo "<tr><td colspan='7'>Total Harga: Rp " . $total . "</td></tr>";
                    echo "<tr><td colspan='7'>Uang Dibayar: Rp " . $uangSibayar . "</td></tr>";

                    $kembali = $uangSibayar - $total;
                    echo "<tr><td colspan='7'>Kembali: Rp " . $kembali . "</td></tr>";
                }
            }
            ?>
        </table>
    </form>
</body>
</html>
