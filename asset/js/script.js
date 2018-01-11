
//function add_cart() {
//    var qty = parseInt($("#p-num").text());
//    if(qty<50) {
//        qty += 1;
//        $("#p-num").text(qty);
//    }
//}
//

//************************************************************
// NUMBER FORMAT ORIGINAL IN JAVASCRIPT
function number_format1(number, decimals, dec_point, thousands_sep) {
    // http://kevin.vanzonneveld.net
    // + original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // + improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // + bugfix by: Michael White (http://crestidg.com)
    // + bugfix by: Benjamin Lupton
    // + bugfix by: Allan Jensen (http://www.winternet.no)
    // + revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // * example 1: number_format(1234.5678, 2, '.', '');
    // * returns 1: 1234.57

    var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
    var d = dec_point == undefined ? "," : dec_point;
    var t = thousands_sep == undefined ? "." : thousands_sep, s = n < 0 ? "-" : "";
    var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;

    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}

//********************************************************
// NUMBER FORMAT EDITED THE SAME PHP
function number_format(number, decimals, dec_point, thousands_sep) {
    // http://kevin.vanzonneveld.net
    // + original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // + improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // + bugfix by: Michael White (http://crestidg.com)
    // + bugfix by: Benjamin Lupton
    // + bugfix by: Allan Jensen (http://www.winternet.no)
    // + revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // * example 1: number_format(1234.5678, 2, '.', '');
    // * returns 1: 1234.57

    var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 0 : decimals;
    var d = dec_point == undefined ? "." : dec_point;
    var t = thousands_sep == undefined ? "," : thousands_sep, s = n < 0 ? "-" : "";
    var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;

    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}

$(document).ready(function () {
    $(".add_cart").click(function () {
        var product_id = $(this).attr("data-pid");
        $.ajax({
            type: "GET",
            url: "./ajax-add-cart.php",
            data: "pid=" + product_id,
            success: function (data) {
                $("#p-num").html(data);

                $.Notifier("Thông báo",
                        "Thêm sản phẩm vào giỏ hàng thành công",
                        "success",
                        {
                            vertical_align: "center",
                            rtl: false,
                            btns: [
                                {
                                    label: "Tiếp tục mua hàng",
                                    type: "error",
                                    onClick: function () {
                                    }
                                },
                                {
                                    label: "Tiến hành thanh toán",
                                    type: "success",
                                    onClick: function () {
                                        window.location.href = "./cart.php";
                                        return true;
                                    }
                                }
                            ],
                            callback: function () {
                            }
                        });
            }
        });
    });

});

$(document).ready(function () {
    $(".minus").click(function () {
        var id = $(this).attr("data-id");
        $.ajax({
            type: "GET",
            url: "ajax-cart-change.php",
            data: "delete_product_id=" + $(this).attr("data-id"),
            success: function (data) {
//                alert("OK");
//                alert(data.quantity);
//                alert("#change-num-" + id);
                var result = $.parseJSON(data);
                $("#change-num-" + id).text(result.quantity);
                $("#sum-price-" + id).text(number_format(result.sumprice) + " đ");
                $("#temp-money").text(number_format(result.totalmoney) + " đ");
                $("#total-money").text(number_format(result.totalmoney) + " đ");
                $("#notify-num-box").text(number_format(result.sumquantity));
            }
        });
    });

    $(".plus").click(function () {
        var id = $(this).attr("data-id");
        $.ajax({
            type: "GET",
            url: "ajax-cart-change.php",
            data: "add_product_id=" + $(this).attr("data-id"),
            success: function (data) {
                var result = $.parseJSON(data);
                $("#change-num-" + id).text(result.quantity);
                $("#sum-price-" + id).text(number_format(result.sumprice) + " đ");
                $("#temp-money").text(number_format(result.totalmoney) + " đ");
                $("#total-money").text(number_format(result.totalmoney) + " đ");
                $("#notify-num-box").text(number_format(result.sumquantity));
            }
        });
    });
});

$(document).ready(function () {
    $(".remove-product").click(function () {
        var pid = $(this).attr("data-id");
        $.Notifier("Thông báo",
                "Bạn thật sự muốn xóa sản phẩm này?",
                "warning",
                {
                    vertical_align: "center",
                    rtl: false,
                    btns: [
                        {
                            label: "Xác nhận",
                            type: "success",
                            onClick: function () {
//                                window.location.href = "./ajax-cart-change.php";
//                                return true;
                                $.ajax({
                                    type: "GET",
                                    url: 'ajax-cart-change.php',
                                    data: "remove_product_id=" + pid,
                                    success: function (data) {
                                        var result = $.parseJSON(data);
                                        if (result.status == 1) {
                                            $('#row-id-' + pid).remove();
//                                            window.location.href = "./ajax-cart.php";
                                        } else {
                                            alert('There is someting wrong!');
                                        }
                                        $("#temp-money").text(number_format(result.totalmoney) + " đ");
                                        $("#total-money").text(number_format(result.totalmoney) + " đ");

                                        $("#notify-container").empty();
                                        $("#notify-container").append("<div class='alert alert-success'>"
                                                + "<button data-dismiss='alert' class='close'>×</button>"
                                                + "Bạn đã xóa sản phẩm <b>" + result.productname + "</b> thành công </div>");
//                                        $("#notify-box").text("");
                                        $("#notify-num-box").text(number_format(result.sumquantity));
                                        if (result.sumquantity <= 0) {
                                            $("#check-out-container").empty();
                                        }
                                    }
                                });
                            }
                        },
                        {
                            label: "Hủy bỏ",
                            type: "error",
                            onClick: function () {}
                        }
                    ],
                    callback: function () {}
                });
    });
});

$(document).ready(function () {
    $("#check-out").click(function () {
        window.location = "checkout.php";
    });
});


    