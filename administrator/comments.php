<?php
include 'include.php';
include './required.php';
$_SESSION['task'] = 'comments';
include 'header.php';
?>

<div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li><a href="./index.php"><i class="icon-home" style="font-size: 18px; width: 30px;"></i></a><span class="divider">&nbsp;</span></li>
            <li><a href="#">Bình luận sản phẩm</a><span class="divider-last">&nbsp;</span></li>
        </ul>
    </div>
</div>

<div id="page" class="dashboard">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget">
                <?php
                $rows_result = mysqli_query($connect, "SELECT id FROM comments");
                $rows_no = mysqli_num_rows($rows_result);
                $rows_per_page = 10;
                $pages_no = intval(($rows_no - 1) / $rows_per_page) + 1;

                $page_curent = isset($_GET['page']) ? $_GET['page'] : 1;
                if (!$page_curent)
                    $page_curent = 1;
                $start = ($page_curent - 1) * $rows_per_page;

                $num = $rows_per_page * ($page_curent - 1);

                $query_execute = mysqli_query($connect, "SELECT comments.id, products.name AS product_name, customer_name, email, phone, content, creative_day "
                        . "FROM comments JOIN products ON comments.product_id = products.id ORDER BY id DESC LIMIT $start,$rows_per_page ");
                ?>

                <div class="widget-body">
                    <table class="table table-condensed table-striped table-hover no-margin">
                        <thead>
                            <tr>
                                <!--<th style="display: none"></th>-->
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Khách hàng bình luận</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Nội dung</th>
                                <th>Ngày bình luận</th>
                        </thead>
                        <tbody>
                            <?php
                            if ($query_execute) {
                                while ($query_result = mysqli_fetch_array($query_execute)) {
                                    ?>
                                    <tr>
                                        <td><?php echo ++$num ?></td>
                                        <td><?php echo $query_result['product_name'] ?></td>
                                        <td><?php echo $query_result['customer_name'] ?></td>
                                        <td><?php echo $query_result['email'] ?></td>
                                        <td><?php echo $query_result['phone'] ?></td>
                                        <td><?php echo $query_result['content'] ?></td>
                                        <td><?php echo $query_result['creative_day'] ?></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo '<tr><td colspan="7" style="text-align: center; color: #db4437; font-size: 16px; font-weight: bold;">'
                                . 'Không có bình luận nào</td</tr>';
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
                                echo "<a href='comments.php?page=1' class=\"page-direct\" ><<</a>";
                                echo "<a href='comments.php?page=" . ($page_curent - 1) . "' class=\"page-direct\"><</a>";
                            }

                            for ($i = 1; $i <= $pages_no; $i++) {
                                ?>
                                <a href='comments.php?page=<?php echo $i ?>' 
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
                            echo "<a href='comments.php?page=" . ($page_curent + 1) . "' class=\"page-direct\" >></a>";
                            echo "<a href='comments.php?page=$pages_no' class=\"page-direct\" >>></a>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>

