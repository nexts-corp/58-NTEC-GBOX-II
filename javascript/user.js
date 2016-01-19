function userInit(){
    var html = '<div style="min-width: 100%; height: 100%; text-align: center;">'
                + '<fieldset style="background-color: #ffffff;">'
                    + '<div id="userOption" style="margin-bottom: 10px;">'
                        + '<button class="button" onclick="javascript: userInsert();">เพิ่มผู้ใช้งาน</button>'
                    + '</div>'
                    + '<div class="data-table">'
                        + '<table>'
                            + '<thead>'
                                + '<tr>'
                                    + '<th width="10%">ลำดับที่</th>'
                                    + '<th width="15%">ชื่อ</td>'
                                    + '<th width="15%">นามสกุล</th>'
                                    + '<th width="15%">Username</th>'
                                    + '<th width="10%">สิทธิผู้ใช้งาน</th>'
                                    + '<th width="15%">Super User<br>(กรณีที่เป็น User)</th>'
                                    + '<th colspan="2" width="20%">แก้ไข/ลบ</th>'
                                + '</tr>'
                            + '</thead>'
                            + '<tbody id="userTable">'
                                + '<tr class="odd">'
                                    + '<td colspan="8"><b>ไม่พบข้อมูล</b></td>'
                                + '</tr>'
                            + '</tbody>'
                        + '</table>'
                    + '</div>'
                + '</fieldset>'
            + '</div>';

    $(".display").html(html);

    $.ajax({
        url: "getdata/user.php",
        type: "POST",
        async: false,
        dataType: "json",
        data:{
            action: "show"
        },
        success:function(result){
            var html;
            if(result.data.length > 0){
                var count = 0;
                for(var i = 0; i < result.data.length; i++){
                    count++;
                    var data = result.data[i];
                    var user_id = getTag(data["user_id"], "-");
                    var firstname = getTag(data["firstname"], "-");
                    var lastname = getTag(data["lastname"], "-");
                    var username = getTag(data["username"], "-");
                    var role = getTag(data["role"], "-");
                    var superuser = getTag(data["superuser"], "-");

                    var row;
                    if(i % 2 == 0) row = "odd";
                    else row = "even";

                    html += '<tr class="'+row+'">'
                            + '<td>'+count+'</td>'
                            + '<td>'+firstname+'</td>'
                            + '<td>'+lastname+'</td>'
                            + '<td>'+username+'</td>'
                            + '<td>'+role+'</td>'
                            + '<td>'+superuser+'</td>'
                            + '<td align="center"><button class="button" onclick="javascript: userUpdate('+user_id+');">แก้ไข</button></td>'
                            + '<td align="center"><button class="button-clear" onclick="javascript: userDelete('+user_id+');">ลบข้อมูล</button></td>'
                        + '</tr>';
                }
            }
            else{
                html = '<tr class="odd">'
                        + '<td colspan="7"><b>ไม่พบข้อมูลอุปกรณ์</b></td>'
                    + '</tr>';
            }
            $("#userTable").html(html);
        }
    });
}

function userInsert(){
    userForm("insert");
    $("#dialogHome").dialog({
        resizable: false,
        title: "เพิ่มผู้ใช้งาน",
        width: "auto",
        height: "auto",
        draggable: false,
        modal: true,
        buttons: {
            "บันทึก": function() {
                userSaveInsert();
            }
        }
    });
}

function userUpdate(user_id){
    userForm("update");
    $("#dialogHome").dialog({
        resizable: false,
        title: "แก้ไขผู้ใช้งาน",
        width: "auto",
        height: "auto",
        draggable: false,
        modal: true,
        buttons: {
            "บันทึก": function() {
                userSaveUpdate(user_id);
            }
        }
    });

    $.ajax({
        url: "getdata/user.php",
        type: "POST",
        async: false,
        dataType: "json",
        data:{
            action: "select",
            user_id: user_id
        },
        success:function(result){
            if(result.data.length > 0){
                var data = result.data[0];
                var firstname = getTag(data["firstname"], "");
                var lastname = getTag(data["lastname"], "");
                var email = getTag(data["email"], "");
                var address = getTag(data["address"], "");
                var phone = getTag(data["telephone"], "");
                var role = getTag(data["role"], "");
                var superuser = getTag(data["superuser"], "");

                $("#userFirstname").val(firstname);
                $("#userLastname").val(lastname);
                $("#userEmail").val(email);
                $("#userAddress").val(address);
                $("#userPhone").val(phone);
                $("#userRoleId").val(role);
                $("#userSuperuser").val(superuser);
            }
        }
    });
}

