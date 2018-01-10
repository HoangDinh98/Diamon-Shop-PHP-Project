<a class="stickcart" href="./cart.php">
    <div>
        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
    </div>
    <span class="p-num" id="p-num">
        <p>
            <?php
            if (isset($_SESSION['product'])) {
                echo $_SESSION['product_num'];
            } else {
                echo 0;
            }
            ?>
        </p>
    </span>
    <!--<strong id="qty-p">0 sản phẩm</strong>-->
</a>

