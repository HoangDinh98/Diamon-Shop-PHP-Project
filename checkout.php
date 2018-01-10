<?php
include './include.php';
include './header.php';
?>
<section class="header_text sub">
<!--    <img class="pageBanner" src="themes/images/pageBanner.png" alt="New products" >-->
    <h4><span>THÔNG TIN ĐẶT HÀNG</span></h4>
</section>	
<section class="main-content">
    <div class="row">
        <div class="span12">
            <div class="accordion-group">
                <div class="accordion-inner">
                    <div class="row-fluid">
                        <div class="span6">
                            <h4>Thông tin người nhận</h4>
                            <div class="control-group">
                                <label class="control-label">Tên</label>
                                <div class="controls">
                                    <input type="text" placeholder="" class="input-xlarge">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Họ</label>
                                <div class="controls">
                                    <input type="text" placeholder="" class="input-xlarge">
                                </div>
                            </div>					  
                            <div class="control-group">
                                <label class="control-label">Số điện thoại</label>
                                <div class="controls">
                                    <input type="text" placeholder="" class="input-xlarge">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Email</label>
                                <div class="controls">
                                    <input type="text" placeholder="" class="input-xlarge">
                                </div>
                            </div>
                        </div>
                        
                        <div class="span6">
                            <h4>Địa chỉ nhận hàng</h4>
                            <div class="control-group">
                                <label class="control-label">Company</label>
                                <div class="controls">
                                    <input type="text" placeholder="" class="input-xlarge">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Company ID:</label>
                                <div class="controls">
                                    <input type="text" placeholder="" class="input-xlarge">
                                </div>
                            </div>					  
                            <div class="control-group">
                                <label class="control-label"><span class="required">*</span> Address 1:</label>
                                <div class="controls">
                                    <input type="text" placeholder="" class="input-xlarge">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Address 2:</label>
                                <div class="controls">
                                    <input type="text" placeholder="" class="input-xlarge">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><span class="required">*</span> City:</label>
                                <div class="controls">
                                    <input type="text" placeholder="" class="input-xlarge">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><span class="required">*</span> Post Code:</label>
                                <div class="controls">
                                    <input type="text" placeholder="" class="input-xlarge">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><span class="required">*</span> Country:</label>
                                <div class="controls">
                                    <select class="input-xlarge">
                                        <option value="1">Afghanistan</option>
                                        <option value="2">Albania</option>
                                        <option value="3">Algeria</option>
                                        <option value="4">American Samoa</option>
                                        <option value="5">Andorra</option>
                                        <option value="6">Angola</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><span class="required">*</span> Region / State:</label>
                                <div class="controls">
                                    <select name="zone_id" class="input-xlarge">
                                        <option value=""> --- Please Select --- </option>
                                        <option value="3513">Aberdeen</option>
                                        <option value="3514">Aberdeenshire</option>
                                        <option value="3515">Anglesey</option>
                                        <option value="3516">Angus</option>
                                        <option value="3517">Argyll and Bute</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>			
        </div>
    </div>
</section>

<?php
include './footer.php';
?>

