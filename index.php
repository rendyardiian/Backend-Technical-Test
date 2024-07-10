<?php
session_start();
//Koneksi ke database
$koneksi = new mysqli("localhost","root","","tokoonline");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Toko Online</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>



<!-- navbar -->
<nav class="navbar navbar-default">
	<div class="container">

	<ul class="nav navbar-nav">
		<li><a href="index.php">Home</a></li>
		<li><a href="checkout.php">Checkout</a></li>
		<li><a href="keranjang.php">Keranjang</a></li>
		<!-- jk sdh login(ada session customer) -->
		<?php if (isset($_SESSION["customer"])): ?>
			<li><a href="logout.php">Logout</a></li>
		<!-- selain itu blm login atau blm ada session customer -->
		<?php else: ?>
			<li><a href="login.php">Login</a></li>
			<li><a href="">Daftar</a></li>
		<?php endif ?>
		
		<form action="pencarian.php" method="get" class="navbar-form navbar-right">
		<input type="text" class="form-control" name="keyword">
		<button class="btn btn-primary">Cari</button>
		</form> 
	</ul>
	</div>
</nav>


<!-- konten -->
<section class="konten">
	<div class="container">
		<h1>Produk Terbaru</h1>

		<div class="row">

			<?php $ambil = $koneksi->query("SELECT * FROM product"); ?>
			<?php while($perproduk = $ambil->fetch_assoc()){ ?>
			
			<div class="col-md-3">
				<div class="thumbnail">
					<img src="foto_produk/<?php echo $perproduk['foto_product']; ?>" width="160" alt="">
					<div class="caption">
						<h4><?php echo $perproduk['nama_product']; ?></h4>
						<h5><?php echo number_format($perproduk['harga_product']); ?></h5>
						<a href="beli.php?id=<?php echo $perproduk['id_product']; ?>" class="btn btn-primary">+ Keranjang</a>
						<a href="lihat.php?id=<?php echo $perproduk['id_product']; ?>" class="btn btn-primary">Detail</a>
					</div>
				</div>
			</div>
			<?php } ?>


		</div>
	</div>	
</section>

</body>
</html>