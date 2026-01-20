<?php
// ژبۆ وێ چەندێ ئەگەر ئەڤ فایلە ب تەنێ هاتە کرن، سیشن هەبیت
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$current_lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : "ku";

// فەرهەنگا وەرگێڕانا مینوویا ناڤبەرێ
$nav_trans = [
    "ku" => [
        "home" => "سەرەکی",
        "about" => "دەربارەی مە",
        "contact" => "هنارتنا نامەکێ",
        "search_placeholder" => "بگەڕییە...",
        "search_btn" => "گەڕیان",
        "lang_name" => "زمان",
        "dir" => "rtl"
    ],
    "ar" => [
        "home" => "الرئيسية",
        "about" => "حول الموقع",
        "contact" => "أرسل رسالة",
        "search_placeholder" => "ابحث هنا...",
        "search_btn" => "بحث",
        "lang_name" => "اللغة",
        "dir" => "rtl"
    ],
    "en" => [
        "home" => "Home",
        "about" => "About Us",
        "contact" => "Contact Us",
        "search_placeholder" => "Search...",
        "search_btn" => "Search",
        "lang_name" => "Language",
        "dir" => "ltr"
    ]
];

$n = $nav_trans[$current_lang];
?>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm sticky-top" style="background: #1a1c20; border-bottom: 1px solid rgba(243, 156, 18, 0.2);">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">
            <span style="color: #f39c12;">ڕێبەریا</span> کوردستانێ ⭐️
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
<?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1): ?>
    <li class="nav-item">
        <a class="nav-link fw-bold text-danger" href="admin_control.php">کۆنترۆلا ئەدمینی ⚙️</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
    </li>
<?php endif; ?>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto py-2">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php"><?php echo $n['home']; ?></a>
                </li>
              
                <li class="nav-item">
                    <a class="nav-link" href="about.php"><?php echo $n['about']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php"><?php echo $n['contact']; ?></a>
                </li>

                <li class="nav-item dropdown ms-lg-3">
                    <a class="nav-link dropdown-toggle btn btn-outline-warning text-warning px-3" href="#" id="langDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 10px;">
                        <i class="fas fa-globe"></i> <?php echo $n['lang_name']; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end bg-dark border-warning shadow" aria-labelledby="langDropdown">
                        <li>
                            <a class="dropdown-item text-white py-2" href="?lang=ku">
                                <img src="https://cdn3.iconfinder.com/data/icons/asian-flags-1/512/kurdish_kurdistan_flag_country_national_region_european-512.png" class="me-2" style="width: 20px;"> کوردی (بادینی)
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-white py-2" href="?lang=ar">
                                <img src="https://flagcdn.com/w20/iq.png" class="me-2" style="width: 20px;"> العربية
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-white py-2" href="?lang=en">
                                <img src="https://flagcdn.com/w20/us.png" class="me-2" style="width: 20px;"> English
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            
            <form action="index.php" method="GET" class="d-flex ms-lg-3 mt-3 mt-lg-0">
                <input name="q" class="form-control me-2 rounded-pill border-0 shadow-sm" type="search" placeholder="<?php echo $n['search_placeholder']; ?>" aria-label="Search">
                <button class="btn btn-warning rounded-pill fw-bold" type="submit"><?php echo $n['search_btn']; ?></button>
            </form>
        </div>
    </div>
</nav>

<style>
    .dropdown-item:hover {
        background-color: rgba(243, 156, 18, 0.2) !important;
        color: #f39c12 !important;
    }
    .navbar-nav .nav-link {
        font-weight: 500;
        transition: 0.3s;
    }
    .navbar-nav .nav-link:hover {
        color: #f39c12 !important;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>