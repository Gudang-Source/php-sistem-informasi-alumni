<?php
ob_start();
session_start();
require_once 'dbconnect.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
// select logged in users detail
$res = $conn->query("SELECT * FROM users WHERE id=" . $_SESSION['user']);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

$mahasiswas = $conn->query("SELECT * FROM alumni");

?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Hello,<?php echo $userRow['email']; ?></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="assets/css/index.css" type="text/css"/>
</head>
<body>

    <!-- Navigation Bar-->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= $pathUrl ?>index.php">Sistem Informasi Alumni</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                </ul>
                <ul class="nav navbar-nav navbar-right">

                    <?php if ($userRow['admin'] == 1): ?>                    
                        <li><a href="<?= $pathUrl ?>mahasiswa_index.php">Dashboard</a></li>
                    <?php endif ?>
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">
                            <span
                                class="glyphicon glyphicon-user"></span>&nbsp;Logged
                            in: <?php echo $userRow['email']; ?>
                            &nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= $pathUrl ?>mahasiswa_show.php?nim=<?= $userRow['nim']; ?>"><span class="glyphicon glyphicon-user"></span>&nbsp;Profile</a></li>
                            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <br> 
    <div class="container">
        <div class="well">
            <a href="<?= $pathUrl ?>mahasiswa_index.php" class="btn btn-sm btn-primary">Mahasiswa</a> 
            <a href="<?= $pathUrl ?>lowongan_index.php" class="btn btn-sm btn-primary">Lowongan</a>
            <a href="<?= $pathUrl ?>alumni_index.php" class="btn btn-sm btn-primary">Alumni</a>
        </div>
        <h3>Data Alumni</h3>


        <a href="<?= $pathUrl ?>mahasiswa_create.php" class="btn btn-primary btn-sm pull-right">Tambah Mahasiswa</a>
        <br>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Program Studi</th>
                    <th>Jenjang Studi</th>
                    <th>Alamat Rumah</th>
                    <th>Agama</th>
                    <th>Handphone</th>
                    <th>Status</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($mahasiswa = $mahasiswas->fetch_assoc()): ?>
                    <tr>
                        <td><?= $mahasiswa['nim']; ?></td>
                        <td><?= $mahasiswa['username']; ?></td>
                        <td><?= $mahasiswa['email']; ?></td>
                        <td><?= $mahasiswa['program_studi']; ?></td>
                        <td><?= $mahasiswa['jenjang_studi']; ?></td>
                        <td><?= $mahasiswa['alamat_rumah']; ?></td>
                        <td><?= $mahasiswa['agama']; ?></td>
                        <td><?= $mahasiswa['handphone']; ?></td>
                        <td><?= $mahasiswa['status']; ?></td>
                        <td>
                            <a href="<?= $pathUrl ?>mahasiswa_edit.php?nim=<?= $mahasiswa['nim']; ?>" class="btn btn-xs btn-info">Edit</a> 
                            <a href="<?= $pathUrl ?>mahasiswa_delete.php?nim=<?= $mahasiswa['nim']; ?>" class="btn btn-xs btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>
    
    <br>

    <script src="assets/js/jquery-2.2.0.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

</body>
</html>
