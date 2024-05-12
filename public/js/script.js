$(document).ready(function(){
    $('#aramaInput').on('keyup', function(){
        var deger = $(this).val().toLowerCase();
        $('#musteriTablo tr').filter(function(){
            $(this).toggle($(this).text().toLowerCase().indexOf(deger) > -1);
        });
    });
});

document.getElementById('btnSwitch').addEventListener('click',()=>{
    if (document.documentElement.getAttribute('data-bs-theme') == 'dark') {
        document.documentElement.setAttribute('data-bs-theme','light');
        document.getElementById('btnSwitch').innerText = 'Karanlık moda geç';
        
    }
    else {
        document.documentElement.setAttribute('data-bs-theme','dark');
        document.getElementById('btnSwitch').innerText = 'Aydınlık moda geç';
       

    }
})


$(document).ready(function() {
    // Cinsiyet alanını dinle
    $('#cinsiyet').change(function() {
        var cinsiyet = $(this).val(); // Seçilen cinsiyeti al
        if (cinsiyet === "") { // Eğer cinsiyet boşsa
            $(this).addClass("is-invalid"); // Hata durumunu göstermek için bootstrap 'is-invalid' sınıfını ekle
        } else {
            $(this).removeClass("is-invalid"); // Hata durumu yoksa sınıfı kaldır
        }
    });
});