function userDelete(user_id){
    userForm("delete");
    $("#dialogHome").dialog({
        resizable: false,
        title: "ลบผู้ใช้งาน",
        width: "auto",
        height: "auto",
        draggable: false,
        modal: true,
        buttons: {
            "ยืนยันการลบ": function() {
                userSaveDelete(user_id);
            }
        }
    });

    $.ajax({
        url: "getdata/user.php",
        type: "POST",
        async: false,
        dataType: "json",
        data:{
            action: "select",
            user_id: user_id
        },
        success:function(result){
            if(result.data.length > 0){
                var data = result.data[0];
                var firstname = getTag(data["firstname"], "");
                var lastname = getTag(data["lastname"], "");
                var email = getTag(data["email"], "");
                var address = getTag(data["address"], "");
                var phone = getTag(data["telephone"], "");
                var role = getTag(data["role"], "");
                var superuser = getTag(data["superuser"], "");

                $("#userFirstname").val(firstname).attr("disabled", "disabled");
                $("#userLastname").val(lastname).attr("disabled", "disabled");
                $("#userEmail").val(email).attr("disabled", "disabled");
                $("#userAddress").val(address).attr("disabled", "disabled");
                $("#userPhone").val(phone).attr("disabled", "disabled");
                $("#userRoleId").val(role).attr("disabled", "disabled");
                $("#userSuperuser").val(superuser).attr("disabled", "disabled");
            }
        }
    });
}

function userSaveInsert(){
    if($("#userFirstname").val() == "") $("#userFirstname").focus();
    else if($("#userLastname").val() == "") $("#userLastname").focus();
    else if($("#userEmail").val() == "") $("#userEmail").focus();
    else if($("#userUsername").val() == "") $("#userUsername").focus();
    else if($("#userPassword").val() == "") $("#userPassword").focus();
    else if($("#userPassword2").val() == "") $("#userPassword2").focus();
    else if($("#userRoleId").val() == "") $("#userRoleId").focus();
    else if ($("#userPassword").val() != $("#userPassword2").val()){
        $("#userPassword").val('').focus();
        $("#userPassword2").val('');
        $("#userStatusLoading").html('<span style="color: red;">รหัสผ่านไม่ตรงกัน</span>');
    }
    else{
        $("#userStatusLoading").html('<img src="images/loading.gif">');

        setTimeout(
            function(){
                $.ajax({
                    url: "getdata/user.php",
                    type: "POST",
                    async: false,
                    dataType: "json",
                    data:{
                        action: "insert",
                        firstname: $("#userFirstname").val(),
                        lastname: $("#userLastname").val(),
                        username: $("#userUsername").val(),
                        password: $("#userPassword").val(),
                        email: $("#userEmail").val(),
                        address: $("#userAddress").val(),
                        telephone: $("#userPhone").val(),
                        role_id: $("#userRoleId").val(),
                        superuser: $("#userSuperuser").val()
                    },
                    success:function(result){
                        var data = result.data[0];
                        var status = data["status"];
                        if(status == "Success"){
                            $("#userStatusLoading").html('<font color="blue"><b>จัดเก็บข้อมูลเรียบร้อย</b></font>');

                            setTimeout(function(){
                                userInit();
                                $("#dialogHome").dialog("close");
                            }, 1000);
                        }
                        else{
                            var message = data["message"];
                            $("#userStatusLoading").html('<font color="red"><b>ไม่สามารถจัดเก็บข้อมูลได้</b></font><br>'+message);
                        }
                    }
                });
            }
        , 100);
    }
}

