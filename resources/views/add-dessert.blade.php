<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Copper | Kiloluk Tatlı</title>
    <link rel="icon" href="{{ asset('img/favicon.png') }}">
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-800">
    <div class="min-h-screen py-6">
        <div class="max-w-8xl mx-auto sm:px-6">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="mb-6">
                                <div class="pt-4">
                                    <h3 class="text-lg font-semibold mb-4">Tatlı Seçip - Gramaj Giriniz</h3>
                                    <div class="space-y-4">
                                        <div id="selectedProduct" class="text-gray-900">Lütfen listeden bir ürün seçin</div>
                                        <div class="flex gap-4">
                                            <input type="number" id="weight" class="flex-1 rounded-md border-gray-300 shadow-sm p-2 border"
                                                   placeholder="gram giriniz" step="1" style="border-color: green;">
                                            <button id="addToCart" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                                                Ekle
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-5">
                                    @foreach($products as $product)
                                        @if($product->active)
                                            <div class="p-3 border rounded-lg hover:bg-gray-50 cursor-pointer product-item"
                                                 data-id="{{ $product->id }}"
                                                 data-name="{{ $product->title }}"
                                                 data-price="{{ $product->price }}">
                                                <div class="flex flex-col">
                                                    <span class="font-medium text-sm mb-1">{{ $product->title }}</span>
                                                    <span class="text-green-600 text-sm">{{ $product->price }}₺</span>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
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
                                                   placeholder="0.00"
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
                document.getElementById('selectedProduct').innerHTML = `
                    <div class="font-medium">${selectedProduct.name}</div>
                    <div class="text-green-600">${selectedProduct.price}₺</div>
                `;
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

        // UpdateCart fonksiyonunu güncelle
        function updateCart() {
            const cartItemsDiv = document.getElementById('cartItems');
            cartItemsDiv.innerHTML = '';
            let total = 0;

            cartItems.forEach((item, index) => {
                total += parseFloat(item.price);
                cartItemsDiv.innerHTML += `
                    <div class="flex justify-between items-center p-3 bg-white rounded-lg">
                        <div>
                            <div class="font-medium">${item.name}</div>
                            <div class="text-sm text-gray-500">${item.weight}gr</div>
                        </div>
                        <div class="flex items-center gap-4">
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
    </script>
</body>
</html>
