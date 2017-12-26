
<?php
$rows_result = mysqli_query($connect, "SELECT id FROM products");
$rows_no = mysqli_num_rows($rows_result);
$rows_per_page = 10;
$pages_no = intval(($rows_no - 1) / $rows_per_page) + 1;

$page_curent = isset($_GET['p']) ? $_GET['p'] : 1;
if (!$page_curent)
    $page_curent = 1;
$start = ($page_curent - 1) * $rows_per_page;

$pr = mysqli_query($connect, "SELECT * FROM products order by id limit $start,$rows_per_page");
?>
<table class="table table-condensed table-striped table-hover no-margin">
    <thead>
        <tr>
            <th>ID</th>
            <th>Danh mục</th>
            <th>Nhà cung cấp</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Trọng lượng</th>
            <th>Giá</th>
            <th>Mô tả</th>
            <th> </th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($p = mysqli_fetch_array($pr)) {
            $categoryid = $p['category_id'];
            $provider_id = $p['provider_id'];

            $pr1 = mysqli_query($connect, "select name from categories where id=$categoryid ");
            while ($p1 = mysqli_fetch_array($pr1)) {
                $categ = $p1['name'];
            }
            $pr2 = mysqli_query($connect, "select name from providers where id=$provider_id ");
            while ($p2 = mysqli_fetch_array($pr2)) {
                $provider_name = $p2['name'];
            }
            ?>
            <tr>
                <td><?php echo $p['id'] ?></td>
                <td><?php echo $categ; ?></td>
                <td><?php echo $provider_name ?></td>
                <td><?php echo $p['name'] ?></td>
                <td><?php echo $p['quantity'] ?></td>
                <td><?php echo $p['weight'] ?></td>
                <td><?php echo $p['price'] ?></td>
                <td><?php echo $p['description'] ?></td>
                <td> <a href="addproduct.php?i=<?php echo $p['id'] ?>" ><img src="../layout/images/edit.jpg" height="20" title="chỉnh sửa" /> </a>&nbsp;&nbsp; <a href="products.php?delete=<?php echo $p['id'] ?>" > <img height="20" src="../layout/images/delete.jpg" />  </a>  </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>

<!--<div class="widget-body">
    <table class="table table-condensed table-striped table-hover no-margin">
        <thead>
            <tr>
                <th style="width:3%"><input type="checkbox" class="no-margin" /></th>
                <th style="width:17%"> Sent by </th>
                <th class="hidden-phone" style="width:55%"> Subject </th>
                <th class="right-align-text hidden-phone" style="width:12%"> Labels </th>
                <th class="right-align-text hidden-phone" style="width:12%"> Date </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="checkbox" class="no-margin" /></td>
                <td> Dulal khan </td>
                <td class="hidden-phone"><strong> Senior Creative Designer </strong><small class="info-fade"> Vector Lab </small></td>
                <td class="right-align-text hidden-phone"><span class="label label label-info"> Read </span></td>
                <td class="right-align-text hidden-phone"> Yesterday </td>
            </tr>
        </tbody>
    </table>
</div>-->