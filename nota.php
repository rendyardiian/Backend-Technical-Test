<?php $koneksi = new mysqli("localhost","root","","tokoonline"); ?>
<<!DOCTYPE html>
<html>
<head>
	<title>Nota Pembelian</title>
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
		
<!-- nota disini copas dari nota admin -->

<h2>Detail Purchasing</h2>
<?php
	$ambil = $koneksi->query("SELECT * FROM purchasing JOIN customer ON purchasing.id_customer=customer.id_customer WHERE purchasing.id_purchasing='$_GET[id]'");
	$detail = $ambil->fetch_assoc();
?>


	<strong><?php echo $detail['nama_customer']; ?></strong> <br>
<p>
	<?php echo $detail['telephone_customer']; ?> <br>
	<?php echo $detail['email_customer']; ?>
</p>

<p>
	Tanggal: <?php echo $detail['tanggal_purchasing']; ?> <br>
	Total: <?php echo $detail['total_purchasing']; ?>
</p>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Produk</th>
			<th>Harga</th>
			<th>Berat</th>
			<th>Subberat</th>
			<th>Subtotal</th>
			<th>Subharga</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM purchasing_product WHERE id_purchasing ='$_GET[id]'"); ?>
		<?php while($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama']; ?></td>
			<td><?php echo $pecah['harga']; ?></td>
			<td><?php echo $pecah['berat']; ?></td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<td><?php echo $pecah['subberat']; ?></td>
			<td><?php echo $pecah['subharga']; ?></td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>

<div class="row">
	<div class="col-md-7">
		<div class="alert alert-info">
			<p>
				Silahkan melakukan pembayaran Rp. <?php echo number_format($detail['total_purchasing']); ?> ke <br>
				<strong>BANK MANDIRI 137-001088-3276 AN. RENDY ARDIAN</strong>
			</p>
		</div>
	</div>
	
</div>



	</div>
</section>

</body>
</html>