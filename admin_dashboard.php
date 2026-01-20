<?php


session_start();
include 'db.php';
if(!isset($_SESSION['admin'])) { header("Location: login.php"); }

// ١. زێدەکرنا باژێری
if(isset($_POST['add_city'])) {
    $name = $_POST['city_name'];
    $img = $_POST['city_img'];
    mysqli_query($conn, "INSERT INTO cities (name, image_url) VALUES ('$name', '$img')");
    echo "<script>alert('باژێر هاتە زێدەکرن');</script>";
}

// ٢. زێدەکرنا جهێن گەشتیاری
if(isset($_POST['add_place'])) {
    $c_id = $_POST['c_id'];
    $p_name = $_POST['p_name'];
    $p_desc = $_POST['p_desc'];
    $p_img = $_POST['p_img'];
    mysqli_query($conn, "INSERT INTO places (city_id, place_name, place_desc, place_image) VALUES ('$c_id', '$p_name', '$p_desc', '$p_img')");
    echo "<script>alert('جەهـ هاتە زێدەکرن');</script>";
}
// کۆدێ ژێبرتنا باژێڕی
if(isset($_GET['del_city'])) {
    $id = $_GET['del_city'];
    
    // ل دەستپێکێ دڤێت هەمی جهێن (Places) وی باژێڕی بهێنە سڕین دا کێشە نەکەڤیتە داتابەیسێ
    mysqli_query($conn, "DELETE FROM places WHERE city_id = $id");
    
    // پاشان باژێڕی بخۆ دسڕین
    mysqli_query($conn, "DELETE FROM cities WHERE id = $id");
    
    header("Location: admin_dashboard.php");
}

// کۆدێ ژێبرتنا جهێن گەشتیاری (Places)
if(isset($_GET['del_place'])) {
    $p_id = $_GET['del_place'];
    mysqli_query($conn, "DELETE FROM places WHERE id = $p_id");
    header("Location: admin_dashboard.php");
}




?>

