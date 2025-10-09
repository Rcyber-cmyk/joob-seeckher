<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kode Reset Password</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; }
        .container { background-color: #ffffff; max-width: 600px; margin: 0 auto; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .header { text-align: center; border-bottom: 1px solid #eeeeee; padding-bottom: 20px; }
        .content { padding: 20px 0; text-align: center; font-size: 16px; line-height: 1.6; }
        .otp-code { font-size: 36px; font-weight: bold; color: #333333; letter-spacing: 5px; margin: 20px 0; padding: 15px; background-color: #f0f8ff; border-radius: 5px; }
        .footer { text-align: center; font-size: 12px; color: #888888; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Reset Password Anda</h2>
        </div>
        <div class="content">
            <p>Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda. Gunakan kode verifikasi di bawah ini:</p>
            
            <div class="otp-code">
                {{ $otp }}
            </div>
            
            <p>Kode ini hanya berlaku selama 10 menit. Jika Anda tidak merasa meminta reset password, abaikan email ini.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Nama Perusahaan Anda. Semua Hak Cipta Dilindungi.</p>
        </div>
    </div>
</body>
</html>

