<?php
session_start();
$koneksi = new mysqli("localhost","root","","tokoonline");


// jk tdk ada session pelanggan (blm login), mk dilarikan ke login.php
if (!isset($_SESSION["customer"])) 
{
	echo "<script>alert('silahkan login');</script>";
	echo "<script>location='login.php';</script>";	
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Checkout</title>
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
				</tr>
			</thead>
			<tbody>
				<?php $nomor=1; ?>
				<?php $totalbelanja = 0; ?>
				<!-- <?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): ?>
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
				</tr>
				<?php $nomor++; ?>
				<?php $totalbelanja+=$subharga; ?>
				<?php endforeach ?> 
			</tbody>
			<tfoot>
				<tr>
					<th colspan="4">Total Belanja</th>
					<th>Rp. <?php echo number_format($totalbelanja) ?></th>
				</tr>
			</tfoot>
		</table>
<form method="post">
	
	<div class="row">
		<div class="col-md-4"></div>
			<div class="form-group">
				<input type="text" readonly value="<?php echo $_SESSION
					['customer']['nama_customer'] ?>" class="form-control">
			</div>
		</div>
		<div class="col-md-4"></div>
			<div class="form-group">
				<input type="text" readonly value="<?php echo $_SESSION
					['customer']['telephone_customer'] ?>" class="form-control">
			</div>
		<div class="col-md-4"></div>
			<select class="form-control" name="id_ongkir">
				<option value="">Pilih Ongkos Kirim</option>
				<?php
				$ambil = $koneksi->query("SELECT * FROM ongkir");
				while($perongkir = $ambil->fetch_assoc()){
				?>
				<option value="<?php echo $perongkir['id_ongkir']?>">
					<?php echo $perongkir['nama_kota']?> -
					Rp. <?php echo number_format($perongkir['tarif'])?> -
				</option>
				<?php } ?>
			</select>
	</div>
</div>
<button class="btn btn-primary" name="checkout">Checkout</button>
</form>
	<?php 
	if (isset($_POST['checkout']))
	{
		$id_pelanggan = $_SESSION['customer']['id_customer'];
		$id_ongkir = $_POST["id_ongkir"];
		$tanggal_pembelian = date ("Y-m-d");

		$ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
		$arrayongkir = $ambil->fetch_assoc();
		$tarif = $arrayongkir['tarif'];

		$total_pembelian = $totalbelanja + $tarif;

		// 1. menyimpan data tabel ke tabel pembelian
		$koneksi->query("INSERT INTO purchasing (id_customer,id_ongkir,tanggal_purchasing,total_purchasing) VALUES ('$id_pelanggan', '$id_ongkir','$tanggal_pembelian','$total_pembelian')");

		// mendapatkan id_pembelian barusan terjadi
		$id_pembelian_barusan = $koneksi->insert_id;

		foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) 
		{

			// mendapatkan data produk berdasarkan id_produk
			$ambil=$koneksi->query("SELECT * FROM product WHERE id_product='$id_produk'");
			$perproduk = $ambil->fetch_assoc();

			$nama = $perproduk['nama_product'];
			$hargaproduk = $perproduk['harga_product'];
			$beratproduk = $perproduk['berat_product'];

			$subberat = $perproduk['berat_product']*$jumlah;
			$subharga = $perproduk['harga_product']*$jumlah;
			$koneksi->query("INSERT INTO purchasing_product (id_purchasing,id_product,nama,harga,berat,subberat,subharga,jumlah) VALUES ('$id_pembelian_barusan','$id_produk','$nama','$hargaproduk','$beratproduk','$subberat','$subharga','$jumlah')");
		}

		//mengkosongkan  kerancang belanja
		unset($_SESSION['keranjang']);

		// tampilan dialihkan ke halaman nota barusan
		echo "<script>alert('Pembelian Sukses');</script>";
		echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
	}
	?>

	</div>
</section>
<pre><?php print_r($_SESSION['customer']) ?></pre>
<!-- <pre><?php print_r($_SESSION['keranjang']) ?></pre> -->
</body>
</html>