function userSaveUpdate(user_id){
    if($("#userFirstname").val() == "") $("#userFirstname").focus();
    else if($("#userLastname").val() == "") $("#userLastname").focus();
    else if($("#userEmail").val() == "") $("#userEmail").focus();
    else if($("#userRoleId").val() == "") $("#userRoleId").focus();
    else{
        $("#userStatusLoading").html('<img src="images/loading.gif">');

        setTimeout(
            function(){
                $.ajax({
                    url: "getdata/user.php",
                    type: "POST",
                    async: false,
                    dataType: "json",
                    data:{
                        action: "update",
                        user_id: user_id,
                        firstname: $("#userFirstname").val(),
                        lastname: $("#userLastname").val(),
                        username: $("#userUsername").val(),
                        password: $("#userPassword").val(),
                        email: $("#userEmail").val(),
                        address: $("#userAddress").val(),
                        telephone: $("#userPhone").val(),
                        role_id: $("#userRoleId").val(),
                        superuser: $("#userSuperuser").val()
                    },
                    success:function(result){
                        var data = result.data[0];
                        var status = data["status"];
                        if(status == "Success"){
                            $("#userStatusLoading").html('<font color="blue"><b>จัดเก็บข้อมูลเรียบร้อย</b></font>');

                            setTimeout(function(){
                                userInit();
                                $("#dialogHome").dialog("close");
                            }, 1000);
                        }
                        else{
                            var message = data["message"];
                            $("#userStatusLoading").html('<font color="red"><b>ไม่สามารถจัดเก็บข้อมูลได้</b></font><br>'+message);
                        }
                    }
                });
            }
        , 100);
    }
}

function userSaveDelete(user_id){
    $("#userStatusLoading").html('<img src="images/loading.gif">');

    setTimeout(
        function(){
            $.ajax({
                url: "getdata/user.php",
                type: "POST",
                async: false,
                dataType: "json",
                data:{
                    action: "delete",
                    user_id: user_id
                },
                success:function(result){
                    var data = result.data[0];
                    var status = data["status"];
                    if(status == "Success"){
                        $("#userStatusLoading").html('<font color="blue"><b>จัดเก็บข้อมูลเรียบร้อย</b></font>');
                        setTimeout(function(){
                            userInit();
                            $("#dialogHome").dialog("close");
                        }, 1000);
                    }
                    else{
                        var message = data["message"];
                        $("#userStatusLoading").html('<font color="red"><b>ไม่สามารถจัดเก็บข้อมูลได้</b></font><br>'+message);
                    }
                }
            });
        }
    , 100);
}

