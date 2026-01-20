<?php 
// 1. گرێدان بە داتابەیس
include 'db.php'; 
include 'navbar.php'; 

// ڕێکخستنی زمان
mysqli_set_charset($conn, "utf8mb4");
?>

<!DOCTYPE html>
<html lang="ku" dir="rtl">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; font-family: 'Tahoma', sans-serif; }
        .city-box { background: white; border-radius: 10px; padding: 15px; margin-bottom: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center; }
        .city-img { width: 100%; height: 200px; object-fit: cover; border-radius: 8px; }
        .city-name { font-weight: bold; margin-top: 10px; color: #333; }
        .city-desc { font-size: 0.9rem; color: #666; }
    </style>
</head>
<body>

<div class="container my-5">
    <h2 class="text-center mb-4">باژێڕێن د لاپەڕێ سەرەکیدا</h2>
    
    <div class="row">
        <?php
        // 2. هێنانی هەمان داتای لاپەڕەی سەرەکی
        $sql = "SELECT * FROM places ORDER BY id DESC";
        $res = mysqli_query($conn, $sql);

        if ($res && mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                ?>
                <div class="col-md-4">
                    <div class="city-box">
                        <img src="images/<?php echo $row['place_image']; ?>" class="city-img">
                        <div class="city-name"><?php echo $row['place_name']; ?></div>
                        <div class="city-desc"><?php echo $row['place_desc']; ?></div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p class='text-center'>چو باژێڕ نینن</p>";
        }
        ?>
    </div>
</div>

</body>
</html>
     