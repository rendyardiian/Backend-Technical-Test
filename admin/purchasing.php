<h2>Purchasing Data</h2>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Pelanggan</th>
			<th>Tanggal</th>
			<th>Total</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<body>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM purchasing JOIN customer ON purchasing.id_customer=customer.id_customer"); ?>
		<?php while($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_customer']; ?></td>
			<td><?php echo $pecah['tanggal_purchasing']; ?></td>
			<td><?php echo $pecah['total_purchasing']; ?></td>
			<td>
				<a href="index.php?halaman=detail&id=<?php echo $pecah['id_purchasing']; ?>"class="btn btn-info">Detail</a>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</body>
</table>