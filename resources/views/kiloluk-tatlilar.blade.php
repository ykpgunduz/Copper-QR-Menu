<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <title>Menü | Copper</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/menu.css" rel="stylesheet">
</head>

<body class="text-nav">
    <div class="container-fluid bg-white p-0">
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Yükleniyor...</span>
            </div>
        </div>
        <nav class="navbar d-flex justify-content-center">
            <img class="logo-underground" src="{{ asset('img/logo.png') }}" alt="Logo" style="width: 80px">
        </nav>
        <div class="container py-5">
            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                <h2 class="section-title mb-4" style="font-family: 'Pacifico', cursive;">Copper Kiloluk Tatlılar</h2>
                <div class="tab-content">
                    <div class="tab-pane fade show active p-0">
                        <div class="row g-4">
                            <div class="menu-grid">
                            @foreach ($products as $product)
                            @if($product->active)
                                <div class="menu-item">
                                    <div class="position-relative">
                                        <img class="flex-shrink-0 img-fluid"
                                        src="{{ $product->thumbnail && file_exists(public_path('storage/img/' . $product->thumbnail)) ? asset('storage/img/' . $product->thumbnail) : asset('img/kafe-logo.png') }}"
                                        alt="{{ $product->title }}">
                                    </div>
                                    <div class="item-info">
                                        <h3>{{ $product->title }}</h3>
                                        <h4>{{ $product->price }}₺</h4>
                                    </div>
                                </div>
                            @endif
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Start -->
        <div class="container-fluid bg-black footer pt-4 wow fadeIn" data-wow-delay="0.1s">
            <div class="container">
                <div class="contact-card">
                    <div class="contact-header">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="footer-logo" style="width: 80px;">
                        <h4 class="contact-title">Copper Coffee Shop</h4>
                    </div>
                    <div class="contact-info">
                        <a href="tel:{{ $cafe->phone }}" class="contact-link">
                            <i class="fa fa-phone contact-icon"></i>
                            <span>{{ $cafe->phone }}</span>
                        </a>
                        <a href="{{ $cafe->address_link }}" target="_blank" class="contact-link">
                            <i class="fa fa-map-marker-alt contact-icon"></i>
                            <span>{{ $cafe->address }}</span>
                        </a>
                        <div class="social-links">
                            <a class="social-link" target="_blank" href="{{ $cafe->insta_link }}" aria-label="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="copyright">
                    <a href="https://harpysocial.com" target="_blank" class="copyright-link">
                        <img src="{{ asset('img/footer-logo.png') }}" alt="Logo" class="footer-logo">
                        Harpy Social &copy; 2025
                    </a>
                    <span class="copyright-divider">|</span>
                    <span>Tüm Hakları Saklıdır.</span>
                </div>
            </div>
        </div>
        <!-- Footer End -->
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/menu.js"></script>

</body>

</html>
