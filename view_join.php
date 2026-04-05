<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>View & Join</title>
</head>
<body>

<h1>VIEW & JOIN</h1>

<h2>INNER JOIN</h2>

<table border="1" cellpadding="10">
<tr>
    <th>Nama Anggota</th>
    <th>Tanggal Pinjam</th>
</tr>

<?php
$inner = mysqli_query($conn, "
SELECT anggota.nama, peminjaman.tanggal
FROM peminjaman
INNER JOIN anggota 
ON peminjaman.id_anggota = anggota.id_anggota
");

while ($row = mysqli_fetch_assoc($inner)) {
?>
<tr>
    <td><?= $row['nama']; ?></td>
    <td><?= $row['tanggal']; ?></td>
</tr>
<?php } ?>
</table>


<hr>

<h2>LEFT JOIN</h2>

<table border="1" cellpadding="10">
<tr>
    <th>Nama Anggota</th>
    <th>Judul Buku</th>
</tr>

<?php
$left = mysqli_query($conn, "
SELECT anggota.nama, buku.judul
FROM anggota
LEFT JOIN peminjaman ON anggota.id_anggota = peminjaman.id_anggota
LEFT JOIN detail_pinjam ON peminjaman.id_pinjam = detail_pinjam.id_pinjam
LEFT JOIN buku ON detail_pinjam.id_buku = buku.id_buku
");

while ($row = mysqli_fetch_assoc($left)) {
?>
<tr>
    <td><?= $row['nama']; ?></td>
    <td><?= $row['judul'] ?? '-'; ?></td>
</tr>
<?php } ?>
</table>


<hr>

<h2>VIEW (Data dari View Database)</h2>

<table border="1" cellpadding="10">
<tr>
    <th>Nama Anggota</th>
    <th>Judul Buku</th>
    <th>Tanggal</th>
</tr>

<?php
$view = mysqli_query($conn, "SELECT * FROM view_peminjaman");

while ($row = mysqli_fetch_assoc($view)) {
?>
<tr>
    <td><?= $row['nama_anggota']; ?></td>
    <td><?= $row['judul']; ?></td>
    <td><?= $row['tanggal']; ?></td>
</tr>
<?php } ?>
</table>

</body>
</html>