<?php 
require_once ('koneksi.php');

function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// Function untuk memasukkan data kamar ke database
function insertKamar($nama_kamar, $tipe_kamar, $harga, $deskripsi)
{
    global $koneksi;
    
    $query = "INSERT INTO kamar (nama_kamar, tipe_kamar, harga, deskripsi) 
              VALUES ('$nama_kamar', '$tipe_kamar', '$harga', '$deskripsi')";
    
    // Menjalankan query dan mengembalikan true jika berhasil, false jika gagal
    return mysqli_query($koneksi, $query);
}


// Function untuk menghapus kamar berdasarkan ID
function deleteKamar($id_kamar)
{
    global $koneksi;

    // Query untuk menghapus data kamar
    $query = "DELETE FROM kamar WHERE id_kamar = $id_kamar";

    // Menjalankan query dan mengembalikan true jika berhasil, false jika gagal
    return mysqli_query($koneksi, $query);
}

// Function untuk memperbarui data kamar
function updateKamar($id_kamar, $nama_kamar, $tipe_kamar, $harga, $deskripsi)
{
    global $koneksi;

    // Query untuk memperbarui data kamar
    $query = "UPDATE kamar SET 
              nama_kamar = '$nama_kamar', 
              tipe_kamar = '$tipe_kamar', 
              harga = '$harga', 
              deskripsi = '$deskripsi' 
              WHERE id_kamar = $id_kamar";

    // Menjalankan query dan mengembalikan true jika berhasil, false jika gagal
    return mysqli_query($koneksi, $query);
}

function insertBooking($id_user, $id_kamar, $tanggal_checkin, $tanggal_checkout) {
    global $koneksi;

    // Insert data ke tabel booking
    $query = "INSERT INTO booking (id_user, id_kamar, tanggal_checkin, tanggal_checkout, status)
              VALUES (?, ?, ?, ?, 'pending')";

    // Siapkan statement dan bind parameter
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "iiss", $id_user, $id_kamar, $tanggal_checkin, $tanggal_checkout);

    // Eksekusi query dan periksa hasilnya
    return mysqli_stmt_execute($stmt);
}

function addUser($nama, $email, $password, $tipe)
{
    global $koneksi;
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO user (nama, email, password, tipe) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $nama, $email, $password_hash, $tipe);
    return mysqli_stmt_execute($stmt);
}

function deleteUser($id_user)
{
    global $koneksi;
    $query = "DELETE FROM user WHERE id_user = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_user);
    return mysqli_stmt_execute($stmt);
}

function updateUser($id_user, $nama, $email, $password, $tipe)
{
    global $koneksi;
    if (!empty($password)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE user SET nama = ?, email = ?, password = ?, tipe = ? WHERE id_user = ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "ssssi", $nama, $email, $password_hash, $tipe, $id_user);
    } else {
        $query = "UPDATE user SET nama = ?, email = ?, tipe = ? WHERE id_user = ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "sssi", $nama, $email, $tipe, $id_user);
    }
    return mysqli_stmt_execute($stmt);
}

// Fungsi untuk hash password saat registrasi atau perubahan password
function hashPassword($password)
{
    return password_hash($password, PASSWORD_DEFAULT);
}


