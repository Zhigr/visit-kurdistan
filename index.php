
<?php
session_start();
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
    header("Location: index.php");
    exit();
}
$current_lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : "ku";

// فەرهەنگا تەواو بۆ هەمی پەیڤێن ماڵپەرێ تە
$translations = [
    "ku" => [
        "welcome" => "ب خێرهاتن بۆ ڕێبەریا کوردستانێ",
        "welcome_desc" => "ماڵپەرێ مە گرێدایێ هەمی جهێن جوان یێن کوردستانێ یە.",
        "btn_start" => "دەستپێبکە",
        "btn_about" => "دەربارەی مە",
        "ad_label" => "ڕیکلاما تایبەت",
        "war_inst" => "پەیمانگەها وار",
        "war_desc" => "پاشەڕۆژا خۆ مسۆگەر بکە دگەل باشترین ستاف و بەشێن زانستی ل پەیمانگەها وار.",
        "contact" => "پەیوەندی",
        "see_more" => "زێدەتر ببینە",
        "cities" => "باژێڕێن مە",
        "view" => "بینین",
        "rights" => "هەمی ماف پاراستینە © 2026",
        "dir" => "rtl"
    ],
    "ar" => [
        "welcome" => "أهلاً بكم في دليل كوردستان",
        "welcome_desc" => "موقعنا مخصص لجميع الأماكن الجميلة في كوردستان.",
        "btn_start" => "ابدأ الآن",
        "btn_about" => "حول الموقع",
        "ad_label" => "إعلان خاص",
        "war_inst" => "معهد وار التقني",
        "war_desc" => "اضمن مستقبلك مع أفضل الكوادر والأقسام العلمية في معهد وار.",
        "contact" => "اتصل بنا",
        "see_more" => "عرض المزيد",
        "cities" => "مدننا",
        "view" => "عرض",
        "rights" => "جميع الحقوق محفوظة © 2026",
        "dir" => "rtl"
    ],
    "en" => [
        "welcome" => "Welcome to Kurdistan Guide",
        "welcome_desc" => "Our website is dedicated to all beautiful places in Kurdistan.",
        "btn_start" => "Get Started",
        "btn_about" => "About Us",
        "ad_label" => "Special Ad",
        "war_inst" => "War Technical Institute",
        "war_desc" => "Secure your future with the best staff and scientific departments at War.",
        "contact" => "Call Us",
        "see_more" => "See More",
        "cities" => "Our Cities",
        "view" => "View",
        "rights" => "All Rights Reserved © 2026",
        "dir" => "ltr"
    ]
];
$txt = $translations[$current_lang];
?>

<?php include 'navbar.php'; ?>

<?php
include 'db.php'; 
$search = "";
if (isset($_GET['q'])) {
    $search = mysqli_real_escape_string($conn, $_GET['q']);
}
if ($search != "") {
    $sql = "SELECT * FROM places WHERE place_name LIKE N'%$search%' OR place_desc LIKE N'%$search%'";
} else {
    $sql = "SELECT * FROM places";
}
$res = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="<?php echo $current_lang; ?>" dir="<?php echo $txt['dir']; ?>">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="design.css?v=<?php echo time(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;700&display=swap');
      body {
        font-family: 'Vazirmatn', sans-serif !important;
        background-color: #ffffff !important;
        direction: <?php echo $txt['dir']; ?>;
        text-align: <?php echo ($txt['dir'] == 'rtl') ? 'right' : 'left'; ?>;
      }
    </style>
</head>
<body>

<section class="hero-welcome">
    <div class="container hero-content text-center">
      <h1 class="welcome-text"><?php echo $txt['welcome']; ?></h1>
        <p class="welcome-desc">
            <?php echo $txt['welcome_desc']; ?>
        </p>
        <div class="hero-buttons">
            <a href="#cities-section" class="btn-hero-primary"><?php echo $txt['btn_start']; ?></a>
            <a href="#about-section" class="btn-hero-outline"><?php echo $txt['btn_about']; ?></a>
        </div>
    </div>
</section>

<section class="ads-section">
    <div class="container">
        <div class="ads-wrapper">
            <div class="ads-content">
                <span class="ads-label"><?php echo $txt['ad_label']; ?></span>
                <h2 class="institute-name"><?php echo $txt['war_inst']; ?></h2>
                <p class="institute-desc">
                    <?php echo $txt['war_desc']; ?>
                </p>
                <div class="ads-links">
                    <a href="tel:0750" class="btn-call">
                        <i class="fas fa-phone-alt"></i> <?php echo $txt['contact']; ?>
                    </a>
                    <a href="#" class="btn-more"><?php echo $txt['see_more']; ?></a>
                </div>
            </div>
            
            <div class="ads-logo-area">
                <div class="logo-circle">
                    <img src="images/IMG_8323.PNG" alt="War Institute Logo" class="war-logo">
                </div>
            </div>
        </div>
    </div>
</section>

<div id="cities-section" class="container mt-5">
   <h1 class="text-center"><?php echo $txt['cities']; ?></h1>
</div>

<div class="container">
    <div class="row">
        <?php
        $query = "SELECT * FROM cities";
        $res = mysqli_query($conn, $query);
        if ($res && mysqli_num_rows($res) > 0) {
            while($row = mysqli_fetch_assoc($res)) {
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="images/<?php echo $row['image_url']; ?>" class="card-img-top">
                       <div class="card-body">
    <h5><?php echo $row['name']; ?></h5>
    <a href="city_details.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">
        <?php echo $txt['view']; ?>
    </a>
</div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>

<footer id="about-section" class="final-footer">
    <div class="container text-center">
        <hr class="footer-divider">
        <div class="footer-bottom-info">
            <p class="copyright-p"><?php echo $txt['rights']; ?></p>
            <p class="dev-p">DEVELOPER: <span class="my-name">zhigr najmaden</span></p>
        </div>
    </div>
</footer>

</body>
</html>
