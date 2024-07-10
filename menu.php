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
		<?php endif ?>
		<li><a href="daftar.php">Daftar</a></li>
		<form action="pencarian.php" method="get" class="navbar-form navbar-right">
		<input type="text" class="form-control" name="keyword">
		<button class="btn btn-primary">Cari</button>
		</form>
	</ul>
	</div>
</nav>