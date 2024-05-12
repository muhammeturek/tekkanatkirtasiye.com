<?php
include '../includes/conn.php';

// Silinecek müşterinin ID'si
$id = $_GET['id'];

// Müşteriyi sil
$sql = "DELETE FROM musteriler WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header("Location: ../index.php"); // Başarılı silme durumunda index.php'ye yönlendir
    exit();
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

