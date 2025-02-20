<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=72mm, initial-scale=1.0">
    <title>Adisyon | Kiloluk Tatlı</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @page {
            size: 72mm auto;
            margin: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            width: 72mm;
            font-size: 12px;
            color: #333;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .container {
            width: 100%;
            padding: 0 2mm;
            box-sizing: border-box;
            margin-top: 0;
        }

        .header {
            margin-top: 0;
            margin-bottom: 1mm;
        }

        .header h1 {
            font-size: 18px;
            margin: 7px 0 0 0;
            font-weight: bold;
        }

        .header-info {
            font-size: 9px;
            line-height: 1.3;
        }

        .info {
            margin: 3mm 0 0 0;
            border-top: 1px dashed #000;
            padding: 3mm 0 1.5mm 0;
            display: flex;
            justify-content: space-between;
        }

        .info span {
            font-size: 12px;
            font-weight: bold;
        }

        .info-two {
            margin: 0 0 5mm 0;
            border-bottom: 1px dashed #000;
            padding: 1.5mm 0 3mm 0;
            display: flex;
            justify-content: space-between;
        }

        .info-two span {
            font-size: 12px;
            font-weight: bold;
        }

        .items {
            margin: 5mm 0;
        }

        .item-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3mm;
            font-size: 12px;
        }

        .item-name {
            flex: 1;
            text-align: left;
        }

        .total {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            font-size: 14px;
            margin-top: 5mm;
            padding: 4mm 0;
            border-top: 1px dashed #000;
            border-bottom: 1px dashed #000;
            margin-bottom: 0;
        }

        .payment-details {
            margin-top: 0;
            padding-top: 2mm;
            padding-bottom: 0;
            border-bottom: none;
        }

        .payment-title {
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 3mm;
            margin-top: 2mm;
            text-align: center;
            padding-bottom: 1mm;
        }

        .payment-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2mm;
            margin-bottom: 1mm;
        }

        .payment-row {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            margin-bottom: 2mm;
            align-items: center;
        }

        .payment-row.grid-item {
            margin-bottom: 0;
            min-width: 70px;
        }

        .payment-row.grid-item.left {
            justify-content: flex-start;
        }

        .payment-row.grid-item.right {
            justify-content: flex-end;
        }

        .payment-divider {
            border-top: 1px dotted #ccc;
            margin: 2mm 0;
        }

        .payment-row.ikram {
            color: #444;
            font-style: italic;
            font-weight: 500;
        }

        .contact-info {
            font-size: 10px;
            margin-top: 2mm;
            color: #444;
        }

        .item-name strong {
            font-weight: bold;
            color: #000;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }
        }
    </style>
    <script>
        window.onload = function() {
            // Otomatik yazdırma dialogu aç
            window.print();

            // 2 saniye sonra pencereyi kapat (yazdırma durumundan bağımsız olarak)
            setTimeout(function() {
                if (window.opener) {
                    window.close(); // Yeni pencerede açıldıysa kapat
                } else {
                    window.location.href = document.referrer || '/'; // Ana sayfaya veya önceki sayfaya dön
                }
            }, 2000);
        }

        // Yazdırma iptal edilse bile 2 saniye sonra kapanacak
        window.addEventListener('afterprint', function() {
            // Yazdırma tamamlandığında veya iptal edildiğinde
            setTimeout(function() {
                if (window.opener) {
                    window.close();
                } else {
                    window.location.href = document.referrer || '/';
                }
            }, 2000);
        });
    </script>
</head>
<body>
    <div class="container">
        <div class="header">
            <div style="display: flex; align-items: center; justify-content: center;">
                <img src="{{ asset('img/adisyon-logo.png') }}" alt="Logo" style="width: 45px; height: 45px; border-radius: 8px; margin-right: 3px;">
                <div style="display: flex; flex-direction: column; align-items: flex-start; justify-content: center;">
                    <h1>Copper</h1>
                    <div style="font-size: 12px; color: #444; margin: 2px 0 2px 1px; font-style: italic; font-weight: 500; letter-spacing: 0.5px;">Kahve & Tatlı</div>
                </div>
            </div>
        </div>

        <div class="info">
            <span>{{ now()->format('H:i') }}</span>
            <span>{{ now()->translatedFormat('d F Y l') }}</span>
        </div>

        <div class="info-two">
            <span>{{ $tableNumber }}. Masa</span>
            <span>{{ $orderNumber }}</span>
        </div>

        <div class="items">
            @foreach(explode("\n", $products) as $product)
                <div class="item-row">
                    <div class="item-name">
                        @php
                            if (strpos($product, ' x ') !== false) {
                                // Adetli ürün formatı: "3 x Magnolya - 120₺"
                                $parts = explode(' - ', $product);
                                $priceInfo = end($parts); // "120₺"
                                $productInfo = explode(' x ', $parts[0]); // ["3", "Magnolya"]
                                $quantity = $productInfo[0];
                                $name = $productInfo[1];
                                echo "<strong>{$quantity} x {$name}</strong> - {$priceInfo}";
                            } else {
                                // Kiloluk ürün formatı değişmedi
                                echo $product;
                            }
                        @endphp
                    </div>
                </div>
            @endforeach
        </div>

        <div class="total">
            <span>TOPLAM</span>
            <span>{{ number_format($totalAmount, 2) }}₺</span>
        </div>

        <div class="payment-details">
            <div class="payment-title">ÖDEME DETAYLARI</div>

            <div class="payment-grid">
                @if($cashMoney > 0)
                    <div class="payment-row grid-item left">
                        <span><i class="fa-solid fa-money-bill-1"></i>Nakit:</span>
                        <span>&nbsp;{{ number_format($cashMoney, 2) }}₺</span>
                    </div>
                @endif

                @if($creditCard > 0)
                    <div class="payment-row grid-item right">
                        <span><i class="fa-solid fa-credit-card"></i>Kart:</span>
                        <span>&nbsp;{{ number_format($creditCard, 2) }}₺</span>
                    </div>
                @endif

                @if($iban > 0)
                    <div class="payment-row grid-item {{ !$creditCard > 0 ? 'right' : 'left' }}">
                        <span><i class="fa-solid fa-university"></i>IBAN:</span>
                        <span>&nbsp;{{ number_format($iban, 2) }}₺</span>
                    </div>
                @endif
            </div>

            <div class="payment-divider"></div>

            <div class="payment-row total-paid full-width">
                <span>ÖDENEN TOPLAM:</span>
                <span>&nbsp;{{ number_format($netAmount, 2) }}₺</span>
            </div>

            @if($ikram > 0)
                <div class="payment-divider"></div>
                <div class="payment-row grid-item ikram">
                    <span><i class="fa-solid fa-gift"></i>İkram:</span>
                    <span>&nbsp;-{{ number_format($ikram, 2) }}₺</span>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
