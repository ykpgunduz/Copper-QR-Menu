<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masaya Sipariş Ekle</title>
    <link rel="icon" href="{{ asset('img/favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-dark">
    <div class="container-fluid mx-5">
        <div class="row pt-3">
            <div class="col-8 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Masa Seçimi</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="d-flex flex-column col-md-6">
                                    @for ($i = 3; $i >= 1; $i--)
                                        <button type="button" class="btn btn-outline-primary masa-button mb-2" data-masa-no="{{ $i }}">
                                            Bahçe {{ $i }}
                                        </button>
                                    @endfor
                                </div>
                            </div>

                            <div class="col-9 p-0">
                                <div class="d-flex justify-content-center mb-4">
                                    @for ($i = 4; $i <= 12; $i++)
                                        <button type="button" class="btn btn-outline-primary masa-button mx-1" data-masa-no="{{ $i }}">
                                            B-{{ $i }}
                                        </button>
                                    @endfor
                                </div>

                                <div class="d-flex justify-content-center mb-4">
                                    @for ($i = 14; $i >= 13; $i--)
                                        <button type="button" class="btn btn-outline-primary masa-button mx-1" data-masa-no="{{ $i }}">
                                            Salon {{ $i }}
                                        </button>
                                    @endfor
                                </div>

                                <div class="d-flex justify-content-around" style="width: 75%;">
                                    <div>
                                        <button type="button" class="btn btn-outline-success masa-button" disabled>
                                            TATLI & KASA
                                        </button>
                                    </div>

                                    <div>
                                        @for ($i = 17; $i >= 15; $i--)
                                            <button type="button" class="btn btn-outline-primary masa-button mx-1" data-masa-no="{{ $i }}">
                                                Salon {{ $i }}
                                            </button>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Sipariş Özeti</h5>
                    </div>
                    <div class="card-body">
                        <div id="siparisOzeti">
                        </div>
                        <div class="mt-3">
                            <h6>Toplam: <span id="toplamTutar">0</span> ₺</h6>
                            <button class="btn btn-success w-100 py-2" id="siparisiOnayla">Siparişi Masaya Ekle</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ürün Listesi -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Ürünler</h5>
                        <div class="input-group input-group-sm mb-2 mx-3" style="width: 300px;">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" class="form-control" id="urunArama" placeholder="Ara...">
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills flex-wrap gap-2 mb-3">
                            @foreach($categories as $category)
                                <li class="nav-item">
                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                            data-filter="{{ $category->id }}">
                                        {{ $category->name }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Ürün Grid -->
                        <div class="row g-3" id="urunListesi">
                            @foreach($products->sortBy('title') as $product)
                                <div class="col-md-2-4 urun-item" style="flex: 0 0 20%; max-width: 20%;" data-kategori="{{ $product->category_id }}" data-urun-adi="{{ strtolower($product->title) }}">
                                    <div class="card h-100 product-card"
                                         data-urun-id="{{ $product->id }}"
                                         data-urun-fiyat="{{ $product->price }}">
                                        <div class="card-body p-2">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <h6 class="card-title mb-0">{{ $product->title }}</h6>
                                                <div class="d-flex flex-column align-items-end">
                                                    <span class="badge bg-primary mb-1">
                                                        {{ $product->price }}₺
                                                    </span>
                                                    <span class="badge bg-success urun-adet-badge" style="display: none;">0</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Mevcut script içeriği -->
    <script>
        $(document).ready(function() {
            let secilenMasa = null;

            // Masa seçimi
            $('.masa-button').click(function() {
                $('.masa-button').removeClass('active');
                $(this).addClass('active');
                secilenMasa = $(this).data('masa-no');
            });

            // Ürün kartına tıklama
            $('.product-card').click(function() {
                if ($(this).hasClass('kiloluk-urun')) {
                    // Kiloluk ürünler için gram input'unu göster
                    const gramInput = $(this).find('.gram-input');
                    $(this).find('.gram-input-group').show();
                    gramInput.focus(); // Input'a otomatik focus ver
                    return;
                }

                // Normal ürünler için eski davranış devam etsin
                let urunId = $(this).data('urun-id');
                let urunFiyat = $(this).data('urun-fiyat');
                let adetBadge = $(this).find('.urun-adet-badge');
                let mevcutAdet = parseInt(adetBadge.text()) || 0;
                let yeniAdet = mevcutAdet + 1;
                adetBadge.text(yeniAdet).show();
                guncelleOzet();
            });

            // Gram ekleme butonu
            $('.gram-ekle').click(function(e) {
                e.stopPropagation();
                const card = $(this).closest('.product-card');
                const gramInput = card.find('.gram-input');
                const gram = parseInt(gramInput.val());

                if (!gram || gram < 50) {
                    alert('Lütfen en az 50 gram giriniz!');
                    return;
                }

                const kgFiyat = card.data('urun-fiyat');
                const hesaplananFiyat = (kgFiyat * gram / 1000).toFixed(2);

                const adetBadge = card.find('.urun-adet-badge');
                adetBadge.text(`${gram}g`).show();

                // Hesaplanan fiyatı sakla
                card.data('hesaplanan-fiyat', hesaplananFiyat);

                // Input'u temizle ve gizle
                gramInput.val('');
                card.find('.gram-input-group').hide();

                guncelleOzet();
            });

            // Gram input'una enter tuşu desteği ekle
            $('.gram-input').keypress(function(e) {
                if (e.which == 13) { // Enter tuşu kodu
                    e.preventDefault(); // Form submit'i engelle
                    $(this).closest('.gram-input-group').find('.gram-ekle').click(); // Ekle butonunu tetikle
                }
            });

            function guncelleOzet() {
                let ozet = '';
                let toplam = 0;

                $('.product-card').each(function() {
                    const adetBadge = $(this).find('.urun-adet-badge');
                    const adetText = adetBadge.text();

                    if (adetText && adetText !== '0') {
                        const urunAdi = $(this).find('.card-title').text();
                        const urunFiyat = parseFloat($(this).data('urun-fiyat'));
                        const adet = parseInt(adetText);

                        let satirToplam = 0;
                        let satirHTML = '';

                        satirToplam = urunFiyat * adet;
                        satirHTML = `<div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="d-flex align-items-center">
                                <button class="btn btn-sm btn-outline-danger me-2 azalt-btn" data-urun-id="${$(this).data('urun-id')}">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <span class="fw-bold">${urunAdi}</span>
                                <span class="text-muted ms-2">x${adet}</span>
                            </div>
                            <div class="text-end">
                                <div>${Math.round(satirToplam)}₺</div>
                            </div>
                        </div>`;

                        ozet += satirHTML;
                        toplam += satirToplam;
                    }
                });

                $('#siparisOzeti').html(ozet);
                $('#toplamTutar').text(Math.round(toplam));

                // Eksiltme butonu işlevi
                $('.azalt-btn').click(function(e) {
                    e.stopPropagation();
                    const urunId = $(this).data('urun-id');
                    const productCard = $(`.product-card[data-urun-id="${urunId}"]`);
                    const adetBadge = productCard.find('.urun-adet-badge');

                    if (productCard.hasClass('kiloluk-urun')) {
                        // Kiloluk ürünler için direkt silme
                        adetBadge.hide().text('0');
                        productCard.data('hesaplanan-fiyat', 0);
                        guncelleOzet();
                    } else {
                        // Normal ürünler için adet bazlı eksiltme
                        let mevcutAdet = parseInt(adetBadge.text()) || 0;
                        if (mevcutAdet > 0) {
                            mevcutAdet--;
                            if (mevcutAdet === 0) {
                                adetBadge.hide().text('0');
                            } else {
                                adetBadge.text(mevcutAdet);
                            }
                            guncelleOzet();
                        }
                    }
                });
            }

            // Sipariş onaylama
            $('#siparisiOnayla').click(function() {
                if (!secilenMasa) {
                    alert('Lütfen bir masa seçin!');
                    return;
                }

                let siparisUrunleri = [];
                $('.product-card').each(function() {
                    const adetBadge = $(this).find('.urun-adet-badge');
                    const adetText = adetBadge.text();

                    if (adetText && adetText !== '0') {
                        let miktar;
                        if ($(this).hasClass('kiloluk-urun')) {
                            // Gramaj ürünleri için gram değerini al
                            miktar = parseInt(adetText);
                        } else {
                            // Normal ürünler için adet al
                            miktar = parseInt(adetText);
                        }

                        siparisUrunleri.push({
                            urun_id: $(this).data('urun-id'),
                            adet: miktar
                        });
                    }
                });

                if (siparisUrunleri.length === 0) {
                    alert('Lütfen en az bir ürün seçin!');
                    return;
                }

                // AJAX ile siparişi kaydet
                $.ajax({
                    url: '/siparis/kaydet',
                    method: 'POST',
                    data: {
                        masa_no: secilenMasa,
                        urunler: siparisUrunleri,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            location.reload();
                        } else {
                            alert('Bir hata oluştu!');
                        }
                    },
                    error: function(xhr) {
                        alert('Sipariş kaydedilirken bir hata oluştu: ' + xhr.responseJSON?.message || 'Bilinmeyen hata');
                    }
                });
            });

            // Ürün arama fonksiyonu
            $('#urunArama').on('input', function() {
                const searchText = $(this).val().toLowerCase();
                $('.urun-item').each(function() {
                    const urunAdi = $(this).data('urun-adi');
                    if (urunAdi.includes(searchText)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            // Kategori filtreleme güncelleme
            $('.nav-pills .nav-link').click(function() {
                $('.nav-pills .nav-link').removeClass('active');
                $(this).addClass('active');
                $('#urunArama').val(''); // Arama kutusunu temizle

                const filter = $(this).data('filter');
                $('.urun-item').each(function() {
                    if ($(this).data('kategori') == filter) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            // Sayfa yüklendiğinde ilk kategorinin ürünlerini göster
            const ilkKategoriId = $('.nav-pills .nav-link.active').data('filter');
            $('.urun-item').each(function() {
                if ($(this).data('kategori') == ilkKategoriId) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    </script>

    <style>
    /* Ana tema renkleri */
    :root {
        --primary-color: #3b82f6;
        --secondary-color: #64748b;
        --success-color: #22c55e;
        --danger-color: #ef4444;
        --background-color: #f1f5f9;
        --card-bg: #ffffff;
        --text-color: #1e293b;
        --border-color: #e2e8f0;
        --hover-bg: #f8fafc;
    }

    body {
        background-color: var(--background-color);
        color: var(--text-color);
        min-height: 100vh;
    }

    /* Kartlar için genel stil */
    .card {
        background-color: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .card-header {
        background-color: var(--hover-bg);
        border-bottom: 1px solid var(--border-color);
        padding: 0.5rem 0 0 1rem;
    }

    /* Masa butonları */
    .masa-button {
        border: 1px solid var(--border-color);
        background-color: var(--card-bg);
        color: var(--text-color);
    }

    .masa-button:hover, .masa-button.active {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }

    /* Kategori pilleri */
    .nav-pills .nav-link {
        color: var(--text-color);
        background-color: var(--hover-bg);
        margin: 0.2rem;
        border-radius: 20px;
        transition: all 0.2s ease;
    }

    .nav-pills .nav-link:hover {
        background-color: rgba(59, 130, 246, 0.1);
        transform: translateY(-1px);
    }

    .nav-pills .nav-link.active {
        background-color: #3b82f6; /* Mavi renk */
        color: white;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        transform: translateY(-1px);
    }

    /* Ürün kartları */
    .product-card {
        background-color: var(--card-bg);
        border: 1px solid var(--border-color);
        transition: all 0.2s;
        cursor: pointer;
        user-select: none; /* Metin seçimini engeller */
    }

    .product-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-color: var(--primary-color);
        background-color: var(--hover-bg);
        position: relative;
    }

    .product-card:hover::after {
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 2rem;
        color: var(--primary-color);
        opacity: 0.3;
        pointer-events: none;
    }

    .product-card .card-title {
        color: var(--text-color);
        font-size: 1rem;
    }

    /* Badge stilleri */
    .badge {
        padding: 0.5rem 0.8rem;
        border-radius: 6px;
        font-weight: 500;
    }

    .badge.bg-primary {
        background-color: var(--primary-color) !important;
    }

    .badge.bg-success {
        background-color: var(--success-color) !important;
    }

    /* Input grupları */
    .input-group {
        background-color: var(--card-bg);
        border: 1px solid var(--border-color);
    }

    .input-group-text {
        background-color: var(--hover-bg);
        border-color: var(--border-color);
        color: var(--text-color);
    }

    .form-control {
        background-color: var(--card-bg);
        border-color: var(--border-color);
        color: var(--text-color);
    }

    .form-control:focus {
        background-color: var(--card-bg);
        border-color: var(--primary-color);
        color: var(--text-color);
    }

    /* Gram input grubu */
    .gram-input-group .input-group {
        background-color: var(--card-bg);
    }

    .gram-input-group .form-control {
        border: none;
        background-color: transparent;
    }

    .gram-input-group .btn {
        border: none;
        background-color: var(--primary-color);
        color: white;
    }

    /* Sipariş özeti */
    #siparisOzeti {
        background-color: var(--card-bg);
    }

    .azalt-btn {
        padding: 0.3rem 0.6rem;
        border-radius: 6px;
        background-color: transparent;
        border-color: var(--danger-color);
        color: var(--danger-color);
    }

    .azalt-btn:hover {
        background-color: var(--danger-color);
        color: white;
    }

    /* Onay butonu */
    #siparisiOnayla {
        background-color: var(--success-color);
        border: none;
        padding: 0.8rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.2s;
    }

    #siparisiOnayla:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(22, 163, 74, 0.2);
    }

    /* Scrollbar */
    .card-body::-webkit-scrollbar {
        width: 8px;
    }

    .card-body::-webkit-scrollbar-track {
        background: var(--hover-bg);
    }

    .card-body::-webkit-scrollbar-thumb {
        background: var(--secondary-color);
    }

    .card-body::-webkit-scrollbar-thumb:hover {
        background: var(--primary-color);
    }
    </style>
</body>
</html>
