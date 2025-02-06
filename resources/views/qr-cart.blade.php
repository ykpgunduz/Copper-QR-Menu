<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <title>Sipariş Ürünleri | Copper</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
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
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/cart.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container-fluid bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Yükleniyor...</span>
            </div>
        </div>

        <nav class="navbar d-flex justify-content-center">
            <img class="logo-underground" src="{{ asset('img/logo.png') }}" alt="Logo" style="width: 80px">
        </nav>

        <div id="error-message" class="text-center" style="display: none; color: red;">Lütfen bir servis türü seçiniz!</div>


        <form action="{{ route('store') }}" method="POST" id="form1">
            @csrf
            <input type="hidden" name="cart_items" id="cart_items">
            <input type="hidden" name="table_number" value="{{ $tableNumber }}" class="form-control" required>
            <input type="hidden" name="session_id" value="{{ $sessionId }}" class="form-control" required>
            <input type="hidden" name="device_info" value="{{ $deviceInfo }}" class="form-control" required>
            <input type="hidden" name="status" id="status" value="service">

        <div class="container py-3">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-selection-container required">
                    <div class="service-header">
                        <h6 class="service-title">Servis Türü Seçiniz</h6>
                        <p class="service-subtitle">
                            Siparişinizi nasıl almak istersiniz?
                        </p>
                    </div>

                    <div class="mb-3 d-flex justify-content-center">
                        <div class="option me-2" id="Masa">
                            <i class="fas mb-3 fa-2xl fa-concierge-bell"></i>
                            <span>Masaya Servis</span>
                        </div>
                        <div class="option ms-2" id="Self">
                            <i class="fas fa-2xl mt-2 mb-4 fa-shopping-bag"></i>
                            <span>Self Servis</span>
                            <small>%5 İndirimli</small>
                        </div>
                    </div>
                </div>

                <script>
                    const options = document.querySelectorAll('.option');
                    const status = document.getElementById('status');

                    function showToast(type, message) {
                        $('.toast-message').remove();

                        const toast = $(`
                            <div class="toast-message toast-${type}">
                                <div class="toast-content">
                                    <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
                                    <span>${message}</span>
                                </div>
                            </div>
                        `);

                        $('body').append(toast);
                        setTimeout(() => toast.addClass('show'), 100);

                        setTimeout(() => {
                            toast.removeClass('show');
                            setTimeout(() => toast.remove(), 300);
                        }, 3000);
                    }

                    options.forEach(option => {
                        option.addEventListener('click', () => {
                            options.forEach(o => o.classList.remove('selected'));
                            option.classList.add('selected');
                            status.value = option.id;
                        });
                    });

                    document.getElementById('form1').addEventListener('submit', function (event) {
                        const status = document.getElementById('status').value;

                        if (!status || (status !== 'Masa' && status !== 'Self')) {
                            event.preventDefault();
                            showToast('error', 'Servis türü seçiniz.');
                        }
                    });

                    options.forEach(option => {
                        option.addEventListener('click', () => {
                            options.forEach(o => o.classList.remove('selected'));
                            option.classList.add('selected');
                            status.value = option.id;
                        });
                    });

                </script>
                    <div id="cart-items" class="cart-container">
                        @if(count($cartItems) == 0)
                        <div class="empty-cart">
                            <i class="fas fa-shopping-cart"></i>
                            <p>Sepetinizde ürün bulunmamaktadır.</p>
                        </div>
                        @else
                            @foreach ($cartItems as $cartItem)
                            <div class="cart-item" data-id="{{ $cartItem->id }}" data-price="{{ $cartItem->price }}">
                                <div class="cart-item-content">
                                    <img class="cart-item-image"
                                    src="{{ $cartItem->product->thumbnail && file_exists(public_path('img/' . $cartItem->product->thumbnail)) ? asset('img/' . $cartItem->product->thumbnail) : asset('img/cafe-logo.png') }}"
                                    alt="{{ $cartItem->product->title }}">
                                    <div class="cart-item-info">
                                        <h5 class="cart-item-title">{{ $cartItem->product->title }}</h5>
                                        <span class="cart-item-price">{{ $cartItem->price }}₺</span>
                                    </div>

                                    <div class="quantity-control">
                                        <button type="button" class="quantity-btn decrease-btn" data-id="{{ $cartItem->id }}">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="number" value="{{ $cartItem->quantity }}"
                                               class="quantity-input" id="quantity-{{ $cartItem->id }}" readonly>
                                        <button type="button" class="quantity-btn increase-btn" data-id="{{ $cartItem->id }}">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>

                                <input type="text"
                                       name="notes[{{ $cartItem->id }}]"
                                       class="note-input"
                                       placeholder="Sipariş notunuz... (opsiyonel)"
                                       value="{{ $cartItem->note ?? '' }}">
                            </div>
                            @endforeach

                            <div class="cart-summary">
                                <div class="total-amount">
                                    <span>Toplam Tutar</span>
                                    <span>{{ $totalAmount }}₺</span>
                                </div>
                            </div>
                        @endif

                        @if($products->where('star', true)->isNotEmpty())
                        <div class="recommended-products my-4">
                            <h5 class="text-center mb-3">Yanında İyi Gider...</h5>
                            <div class="recommended-carousel">
                                @foreach ($products->where('star', true) as $product)
                                <div class="recommended-product-card">
                                    <img src="{{ $product->thumbnail && file_exists(public_path('storage/img/' . $product->thumbnail)) ? asset('storage/img/' . $product->thumbnail) : asset('img/cafe-logo.png') }}" alt="{{ $product->title }}" style="max-width: 150px; height: auto; object-fit: cover;">
                                    <div class="info">
                                        <h6 class="product-title">{{ $product->title }}</h6>
                                        <div class="price-add">
                                            <span class="product-price">{{ $product->price }}₺</span>
                                            <button class="btn btn-sm btn-dark add-to-cart-btn" data-id="{{ $product->id }}"><i class="fa-solid fa-cart-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    </div>
            </div>
        </div>
        <!-- Menu End -->

        <div id="success-message" class="text-center" style="display: none; color: green;"></div>

    </div>

    <nav class="navbar navbar-expand-lg fixed-bottom">
        <div class="container d-flex justify-content-center my-2">
            <a href="{{ route('index', ['table' => $tableNumber]) }}" class="btn btn-light btn-md ms-2"><i class="fa-solid fa-book-open"></i> Menüye Dön</a>
            <button type="submit" form="form1" value="Submit" class="btn btn-success ms-3"><i class="fa-solid fa-circle-check"></i> Siparişi Onayla</button>
        </div>
    </nav>

