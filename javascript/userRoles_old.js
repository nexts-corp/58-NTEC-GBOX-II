$(document).ready(function(){

    $('.bt_sl_dv').click(function(){

        var template = '';
        $("#deviceDialog").html(template);


        $("#deviceDialog").dialog("open");
    });

    $("#deviceDialog").dialog({
        autoOpen: false,
        dialogClass: "alert",
        modal: true,
        show: {
            effect: "slide",
            duration: 500
        },
        hide: {
            effect: "slide",
            duration: 500
        }

    });

});



function rolesInit(){

    $.post( "getdata/roles.php",{action:'show'}, function( data ) {
        $(".display").html(data);
    });


}
