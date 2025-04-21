<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <title>Copper Cafe Menü</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
        }

        html, body {
            height: 100%;
            width: 100%;
            overflow-x: hidden;
            touch-action: pan-y;
        }

        #pdfContainer {
            width: 100%;
            padding: 10px;
        }

        .pdf-page {
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        .pdf-page canvas {
            width: 100% !important;
            height: auto !important;
            display: block;
        }

        .whatsapp-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #25D366;
            color: white;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 40px;
            z-index: 9999;
        }

        .whatsapp-btn:hover {
            background: #128C7E;
            color: white;
            transform: scale(1.1);
        }

        .loading {
            text-align: center;
            padding: 20px;
            font-size: 18px;
            color: #666;
        }

        .zoom-controls {
            position: fixed;
            bottom: 90px;
            right: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            z-index: 9998;
        }

        .zoom-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            color: #333;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            cursor: pointer;
            font-size: 20px;
        }

        @media (max-width: 768px) {
            #pdfContainer {
                padding: 5px;
            }

            .pdf-page {
                margin-bottom: 10px;
            }

            .whatsapp-btn {
                width: 50px;
                height: 50px;
                font-size: 30px;
            }

            .zoom-controls {
                bottom: 80px;
            }

            .zoom-btn {
                width: 35px;
                height: 35px;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div id="pdfContainer"></div>
    <div id="loading" class="loading">Menü yükleniyor...</div>
    <div class="zoom-controls">
        <button class="zoom-btn" onclick="zoomIn()">+</button>
        <button class="zoom-btn" onclick="zoomOut()">-</button>
    </div>
    <a href="https://wa.me/905358298020" target="_blank" class="whatsapp-btn">
        <i class="fa-brands fa-whatsapp"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // PDF.js worker'ı ayarla
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js';

        let pdfDoc = null;
        let pageNum = 1;
        let pageRendering = false;
        let pageNumPending = null;
        let currentScale = 1.0;
        const container = document.getElementById('pdfContainer');
        const loading = document.getElementById('loading');

        // Zoom fonksiyonları
        function zoomIn() {
            currentScale += 0.1;
            renderAllPages();
        }

        function zoomOut() {
            if (currentScale > 0.5) {
                currentScale -= 0.1;
                renderAllPages();
            }
        }

        // Tüm sayfaları yeniden render et
        function renderAllPages() {
            container.innerHTML = '';
            pageNum = 1;
            renderPage(pageNum);
        }

        // PDF'i yükle
        pdfjsLib.getDocument("{{ asset('pdf/menu.pdf') }}").promise.then(function(pdf) {
            pdfDoc = pdf;
            loading.style.display = 'none';
            renderPage(pageNum);
        });

        // Sayfa render etme fonksiyonu
        function renderPage(num) {
            pageRendering = true;
            pdfDoc.getPage(num).then(function(page) {
                const viewport = page.getViewport({ scale: currentScale });
                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                const pageDiv = document.createElement('div');
                pageDiv.className = 'pdf-page';
                pageDiv.appendChild(canvas);
                container.appendChild(pageDiv);

                const renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };

                const renderTask = page.render(renderContext);
                renderTask.promise.then(function() {
                    pageRendering = false;
                    if (pageNumPending !== null) {
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }
                });
            });

            // Sonraki sayfayı hazırla
            if (num < pdfDoc.numPages) {
                pageNum++;
                setTimeout(() => {
                    if (!pageRendering) {
                        renderPage(pageNum);
                    } else {
                        pageNumPending = pageNum;
                    }
                }, 50);
            }
        }

        // Scroll event listener
        window.addEventListener('scroll', function() {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 100) {
                if (!pageRendering && pageNum <= pdfDoc.numPages) {
                    renderPage(pageNum);
                }
            }
        });

        // Dokunmatik zoom engelleme
        document.addEventListener('touchmove', function(e) {
            if (e.touches.length > 1) {
                e.preventDefault();
            }
        }, { passive: false });
    </script>
</body>
</html>
