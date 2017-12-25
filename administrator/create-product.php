<?php

include 'include.php';
include 'header.php';
//include 'footer.php';
?>
<script type="text/javascript" src="./ckeditor/ckeditor.js"></script>

<div id="page" class="dashboard">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget">
                <div class="widget-body">
                    <form class="form-horizontal" action="/action_page.php">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Tên sản phẩm:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Số lượng:</label>
                            <div class="col-sm-10">          
                                <input type="text" class="form-control" id="quantity" name="quantity">
                            </div>
                        </div>
                        <!--                        <div class="form-group">        
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <div class="checkbox">
                                                            <label><input type="checkbox" name="remember"> Remember me</label>
                                                        </div>
                                                    </div>
                                                </div>-->
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Số lượng:</label>
                            <div class="col-sm-10">          
                                <input type="text" class="form-control" id="quantity" name="quantity">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Giá:</label>
                            <div class="col-sm-10">          
                                <input type="text" class="form-control" id="price" name="price">
                            </div>
                        </div>
<!--                        <div class="form-group">
                            
                        </div>-->
                        <div class="form-group">
                            <label class="col-sm-12" for="pwd">Mô tả:</label>
                            <div class="col-sm-12">          
                                <textarea type="text" class="form-control" id="description" name="description"> </textarea>
                            </div>
                        </div>
                        <div class="form-group">        
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    CKEDITOR.replace('description')
</script>
<?php

include 'footer.php';
?>

