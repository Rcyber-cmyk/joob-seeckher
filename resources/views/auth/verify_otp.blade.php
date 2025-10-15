<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - Messari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #263341; color: #ffffff; }
        .verify-container { display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 2rem; }
        .verify-box { background-color: #2d3748; padding: 2.5rem; border-radius: 1rem; max-width: 500px; width: 100%; text-align: center; box-shadow: 0 10px 25px rgba(0,0,0,0.3); }
        .verify-box h2 { font-weight: 700; color: #ffffff; margin-bottom: 1rem; }
        .verify-box p { color: #a0aec0; }
        .btn-verify { background-color: #f97316; border: none; color: white; padding: 0.75rem 1.5rem; font-weight: bold; border-radius: 0.5rem; transition: all 0.3s ease; width: 100%; font-size: 1rem; }
        .btn-verify:hover { background-color: #fb923c; color: white; }
        .btn-verify:disabled { background-color: #4a5568; cursor: not-allowed; }
        
        .otp-input-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 2rem 0;
        }
        .otp-input {
            width: 50px;
            height: 60px;
            font-size: 1.75rem;
            text-align: center;
            border-radius: 0.5rem;
            background-color: #4a5568 !important;
            border: 1px solid #4a5568 !important;
            color: white !important;
            -moz-appearance: textfield; /* Firefox */
        }
        .otp-input::-webkit-outer-spin-button,
        .otp-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .otp-input:focus {
            border-color: #f97316 !important;
            box-shadow: 0 0 0 0.25rem rgba(249, 115, 22, 0.25) !important;
        }
    </style>
</head>
<body>
<div class="verify-container">
    <div class="verify-box">
        <i class="bi bi-shield-lock-fill fs-1" style="color: #f97316;"></i>
        <h2 class="mt-3">Masukkan Kode OTP</h2>
        <p>Kami telah mengirimkan 4 digit kode verifikasi ke email Anda. Silakan masukkan di bawah ini.</p>
        
        <form id="otpForm" method="POST" action="{{ route('otp.verification.verify') }}">
            @csrf
            
            <!-- Hidden input to combine OTP -->
            <input type="hidden" name="otp" id="otp_hidden_input">

            <!-- Visible OTP inputs -->
            <div class="otp-input-container">
                <input type="number" class="form-control otp-input" id="otp-1" maxlength="1" required>
                <input type="number" class="form-control otp-input" id="otp-2" maxlength="1" required>
                <input type="number" class="form-control otp-input" id="otp-3" maxlength="1" required>
                <input type="number" class="form-control otp-input" id="otp-4" maxlength="1" required>
            </div>

            @error('otp')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-verify" id="verifyBtn" disabled>Verifikasi</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const otpInputs = document.querySelectorAll('.otp-input');
        const hiddenInput = document.getElementById('otp_hidden_input');
        const otpForm = document.getElementById('otpForm');
        const verifyBtn = document.getElementById('verifyBtn');

        otpInputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                // Allow only one digit
                if (input.value.length > 1) {
                    input.value = input.value.slice(0, 1);
                }

                // Move to the next input if a digit is entered
                if (input.value && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
                
                updateHiddenInputAndButton();
            });

            input.addEventListener('keydown', (e) => {
                // Move to the previous input on backspace if current is empty
                if (e.key === 'Backspace' && !input.value && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });
        });
        
        function updateHiddenInputAndButton() {
            let otp = '';
            otpInputs.forEach(input => {
                otp += input.value;
            });
            hiddenInput.value = otp;
            
            // Enable button only if all 4 digits are filled
            if (otp.length === 4) {
                verifyBtn.disabled = false;
            } else {
                verifyBtn.disabled = true;
            }
        }
    });
</script>

</body>
</html>
