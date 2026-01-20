<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }

if (!isset($_SESSION['lang'])) { $_SESSION['lang'] = "ku"; }

if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
    header("Location: " . strtok($_SERVER['REQUEST_URI'], '?'));
    exit();
}

$lang = $_SESSION['lang'];

$translations = [
"zakho_name" => "زاخۆ",
"zakho_desc" => "باژێڕێ دیرۆک و نۆژەنکرنێ، خودان پرا دەلال و کۆرنیشەکێ مۆدێرن.",
"delal_bridge" => "پرا دەلال",
"delal_desc" => "مەزنترین و کەڤنترین پرا بەردی ل دەڤەرێ.",
"corniche_zakho" => "کۆرنیشێ زاخۆ",
"corniche_desc" => "جوانترین جه بۆ پیاسەکرنا شەڤێ و دیمەنێن سەر ئاڤێ.",
"sharanish" => "شەرانش",
"sharanish_desc" => "وورڤە و دارستانێن سروشتی یێن دڵڕەڤێن.",
// ل پشکا زمانی زێدە بکە
"qishla_name" => "قشلا زاخۆ",
"qishla_desc" => "مۆزەخانە و ناڤەندەکا دیرۆکی یا نۆژەنکری ل دلێ باژێڕی.",
"parks_zakho" => "پارکێن زاخۆ",
"parks_desc" => "گەورەترین پارکێن سەوز و جهێن حەوانەیا خێزانان ب دیزاینەکا مۆدێرن.",
"qishla_link" => "images/zakho_qishla.jpg", // ناڤێ وێنەیێ تە
"parks_link" => "images/zakho_parks.jpg",
"museum_name" => "مۆزەخانا زاخۆ (قشلا زاخۆ)",
"museum_desc" => "ناڤەندەکا دیرۆکی کو پتر ژ ٣٠٠ پارچێن شوێنەواری و فۆلکلۆری یێن دەڤەرێ تێدا دهێنە پاراستن.",
"museum_location" => "جهـ: سەنتەرێ باژێڕێ زاخۆ - قشلا دیرۆکی",
"museum_time" => "دەمێن ڤەکرنێ: ٩:٠٠ سپێدێ - ٥:٠٠ ئێڤاری",












    "ku" => [
        "dir" => "rtl",
        "about_title" => "دەربارەی مە",
        "real_photos" => "وێنێن ڕاستەقینە",
        "photos_desc" => "دابینکرنا نووترین و جوانترین وێنەیێن سروشتێ کوردستانێ.",
        "free_service" => "خزمەتەکا بێبەرامبەر",
        "free_desc" => "ئارمانجا مە خزمەتە بۆ گەشتیاران.",
        "footer_rights" => "© 2026 هەمی ماف پاراستینە"
    ],
    "ar" => [
        "dir" => "rtl",
        "about_title" => "حول الموقع",
        "real_photos" => "صور حقيقية",
        "photos_desc" => "توفير أحدث وأجمل الصور لطبيعة كوردستان.",
        "free_service" => "خدمة مجانية",
        "free_desc" => "هدفنا هو الخدمة والترويج للسياحة.",
        "footer_rights" => "© 2026 جميع الحقوق محفوظة"
    ],
    "en" => [
        "dir" => "ltr",
        "about_title" => "About Us",
        "real_photos" => "Real Photos",
        "photos_desc" => "Providing the latest and beautiful photos of Kurdistan.",
        "free_service" => "Free Service",
        "free_desc" => "Our goal is to serve and promote tourism.",
        "footer_rights" => "© 2026 All Rights Reserved"
    ]
    




    
];

$txt = $translations[$lang];
?>
