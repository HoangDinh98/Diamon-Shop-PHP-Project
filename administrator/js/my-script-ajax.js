$(document).ready(function () {
    $('#product-page').click(function () {
        $.ajax({
            url: "product-page.php",
            data: {
                
            },
            success: function (html) {
                jQuery('#work-space').html(html);
            }
        });
    })
}
)