<!DOCTYPE html>
<html lang="ku" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>کۆنترۆڵا ئەدمینی</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light p-5">
    <div class="container bg-white p-4 shadow-sm rounded">
        <div class="d-flex justify-content-between mb-4">
            <h2>ڕێبەریا ئەدمینی</h2>
            <a href="logout.php" class="btn btn-danger">دەرکەفتن</a>
        </div>

        <div class="card p-3 mb-5 border-primary">
            <h5>+ زێدەکرنا باژێرەکێ نوو</h5>
            <form method="POST" class="row g-2">
                <div class="col-md-5"><input type="text" name="city_name" class="form-control" placeholder="ناڤێ باژێری" required></div>
                <div class="col-md-5"><input type="text" name="city_img" class="form-control" placeholder="وێنە (zaxo.jpg)" required></div>
                <div class="col-md-2"><button name="add_city" class="btn btn-primary w-100">زێدە بکە</button></div>
            </form>
        </div>

        <div class="card p-3 border-success">
            <h5>+ زێدەکرنا جهەکێ گەشتیاری</h5>
            <form method="POST" class="row g-2">
                <div class="col-md-3">
                    <select name="c_id" class="form-select" required>
                        <option value="">باژێری هەلبژێرە...</option>
                        <?php
                        $cities = mysqli_query($conn, "SELECT * FROM cities");
                        while($c = mysqli_fetch_assoc($cities)) {
                            echo "<option value='{$c['id']}'>{$c['name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3"><input type="text" name="p_name" class="form-control" placeholder="ناڤێ جهی (م: سۆلاڤ)" required></div>
                <div class="col-md-3"><input type="text" name="p_img" class="form-control" placeholder="وێنە (solav.jpg)" required></div>
                <div class="col-md-3"><button name="add_place" class="btn btn-success w-100">زێدە بکە</button></div>
                <div class="col-12 mt-2"><textarea name="p_desc" class="form-control" placeholder="وەسفەکا کورت دەربارەی ڤی جهی بنڤێسە..." rows="2"></textarea></div>
            </form>
        </div>
    </div>
    <div class="card p-3 border-danger mt-4">
    <h5>بەڕێوەبردنی کۆمێنتەکان</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ناوی بەکارهێنەر</th>
                <th>کۆمێنت</th>
                <th>کردار</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $coms = mysqli_query($conn, "SELECT * FROM comments ORDER BY id DESC");
            while($c = mysqli_fetch_assoc($coms)) {
                echo "<tr>
                        <td>{$c['user_name']}</td>
                        <td>{$c['comment_text']}</td>
                        <td><a href='?del_com={$c['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"ئایا دڵنیایی؟\")'>بسڕەوە</a></td>
                      </tr>";
            }
            // کۆدی سڕینەوە
            if(isset($_GET['del_com'])) {
                $id_to_del = $_GET['del_com'];
                mysqli_query($conn, "DELETE FROM comments WHERE id = $id_to_del");
                echo "<script>window.location='admin_dashboard.php';</script>";
            }
            ?>
        </tbody>
    </table>
    <hr>
<h4>ڕێڤەبرنا باژێڕان</h4>
<table class="table table-bordered bg-white shadow-sm">
    <thead class="table-dark">
        <tr>
            <th>ناڤێ باژێڕی</th>
            <th>وێنە</th>
            <th>کردار (Action)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $city_list = mysqli_query($conn, "SELECT * FROM cities");
        while($city = mysqli_fetch_assoc($city_list)) {
            echo "<tr>
                    <td>{$city['name']}</td>
                    <td>{$city['image_url']}</td>
                    <td>
                        <a href='?del_city={$city['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"ئەگەر باژێڕی بڕی، هەمی جهێن وی ژی دێ هێنە سڕین! ئایا دڵنیایی؟\")'>ژێبرن</a>
                    </td>
                  </tr>";
        }
        ?>
    </tbody>
</table>
</div>
<hr>
<h4>ڕێڤەبرنا جهان (Places)</h4>
<table class="table table-bordered bg-white shadow-sm">
    <thead class="table-success">
        <tr>
            <th>ناڤێ جهی</th>
            <th>باژێڕ</th>
            <th>کردار</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $place_list = mysqli_query($conn, "SELECT places.*, cities.name as c_name FROM places JOIN cities ON places.city_id = cities.id");
        while($p = mysqli_fetch_assoc($place_list)) {
            echo "<tr>
                    <td>{$p['place_name']}</td>
                    <td>{$p['c_name']}</td>
                    <td>
                        <a href='?del_place={$p['id']}' class='btn btn-outline-danger btn-sm' onclick='return confirm(\"ئایا دڵنیایی ژ سڕینا ڤی جهی؟\")'>ژێبرن</a>
                    </td>
                  </tr>";
        }
        ?>
    </tbody>
</table>
<hr class="my-5">
<div class="card p-4 shadow-sm border-warning">
    <h4 class="mb-4 text-warning">ڕێڤەبرنا کۆمێنتێن گەشتیاران</h4>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>باژێڕ</th>
                    <th>ناڤێ گەشتیارێ</th>
                    <th>کۆمێنت</th>
                    <th>رێکەفت</th>
                    <th>کردار</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // کێشانا کۆمێنتان ب ناڤێ باژێڕی ڤە
                $com_query = "SELECT comments.*, cities.name AS c_name 
                              FROM comments 
                              JOIN cities ON comments.city_id = cities.id 
                              ORDER BY comments.id DESC";
                $res_com = mysqli_query($conn, $com_query);

                if(mysqli_num_rows($res_com) > 0) {
                    while($row = mysqli_fetch_assoc($res_com)) {
                        echo "<tr>
                                <td><span class='badge bg-info'>{$row['c_name']}</span></td>
                                <td class='fw-bold'>{$row['user_name']}</td>
                                <td>" . substr($row['comment_text'], 0, 50) . "...</td>
                                <td><small>{$row['created_at']}</small></td>
                                <td>
                                    <a href='?del_com={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"ئایا تو دڵنیایی ژ سڕینا ڤێ کۆمێنتێ؟\")'>سڕین</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center text-muted'>چو کۆمێنت نینن</td></tr>";
                }

                // کۆدێ سڕینێ دەما کلیک ل سەر دوگمێ سڕین دهێتە کرن
                if(isset($_GET['del_com'])) {
                    $id_com = $_GET['del_com'];
                    mysqli_query($conn, "DELETE FROM comments WHERE id = $id_com");
                    echo "<script>window.location='admin_dashboard.php';</script>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>