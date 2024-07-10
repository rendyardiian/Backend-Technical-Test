<?php
session_start();


echo "<pre>";
print_r($_SESSION['keranjang']);
echo "</pre>";

$koneksi = new mysqli("localhost","root","","tokoonline");


if(empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang']))
{
	echo "<script>alert('keranjang kosong, silahkan belanja terlebih dahulu');</script>";
	echo "<script>location='index.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Keranjang Belanja</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

<!-- navbar -->
<nav class="navbar navbar-default">
	<div class="container">

	<ul class="nav navbar-nav">
		<li><a href="index.php">Home</a></li>
		<li><a href="keranjang.php">Keranjang</a></li>
		<!-- jk sdh login(ada session customer) -->
		<?php if (isset($_SESSION["customer"])): ?>
			<li><a href="logout.php">Logout</a></li>
		<!-- selain itu blm login atau blm ada session customer -->
		<?php else: ?>
			<li><a href="login.php">Login</a></li>
		<?php endif ?>
		
		<li><a href="checkout.php">Checkout</a></li>
	</ul>
	</div>
</nav>


<section class="konten">
	<div class="container">
		<h1>Keranjang Belanja</h1>
		<hr>
		<table class="table table-bordered ">
			<thead>
				<tr>
					<th>No</th>
					<th>Produk</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th>Subharga</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $nomor=1; ?>
				<?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): ?>
				<!-- menampilkan produk yg sedang diperulangkan berdasarkan id_produk -->
				<?php
				$ambil = $koneksi->query("SELECT * FROM product WHERE id_product='$id_produk'");
				$pecah = $ambil->fetch_assoc();
				$subharga = $pecah["harga_product"]*$jumlah;

				?>
				<tr>
					<td><?php echo $nomor; ?></td>
					<td><?php echo $pecah['nama_product']; ?></td>
					<td>Rp. <?php echo number_format($pecah["harga_product"]); ?></td>
					<td><?php echo $jumlah; ?></td>
					<td>Rp. <?php echo number_format($subharga); ?></td>
					<td>
						<a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-xs">Hapus</a>
					</td>
				</tr>
				<?php $nomor++; ?>
				<?php endforeach ?>
			</tbody>
		</table>


		<a href="index.php" class="btn btn-default">Lanjutkan Belanja</a>
		<a href="checkout.php" class="btn btn-primary">Checkout</a>
	</div>
</section>



</body>
</html>