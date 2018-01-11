<?php
//GLOBAL $firstname, $lastname, $phone, $email, $city, $district, $town, $village;
//GLOBAL $firstnameErr, $lastnameErr, $phoneErr, $cityErr, $districtErr, $townErr, $villageErr;
//GLOBAL $isErr;

$firstname = $lastname = $phone = $email = $city = $district = $town = $village = "";
$firstnameErr = $lastnameErr = $phoneErr = $cityErr = $districtErr = $townErr = $villageErr = "";
$isErr = FALSE;

function standardize_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function getData() {
    
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    GET DATA
    if (empty($_POST["firstname"])) {
        $firstnameErr = "Vui lòng nhập Tên của bạn";
        $isErr = TRUE;
    } else {
        $firstname = standardize_data($_POST["firstname"]);
    }

    if (empty($_POST["lastname"])) {
        $lastnameErr = "Vui lòng nhập Họ của bạn";
        $isErr = TRUE;
    } else {
        $lastname = standardize_data($_POST["lastname"]);
    }

    if (empty($_POST["phone"])) {
        $phoneErr = "Vui lòng nhập SĐT của bạn";
        $isErr = TRUE;
    } else {
        $phone = standardize_data($_POST["phone"]);
    }

    if (!empty($_POST["email"])) {
        $email = standardize_data($_POST["email"]);
    }

    if (empty($_POST["city"])) {
        $cityErr = "Vui lòng nhập Tỉnh/TP của bạn";
        $isErr = TRUE;
    } else {
        $city = standardize_data($_POST["city"]);
    }

    if (empty($_POST["district"])) {
        $districtErr = "Vui lòng nhập Quận/Huyện của bạn";
        $isErr = TRUE;
    } else {
        $district = standardize_data($_POST["district"]);
    }

    if (empty($_POST["town"])) {
        $townErr = "Vui lòng nhập Xã/Phường/Thị trấn của bạn";
        $isErr = TRUE;
    } else {
        $town = standardize_data($_POST["town"]);
    }

    if (empty($_POST["village"])) {
        $villageErr = "Vui lòng nhập Thôn/Xóm/Số nhà của bạn";
        $isErr = TRUE;
    } else {
        $village = standardize_data($_POST["village"]);
    }
//    END GET DATA

    if (!$isErr) {
        $fullname = $lastname . " " . $firstname;
        $address = $village . ", " . $town . ", " . $district . ", " . $city;
        $exportdate = date("Y-m-d H:i:m");

        $sql = "INSERT INTO orders(customer_name, address, phone, email, export_date) "
                . "VALUES('$fullname', '$address', '$phone', '$email', '$exportdate')";
        $query_execute = mysqli_query($connect, $sql);
        
        if (isset($query_execute)) {
            $order_id = mysqli_insert_id($connect);

            foreach ($_SESSION['product'] AS $key => $value) {
                $query = "SELECT price, prm.value AS promotion "
                        . "FROM products AS p JOIN promotions AS prm ON p.promotion_id = prm.id "
                        . "WHERE p.id = $key ";
                $query_execute1 = mysqli_query($connect, $query);
                
                if (isset($query_execute1)) {
                    $query_result1 = mysqli_fetch_array($query_execute1);
                    $quantity = (int) $value['quantity'];
                    $promotion = (int) $query_result1['promotion'];
                    $original_price = (int) $query_result1['price'];
                    $price = (int) round($original_price * (1 - $promotion / 100));

                    $query = "INSERT INTO orders_detail(order_id, product_id, quantity, original_price, price) "
                            . "VALUES ('$order_id', '$key', '$quantity', '$original_price', '$price');";
                    $t = mysqli_query($connect, $query);
                }
            }
            unset($_SESSION['product']);
            unset($_SESSION['product_num']);
        }
//        echo '<script>window.location.href = "./success.php"</script>';
//        sleep(0.5);
        echo '<script>
            $(document).ready(function () {
            $.Notifier("Chúc mừng",
                    "Bạn đã đặt hàng THÀNH CÔNG <br>Đơn hàng sẽ được giao trong thời gian sơm nhất!",
                    "info",
            {
            vertical_align: "center",
                    rtl: false,
                    btns: [
                    {
                    label: "OK",
                            type: "success",
                            onClick: function () {
                            window.location.href = "./demo.php";
                                    return true;
                            }
                    }
                    ],
                    callback: function () {
                    window.location.href = "./demo.php";
                    }
            });
            });
        </script>';
    }
}
?>


