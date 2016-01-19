function login(){
    if($("#username").val() != "" && $("#password").val() != ""){
        $.ajax({
            url: "getdata/login.php",
            type: "POST",
            async: false,
            dataType: "json",
            data:{
                action: "login",
                username: $("#username").val(),
                password: $("#password").val()
            },
            success:function(result){
                if(result.data.length > 0){
                    var data = result.data[0];
                    var status = data["status"];
                    if(status == "Success"){
                        var role = data["role"];
                        if(role == "Administrator") window.location = "index_admin.php";
                        else if(role == "Superuser") window.location = "index_superuser.php";
                        else if(role == "User") window.location = "index_user.php";
                    }
                    else{
                        var message = data["message"];
                        $("#messageError").html(message);
                        $("#password").val('');
                    }
                }
            }
        });
    }
}

function logout(){
    $("#dialogHome").html('<div style="width: 250px;">คุณต้องการออกจากระบบ?</div>').dialog({
        resizable: false,
        title: "ออกจากระบบ",
        width: "auto",
        height: "auto",
        draggable: false,
        modal: true,
        buttons: {
            "ยืนยัน": function() {
                $.ajax({
                    url: "getdata/login.php",
                    type: "POST",
                    async: false,
                    dataType: "json",
                    data:{
                        action: "logout"
                    },
                    success:function(result){
                        window.location = "login.php";
                    }
                });
            },
            "ยกเลิก": function() {
                $( this ).dialog( "close" );
            }
        }
    });
}

function forgetPassword(){
    var html = '<div style="width: 500px">'
                + '<fieldset class="inputs-login" style="border: 0;">'
                    + '<input id="usernameSend" name="usernameSend" type="text" placeholder="Username ที่ใช้ในระบบ" autofocus>'
                    + '<input id="emailSend" name="emailSend" type="text" placeholder="Email ที่ใช้ในระบบ">'
                    + '<div id="statusSend" style="width: 100%; text-align: center;"></div>'
                + '</fieldset>'
            + '</div>';

    $("#dialogLogin").html(html).dialog({
        resizable: false,
        title: "ลืมรหัสผ่าน",
        width: "auto",
        height: "auto",
        draggable: false,
        modal: true,
        buttons: {
            "ส่งเข้า Email": function() {
                if($("#usernameSend").val() == ""){
                    $("#usernameSend").focus();
                }
                else if($("#emailSend").val() == ""){
                    $("#emailSend").focus();
                }
                else{
                    $("#statusSend").html('<img src="images/loading.gif">');
                    setTimeout(
                        function(){
                            $.ajax({
                                url: "getdata/login.php",
                                type: "POST",
                                async: false,
                                dataType: "json",
                                data:{
                                    action: "send_password",
                                    username: $("#usernameSend").val(),
                                    email: $("#emailSend").val()
                                },
                                success:function(result){
                                    var data = result.data[0];
                                    var status = data["status"];

                                    if(status == "Success"){
                                        $("#statusSend").html('<span style="color: blue;">เราได้ส่งรหัสผ่านใหม่เข้า Email ของคุณแล้ว</span>');
                                    }
                                    else{
                                        var message = data["message"];
                                        $("#statusSend").html('<span style="color: red;">'+message+'</span>');
                                    }
                                }
                            });
                        }
                    , 100);
                }
            },
            "ยกเลิก": function() {
                $(this).dialog("close");
            }
        }
    });
}