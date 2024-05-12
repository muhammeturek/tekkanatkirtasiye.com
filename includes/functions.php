<?php 
session_start();

// Kullanıcı oturum açmış mı kontrol et
function check_session() {
    if(!isset($_SESSION['kullaniciadi'])) {
        header("Location: ../admin/login.php");
        exit;
    }
}

// Kullanıcı oturum açmışsa kontrol yap
check_session();

// Oturumu sonlandırma
if(isset($_POST['logout'])) {
    session_destroy();
    header("Location: ../admin/login.php");
    exit;
}   

?>