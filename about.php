
<?php include 'lang.php'; ?>
<?php 
// ئەگەر ناڤبار د فایلەکێ جودا دا بیت
include 'navbar.php'; 
?>

<!DOCTYPE html>
<html lang="ku" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>دەربارەی مە - ڕێبەریا کوردستانێ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* هێنانا فونتەکێ کوردی یێ جوان */
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;500;700&display=swap');

        body { 
            background-color: #fcfcfc; 
            font-family: 'Noto Sans Arabic', Tahoma, sans-serif; 
        }
        
        .about-header {
            background: linear-gradient(rgba(20, 40, 80, 0.85), rgba(30, 60, 114, 0.85)), url('images/kurd_bg.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 120px 0;
            text-align: center;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0% 100%);
        }

        .section-title {
            font-weight: 700;
            color: #1e3c72;
            margin-bottom: 25px;
            position: relative;
        }

        .about-text {
            font-size: 1.1rem;
            line-height: 2;
            color: #444;
        }

        .feature-card {
            border: none;
            border-radius: 20px;
            background: #ffffff;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            padding: 30px;
            height: 100%;
            cursor: pointer;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            background: #1e3c72;
            color: white !important;
        }

        .feature-card i {
            font-size: 45px;
            color: #f39c12;
            margin-bottom: 20px;
        }

        .feature-card:hover i {
            color: #ffffff;
        }

        /* لادانا خەتێ بن لینکێن کارتان */
        .card-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }
    </style>
</head>
<body>

<div class="about-header">
    <div class="container">
        <h1 class="display-3 fw-bold">ڕێبەریا کوردستانێ</h1>
        <p class="lead fs-3">ب خێرهاتی بۆ ناسینا جوانیێن وەڵاتێ مە</p>
    </div>
</div>

<div class="container my-5">
    <div class="row align-items-center g-5">
        <div class="col-lg-6">
            <h2 class="section-title h1">ئەم کینە؟</h2>
            <div class="about-text">
                <p>
                    ب خێرهاتی بۆ <strong>ڕێبەریا کوردستانێ</strong>. ئەڤە مەزنترین سەکۆیا گەشتیارییە بۆ ناساندنا باژێڕ و جهێن گەشتیاری یێن کوردستانێ. ئارمانجا مە ئەوە هەر گەشتیارەک ب ساناهی بگەهیتە زانیاریێن دروست ل سەر جهێن رەوشەنبیر و سروشتی.
                </p>
                <p>
                    ئەم باوەر دکەین کو کوردستان خودان سروشتەکێ بێ وێنە و دیرۆکەکا دەولەمەندە. لەورا ئەم ل ڤێرە هەول ددەین جوانترین وێنە و ڕاستترین زانیاریان پێشکێشی تە بکەین دا کو گەشتەکا خۆش و بێ یادگار دگەل مە ببورینی.
                </p>
            </div>
        </div>
        <div class="col-lg-6">
            <img src="images/about_image.jpg" class="img-fluid rounded-5 shadow-lg" alt="دەربارەی مە">
        </div>
    </div>

    <div class="row g-4 mt-5">
        
        <div class="col-md-4">
            <a href="https://www.google.com/maps/search/tourist+places+in+kurdistan" target="_blank" class="card-link">
                <div class="feature-card text-center">
                    <i class="fas fa-map-marked-alt"></i>
                    <h3>ڕێبەریا دروست</h3>
                    <p>هەمی باژێڕ و جهێن گەشتیاری ب هووربینی ل ڤێرە هاتینە دیارکرن.</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="https://www.google.com/search?q=kurdistan&rlz=1CDGOYI_enIQ1181IQ1181&hl=ar&sourceid=chrome-mobile&ie=UTF-8#ebo=0" target="_blank" class="card-link">
                <div class="feature-card text-center">
                    <i class="fas fa-camera"></i>
                    <h3>وێنێن ڕاستەقینە</h3>
                    <p>دابینکرنا نووترین و جوانترین وێنەیێن سروشتێ ڕەنگینێ کوردستانێ.</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="index.php" class="card-link">
                <div class="feature-card text-center">
                    <i class="fas fa-home"></i>
                    <h3>خزمەتەکا بێبەرامبەر</h3>
                    <p>ئارمانجا مە خزمەتە و ڤەگەڕیان بۆ لاپەڕێ سەرەکی یێ مالپەری.</p>
                </div>
            </a>
        </div>

    </div>
</div>

<footer class="bg-dark text-white text-center py-4 mt-5">
    <p class="mb-0">© 2026 ڕێبەریا کوردستانێ - هەمی ماف پاراستینە</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



</body>
</html>
