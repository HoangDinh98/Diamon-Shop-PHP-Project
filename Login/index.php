<?php 
?>
<!DOCTYPE html>
<html>
    <head>
        <script src="jquery-3.2.1.js"></script>
        <link rel="stylesheet" href="bootstrap.css"/>
        <script src="bootstrap.js"></script>
    </head>
    <body>
        <br />
        <div class="container" style="width: 700px;">
            <?php
            if (isset($_SESSION["username"])) {
                ?>
                <div align="center">
                    <h4>Welcome - <?php echo $_SESSION['username']; ?></h4></br>
                    <a href="#" id="logout">Logout</a>
                </div>
                <?php
            } else {
                ?>
                <div align="center"
                     <button type="button" name="login" id="login" class="btn btn-success" data-toggle="modal" data-target="#loginModal">Login</button>
                </div>    
                <?php
            }
            ?>
            <div id="loginModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismis="modal">&times;</button>
                            <h2 class="modal-title">Login</h2>
                        </div>
                        <div class="modal-body">
                            <label>Username</label>
                            <input type="text" name="username" id="username" placeholder="Insert your username" class="form-control" />
                            <br>
                            <label>Password</label>
                            <input type="password" name="password" id="password" placeholder="Insert your password" class="form-control" />
                            <br>
                            <button type="button" name="login-button" id="login-button" class="btn btn-warning">Login</button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
//                $("#login-button").click(function () {
//                    alert("sssss");
//                }
//                )
            </script>
            <script>
                $(document)ready(function() {
                    $('#login-button').click(function() {
                        alert("AAAA");
                        var username = $('#username').val();
                        var password = $('#password').val();
                        if (username != '' && password != '')
                        {
                            $.ajax({
                                url: "action.php",
                                METHOD: "POST",
                                data: {username: username, passowrd: password},
                                success: function (data) {
                                    if (data == 'NO') {
                                        alert("Wrong DATA");
                                    } else
                                    {
                                        $('#loginModal').hide();
                                        location.reload();
                                    }

                                }
                            });
                        } else
                        {
                            alert("Both Fields are required");
                        }
                    });
                    
                    $('#logout').clock(funtion(){
                        var action = "logout";
                        $.ajax({
                            url: "action.php",
                            method: "POST",
                            data: {action: action},
                            success: function (data) {
                                location.reload();
                            }
                        });
                    });
                    });
            </script>
    </body>
</html>

