<?php 
include 'navbar.php'; 

// پشکا فرێکرنا نامێ
$message_status = "";
if (isset($_POST['send_msg'])) {
    $name    = strip_tags(trim($_POST['name']));
    $email   = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = strip_tags(trim($_POST['message']));
    
    // ئیمێلێ تە یێ تو دڤێی نامە بۆ بهێت
    $to = "zhigrnajmaden@gmail.com";
    
    $subject = "نامەکا نوی ژ لایێ: $name";
    
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $body = "تە نامەکا نوی وەرگرت ل سەر مالپەرێ خۆ:\n\n";
    $body .= "ناڤێ نێرەری: $name\n";
    $body .= "ئیمێلێ نێرەری: $email\n";
    $body .= "نامە:\n$message\n";

    // فرێکرنا نامێ ب ڕێکا سێرڤەری
    if (mail($to, $subject, $body, $headers)) {
        $message_status = "success";
    } else {
        $message_status = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="ku" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پەیوەندی ب مە بکە</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;700&display=swap');
        body { background-color: #f0f2f5; font-family: 'Noto Sans Arabic', sans-serif; }
        .contact-box { background: #fff; border-radius: 25px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.1); border: none; }
        .info-side { background: linear-gradient(45deg, #1e3c72, #2a5298); color: white; padding: 50px; }
        .form-side { padding: 50px; background: white; }
        .form-control { border-radius: 12px; padding: 15px; border: 1px solid #eee; background: #f9f9f9; }
        .btn-send { background: #f39c12; color: white; border: none; padding: 15px; border-radius: 12px; font-weight: bold; width: 100%; transition: 0.3s; }
        .btn-send:hover { background: #d35400; transform: translateY(-3px); }
    </style>
</head>
<body>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card contact-box">
                <div class="row g-0">
                    <div class="col-md-5 info-side d-flex flex-column justify-content-center">
                        <h2 class="fw-bold mb-4">پەیوەندیێ ب مە بکە</h2>
                        <p class="mb-5 text-light">هەر پێشنیارەک یان پرسیارەک تە هەبیت، تو دشێی نامەیا خۆ ل ڤێرە بنڤیسی و دێ ڕاستەوخۆ گەهیتە مە.</p>
                        
                        <div><i class="fas fa-location-dot me-2 text-warning"></i>کوردستان - زاخو</div>
                    </div>
                    <div class="col-md-7 form-side text-end">
                        
                        <?php if($message_status == "success"): ?>
                            <div class="alert alert-success border-0 shadow-sm mb-4">نامەیا تە ب سەرکەفتی هاتە فرێکرن! سپاس بۆ پەیوەندیا تە.</div>
                        <?php elseif($message_status == "error"): ?>
                            <div class="alert alert-danger border-0 shadow-sm mb-4">ببوورە! نامە نەهاتە فرێکرن. سێرڤەرێ ئیمێلێ کار ناکەت.</div>
                        <?php endif; ?>

                        <form action="" method="POST">
                            <div class="mb-3">
                                <label class="form-label fw-bold">ناڤێ تە یێ سیانی</label>
                                <input type="text" name="name" class="form-control" placeholder="ناڤێ خۆ ل ڤێرە بنڤیسە" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">ئیمێلێ تە</label>



<input type="email" name="email" class="form-control" placeholder="example@gmail.com" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold">نامەیا تە</label>
                                <textarea name="message" class="form-control" rows="5" placeholder="نامەیا خۆ بۆ مە بنڤیسە..." required></textarea>
                            </div>
                            <button type="submit" name="send_msg" class="btn-send">
                                <i class="fas fa-paper-plane ms-2"></i> فرێکرنا نامێ
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="final-footer">
    <div class="container text-center">
        
       

        <hr class="footer-divider">

        <div class="footer-bottom-info">
            <p class="copyright-p">هەمی ماف پاراستینە © 2026</p>
            <p class="dev-p">DEVELOPER: <span class="my-name">zhigr najmaden</span></p>
        </div>

    </div>
</footer>

<style>
    /* ڕەنگێ ڕەشێ یەکسان دگەل مالپەری */
    .final-footer {
        background-color: #1e3c72;
        padding: 10px 0;
        margin-top: 60px;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    /* ڕێکخستنا ئایکۆنان ل نیڤێ */
    .social-links-container {
        display: flex;
        justify-content: center;
        gap: 25px;
    }

    /* ستایلێ بازنەیی بۆ ئایکۆنان دا کو گەلەک دیار بن */
    .icon-box {
        width: 55px;
        height: 55px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 24px;
        text-decoration: none;
        transition: transform 0.3s ease;
        background: rgba(255, 255, 255, 0.03); /* سێبەرەکا گەلەک تەنک */
    }

    /* ڕەنگێن هەمیشە دیار بۆ هەر ئایکۆنەکێ */
    .fb-color { color: #1877F2; border: 1px solid #1877F2; }
    .ig-color { color: #E4405F; border: 1px solid #E4405F; }
    .sc-color { color: #FFFC00; border: 1px solid #FFFC00; }
    .wa-color { color: #25D366; border: 1px solid #25D366; }

    /* جوولە دەمێ ماوس دچیتە سەر (تەنێ بۆ جوانیێ) */
    .icon-box:hover {
        transform: scale(1.15);
        background: rgba(255, 255, 255, 0.1);
    }

    .footer-divider {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        width: 300px;
        margin: 20px auto;
    }

    /* ستایلێ نڤیسینێ ل نیڤێ */
    .copyright-p {
        color: #f9f8f8f6;
        font-size: 15px;
        margin-bottom: 5px;
    }

    .dev-p {
        color: #ffffff;
        font-size: 13px;
        letter-spacing: 2px;
    }

    .my-name {
        color: #f39c12; /* ناڤێ تە ب پرتەقاڵی گەش */
        font-weight: bold;
        text-transform: uppercase;
    }
</style>
</body>
</html>