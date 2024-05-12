<?php 
 
include '../includes/conn.php';


// Formdan gelen verileri al
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['kullaniciadi']) && isset($_POST['parola'])) {
        $username = $_POST['kullaniciadi'];
        $password = $_POST['parola'];

        // Veritabanından kullanıcıyı sorgula
        $query = "SELECT * FROM login WHERE kullaniciadi = ? AND parola = ?";
        $statement = $conn->prepare($query);
        $statement->bind_param("ss", $username, $password);
        $statement->execute();
        $result = $statement->get_result();

        // Kullanıcı bulunduysa yönlendir
        if ($result->num_rows == 1) {
            // Oturumu başlat
            session_start();

            // Kullanıcıyı oturum değişkenine kaydet
            $_SESSION['kullaniciadi'] = $username;

            // Index sayfasına yönlendir
            header("Location:../index.php");
            exit;
        } else {
            echo "Kullanıcı adı veya şifre yanlış.";
        }
    } else {
        echo "Lütfen kullanıcı adı ve şifre girin.";
    }
}
?>




<!DOCTYPE html>
<html class="h-full" lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
</head>
<body class="h-full w-full bg-gray-100 flex items-center justify-center " style="font-family: 'Inter', sans-serif;" >
<div class="flex items-center justify-center">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="grid gap-2.5  p-4 w[400px] border border-gray-300 rounded bg-white">
    <h3 class="text-xl font-bold mb-2 text-center border-b pb-2">Tekkanat Kırtasiye Müşteri Sistemi</h3>
    <?php if(isset($error_message)) { ?>
            <div class="text-red-500"><?php echo $error_message; ?></div>
        <?php } ?>
        <label class="block w-full" for="kullaniciadi">
            <div class="text-sm mb-2 text-gray 600">Kullanıcı Adı</div>
            <div class="flex h-10 items-center border rounded w-full border-gray-300 focus-within:border-black">   
                <input autocomplete="off" class="h-full px-3 bg-transparent text-sm w-full rounded outline-none" type="text" name="kullaniciadi" id="kullaniciadi">
            </div>
        </label>

        <label class="block w-full" for="parola">
        <div class="text-sm mb-2 text-gray 600">Parola</div>
        <div  class="flex h-10 items-center border rounded w-full border-gray-300 focus-within:border-black">
            <input class="h-full px-3 bg-transparent text-sm w-full rounded outline-none" type="password" name="parola" id="parola">
        </div>
        </label>
        
        <button class="rounded inline-flex whitespace-nowrap cursor-pointer gap-x-2 border border-transparent items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed disabled:pointer-events-none h-8 px-4 text-sm bg-blue-600/80 text-white hover:bg-indigo-600">Giriş Yap</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="../public/js/script.js"></script>
</body>
</html>