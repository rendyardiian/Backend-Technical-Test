<?php
session_start();
$koneksi = new mysqli("localhost","root","","tokoonline");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Customer</title>
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
		
		<!-- <li><a href="checkout.php">Checkout</a></li> -->
	</ul>
	</div>
</nav>

<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-tittle">Login Customer</h3>
				</div>
				<div class="panel-body">
					<form method="post">
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="password">
						</div>
						<button class="btn btn-primary" name="login">Login</button>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>

<?php
// jk ada tombol login (tombol login ditekan)
if (isset($_POST["login"])) 
{
	$email = $_POST["email"];
	$password = $_POST["password"];
	// lakukan kuery ngecek akun di tabel pelanggan di db
	$ambil = $koneksi->query("SELECT * FROM customer WHERE email_customer='$email' AND password_customer='$password'");

	// ngitung akun yang terambil
	$akunyangcocok = $ambil->num_rows;

	// jika 1 akun yg cocok, mk diloginkan
	if ($akunyangcocok==1)
	{
		// anda sudah  login
		// mendapatkan akun dalam bentuk array
		$akun = $ambil->fetch_assoc();
		//simpan di session pelanggan
		$_SESSION["customer"] = $akun;
		echo "<script>alert('anda sukses login');</script>";
		echo "<script>location='index.php';</script>";
	}
	else
	{
		// anda gagal login
		echo "<script>alert('anda gagal login, periksa akun Anda');</script>";
		echo "<script>location='login.php';</script>";
	}
}

?>



</body>
</html>