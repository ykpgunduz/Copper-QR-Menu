<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiloluk Tatlı Siparişi</title>
    <link rel="icon" href="{{ asset('img/favicon.png') }}">
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-800">
    <!-- Ödeme Uyarı Banner'ı -->
    <div class="bg-red-600 text-white px-4 py-3 shadow-lg">
        <div class="max-w-8xl mx-auto flex items-center justify-center">
            <svg class="h-12 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <div id="countdown" class="ml-4 font-bold"></div>
        </div>
    </div>

    <script>
        // 12 Mart 2024 00:00'a kadar sayaç
        function startCountdown() {
            const targetDate = new Date('2025-03-12T00:00:00');

            function updateCountdown() {
                const currentTime = new Date();
                const timeDiff = targetDate - currentTime;

                if (timeDiff <= 0) {
                    document.getElementById('countdown').innerHTML = 'Süre doldu!';
                    return;
                }

                const hours = Math.floor(timeDiff / (1000 * 60 * 60));
                const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);

                document.getElementById('countdown').innerHTML =
                    `Sistemi kullanmaya devam edebilmek için ${hours}:${minutes < 10 ? '0' : ''}${minutes}:${seconds < 10 ? '0' : ''}${seconds} içerisinde ödeme yapınız. Aksi halde sistem kapancaktır!`;
            }

            updateCountdown();
            setInterval(updateCountdown, 1000);
        }

        startCountdown();
    </script>
    <div class="min-h-screen py-4">
        <div class="max-w-8xl mx-auto sm:px-6">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="mb-6">
                                <!-- Kiloluk Tatlılar Bölümü -->
                                <div class="pt-2">
                                    <h3 class="text-lg font-semibold mb-4">Tatlı Seçip - Gramaj Giriniz</h3>
                                    <div class="flex gap-4 items-start">
                                        <!-- Sol taraf: Seçilen ürün -->
                                        <div class="w-1/2">
                                            <div id="selectedProduct"
                                                 class="h-[56px] p-3 border-2 rounded-md bg-gray-50 flex flex-col justify-center"
                                                 style="border-color: #22c55e;">
                                                <div class="text-gray-500 text-xs">Seçilen Ürün:</div>
                                                <div class="selected-product-info text-gray-900 font-medium">Listeden bir ürün seçin</div>
                                            </div>
                                        </div>

                                        <!-- Sağ taraf: Gram girişi -->
                                        <div class="w-1/2">
                                            <div class="flex gap-2">
                                                <input type="number"
                                                       id="weight"
                                                       class="flex-1 rounded-md border-2 shadow-sm p-3 text-lg font-medium focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                                       placeholder="Gram giriniz"
                                                       step="1"
                                                       style="border-color: #22c55e;">
                                                <button id="addToCart"
                                                        class="bg-green-600 text-white px-3 py-3 rounded-md hover:bg-green-700 whitespace-nowrap font-medium">
                                                    ⏎ Enter
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-5">
                                    @foreach($products as $product)
                                        @if($product->active && $product->category->name === 'Kiloluk Tatlılar')
                                            <div class="pl-2 pt-3 pb-3 border-2 border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer product-item"
                                                 data-id="{{ $product->id }}"
                                                 data-name="{{ $product->title }}"
                                                 data-price="{{ $product->price }}"
                                                 data-type="weight">
                                                <div class="flex flex-col">
                                                    <span class="text-sm font-bold text-gray-800 mb-1">{{ $product->title }}</span>
                                                    <span class="text-sm font-medium text-green-600">{{ $product->price }}₺ / kg</span>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                <!-- Adetli Tatlılar Bölümü -->
                                <div class="pt-8">
                                    <h3 class="text-lg font-semibold mb-4">Adetli Tatlılar</h3>
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                        @foreach($products as $product)
                                            @if($product->active && $product->category->name === 'Tatlılar')
                                                <div class="pl-2 pt-3 pb-3 border-2 border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer piece-product-item relative"
                                                     data-id="{{ $product->id }}"
                                                     data-name="{{ $product->title }}"
                                                     data-price="{{ $product->price }}"
                                                     data-type="piece">
                                                    <div class="flex flex-col">
                                                        <span class="text-sm font-bold text-gray-800 mb-1">{{ $product->title }}</span>
                                                        <span class="text-sm font-medium text-green-600">{{ $product->price }}₺ / adet</span>
                                                    </div>
                                                    <!-- Adet göstergesi -->
                                                    <div class="quantity-badge hidden absolute -top-2 -right-2 bg-green-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold">0</div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sağ Taraf: Sepet -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4">Sipariş Listesi</h3>
                            <div id="cartItems" class="space-y-4 mb-6">
                                <!-- Sepet öğeleri buraya eklenecek -->
                            </div>

                            <div class="border-t pt-4">
                                <div class="flex justify-between items-center mb-4">
                                    <span class="font-semibold">Toplam Tutar:</span>
                                    <span id="totalPrice" class="text-xl font-bold text-green-600">0.00 TL</span>
                                </div>

                                <form action="{{ route('orders.store-by-weight') }}" method="POST" id="orderForm">
                                    @csrf
                                    <input type="hidden" name="order_items" id="orderItems">
                                    <input type="hidden" name="table_number" id="table_number">
                                    <input type="hidden" name="payment_method" id="paymentMethod">

                                    <!-- Tahsilat Tutarı -->
                                    <div class="mb-6">
                                        <label class="block text-lg font-medium text-gray-700 mb-2">Tahsilat Tutarı</label>
                                        <div class="relative">
                                            <input type="number"
                                                   name="received_amount"
                                                   id="receivedAmount"
                                                   class="w-full h-14 text-2xl font-bold rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 pl-4 pr-12"
                                                   placeholder="0"
                                                   step="0.01"
                                                   onkeypress="return event.keyCode != 13;">
                                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xl font-bold text-gray-500">₺</span>
                                        </div>
                                        <div class="mt-2 flex justify-between items-center">
                                            <div>
                                                <span class="text-sm text-gray-500">İkram Tutarı: </span>
                                                <span id="ikramTutari" class="text-lg font-medium text-orange-600">0.00 ₺</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-3 gap-3">
                                        <button type="submit"
                                                class="payment-btn bg-yellow-500 text-white px-4 py-3 rounded-md hover:bg-yellow-600 font-medium"
                                                data-method="nakit">
                                            NAKİT
                                        </button>
                                        <button type="submit"
                                                class="payment-btn bg-blue-500 text-white px-4 py-3 rounded-md hover:bg-blue-600 font-medium"
                                                data-method="kart">
                                            KART
                                        </button>
                                        <button type="submit"
                                                class="payment-btn bg-green-500 text-white px-4 py-3 rounded-md hover:bg-green-600 font-medium"
                                                data-method="iban">
                                            IBAN
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedProduct = null;
        let cartItems = [];

        // Rastgele masa numarası oluştur (30-40 arası)
        const randomTableNumber = Math.floor(Math.random() * (40 - 30 + 1)) + 30;
        document.getElementById('table_number').value = randomTableNumber;

        // Ürün seçimi
        document.querySelectorAll('.product-item').forEach(item => {
            item.addEventListener('click', function() {
                // Önceki seçili ürünün vurgusunu kaldır
                document.querySelectorAll('.product-item').forEach(p => {
                    p.classList.remove('ring-2', 'ring-green-500');
                });

                // Yeni seçilen ürünü vurgula
                this.classList.add('ring-2', 'ring-green-500');

                selectedProduct = {
                    id: this.dataset.id,
                    name: this.dataset.name,
                    price: parseFloat(this.dataset.price)
                };

                // Seçilen ürün bilgisini güncelle
                document.querySelector('.selected-product-info').innerHTML = `
                    <div class="flex items-center justify-between">
                        <span class="truncate">${selectedProduct.name}</span>
                        <span class="text-green-600 whitespace-nowrap">${selectedProduct.price}₺ / kg</span>
                    </div>
                `;

                // Gram input'una fokuslan
                document.getElementById('weight').focus();
            });
        });

        // Sepete ekleme
        document.getElementById('addToCart').addEventListener('click', function() {
            if (!selectedProduct) {
                alert('Lütfen bir ürün seçin');
                return;
            }

            const weight = parseFloat(document.getElementById('weight').value);
            if (!weight || weight <= 0) {
                alert('Lütfen geçerli bir gramaj girin');
                return;
            }

            const totalPrice = (selectedProduct.price * weight / 1000).toFixed(2);
            const cartItem = {
                product_id: selectedProduct.id,
                name: selectedProduct.name,
                weight: weight,
                price: totalPrice
            };

            cartItems.push(cartItem);
            updateCart();
            document.getElementById('weight').value = '';
        });

        // Enter tuşu ile ekleme fonksiyonu
        document.getElementById('weight').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Formun submit olmasını engelle
                document.getElementById('addToCart').click(); // Ekle butonunu tetikle
            }
        });

        // İkram tutarı hesaplama
        document.getElementById('receivedAmount').addEventListener('input', function() {
            const totalAmount = parseFloat(document.getElementById('totalPrice').textContent) || 0;
            const receivedAmount = parseFloat(this.value) || 0;
            const ikramAmount = Math.max(0, totalAmount - receivedAmount);

            document.getElementById('ikramTutari').textContent = ikramAmount.toFixed(2) + ' ₺';
        });

        // Ödeme işlemleri
        document.querySelectorAll('.payment-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                if (cartItems.length === 0) {
                    alert('Lütfen sepete en az bir ürün ekleyin');
                    return;
                }

                const receivedAmount = parseFloat(document.getElementById('receivedAmount').value) || 0;
                const totalAmount = parseFloat(document.getElementById('totalPrice').textContent);

                if (receivedAmount <= 0) {
                    alert('Lütfen tahsilat tutarını giriniz');
                    return;
                }

                if (receivedAmount > totalAmount) {
                    alert('Tahsilat tutarı toplam tutardan büyük olamaz');
                    return;
                }

                const method = this.dataset.method;
                document.getElementById('paymentMethod').value = method;
                document.getElementById('orderForm').submit();
            });
        });

        // IBAN Modal kapat
        function closeIbanModal() {
            document.getElementById('ibanModal').classList.add('hidden');
        }

        // Adetli ürün seçimi için event listener
        document.querySelectorAll('.piece-product-item').forEach(item => {
            item.addEventListener('click', function() {
                const product = {
                    id: this.dataset.id,
                    name: this.dataset.name,
                    price: parseFloat(this.dataset.price),
                    type: 'piece'
                };

                const existingItemIndex = cartItems.findIndex(item =>
                    item.product_id === product.id && item.type === 'piece'
                );

                if (existingItemIndex !== -1) {
                    cartItems[existingItemIndex].quantity += 1;
                    cartItems[existingItemIndex].price = (product.price * cartItems[existingItemIndex].quantity).toFixed(2);
                } else {
                    const cartItem = {
                        product_id: product.id,
                        name: product.name,
                        weight: null,
                        quantity: 1,
                        price: product.price.toFixed(2),
                        type: 'piece'
                    };
                    cartItems.push(cartItem);
                }

                // Animasyon efekti ekle
                const badge = this.querySelector('.quantity-badge');
                badge.classList.add('scale-125');
                setTimeout(() => {
                    badge.classList.remove('scale-125');
                }, 200);

                updateCart();
            });
        });

        // UpdateCart fonksiyonunu güncelle
        function updateCart() {
            const cartItemsDiv = document.getElementById('cartItems');
            cartItemsDiv.innerHTML = '';
            let total = 0;

            // Tüm adet rozetlerini sıfırla
            document.querySelectorAll('.quantity-badge').forEach(badge => {
                badge.classList.add('hidden');
                badge.textContent = '0';
            });

            // Sepetteki ürünlerin adet rozetlerini güncelle
            cartItems.forEach(item => {
                if (item.type === 'piece') {
                    const productCard = document.querySelector(`.piece-product-item[data-id="${item.product_id}"]`);
                    if (productCard) {
                        const badge = productCard.querySelector('.quantity-badge');
                        badge.classList.remove('hidden');
                        badge.textContent = item.quantity;
                    }
                }
            });

            cartItems.forEach((item, index) => {
                total += parseFloat(item.price);
                const quantityText = item.type === 'piece' ?
                    `${item.quantity} Adet` :
                    `${item.weight}gr`;

                cartItemsDiv.innerHTML += `
                    <div class="flex justify-between items-center p-3 bg-white rounded-lg">
                        <div>
                            <div class="font-medium">${item.name}</div>
                            <div class="text-sm text-gray-500">${quantityText}</div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-2">
                                ${item.type === 'piece' ? `
                                    <button onclick="decreaseQuantity(${index})" class="text-gray-500 hover:text-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <span class="mx-2">${item.quantity}</span>
                                    <button onclick="increaseQuantity(${index})" class="text-gray-500 hover:text-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                ` : ''}
                            </div>
                            <span class="font-medium">${item.price} TL</span>
                            <button onclick="removeItem(${index})" class="text-red-500 hover:text-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                `;
            });

            const totalPrice = total.toFixed(2);
            const flooredPrice = Math.floor(total); // Virgülden önceki kısım
            const ikramAmount = (total - flooredPrice).toFixed(2); // Virgülden sonraki kısım

            document.getElementById('totalPrice').textContent = totalPrice + ' ₺';
            document.getElementById('orderItems').value = JSON.stringify(cartItems);

            // Tahsilat tutarını otomatik doldur (tam sayı olarak)
            const receivedInput = document.getElementById('receivedAmount');
            receivedInput.value = flooredPrice;

            // İkram tutarını güncelle (kuruşlar)
            document.getElementById('ikramTutari').textContent = ikramAmount + ' ₺';
        }

        function removeItem(index) {
            cartItems.splice(index, 1);
            updateCart();
        }

        // Adet arttırma fonksiyonu
        function increaseQuantity(index) {
            const item = cartItems[index];
            const basePrice = parseFloat(item.price) / item.quantity;
            item.quantity += 1;
            item.price = (basePrice * item.quantity).toFixed(2);
            updateCart();
        }

        // Adet azaltma fonksiyonu
        function decreaseQuantity(index) {
            const item = cartItems[index];
            if (item.quantity > 1) {
                const basePrice = parseFloat(item.price) / item.quantity;
                item.quantity -= 1;
                item.price = (basePrice * item.quantity).toFixed(2);
                updateCart();
            } else {
                removeItem(index);
            }
        }
    </script>

    <!-- Style eklemeleri -->
    <style>
        .quantity-badge {
            transition: transform 0.2s ease-in-out;
        }

        /* Input için özel stil */
        input[type="number"] {
            -moz-appearance: textfield;
        }

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Input placeholder stil */
        input[type="number"]::placeholder {
            color: #9ca3af;
            font-weight: normal;
        }
    </style>
</body>
</html>
