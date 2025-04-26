<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menü Seçimi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 20px;
        }

        .container {
            text-align: center;
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 1.5rem;
            font-size: 2rem;
        }

        .welcome-text {
            color: #7f8c8d;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .menu-button {
            padding: 1rem 2rem;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            text-decoration: none;
            color: white;
        }

        .turkish {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        }

        .english {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        }

        .menu-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 480px) {
            .container {
                padding: 1.5rem;
            }

            h1 {
                font-size: 1.5rem;
            }

            .menu-button {
                padding: 0.8rem 1.5rem;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hoş Geldiniz</h1>
        <p class="welcome-text">Lütfen menünüzü görüntülemek için dil seçeneğini seçiniz.</p>
        <div class="button-container">
            <a href="{{ route('tr-remote-menu') }}" class="menu-button turkish">Türkçe Menü İçin Tıklayınız</a>
            <a href="{{ route('en-remote-menu') }}" class="menu-button english">English Menu Click Here</a>
        </div>
    </div>
</body>
</html>
