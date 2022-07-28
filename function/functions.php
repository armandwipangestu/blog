<?php

date_default_timezone_set('Asia/Jakarta');

function koneksi()
{
	return mysqli_connect("127.0.0.1", "username", "password", "demo_blog");
}

function query($query)
{
	$conn = koneksi();

	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) == 1) {
		return mysqli_fetch_assoc($result);
	}

	$rows = [];

	while ($row = mysqli_num_rows($result)) {
		$rows[] = $row;
	}

	return $rows;
}

function login($data)
{
	$username = htmlspecialchars($data['username']);
	$password = htmlspecialchars($data['password']);

	if ($user = query("SELECT * FROM admin WHERE username = '$username'")) {
		if (password_verify($password, $user["password"])) {
			$id = $user['id'];
			$username = $user['username'];
			$_SESSION['login'] = true;
			$_SESSION['id'] = $id;
			$_SESSION['username'] = $username;
			header("Location: ../admin/index.php");
			exit;
		} else {
			return [
				'error' => true,
				'pesan' => 'Username / Password Salah'
			];
		}
	} else {
		return [
			'error' => true,
			'pesan' => 'Username / Password Salah'
		];
	}
}

function daftar($data)
{
	$conn = koneksi();
	$username = htmlspecialchars($data['username']);
	$password = mysqli_real_escape_string($conn, $data['password']);

	if (empty($username) || empty($password)) {
		return false;
	}

	if (query("SELECT * FROM admin WHERE username = '$username'")) {
		return false;
	}

	$password_baru = password_hash($password, PASSWORD_DEFAULT);

	$query = "INSERT INTO admin VALUES (NULL, '$username', '$password_baru')";

	mysqli_query($conn, $query) or die(mysqli_error($conn));
	return mysqli_affected_rows($conn);
}

function gambar($path, $gambar_lama)
{
	$nama_file = $_FILES["gambar"]["name"];
	$type_file = $_FILES["gambar"]["type"];
	$ukuran_file = $_FILES["gambar"]["size"];
	$error = $_FILES["gambar"]["error"];
	$tmp_file = $_FILES["gambar"]["tmp_name"];

	if ($error == 4) {
		if ($gambar_lama) {
			return $gambar_lama;
		} else {
			return 'default.png';
		}
	}

	$daftar_gambar = ["jpg", "jpeg", "png", "svg"];

	$ekstensi_file = explode('.', $nama_file);

	$ekstensi_file = strtolower(end($ekstensi_file));

	if (!in_array($ekstensi_file, $daftar_gambar)) {
		echo "
      <script>
        alert('yang anda masukan bukan gambar');
      </script>";
		return false;
	}

	if ($type_file != 'image/jpeg' && $type_file != 'image/png' && $type_file != 'image/svg+xml') {
		echo "
      <script>
        alert('ekstensi file tidak diketahui');
      </script>";
		return false;
	}

	if ($ukuran_file > 20000000) {
		echo "
      <script>
        alert('ukuran gambar terlalu besar!');
      </script>";
		return false;
	}


	$nama_file_baru = uniqid();

	$nama_file_baru .= '.';

	$nama_file_baru .= $ekstensi_file;

	move_uploaded_file($tmp_file, $path .= $nama_file_baru);

	return $nama_file_baru;
}

function tanggal_indonesia($tanggal)
{
	$bulan = array(
		1 => 'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);

	$pecahkan = explode('-', $tanggal);

	// Variable pecahkan 0 = tanggal
	// Variable pecahkan 1 = bulan
	// Variable pecahkan 2 = tahun

	return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0] . ' ' . date("H:i");
}

