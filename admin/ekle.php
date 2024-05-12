<?php
include '../includes/conn.php';

session_start();

// Kullanıcı oturum açmış mı kontrol et
function check_session() {
    if(!isset($_SESSION['kullaniciadi'])) {
        header("Location: ../admin/login.php");
        exit;
    }
}

// Oturumu sonlandır ve kullanıcıyı giriş sayfasına yönlendir
function logout() {
    // Oturumu sonlandır
    session_destroy();

    // Kullanıcıyı giriş yapma sayfasına yönlendir
    header("Location: ../admin/login.php");
    exit;
}

// Oturumu sonlandırma formu gönderildiğinde logout() işlevini çağır
if(isset($_POST['logout'])) {
    logout();
}

// Kullanıcı oturum açmamışsa kontrol yap
check_session();



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri al
    $ad = $_POST['ad'];
    $soyad = $_POST['soyad'];
    $cinsiyet = !empty($_POST['cinsiyet']) ? $_POST['cinsiyet'] : '';
    $dogumtarihi = date('Y-m-d', strtotime($_POST['dogumtarihi']));
    $borc = $_POST['borc'];

    // Veritabanına ekle
    $sql = "INSERT INTO musteriler (ad, soyad, cinsiyet, dogumtarihi, borc) VALUES ('$ad', '$soyad', '$cinsiyet', '$dogumtarihi', '$borc')";

    if ($conn->query($sql) === TRUE) {
        echo '<div class="alert alert-success" role="alert">Ekleme başarılı. Yönlendiriliyorsunuz...</div>';
        header("refresh:3;url=../index.php"); // Başarılı ekleme durumunda 3 saniye sonra index.php'ye yönlendir
        exit();
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>  
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Müşteri Ekle</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1 class="my-5">Tekkanat Kırtasiyesi Müşteri Yönetimi</h1>

    <!-- Müşteri Ekle Formu -->
    <h2>Yeni Müşteri Ekle</h2>
    <form method="post" action="ekle.php" class="mb-4 needs-validation was-validated">
        <div class="form-group">
            <label  for="validationCustom01" class="form-label" for="ad">Ad</label>
            <input autocomplete="off" type="text" class="form-control" id="validationCustom01" name="ad" required>
           
            <div class="invalid-feedback mb-4">Lütfen Ad alanını doldurun.</div>
        </div>
        <div class="form-group">
            <label   for="soyad">Soyad</label>
            <input autocomplete="off" type="text" class="form-control" id="validationCustom02" name="soyad" required>
           
            <div class="invalid-feedback mb-4">Lütfen Soyad alanını doldurun.</div>
        </div>
        <div class="form-group">
            <label for="cinsiyet">Cinsiyet</label>
            <select class="form-control" id="cinsiyet" name="cinsiyet" required>
                <option value="" selected disabled>Lütfen seçiniz</option>
                <option value="Erkek">Erkek</option>
                <option value="Kadın">Kadın</option>
                <div class="invalid-feedback mb-4">Lütfen Cinsiyet alanını doldurun.</div>
            </select>
        </div>
        <div class="form-group">
            <label   for="dogumtarihi" class="mt-4">Doğum Tarihi</label>
            <input type="date" class="form-control" id="dogumtarihi" name="dogumtarihi" required>
            <div class="invalid-feedback mb-4">Lütfen Doğum Tarihi alanını doldurun.</div>
        </div>
        <div class="form-group">
            <label   for="borc">Borç</label>
            <input autocomplete="off" type="number" class="form-control" id="borc" name="borc" required>
            <div class="invalid-feedback mb-4">Lütfen Borç alanını doldurun.</div>
        </div>
        
        <div class="d-flex justify-content-between align-items-center">
        <button type="submit" class="btn btn-primary px-5" name="ekle">Ekle</button>
        <a href="../index.php" class="btn btn-secondary px-5">İptal</a>
        </div>
    </form>
</div>
<!-- Bootstrap JS ve jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
