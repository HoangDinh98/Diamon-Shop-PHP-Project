<?php
if (isset($_FILES['image'])) {
    $errors = array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

    $expensions = array("jpeg", "jpg", "png");

    if (in_array($file_ext, $expensions) === false) {
        $errors[] = "Không chấp nhận định dạng ảnh có đuôi này, mời bạn chọn JPEG hoặc PNG.";
    }

    if ($file_size > 2097152) {
        $errors[] = 'Kích cỡ file nên là 2 MB';
    }

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "images/" . $file_name);
        echo "Thành công!!!";
    } else {
        print_r($errors);
    }
}
?>
<html>
    <body>

        <form action="" method="POST" enctype="multipart/form-data">
            <input type="file" name="image" />
            <input type="submit"/>
        </form>

        <?php
        date_default_timezone_set('Asia/Ho_Chi_Minh');
//        $format = "%H:%M:%S %d-%B-%Y";
//        $timestamp = time();
//        echo $strTime = strftime($format, $timestamp);
//        echo "<br />";
//        echo "Timestamp:" . $timestamp;
        $format = "%H%M%S";
        $timestamp = time();
        echo $strTime = strftime($format, $timestamp);
        echo "<br />";
        echo "Timestamp:" . $timestamp;
        ?>

    </body>
</html>

