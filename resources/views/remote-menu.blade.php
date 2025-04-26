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
            background: linear-gradient(135deg, #1a1a1a 0%, #2c3e50 100%);
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80') center/cover;
            opacity: 0.1;
            z-index: 0;
        }

        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.95);
            padding: 3rem;
            border-radius: 30px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            max-width: 800px;
            width: 100%;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(10px);
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 1.5rem;
            font-size: 2.5rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .welcome-text {
            color: #7f8c8d;
            margin-bottom: 3rem;
            line-height: 1.8;
            font-size: 1.2rem;
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 2rem;
        }

        .menu-button {
            padding: 1.2rem 2.5rem;
            border: none;
            border-radius: 15px;
            font-size: 1.2rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            color: white;
            flex: 1;
            max-width: 300px;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        .turkish {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        }

        .english {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        }

        .menu-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }

        .menu-button:hover::before {
            left: 100%;
        }

        .menu-button:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        @media (max-width: 768px) {
            .button-container {
                flex-direction: column;
                gap: 1rem;
            }

            .menu-button {
                max-width: 100%;
            }

            .container {
                padding: 2rem;
            }

            h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hoş Geldiniz</h1>
        <p class="welcome-text">Menüyü hangi dilde<br>görüntülemek istersiniz?</p>
        <div class="button-container">
            <a href="{{ route('tr-remote-menu') }}" class="menu-button turkish">Türkçe Menü</a>
            <a href="{{ route('en-remote-menu') }}" class="menu-button english">English Menu</a>
        </div>
    </div>
</body>
</html>
