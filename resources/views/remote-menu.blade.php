<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <title>Copper Cafe Menü</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            width: 100%;
            overflow: hidden;
        }

        #pdfViewer {
            width: 100%;
            height: 100%;
            border: none;
            display: block;
            position: fixed;
            top: 0;
            left: 0;
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
    </style>
</head>
<body>
    <iframe id="pdfViewer" src="{{ asset('pdf/menu.pdf') }}#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf"></iframe>
    <a href="https://wa.me/905358298020" target="_blank" class="whatsapp-btn">
        <i class="fa-brands fa-whatsapp"></i>
    </a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        // PDF.js worker'ı ayarla
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js';

        // Sayfa yüklendiğinde PDF'in tam ekran görüntülenmesi
        window.addEventListener('load', function() {
            const pdfViewer = document.getElementById('pdfViewer');
            pdfViewer.style.height = window.innerHeight + 'px';
        });

        // Ekran boyutu değiştiğinde PDF boyutunu güncelle
        window.addEventListener('resize', function() {
            const pdfViewer = document.getElementById('pdfViewer');
            pdfViewer.style.height = window.innerHeight + 'px';
        });
    </script>
</body>
</html>
