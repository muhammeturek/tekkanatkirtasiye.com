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
    $id = $_POST['id'];
    $ad = $_POST['ad'];
    $soyad = $_POST['soyad'];
    $cinsiyet = $_POST['cinsiyet'];
    $dogumtarihi = date('Y-m-d', strtotime($_POST['dogumtarihi']));
    $borc = $_POST['borc'];

    // Veritabanında güncelle
    $sql = "UPDATE musteriler SET ad='$ad', soyad='$soyad', cinsiyet='$cinsiyet', dogumtarihi='$dogumtarihi', borc='$borc' WHERE id='$id'";
    
    if ($conn->query($sql) === TRUE) {
        echo '<div class="alert alert-success" role="alert">Güncelleme başarılı. Yönlendiriliyorsunuz...</div>';
        header("refresh:5;url=../index.php"); // Başarılı ekleme durumunda 3 saniye sonra index.php'ye yönlendir
        exit();
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }
}

// ID parametresini kontrol et
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Geçersiz ID.";
    exit();
}

$id = $_GET['id'];

// Veritabanından müşteri bilgilerini al
$sql = "SELECT * FROM musteriler WHERE id='$id'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $ad = $row['ad'];
    $soyad = $row['soyad'];
    $cinsiyet = $row['cinsiyet'];
    $dogumtarihi = $row['dogumtarihi'];
    $borc = $row['borc'];
} else {
    echo "Müşteri bulunamadı.";
    exit();
}
if(empty($cinsiyet)){
    // Eğer cinsiyet bilgisi yoksa, varsayılan bir değer belirle
    $cinsiyet = "Belirtilmemiş";
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Müşteri Düzenle</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="container-sm">
    <h1 class="my-5">Müşteri Düzenle</h1>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="mb-3">
            <label for="ad" class="form-label">Ad</label>
            <input type="text" class="form-control" id="ad" name="ad" value="<?php echo $ad; ?>">
        </div>
        <div class="mb-3">
            <label for="soyad" class="form-label">Soyad</label>
            <input type="text" class="form-control" id="soyad" name="soyad" value="<?php echo $soyad; ?>">
        </div>
        <div class="mb-3">
        <label for="cinsiyet" class="form-label">Cinsiyet</label>
        <select class="form-select" id="cinsiyet" name="cinsiyet" required>

                <option disabled value="">Lütfen cinsiyetinizi seçiniz</option>
                <option value="erkek" <?php if ($cinsiyet == "Erkek") echo "selected"; ?>>Erkek</option>
                <option value="kadin" <?php if ($cinsiyet == "Kadın") echo "selected"; ?>>Kadın</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="dogumtarihi" class="form-label">Doğum Tarihi</label>
            <input type="date" class="form-control" id="dogumtarihi" name="dogumtarihi" value="<?php echo $dogumtarihi; ?>">
        </div>
        <div class="mb-3">
            <label for="borc" class="form-label">Borç</label>
            <input type="text" class="form-control" id="borc" name="borc" value="<?php echo $borc; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Güncelle</button>
        <a href="../public/index.php" class="btn btn-secondary">İptal</a>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+5G25Gk9aG5j9coa4iFyTuA7CjF5g4+TpEjhJH2" crossorigin="anonymous"></script>


<script>

   


</script>


<!-- Bootstrap JS ve jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="../js/script.js"></script>
</body>
</html>