## USER SESSION ESTIMATION SYSTEM

# BACKEND:
    - Yazılım dili olarak PHP kullanıldı.
    - CORS hatalarına karşılık başlıklar eklendi, diğer domain'lerden gelen istekleri kabul edilmesi sağlandı.
    - "file_get_contents" ile belirtilen URL'den JSON verisi çekildi. Daha sonra da çekilen JSON verisi decode edilerek PHP dizisine dönüştürüldü. Veri işlendikten sonra PHP dizisi tekrar JSON formatıyla tarayıcıya gönderildi.
    * Kısacası dış bir kaynaktan JSON verisi alındı, PHP'de işlendi ve tekrar JSON formatında yanıt olarak döndü.

    - api.php'den analizler için veri çekildi.
    - Buradaki login kayıtları için ayrı ayrı işlem yapıldı.
    - Kullanıcı giriş zamanları analiz edildi (saat, tarih, hafta günü).
    - Girişler arasındaki zaman farkı hesaplandı.
    - En yoğun saatler, en aktif günler ve ortalama tekrar süreleri analiz edildi.
    * Tahmin Yöntemleri;
        - Ortalama Aralık Yöntemi: Kullanıcının geçmiş giriş aralıklarının ortalaması alınıp, bu süre son login zamanına eklenerek tahmini bir sonraki giriş zamanı hesaplandı.
        - Gün + Saat Patern Yöntemi: Kullanıcının en sık giriş yaptığı gün ve saatte, bu paterni tekrar ederek tahmini giriş zamanı belirlenmiş.
    - Her kullanıcı için son giriş zamanı ve iki farklı tahmin yöntemiyle hesaplanan tahmini giriş zamanları birleştirilip JSON formatında çıktı olarak verildi.


# FRONTEND:
    - Vite kurulumu yapıldı. (npm create vite@latest -> proje adı -> React -> Javascript -> cd frontend -> npm install -> npm run dev)
    - Framework olarak React kullanıldı.
    - analyze.php dosyasından her kullanıcı için son login zamanı ve her algoritmaya göre tahmin edilen login zamanı bilgileri useEffect hook'u ile fetch ile çekildi.
    - Burada json verilerinin sonucunda return kısmında tablo verileri hazırlandı.
    - Tablo verilerinin dizaynı App.css dosyasında yapıldı.


- DEPLOYMENT:
    - Backend tarafında Render ve Heroku ile deploy edilmesi denendi fakat sürekli "There's something yet" uyarısı alındı. (index.php'de yapılmaya çalışılan adım yorum satırı içinde.)
    - Backend tarafındaki deployment hatasından dolayı frontend de dolaylı olarak deploy edilemedi. Fakat her zaman kullandığım Vercel ile deploy edilecekti.
    Github Link: https://github.com/EzgiUOztuna/User-Session-Estimation-System-Project
