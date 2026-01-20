<!DOCTYPE html>
<html lang="ku" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="design.css?v=<?php echo time(); ?>">
</head>
<body>

<nav class="custom-nav mb-5">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="index.php" class="nav-link-custom fs-4">ڕێبەریا کوردستانێ ⭐</a>
        <div>
            <a href="index.php" class="nav-link-custom">سەرەکی</a>
            <a href="saved.php" class="btn btn-main ms-3">لیستا من ❤️</a>
        </div>
    </div>
</nav>





<?php
include 'db.php';

// پشکنینی هەبوونی کۆکی بۆ ڕێگری لە Warning
$saved_ids = array();
if (isset($_COOKIE['saved_places'])) {
    $saved_ids = json_decode($_COOKIE['saved_places'], true);
}

// ئەگەر لیستەکە خاڵی نەبوو، زانیارییەکان بهێنە
if (!empty($saved_ids) && is_array($saved_ids)) {
    $ids_string = implode(',', array_map('intval', $saved_ids));
    $query = "SELECT * FROM places WHERE id IN ($ids_string)";
    $result = mysqli_query($conn, $query);
    
    // لێرە خولەکە (loop) دەست پێ دەکات بۆ نیشاندانی وێنەکان
    while ($row = mysqli_fetch_assoc($result)) {
        // نیشاندانی کارتەکان
    }
} else {
    echo "<div class='text-center mt-5'><h3>هێشتا تە چو جهـ سەیڤ نەکرینە.</h3></div>";
}
?>



<?php 
// پەیوەندی بە داتابەیس
include 'db.php'; 
?>
<!DOCTYPE html>
<html lang="ku" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لیستەکا من ⭐</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; font-family: 'Tahoma', sans-serif; }
        .card { border: none; border-radius: 12px; transition: 0.3s; }
        .card:hover { transform: scale(1.02); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .btn-back { margin-bottom: 20px; }
        .empty-msg { padding: 100px 0; text-align: center; color: #777; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">⭐ جهێن سەیڤ کری</h2>
        <a href="index.php" class="btn btn-outline-secondary btn-back">زڤڕین بۆ سەرەکی</a>
    </div>

    <div class="row">
        <?php
        // ١. پشکنین بکە ئایا کۆکی "saved_places" بوونی هەیە و خاڵی نییە
        if (isset($_COOKIE['saved_places']) && !empty($_COOKIE['saved_places'])) {
            
            // ٢. وەرگرتنی ئایدییەکان و گۆڕینیان لە JSON بۆ Array
            $ids = json_decode($_COOKIE['saved_places'], true);
            
            if (is_array($ids) && count($ids) > 0) {
                
                // پاقژکردنەوەی ئایدییەکان بۆ پاراستنی داتابەیس
                $ids_safe = implode(',', array_map('intval', $ids));
                
                // ٣. هێنانی زانیاری شوێنەکان لە داتابەیس بەپێی ئایدییەکان
                $query = "SELECT * FROM places WHERE id IN ($ids_safe)";
                $result = mysqli_query($conn, $query);
                
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm h-100">
                                <img src="images/<?php echo $row['place_image']; ?>" class="card-img-top" style="height:200px; object-fit:cover;" alt="image">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold"><?php echo $row['place_name']; ?></h5>
                                    <p class="card-text text-muted"><?php echo mb_substr($row['place_desc'], 0, 100); ?>...</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="city_details.php?id=<?php echo $row['city_id']; ?>" class="btn btn-sm btn-info text-white">بینین</a>
                                        <a href="save_place.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger">لابرن</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="empty-msg"><h3>داتاکان لە داتابەیس نەدۆزرانەوە.</h3></div>';
                }
            } else {
                echo '<div class="empty-msg"><h3>لیستا تە یا تالە!</h3><p>هێشتا تە چو جهـ سەیڤ نەکرینە.</p></div>';
            }
        } else {
            // ئەگەر بەکارهێنەر هیچ شتێکی سەیڤ نەکردبێت ئەم پەیامە دەردەکەوێت
            echo '<div class="empty-msg">
                    <h3>هێشتا تە چو جهـ سەیڤ نەکرینە.</h3>
                    <p class="text-muted">بڕۆ لاپەڕێ باژێڕان و کلیک ل سەر ستێرکێ بکە.</p>
                  </div>';
        }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>