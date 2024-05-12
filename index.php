<?php
include './includes/conn.php';

// Kullanıcı bulunduysa yönlendir


session_start();

// Kullanıcı oturum açmış mı kontrol et
function check_session() {
    if(!isset($_SESSION['kullaniciadi'])) {
        header("Location: ./admin/login.php");
        exit;
    }
}

// Oturumu sonlandır ve kullanıcıyı giriş sayfasına yönlendir
function logout() {
    // Oturumu sonlandır
    session_destroy();

    // Kullanıcıyı giriş yapma sayfasına yönlendir
    header("Location: ./admin/login.php");
    exit;
}

// Oturumu sonlandırma formu gönderildiğinde logout() işlevini çağır
if(isset($_POST['logout'])) {
    logout();
}

// Kullanıcı oturum açmamışsa kontrol yap
check_session();





if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['ad']) && isset($_POST['soyad']) && isset($_POST['cinsiyet']) && isset($_POST['dogumtarihi']) && isset($_POST['borc'])) {
        $ad = $_POST['ad'];
        $soyad = $_POST['soyad'];
        $cinsiyet = $_POST['cinsiyet'];
        $dogumtarihi = date('Y-m-d', strtotime($_POST['dogumtarihi']));
        $borc = $_POST['borc'];
    

    


    // Veritabanına ekle
    $sql = "INSERT INTO musteriler (ad, soyad, cinsiyet, dogumtarihi, borc) VALUES ('$ad', '$soyad', '$cinsiyet', '$dogumtarihi', '$borc')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: ../index.php"); // Başarılı ekleme durumunda index.php'ye yönlendir
        exit();
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }
}
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kırtasiye Müşteri Yönetim sistemi </title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<div class="container">
    <header class="d-flex justify-content-between align-items-center">
    <h1 class="my-5">Tekkanat Kırtasiyesi Müşteri Yönetim Sistemi</h1>
    <form method="post">
    <button class="btn btn-danger" type="submit" name="logout">Çıkış Yap</button>
    </form> 
    </header>

    <div class="d-flex justify-content-between mb-4">
    <button type="button" class="btn btn-success " onclick="window.location.href='./admin/ekle.php'">Yeni Müşteri Ekle</button>
    <button class="btn btn-primary" id="btnSwitch">Karanlık Moda geç!</button>
    </div>
    <div class="mb-4 position-relative">
        <input type="text" class="form-control ps-5 shadow-none focus-none" id="aramaInput" placeholder="Ara...">
        <i style="color: black" class="bi bi-search position-absolute top-0 start-0 mt-1 ms-2 fs-5 "></i>
    </div>
    <!-- Müşteri Listesi -->
    <h2 class="mt-4">Müşteri Listesi</h2>
    <table class="table" id="musteriTablo">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ad</th>
                <th>Soyad</th>
                <th>Cinsiyet</th>
                <th>Doğum Tarihi</th>
                <th>Borç</th>
                <th>Güncelle</th>
                <th>Kaydı Sil</th>
            </tr>
        </thead>
        <tbody>
            <?php include './admin/listele.php';
           


            
            
           
            ?>
        

            
    


          

        </tbody>


  



    </table>
    
    <footer style="height:100px;" class=" align-items-center justify-content-center d-flex mt-4 border border-top">
    <h1 class="h3 d-flex "><a target="_blank" href="https://github.com/muhammeturek" >Muhammet Ürek </a>&nbsp tarafından geliştirilmiştir. - 2024</h1>
    </footer>
</div>

<!-- Bootstrap JS ve jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="../public/js/script.js"></script>


</body>
</html>
