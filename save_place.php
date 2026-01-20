<link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


<?php
// هیچ بۆشاییەک پێش ئەم تاگە نەبێت
ob_start(); 
session_start();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // وەرگرتنی لیستی کۆن
    $saved = isset($_COOKIE['saved_places']) ? json_decode($_COOKIE['saved_places'], true) : array();
    if (!is_array($saved)) { $saved = array(); }

    // ئەگەر هەبوو لایببە، ئەگەر نا زیادی بکە
    if (in_array($id, $saved)) {
        $saved = array_diff($saved, array($id));
    } else {
        $saved[] = $id;
    }

    // دروستکردنی کۆکی بۆ هەموو ماڵپەڕەکە
    $data = json_encode(array_values($saved));
    setcookie('saved_places', $data, time() + (86400 * 30), "/");

    // ناردنەوە بۆ لاپەڕەی پێشوو
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
ob_end_flush();
?>
