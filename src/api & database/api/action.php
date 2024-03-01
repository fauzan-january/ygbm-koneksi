<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
header('Content-Type: application/json; charset=UTF-8');

include "db_config.php";
$postjson = json_decode(file_get_contents('php://input'), true);
$aksi = strip_tags($postjson['aksi']);
$data = array();

switch ($aksi) {
  case "addRegister":
    $nama = filter_var($postjson['nama'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
    $tempat_lahir = filter_var($postjson['tempat_lahir'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
    $tanggal_lahir = filter_var($postjson['tanggal_lahir'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
    $alamat = filter_var($postjson['alamat'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
    $jenis_kelamin = filter_var($postjson['jenis_kelamin'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
    $agama = filter_var($postjson['agama'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
    $pendidikan_terakhir = filter_var($postjson['pendidikan_terakhir'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
    $kegiatan_sekarang = filter_var($postjson['kegiatan_sekarang'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
    $nomor_telepon = filter_var($postjson['nomor_telepon'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
    $email = filter_var($postjson['email'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
    $status_koneksi = filter_var($postjson['status_koneksi'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
    $atas_nama = filter_var($postjson['atas_nama'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
    $nama_koneksi = filter_var($postjson['nama_koneksi'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);

    try {
      $sql = "INSERT INTO `data_koneksi` (nama,tempat_lahir,tanggal_lahir,alamat,jenis_kelamin,agama,pendidikan_terakhir,kegiatan_sekarang,nomor_telepon,email,status_koneksi,atas_nama,nama_koneksi) VALUES (:nama, :tempat_lahir, :tanggal_lahir, :alamat, :jenis_kelamin, :agama, :pendidikan_terakhir, :kegiatan_sekarang, :nomor_telepon, :email, :status_koneksi, :atas_nama, :nama_koneksi)";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':nama', $nama, PDO::PARAM_STR);
      $stmt->bindParam(':tempat_lahir', $tempat_lahir, PDO::PARAM_STR);
      $stmt->bindParam(':tanggal_lahir', $tanggal_lahir, PDO::PARAM_STR);
      $stmt->bindParam(':alamat', $alamat, PDO::PARAM_STR);
      $stmt->bindParam(':jenis_kelamin', $jenis_kelamin, PDO::PARAM_STR);
      $stmt->bindParam(':agama', $agama, PDO::PARAM_STR);
      $stmt->bindParam(':pendidikan_terakhir', $pendidikan_terakhir, PDO::PARAM_STR);
      $stmt->bindParam(':kegiatan_sekarang', $kegiatan_sekarang, PDO::PARAM_STR);
      $stmt->bindParam(':nomor_telepon', $nomor_telepon, PDO::PARAM_STR);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->bindParam(':status_koneksi', $status_koneksi, PDO::PARAM_STR);
      $stmt->bindParam(':atas_nama', $atas_nama, PDO::PARAM_STR);
      $stmt->bindParam(':nama_koneksi', $nama_koneksi, PDO::PARAM_STR);
      $stmt->execute();
      if ($stmt) $result = json_encode(array('success' => true));
      else $result = json_encode(array('success' => false, 'msg' => 'error , please try again'));
      echo $result;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
    break;

  case "getdata":
    $limit = filter_var($postjson['limit'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
    $start = filter_var($postjson['start'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);

    try {
      $sql = "SELECT * FROM `data_koneksi` ORDER BY `nama` DESC LIMIT :start,:limit";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':start', $start, PDO::PARAM_STR);
      $stmt->bindParam(':limit', $limit, PDO::PARAM_STR);
      $stmt->execute();
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($rows as $row) {
        $data[] = array(
          'nama' => $row['nama'],
          'tempat_lahir' => $row['tempat_lahir'],
          'tanggal_lahir' => $row['tanggal_lahir'],
          'alamat' => $row['alamat'],
          'jenis_kelamin' => $row['jenis_kelamin'],
          'agama' => $row['agama'],
          'pendidikan_terakhir' => $row['pendidikan_terakhir'],
          'kegiatan_sekarang' => $row['kegiatan_sekarang'],
          'nomor_telepon' => $row['nomor_telepon'],
          'email' => $row['email'],
          'status_koneksi' => $row['status_koneksi'],
          'atas_nama' => $row['atas_nama'],
          'nama_koneksi' => $row['nama_koneksi']
        );
      }
      if ($stmt) $result = json_encode(array('success' => true, 'result' => $data));
      else $result = json_encode(array('success' => false));
      echo $result;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
    break;
}
?>