<?php

include './include.php';
include './header.php';
include './checkout-validation.php';
?>
<section class="header_text sub">
<!--    <img class="pageBanner" src="themes/images/pageBanner.png" alt="New products" >-->
    <h4><span>THÔNG TIN ĐẶT HÀNG</span></h4>
    <p>Vui lòng nhập thông tin vào form dưới đấy<br>
        Những trường có dấu (*) là bắt buộc
    </p>
</section>	
<section class="main-content">
    <div class="row">
        <div class="span12">
            <div class="accordion-group">
                <div class="accordion-inner">
                    <form class="row-fluid" id="checkout-form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="span6 part-block">
                            <div class="group-block">
                                <h4>Thông tin người nhận</h4>
                                <div class="control-group">
                                    <label class="control-label"><span class="required"><b>*</b></span> Tên 
                                        <span class="required">
                                            <?php
                                                echo $firstnameErr;
                                            ?>
                                        </span>
                                    </label>
                                    <div class="controls">
                                        <input type="text" id="firstname" name="firstname" class="input-xlarge"
                                               value="<?php echo $firstname; ?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"><span class="required"><b>*</b></span> Họ 
                                        <span class="required">
                                            <?php
                                                echo $lastnameErr;
                                            ?>
                                        </span>
                                    </label>
                                    <div class="controls">
                                        <input type="text" id="lastname" name="lastname" class="input-xlarge"
                                               value="<?php echo $lastname; ?>">
                                    </div>
                                </div>					  
                                <div class="control-group">
                                    <label class="control-label"><span class="required"><b>*</b></span> Số điện thoại 
                                        <span class="required">
                                            <?php
                                            echo $phoneErr;
                                            ?>
                                        </span>
                                    </label>
                                    <div class="controls">
                                        <input type="text" id="phone" name="phone" class="input-xlarge"
                                               value="<?php echo $phone; ?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Email</label>
                                    <div class="controls">
                                        <input type="text" id="email" name="email" class="input-xlarge"
                                               value="<?php echo $email; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="span6 part-block">
                            <div class="group-block">
                                <h4>Địa chỉ nhận hàng</h4>
                                <div class="control-group">
                                    <label class="control-label"><span class="required"><b>*</b></span> Tỉnh, Thành phố 
                                        <span class="required">
                                            <?php
                                            echo $cityErr;
                                            ?>
                                        </span>
                                    </label>
                                    <div class="controls">
                                        <input type="text" id="city" name="city" class="input-xlarge"
                                               value="<?php echo $city; ?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"><span class="required"><b>*</b></span> Quận, Huyện 
                                        <span class="required">
                                            <?php
                                            echo $districtErr;
                                            ?>
                                        </span>
                                    </label>
                                    <div class="controls">
                                        <input type="text" id="district" name="district" class="input-xlarge"
                                               value="<?php echo $district; ?>">
                                    </div>
                                </div>					  
                                <div class="control-group">
                                    <label class="control-label"><span class="required"><b>*</b></span> Phường, Xã, Thị trấn 
                                        <span class="required">
                                            <?php
                                            echo $townErr;
                                            ?>
                                        </span>
                                    </label>
                                    <div class="controls">
                                        <input type="text" id="town" name="town" class="input-xlarge"
                                               value="<?php echo $town; ?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"><span class="required"><b>*</b></span> Số nhà, Thôn, Xóm 
                                        <span class="required">
                                            <?php
                                            echo $villageErr;
                                            ?>
                                        </span>
                                    </label>
                                    <div class="controls">
                                        <input type="text" id="village" name="village" class="input-xlarge"
                                               value="<?php echo $village; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="span12" style="margin-left: 0px; text-align: center;">
                            <input type="submit" name="checkout_submit" id="checkout_submit"
                                   value="XÁC NHẬN THÔNG TIN VÀ ĐẶT HÀNG">
                        </div>
                    </form>
                </div>
            </div>			
        </div>
    </div>
</section>

<?php

include './footer.php';
?>

