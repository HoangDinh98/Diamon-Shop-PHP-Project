<?php
include 'include.php';
include 'header.php';
?>

<div id="page" class="dashboard">
    <!--    <div class="alert alert-info">
            <button data-dismiss="alert" class="close">×</button>
            Welcome to the <strong>Admin Lab</strong> Theme. Please don't forget to check all the pages! 
        </div>-->
    <?php
    if (isset($_SESSION['notify'])) {
        ?>
        <div class="alert alert-success" id="notify">
            <button data-dismiss="alert" class="close">×</button>
            <?php
            echo $_SESSION['notify'];
            unset($_SESSION['notify']);
            ?>
        </div>
        <script>
            $(document).ready(function () {
                $('#notify').delay(5000).fadeOut();
            });
        </script>
        <?php
    }
    ?>
    <div>
        <button type="button" name="product-create" value="Thêm sản phẩm">
            <a href="./create-product.php">Thêm tài khoản</a>
        </button>
    </div>
    <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
    <!-- Show firt table -->
    <div class="row-fluid">
        <div class="span12">
            <div class="widget">
                <?php
//                Phân trang
                $rows_result = mysqli_query($connect, "SELECT id FROM users");
                $rows_no = mysqli_num_rows($rows_result);
                $rows_per_page = 20;
                $pages_no = intval(($rows_no - 1) / $rows_per_page) + 1;

                $page_curent = isset($_GET['p']) ? $_GET['p'] : 1;
                if (!$page_curent)
                    $page_curent = 1;
                $start = ($page_curent - 1) * $rows_per_page;
//                Hết phân trang
//                Select các thông tin của ủe lên
                $query_execute = mysqli_query($connect, "SELECT id, user_name, email, fullname, gender, birthday, phone "
                        . "FROM users WHERE is_active = '1'");
                ?>
                <div class="widget-body">
                    <table class="table table-condensed table-striped table-hover no-margin">
                        <thead>
                            <tr>
                                <!--<th style="display: none"></th>-->
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Tên đầy đủ</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Số điện thoại</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($query_result = mysqli_fetch_array($query_execute)) {
                                ?>
                                <tr>
                                    <!--<td style="display: none"><?php echo $p['id'] ?></td>-->
                                    <td><?php echo $query_result['id'] ?></td>
                                    <td><?php echo $query_result['user_name'] ?></td>
                                    <td><?php echo $query_result['email'] ?></td>
                                    <td><?php echo $query_result['fullname'] ?></td>
                                    <td><?php echo $query_result['gender'] ?></td>
                                    <td><?php echo $query_result['birthday'] ?></td>
                                    <td><?php echo $query_result['phone'] ?></td>
                                    <td>
    <!--                                        <a href="addproduct.php?i=<?php echo $p['id'] ?>" >Chỉnh sửa</a>&nbsp;&nbsp;-->
    <!--                                        <a href="products.php?delete=<?php echo $p['id'] ?>" >Xóa</a>-->
                                        <a href="create-product.php?pid=<?php echo $p['id'] ?>">Chỉnh sửa</a>&nbsp;&nbsp;
                                        <a onclick="addNotifier(<?php echo $p["id"] ?>)">Xóa</a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>