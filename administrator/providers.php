<?php
include 'include.php';
include 'header.php';
//include 'product-action.php';
?>

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
        <button type="button" name="product-create" value="">
            <a href="./add-provider.php">Thêm mới nhà cung cấp</a>
        </button>
    </div>


    <div class="row-fluid">
        <div class="span12">
            <div class="widget">
                <?php
                $query_execute = mysqli_query($connect, "SELECT id, name, address, email, website, phone "
                        . "FROM providers WHERE is_active = '1' ORDER BY id ASC");
                ?>

                <div class="widget-body">
                    <table class="table table-condensed table-striped table-hover no-margin">
                        <thead>
                            <tr>
                                <!--<th style="display: none"></th>-->
                                <th>ID</th>
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
                                    <td><?php echo $query_result['id'] ?></td>
                                    <td><?php echo $query_result['name'] ?></td>
                                    <td><?php echo $query_result['address'] ?></td>
                                    <td><?php echo $query_result['email'] ?></td>
                                    <td><?php echo $query_result['website'] ?></td>
                                    <td><?php echo $query_result['phone'] ?></td>
                                    <td>
                                        <a href="add-provider.php?provider_id=<?php echo $query_result['id']?>">Chỉnh sửa</a>&nbsp;&nbsp;
                                        <a onclick="addNotifier(<?php echo $p["id"] ?>)">Xóa</a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>