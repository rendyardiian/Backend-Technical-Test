<?php
session_start();
$koneksi = new mysqli("localhost","root","","tokoonline");
?>
<!DOCTYPE html>
<html>
<head>
    <title>daftar</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
<?php include 'menu.php'; ?>
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2"> <div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Daftar Pelanggan</h3>
</div>
<div class="panel-body">
<form method="post" class="form-horizontal">
<div class="form-group">
<label class="control-label col-md-3">Nama</label>
[ <div class="col-md-7">
<input type="text" class="form-control" name="nama">
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>