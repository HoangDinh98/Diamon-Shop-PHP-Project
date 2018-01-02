<?php require_once("./include.php"); ?>


<option value="0">-- Vui lòng chọn--</option>
<?php
if (isset($_GET['c'])&& $_GET['c']>0) {
    $cs = mysqli_query($connect, "SELECT * FROM categories WHERE parent_id=$_GET[c]");
    while ($ci = mysqli_fetch_array($cs)) {
        ?>
        <option value="<?php echo $ci['id'] ?>" ><?php echo $ci['name'] ?></option>
        <?php
    }
}
?>