</form>

    <!-- JavaScript Libraries -->
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

    <script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#form1').on('submit', function(e) {
            e.preventDefault();

            const selectedService = document.querySelector('.option.selected');
            if (!selectedService) {
                showToast('error', 'Servis türü seçiniz!');
                window.scrollTo({ top: 0, behavior: 'smooth' });
                return false;
            }

            // Butonu devre dışı bırak
            $('button[type="submit"]').prop('disabled', true);

            updateCartItems().then(() => {
                this.submit();
            }).catch(() => {
                // Hata durumunda butonu tekrar etkinleştir
                $('button[type="submit"]').prop('disabled', false);
            });
        });

        $('.option').on('click', function() {
            $('.option').removeClass('selected');
            $(this).addClass('selected');
            $('#status').val($(this).attr('id'));
        });

        async function updateCartItems() {
            try {
                const response = await $.ajax({
                    url: '/cart/get-items',
                    type: 'GET',
                    data: {
                        table: '{{ $tableNumber }}',
                        session_id: '{{ $sessionId }}'
                    }
                });

                $('#cart_items').val(JSON.stringify(response.cartItems));
            } catch (error) {
                console.error('Cart items güncellenirken hata:', error);
                showToast('error', 'Sipariş gönderilemedi');
                return false;
            }
        }

        // Miktar güncelleme işlemleri
        $('.increase-btn, .decrease-btn').on('click', function() {
            const productId = $(this).data('id');
            const change = $(this).hasClass('increase-btn') ? 1 : -1;
            const tableNumber = '{{ $tableNumber }}';

            $.ajax({
                url: '/cart/update/' + productId,
                type: 'POST',
                data: {
                    quantity_change: change,
                    table: tableNumber
                },
                success: function(response) {
                    if (response.success) {
                        const quantityInput = $(`#quantity-${productId}`);
                        let newQuantity = parseInt(quantityInput.val()) + change;

                        if (newQuantity <= 0) {
                            $(`[data-id="${productId}"]`).closest('.cart-item').fadeOut(300, function() {
                                $(this).remove();
                                if ($('.cart-item').length === 0) {
                                    $('#cart-items').html(`
                                        <div class="empty-cart">
                                            <i class="fas fa-shopping-cart"></i>
                                            <p>Sepetinizde ürün bulunmamaktadır.</p>
                                        </div>
                                    `);
                                }
                            });
                        } else {
                            quantityInput.val(newQuantity);
                        }

                        if (response.totalAmount) {
                            $('.total-amount span:last-child').text(response.totalAmount + '₺');
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Ajax Error:', error);
                    showToast('error', 'İşlem gerçekleştirilemedi');
                }
            });
        });
    });

    $(document).ready(function () {
        $('.add-to-cart-btn').on('click', function () {
            const productId = $(this).data('id');
            $.ajax({
                url: '/cart/add',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    product_id: productId,
                },
                success: function (response) {
                    if (response.success) {
                        showToast('success', 'Ürün sepete eklendi!');
                    } else {
                        showToast('error', 'Ürün sepete eklenemedi.');
                    }
                },
                error: function () {
                    showToast('error', 'Bir hata oluştu.');
                },
            });
        });
    });
    </script>

</body>
</html>