function userForm(option){
    var html = '<form onsubmit="return false;">'
                + '<fieldset>'
                    + '<table width="600px" border="0" cellpadding="0" align="center">'
                        + '<tr>'
                            + '<td>ชื่อ <div class="required-fill">**</div></td>'
                            + '<td>'
                                + '<fieldset class="inputs" style="border: 0;">'
                                    + '<input id="userFirstname" name="userFirstname" type="text" autofocus>'
                                + '</fieldset>'
                            + '</td>'
                        + '</tr>'
                        + '<tr>'
                            + '<td>นามสกุล <div class="required-fill">**</div></td>'
                            + '<td>'
                                + '<fieldset class="inputs" style="border: 0;">'
                                    + '<input id="userLastname" name="userLastname" type="text">'
                                + '</fieldset>'
                            + '</td>'
                        + '</tr>'
                        + '<tr>'
                            + '<td>อีเมลล์ <div class="required-fill">**</div></td>'
                            + '<td>'
                                + '<fieldset class="inputs" style="border: 0;">'
                                    + '<input id="userEmail" name="userEmail" type="text">'
                                + '</fieldset>'
                            + '</td>'
                        + '</tr>'
                        + '<tr>'
                            + '<td>เบอร์โทรศัพท์</td>'
                            + '<td>'
                                + '<fieldset class="inputs" style="border: 0;">'
                                    + '<input id="userPhone" name="userPhone" type="text">'
                                + '</fieldset>'
                            + '</td>'
                        + '</tr>'
                        + '<tr>'
                            + '<td>ที่อยู่</td>'
                            + '<td>'
                                + '<fieldset class="inputs" style="border: 0;">'
                                    + '<input id="userAddress" name="userAddress" type="text">'
                                + '</fieldset>'
                            + '</td>'
                        + '</tr>';

                if(option == "insert"){
                    html += '<tr>'
                            + '<td>Username <div class="required-fill">**</div></td>'
                            + '<td>'
                                + '<fieldset class="inputs" style="border: 0;">'
                                    + '<input id="userUsername" name="userUsername" type="text">'
                                + '</fieldset>'
                            + '</td>'
                        + '</tr>'
                        + '<tr>'
                            + '<td>รหัสผ่าน <div class="required-fill">**</div></td>'
                            + '<td>'
                                + '<fieldset class="inputs" style="border: 0;">'
                                    + '<input id="userPassword" name="userPassword" type="password">'
                                + '</fieldset>'
                            + '</td>'
                        + '</tr>'
                        + '<tr>'
                            + '<td>รหัสผ่านอีกครั้ง <div class="required-fill">**</div></td>'
                            + '<td>'
                                + '<fieldset class="inputs" style="border: 0;">'
                                    + '<input id="userPassword2" name="userPassword2" type="password">'
                                + '</fieldset>'
                            + '</td>'
                        + '</tr>';
                }

                html += '<tr>'
                            + '<td>ระดับผู้ใช้งาน <div class="required-fill">**</div></td>'
                            + '<td>'
                                + '<div class="styled-select">'
                                    + '<select id="userRoleId" name="userRoleId" onchange="javascript: showSuperuser();">'
                                        + '<option value=""></option>'
                                    + '</select>'
                                + '</div>'
                            + '</td>'
                        + '</tr>'

                        + '<tr>'
                            + '<td><div id="divUserSuperuserLabel">Super User </div></td>'
                            + '<td>'
                                + '<div id="divUserSuperuser" class="styled-select">'
                                    + '<select id="userSuperuser" name="userSuperuser">'
                                        + '<option value=""></option>'
                                    + '</select>'
                                + '</div>'
                            + '</td>'
                        + '</tr>'

                        + '<tr>'
                            + '<td colspan="2" align="center">'
                                + '<div id="userStatusLoading"></div>'
                            + '</td>'
                        + '</tr>'
                    + '</table>'
                + '</fieldset>'
            + '</form>';

    $("#dialogHome").html(html);

    $.ajax({
        url: "getdata/user.php",
        type: "POST",
        async: false,
        dataType: "json",
        data:{
            action: "get_role"
        },
        success:function(result){
            var html = '';
            if(result.data.length > 0){
                for(var i = 0; i < result.data.length; i++){
                    var data = result.data[i];
                    var id = data["role_id"];
                    var role = data["role_th"];

                    html += '<option value="'+id+'">'+role+'</option>'
                }
            }

            $("#userRoleId").html(html);
        }
    });

    $.ajax({
        url: "getdata/user.php",
        type: "POST",
        async: false,
        dataType: "json",
        data:{
            action: "get_superuser"
        },
        success:function(result){
            var html = '';
            if(result.data.length > 0){
                for(var i = 0; i < result.data.length; i++){
                    var data = result.data[i];
                    var username = data["username"];
                    var firstname = data["firstname"];
                    var lastname = data["lastname"];

                    html += '<option value="'+username+'">'+firstname+' '+lastname+'</option>'
                }
            }

            $("#userSuperuser").html(html);
        }
    });
}

function showSuperuser(){
    if($("#userRoleId").val() == 1){
        $("#divUserSuperuserLabel").show();
        $("#divUserSuperuser").show();
    }
    else{
        $("#divUserSuperuserLabel").hide();
        $("#divUserSuperuser").hide();
    }
}
