<?php
include 'include.php';
include './required.php';
$_SESSION['task'] = 'providers';
include 'header.php';
//include 'product-action.php';
?>

<div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li><a href="./index.php"><i class="icon-home" style="font-size: 18px; width: 30px;"></i></a><span class="divider">&nbsp;</span></li>
            <li><a href="#">Nhà cung cấp</a><span class="divider-last">&nbsp;</span></li>
        </ul>
    </div>
</div>

<div id="page" class="dashboard">
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
        <a class="create-button" href="./add-provider.php">Thêm mới nhà cung cấp</a>
    </div>


    <div class="row-fluid">
        <div class="span12">
            <div class="widget">
                <?php
                $rows_result = mysqli_query($connect, "SELECT id FROM providers WHERE is_active = 1");
                $rows_no = mysqli_num_rows($rows_result);
                $rows_per_page = 10;
                $pages_no = intval(($rows_no - 1) / $rows_per_page) + 1;

                $page_curent = isset($_GET['page']) ? $_GET['page'] : 1;
                if (!$page_curent)
                    $page_curent = 1;
                $start = ($page_curent - 1) * $rows_per_page;

                $num = $rows_per_page * ($page_curent - 1);

                $query_execute = mysqli_query($connect, "SELECT id, name, address, email, website, phone "
                        . "FROM providers WHERE is_active = '1' ORDER BY id DESC LIMIT $start,$rows_per_page ");
                ?>

                <div class="widget-body">
                    <table class="table table-condensed table-striped table-hover no-margin">
                        <thead>
                            <tr>
                                <!--<th style="display: none"></th>-->
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Địa chỉ</th>
                                <th>Email</th>
                                <th>Website</th>
                                <th>Số điện thoại</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($query_result = mysqli_fetch_array($query_execute)) {
                                ?>
                                <tr>
                                    <td><?php echo ++$num ?></td>
                                    <td><?php echo $query_result['name'] ?></td>
                                    <td><?php echo $query_result['address'] ?></td>
                                    <td><?php echo $query_result['email'] ?></td>
                                    <td><?php echo $query_result['website'] ?></td>
                                    <td><?php echo $query_result['phone'] ?></td>
                                    <td>
                                        <a class="button-a edit-button" href="add-provider.php?provider_id=<?php echo $query_result['id'] ?>&page=<?php echo $page_curent ?>"><i class="icon-edit"></i></a>&nbsp;
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
                                echo "<a href='providers.php?page=1' class=\"page-direct\" ><<</a>";
                                echo "<a href='providers.php?page=" . ($page_curent - 1) . "' class=\"page-direct\"><</a>";
                            }

                            for ($i = 1; $i <= $pages_no; $i++) {
                                ?>
                                <a href='providers.php?page=<?php echo $i ?>' 
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
                            echo "<a href='providers.php?page=" . ($page_curent + 1) . "' class=\"page-direct\" >></a>";
                            echo "<a href='providers.php?page=$pages_no' class=\"page-direct\" >>></a>";
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
                                window.location.href = "action.php?provider_delete_id=" + id + "&page=" + page_return;
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