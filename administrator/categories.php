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
            <a href="./add-category.php">Thêm danh mục</a>
        </button>
    </div>


    <div class="row-fluid">
        <div class="span12">
            <div class="widget">
                <?php
                $query_execute = mysqli_query($connect, "SELECT id, name, parent_id FROM categories ORDER BY id ASC");
                ?>

                <div class="widget-body">
                    <table class="table table-condensed table-striped table-hover no-margin">
                        <thead>
                            <tr>
                                <!--<th style="display: none"></th>-->
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Chứa trong danh mục</th>
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
                                    <td><?php
                                        //Test if parent_id == 0 then show "Root category" else find out Mother category
                                        if($query_result['parent_id']==0) {
                                        echo 'Danh mục gốc';
                                        } else {
                                        $parent_id_tmp = $query_result['parent_id'];
                                        $query_tmp = mysqli_query($connect, "SELECT name FROM categories WHERE id = $parent_id_tmp");
                                        $result_tmp = mysqli_fetch_array($query_tmp);
                                        echo $result_tmp['name'];
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="add-category.php?category_id=<?php echo $query_result['id']?>">Chỉnh sửa</a>&nbsp;&nbsp;
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


