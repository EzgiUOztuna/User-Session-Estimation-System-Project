## USER SESSION ESTIMATION SYSTEM

- BACKEND;
    - CORS hatalarına karşılık başlıklar eklendi, diğer domain'lerden gelen istekleri kabul edilmesi sağlandı.
    - "file_get_contents" ile belirtilen URL'den JSON verisi çekildi. Daha sonra da çekilen JSON verisi decode edilerek PHP dizisine dönüştürüldü. Veri işlendikten sonra PHP dizisi tekrar JSON formatıyla tarayıcıya gönderildi.
    * Kısacası dış bir kaynaktan JSON verisi alındı, PHP'de işlendi ve tekrar JSON formatında yanıt olarak döndü.

    - 