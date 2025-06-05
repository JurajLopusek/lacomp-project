<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Správa z kontaktného formulára</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #fbeaea, #fff5f5);
            margin: 0;
            padding: 0;
            color: #333;
        }

        .email-wrapper {
            max-width: 700px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(139, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background-color: #8B0000;
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: white;

        }

        .content {
            padding: 30px 25px;
        }

        .section {
            padding: 30px;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #8B0000;
            margin-bottom: 5px;
        }

        .message-box {
            background-color: #fff0f0;
            border-left: 5px solid #c0392b;
            padding: 15px 20px;
            font-size: 15px;
            line-height: 1.6;
            border-radius: 4px;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        a {
            color: #8B0000;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

<div class="email-wrapper">
    <div class="header">
        <h1>📥 Nová správa z kontaktného formulára</h1>
    </div>

    <div class="content">
        <div class="section">
            <div class="section-title">Meno odosielateľa</div>
            <div class="message-box">{{ $contactData['name'] }}</div>
        </div>

        <div class="section">
            <div class="section-title">Emailová adresa</div>
            <div class="message-box"><a href="mailto:{{ $contactData['email'] }}">{{ $contactData['email'] }}</a></div>
        </div>

        <div class="section">
            <div class="section-title">Obsah správy</div>
            <div class="message-box">
                {{ $contactData['message'] }}
            </div>
        </div>
    </div>
</div>

</body>
</html>
