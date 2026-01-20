<!DOCTYPE html>
<html lang="ku" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="design.css?v=<?php echo time(); ?>">
<?php include 'navbar.php'; ?>

</head>
<body>






<?php 
include 'db.php'; 
$id = $_GET['id']; 
$city_q = mysqli_query($conn, "SELECT name FROM cities WHERE id = $id");
$city = mysqli_fetch_assoc($city_q);
?>
<!DOCTYPE html>
<html lang="ku" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title><?php echo $city['name']; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .card-img-top { height: 250px; object-fit: cover; }
.comment-box {
    background: #ffffff;
    border-right: 5px solid #007bff; /* هێڵێکی شین لە لای ڕاست */
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 8px;
    transition: 0.3s;
}
.comment-box:hover {
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">گەشت ل <?php echo $city['name']; ?></h1>
        <div class="row">
            <?php
            $places = mysqli_query($conn, "SELECT * FROM places WHERE city_id = $id");
            if(mysqli_num_rows($places) > 0) {
                while($place = mysqli_fetch_assoc($places)) {
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="images/<?php echo $place['place_image']; ?>" class="card-img-top">
                            <div class="card-body text-center">
                                <h5 class="fw-bold"><?php echo $place['place_name']; ?></h5>
                                <p><?php echo $place['place_desc']; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='alert alert-info text-center w-100'>هێشتا چو جەهـ بۆ ڤی باژێری نەیێنە زێدەکرن.</div>";
            }
            ?>
        </div>
        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-secondary">زڤڕین</a>
        </div>
    </div>
    <hr class="mt-5">
<div class="container mb-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm p-4 mb-4">
                <h5 class="mb-3">ڕایێ خۆ ل سەر ڤی باژێری بنڤێسە:</h5>
                <form action="" method="POST">
                    <input type="text" name="u_name" class="form-control mb-2" placeholder="ناڤێ تە" required>
                    <textarea name="u_comment" class="form-control mb-2" placeholder="کۆمێنتا تە بنڤێسە..." rows="3" required></textarea>
                    <button name="submit_com" class="btn btn-primary">بڵاڤ بکە</button>
                </form>
            </div>

            <?php
            // کۆدێ سەیڤکرنا کۆمێنتێ
            if(isset($_POST['submit_com'])) {
                $u_name = mysqli_real_escape_string($conn, $_POST['u_name']);
                $u_text = mysqli_real_escape_string($conn, $_POST['u_comment']);
                $city_id = $_GET['id'];
                
                $sql_ins = "INSERT INTO comments (city_id, user_name, comment_text) VALUES ('$city_id', '$u_name', '$u_text')";
                if(mysqli_query($conn, $sql_ins)) {
                    echo "<div class='alert alert-success'>کۆمێنتا تە ب سەرکەفتی هاتە بڵاڤکرن!</div>";
                    echo "<meta http-equiv='refresh' content='1'>";
                }
            }

            // کێشانا کۆمێنتان ژ داتابەیسێ
            $id = $_GET['id'];
            $get_coms = mysqli_query($conn, "SELECT * FROM comments WHERE city_id = $id ORDER BY id DESC");
            echo "<h5 class='mb-3'>کۆمێنتێن گەشتیاران:</h5>";
            
            if(mysqli_num_rows($get_coms) > 0) {
                while($com = mysqli_fetch_assoc($get_coms)) {
                    echo "
                    <div class='card mb-2 p-3 border-0 shadow-sm bg-white'>
                        <div class='d-flex justify-content-between'>
                            <h6 class='text-primary mb-1'>{$com['user_name']}</h6>
                            <small class='text-muted'>{$com['created_at']}</small>
                        </div>
                        <p class='mb-0 text-dark'>{$com['comment_text']}</p>
                    </div>";
                }
            } else {
                echo "<p class='text-muted'>هێشتا چو کۆمێنت نینن. ببە ئێکەم کەس کۆمێنتێ بنڤێسیت!</p>";
            }
            ?>
       <?php
// پشکنین کا ئایا ئەڤ جەهە سەیڤ کرییه یان نە
$is_saved = false;
if (isset($_COOKIE['saved_places'])) {
    $saved_array = json_decode($_COOKIE['saved_places'], true);
    if (in_array($place['id'], $saved_array)) {
        $is_saved = true;
    }
}
?>

<a href="save_place.php?id=<?php echo $place['id']; ?>" class="btn <?php echo $is_saved ? 'btn-warning' : 'btn-outline-warning'; ?> btn-sm">
    <?php echo $is_saved ? '⭐ سەیڤ کرییه' : '☆ سەیڤ بکە'; ?>
</a>
    
    </div>
    </div>
</div>


</body>
</html>