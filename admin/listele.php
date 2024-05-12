<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Müşteri Listesi</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kullanıcı oturum açmış mı kontrol et
if (!isset($_SESSION['kullaniciadi'])) {
    // Oturum açılmamışsa kullanıcıyı login.php sayfasına yönlendir
    header("Location: ../admin/login.php");
    exit;
}
include './includes/conn.php';


// Müşteri listesi
$sql = "SELECT * FROM musteriler";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["id"]."</td>
                <td>".$row["ad"]."</td>
                <td>".$row["soyad"]."</td>
                <td>".$row["cinsiyet"]."</td>
                <td>".$row["dogumtarihi"]."</td>
                <td>".$row["borc"]."</td>
                <td>
                    <a href='./admin/duzenle.php?id=".$row["id"]."' class='btn btn-sm btn-warning'>Güncelle</a>
                </td>

                <td>
                    <a href='#' class='btn btn-sm btn-danger' data-toggle='modal' data-target='#confirmDelete".$row["id"]."'>Kaydı Sil</a>
                </td>
            </tr>";

        // Modal for each row
        echo "<div class='modal fade' id='confirmDelete".$row["id"]."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalLabel'>Silmek İstediğinize Emin Misiniz?</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>İptal</button>
                        <a href='./admin/sil.php?id=".$row["id"]."' class='btn btn-danger'>Sil</a>
                    </div>
                </div>
            </div>
        </div>";
    }
} else {
    echo "<tr><td colspan='8'>Kayıt bulunamadı.</td></tr>";
}
$conn->close();
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
