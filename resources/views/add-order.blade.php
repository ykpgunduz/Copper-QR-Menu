<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masaya Sipariş Ekle</title>
    <link rel="icon" href="{{ asset('img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/new.css') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-dark">
    <div class="container-fluid">
        <div class="row pt-3">
            <!-- Masa Seçimi -->
            <div class="col-8 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Masa Seçimi</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Bahçe Masaları -->
                            <div class="col-3">
                                <div class="d-flex flex-column col-md-6">
                                    @for ($i = 3; $i >= 1; $i--)
                                        <button type="button" class="btn btn-outline-primary masa-button mb-2 {{ isset($aktifMasalar[$i]) ? 'masa-aktif' : '' }}" data-masa-no="{{ $i }}">
                                            Bahçe {{ $i }}
                                        </button>
                                    @endfor
                                </div>
                            </div>

                            <!-- Diğer Masalar -->
                            <div class="col-9 p-0">
                                <!-- B Masaları -->
                                <div class="d-flex justify-content-center mb-4">
                                    @for ($i = 4; $i <= 12; $i++)
                                        <button type="button" class="btn btn-outline-primary masa-button mx-1 {{ isset($aktifMasalar[$i]) ? 'masa-aktif' : '' }}" data-masa-no="{{ $i }}">
                                            B-{{ $i }}
                                        </button>
                                    @endfor
                                </div>

                                <!-- Salon Masaları 13-14 -->
                                <div class="d-flex justify-content-center mb-4">
                                    @for ($i = 14; $i >= 13; $i--)
                                        <button type="button" class="btn btn-outline-primary masa-button mx-1 {{ isset($aktifMasalar[$i]) ? 'masa-aktif' : '' }}" data-masa-no="{{ $i }}">
                                            Salon {{ $i }}
                                        </button>
                                    @endfor
                                </div>

                                <!-- Salon Masaları 15-17 -->
                                <div>
                                    @for ($i = 17; $i >= 15; $i--)
                                        <button type="button" class="btn btn-outline-primary masa-button mx-1 {{ isset($aktifMasalar[$i]) ? 'masa-aktif' : '' }}" data-masa-no="{{ $i }}">
                                            Salon {{ $i }}
                                        </button>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sipariş Özeti -->
            <div class="col-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Sipariş Özeti</h5>
                    </div>
                    <div class="card-body">
                        <form id="siparisForm" action="{{ route('siparis.ekle') }}" method="POST">
                            @csrf
                            <input type="hidden" name="masa_no" id="secilenMasaInput">
                            <div id="siparisOzeti"></div>
                            <div class="mt-3">
                                <h6>Toplam: <span id="toplamTutar">0</span> ₺</h6>
                                <button type="submit" class="btn btn-success w-100 py-2" id="siparisiOnayla">
                                    Siparişi Masaya Ekle
                                </button>
                            </div>
                        </form>
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
                        <!-- Kategori Filtreleme -->
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
                                <div class="col-md-2-4 urun-item" style="flex: 0 0 20%; max-width: 20%;"
                                     data-kategori="{{ $product->category_id }}"
                                     data-urun-adi="{{ strtolower($product->title) }}">
                                    <div class="card h-100 product-card"
                                         data-urun-id="{{ $product->id }}"
                                         data-urun-fiyat="{{ $product->price }}">
                                        <div class="card-body p-2">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <h6 class="card-title mb-0">{{ $product->title }}</h6>
                                                <div class="d-flex flex-column align-items-end">
                                                    <span class="badge bg-primary mb-1">{{ $product->price }}₺</span>
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

    <script>
        $(document).ready(function() {
            let secilenMasa = null;
            let sepet = {};

            // Sayfa yüklendiğinde ilk kategorideki ürünleri göster
            const ilkKategoriId = $('.nav-pills .nav-link.active').data('filter');
            $('.urun-item').each(function() {
                if (ilkKategoriId === $(this).data('kategori')) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            // Masa seçimi
            $('.masa-button').click(function() {
                $('.masa-button').removeClass('active');
                $(this).addClass('active');
                secilenMasa = $(this).data('masa-no');
                $('#secilenMasaInput').val(secilenMasa);
            });

            // Ürün seçimi
            $('.product-card').click(function() {
                if (!secilenMasa) {
                    alert('Lütfen önce bir masa seçin!');
                    return;
                }

                const urunId = $(this).data('urun-id');
                const urunAdi = $(this).find('.card-title').text();
                const urunFiyat = parseFloat($(this).data('urun-fiyat'));

                if (!sepet[urunId]) {
                    sepet[urunId] = {
                        adet: 0,
                        ad: urunAdi,
                        fiyat: urunFiyat
                    };
                }

                sepet[urunId].adet++;

                // Ürün kartı üzerindeki adet badge'ini güncelle
                const badge = $(this).find('.urun-adet-badge');
                badge.text(sepet[urunId].adet).show();

                siparisiGuncelle();
            });

            // Sipariş özetini güncelleme
            function siparisiGuncelle() {
                let html = '';
                let toplam = 0;

                for (const [urunId, urun] of Object.entries(sepet)) {
                    if (urun.adet > 0) {
                        const tutar = urun.adet * urun.fiyat;
                        toplam += tutar;

                        // Her ürün için gizli input alanları oluştur
                        html += `
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <span class="fw-bold">${urun.ad}</span>
                                    <span class="text-muted">x${urun.adet}</span>
                                    <input type="hidden" name="urunler[${urunId}][adet]" value="${urun.adet}">
                                    <input type="hidden" name="urunler[${urunId}][fiyat]" value="${urun.fiyat}">
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="me-2">${tutar}₺</span>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="urunSil(${urunId})">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        `;
                    }
                }

                $('#siparisOzeti').html(html);
                $('#toplamTutar').text(toplam);
            }

            // Ürün silme fonksiyonu
            window.urunSil = function(urunId) {
                if (sepet[urunId]) {
                    sepet[urunId].adet = 0;
                    $(`.product-card[data-urun-id="${urunId}"]`).find('.urun-adet-badge').hide();
                    siparisiGuncelle();
                }
            };

            // Form gönderimi öncesi kontrol
            $('#siparisForm').on('submit', function(e) {
                if (!secilenMasa) {
                    e.preventDefault();
                    alert('Lütfen bir masa seçin!');
                    return false;
                }

                if (Object.keys(sepet).filter(key => sepet[key].adet > 0).length === 0) {
                    e.preventDefault();
                    alert('Lütfen en az bir ürün seçin!');
                    return false;
                }
            });

            // Kategori filtreleme
            $('.nav-pills .nav-link').click(function() {
                $('.nav-pills .nav-link').removeClass('active');
                $(this).addClass('active');

                const kategoriId = $(this).data('filter');
                $('.urun-item').each(function() {
                    if (kategoriId === $(this).data('kategori')) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            // Ürün arama
            $('#urunArama').on('input', function() {
                const aramaMetni = $(this).val().toLowerCase();

                $('.urun-item').each(function() {
                    const urunAdi = $(this).data('urun-adi');
                    if (urunAdi.includes(aramaMetni)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
</body>
</html>