function timeAgo($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function tambahPost($data)
{
	$conn = koneksi();

	$judul = htmlspecialchars($data['judul']);
	$tags = htmlspecialchars($data['tags']);
	$konten = $data['konten'];
	$konten_escape = mysqli_real_escape_string($conn, $konten);
	$path = "../../assets/img/post/";
	$gambar = gambar($path, false);
	//$tanggal_dibuat = tanggal_indonesia(date('Y-m-d'));
	$tanggal_dibuat = date('d F Y H:i:s');

	if (!$gambar) {
		return false;
	}

	$query = "INSERT INTO post
    VALUES (NULL, '$judul', '$tags', '$konten_escape', '$gambar', '$tanggal_dibuat', '')
  ";

	mysqli_query($conn, $query) or die(mysqli_error($conn));
	return mysqli_affected_rows($conn);
}

function cekPerubahan($data)
{
	if ($data != '') {
		return true;
	} else {
		return false;
	}
}

function ubahPost($data)
{
	$conn = koneksi();

	$id = $data['id'];
	$judul = htmlspecialchars($data['judul']);
	$tags = htmlspecialchars($data['tags']);
	$konten = $data['konten'];
	$konten_escape = mysqli_real_escape_string($conn, $konten);
	$gambar_lama = htmlspecialchars($data["gambar_lama"]);
	$path = "../assets/img/post/";
	//$tanggal_diubah = tanggal_indonesia(date('Y-m-d'));
	$tanggal_diubah = date('d F Y H:i:s');

	$gambar = gambar($path, $gambar_lama);

	if (!$gambar) {
		return false;
	}

	if ($gambar_lama != "default.png") {
		if ($gambar_lama != $gambar && $gambar != '') {
			unlink($path . $gambar_lama);
		}
	}

	$query = "UPDATE post SET
    judul = '$judul',
    tag = '$tags',
    konten = '$konten_escape',
    thumbnail = '$gambar',
    tanggal_diubah = '$tanggal_diubah'
    WHERE id = '$id'
  ";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn) or die(mysqli_error($conn));
}

function relatedPost($data)
{
	$conn = koneksi();
	$all_post = mysqli_query($conn, "SELECT * FROM post");
	$rows = [];
	while ($row = mysqli_fetch_assoc($all_post)) {
		$rows[] = $row;
	}
	$rows_count = count($rows);
	$relateds = [];

	for ($i = 0; $i < $rows_count; $i++) {
		if ($rows[$i]["tag"] == $data["tag"] && $rows[$i]["id"] != $data["id"]) {
			$relateds[] = $rows[$i];
		}
	}

	return $relateds;
}

function ubahUser($data)
{
	$conn = koneksi();

	$id = $data["id"];
	$username = htmlspecialchars($data["username"]);
	$password = htmlspecialchars($data["password"]);
	$password_verify = htmlspecialchars($data["passwordverify"]);

	if (password_verify($password_verify, $password)) {

		$query = "UPDATE admin SET
            username = '$username'
            WHERE id = '$id'
    ";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn) or die(mysqli_error($conn));
	} else {
		echo "
      <script>
        alert('Verifikasi Password salah');
      </script>
    ";
		return false;
	}
}

function resetpass($data)
{
	$conn = koneksi();

	$id = $data["id"];
	$password = htmlspecialchars($data["password"]);
	$password_lama = htmlspecialchars($data["passwordlama"]);
	$password_baru = htmlspecialchars($data["passwordbaru"]);
	$konfirmasi_password = htmlspecialchars($data["konfirmasipassword"]);

	if (password_verify($password_lama, $password)) {
		if ($password_baru == $konfirmasi_password) {

			$passwordB = password_hash($password_baru, PASSWORD_DEFAULT);

			$query = "UPDATE admin SET
                  password = '$passwordB'
                WHERE id = '$id';
      ";

			mysqli_query($conn, $query);

			return mysqli_affected_rows($conn) or die(mysqli_error($conn));
		} else {
			echo "
      <script>
        alert('Konfirmasi Password Salah!');
        document.location.href = 'resetpass.php?id=" . $id . "';
      </script>
    ";
		}
	} else {
		echo "
      <script>
        alert('Password Lama Salah!');
        document.location.href = 'resetpass.php?id=" . $id . "';
      </script>
    ";
	}
}

function hapusUser($id)
{

	$conn = koneksi();

	$user = query("SELECT * FROM admin WHERE id = '$id'");

	mysqli_query($conn, "DELETE FROM admin WHERE id = '$id'") or die(mysqli_error($conn));
	return mysqli_affected_rows($conn);
}

function hapusPost($id)
{
	$conn = koneksi();

	$data = query("SELECT * FROM post WHERE id = '$id'");
	if ($data["thumbnail"] != "default.png") {

		unlink('../assets/img/post/' . $data["thumbnail"]);
	}

	mysqli_query($conn, "DELETE FROM post WHERE id = '$id'") or die(mysqli_error($conn));
	return mysqli_affected_rows($conn);
}

function cari($keyword)
{
	$conn = koneksi();

	$query = "SELECT * FROM post
            WHERE
            judul LIKE '%$keyword%' OR
            tag LIKE '%$keyword%'
  ";

	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}

	return $rows;
}

function potongText($text, $batas, $break = ".", $pad = "...")
{
	if (strlen($text) <= $batas) {
		return $text;
	}

	if (false !== ($breakpoint = strpos($text, $break, $batas))) {
		if ($breakpoint < strlen($text) - 1) {
			$text = substr($text, 0, $breakpoint) . $pad;
		}
	}

	return $text;
}
