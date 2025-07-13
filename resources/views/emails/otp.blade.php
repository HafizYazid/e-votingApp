<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kode OTP Pemilihan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .otp-code {
            background-color: #007bff;
            color: white;
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            padding: 20px;
            border-radius: 8px;
            letter-spacing: 3px;
            margin: 20px 0;
        }
        .info {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Kode OTP Pemilihan UPI</h1>
            @if($userName)
                <p>Halo <strong>{{ $userName }}</strong>,</p>
            @endif
            <p>Gunakan kode OTP berikut untuk melakukan verifikasi</p>
        </div>
        
        <div class="otp-code">
            {{ $otp }}
        </div>
        
        <div class="info">
            <p><strong>Penting:</strong></p>
            <ul>
                <li>Kode OTP ini berlaku selama <strong>2 menit</strong></li>
                <li>Jangan bagikan kode ini kepada siapa pun</li>
                <li>Gunakan kode ini hanya untuk verifikasi pemilihan</li>
            </ul>
        </div>
        
        <div class="footer">
            <p>Email ini dikirim secara otomatis dari sistem PEMIRA UPI</p>
            <p>Jika Anda tidak meminta kode OTP ini, abaikan email ini</p>
        </div>
    </div>
</body>
</html>