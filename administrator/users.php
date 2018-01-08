<?php
include 'include.php';
$_SESSION['task'] = 'users';
include 'header.php';
?>

<div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li><a href="./index.php"><i class="icon-home" style="font-size: 18px; width: 30px;"></i></a><span class="divider">&nbsp;</span></li>
            <li><a href="#">Tài khoản</a><span class="divider-last">&nbsp;</span></li>
        </ul>
    </div>
</div>

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
        <a class="create-button" href="#">Thêm tài khoản</a>
    </div>
    <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
    <!-- Show firt table -->
    <div class="row-fluid">
        <div class="span12">
            <div class="widget">
                <?php
//                Phân trang
                $rows_result = mysqli_query($connect, "SELECT id FROM users WHERE is_active = 1");
                $rows_no = mysqli_num_rows($rows_result);
                $rows_per_page = 10;
                $pages_no = intval(($rows_no - 1) / $rows_per_page) + 1;

                $page_curent = isset($_GET['page']) ? $_GET['page'] : 1;
                if (!$page_curent)
                    $page_curent = 1;
                $start = ($page_curent - 1) * $rows_per_page;

                $num = $rows_per_page * ($page_curent - 1);

//                Hết phân trang
//                Select các thông tin của ủe lên
                $query_execute = mysqli_query($connect, "SELECT id, user_name, email, fullname, gender, birthday, phone "
                        . "FROM users WHERE is_active = '1' ORDER BY id DESC LIMIT $start,$rows_per_page ");
                ?>
                <div class="widget-body">
                    <table class="table table-condensed table-striped table-hover no-margin">
                        <thead>
                            <tr>
                                <!--<th style="display: none"></th>-->
                                <th>STT</th>
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
                                    <td><?php echo ++$num ?></td>
                                    <td><?php echo $query_result['user_name'] ?></td>
                                    <td><?php echo $query_result['email'] ?></td>
                                    <td><?php echo $query_result['fullname'] ?></td>
                                    <td><?php echo $query_result['gender'] ?></td>
                                    <td><?php echo $query_result['birthday'] ?></td>
                                    <td><?php echo $query_result['phone'] ?></td>
                                    <td>
                                        <a class="button-a delete-button" onclick="addNotifier(<?php echo $query_result["id"] . ', ' . $page_curent ?>)"><i class="icon-trash"></i></a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="widget-body">
                    <?php
                    if ($pages_no > 1) {
                        echo "Pages: ";
                        if ($page_curent >= 1) {
                            if ($page_curent > 1) {
                                echo "<a href='users.php?page=1' class=\"page-direct\" ><<</a>";
                                echo "<a href='users.php?page=" . ($page_curent - 1) . "' class=\"page-direct\"><</a>";
                            }

                            for ($i = 1; $i <= $pages_no; $i++) {
                                ?>
                                <a href='users.php?page=<?php echo $i ?>' 
                                   class="page <?php
                                   if ($page_curent == $i) {
                                       echo 'page-active';
                                   }
                                   ?>" >
                                       <?php echo $i ?>
                                </a>
                                <?php
                            }
                        }
                        if ($page_curent < $pages_no) {
                            echo "<a href='users.php?page=" . ($page_curent + 1) . "' class=\"page-direct\" >></a>";
                            echo "<a href='users.php?page=$pages_no' class=\"page-direct\" >>></a>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function addNotifier(id, page_return) {
        var notifier = $.Notifier("Cảnh báo",
                "Bạn có thực sự muốn xóa bản ghi này?",
                "warning",
                {
                    vertical_align: "center",
                    rtl: false,
                    btns: [
                        {
                            label: "OK",
                            type: "success",
                            onClick: function () {
                                window.location.href = "action.php?user_delete_id=" + id + "&page=" + page_return;
                                return true;
                            }
                        },
                        {
                            label: "Hủy",
                            type: "default",
                            onClick: function () {
                                debugger;
                            }
                        }
                    ],
                    callback: function () {
                        debugger;
                    }
                });

    }
</script>

<?php
include 'footer.php';
?>