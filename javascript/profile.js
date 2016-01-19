function editProfile(){
    var html = '<form onsubmit="return false;">'
                + '<fieldset>'
                    + '<table style="width: 600px;" align="center">'
                        + '<tr>'
                            + '<td align="right">Username <div class="required-fill">**</div></td>'
                            + '<td align="center">'
                                + '<fieldset class="inputs" style="border: 0;">'
                                    + '<input id="editUsername" name="editUsername" type="text" readonly="readonly" />'
                                + '</fieldset>'
                            + '</td>'
                        + '</tr>'
                        + '<tr>'
                            + '<td align="right">ชื่อ <div class="required-fill">**</div></td>'
                            + '<td align="center">'
                                + '<fieldset class="inputs" style="border: 0;">'
                                    + '<input id="editFirstname" name="editFirstname" type="text" autofocus>'
                                + '</fieldset>'
                            + '</td>'
                        + '</tr>'
                        + '<tr>'
                            + '<td align="right">นามสกุล <div class="required-fill">**</div></td>'
                            + '<td align="center">'
                                + '<fieldset class="inputs" style="border: 0;">'
                                    + '<input id="editLastname" name="editLastname" type="text">'
                                + '</fieldset>'
                            + '</td>'
                        + '</tr>'
                        + '<tr>'
                            + '<td align="right">อีเมลล์ <div class="required-fill">**</div></td>'
                            + '<td align="center">'
                                + '<fieldset class="inputs" style="border: 0;">'
                                    + '<input id="editEmail" name="editEmail" type="text">'
                                + '</fieldset>'
                            + '</td>'
                        + '</tr>'
                        + '<tr>'
                            + '<td align="right">เบอร์โทรศัพท์</td>'
                            + '<td align="center">'
                                + '<fieldset class="inputs" style="border: 0;">'
                                    + '<input id="editPhone" name="editPhone" type="text" required>'
                                + '</fieldset>'
                            + '</td>'
                        + '</tr>'
                        + '<tr>'
                            + '<td align="right">ที่อยู่</td>'
                            + '<td align="center">'
                                + '<fieldset class="inputs" style="border: 0;">'
                                    + '<input id="editAddress" name="editAddress" type="text">'
                                + '</fieldset>'
                            + '</td>'
                        + '</tr>'
                        + '<tr>'
                            + '<td colspan="2" align="center"><div id="profileLoading"></div></td>'
                        + '</tr>'
                    + '</table>'
                + '</fieldset>'
            + '</form>';

    $("#dialogHome").html(html).dialog({
        resizable: false,
        title: "แก้ไขข้อมูลส่วนตัว",
        width: "auto",
        height: "auto",
        draggable: false,
        modal: true,
        buttons: {
            "บันทึก": function() {
                saveEditProfile();
            }
        }
    });

    setTimeout(
        function(){
            $.ajax({
                url: "getdata/profile.php",
                type: "POST",
                async: false,
                dataType: "json",
                data:{
                    action: "show_profile"
                },
                success:function(result){
                    var data = result.data[0];
                    var firstname = getTag(data["firstname"], "");
                    var lastname = getTag(data["lastname"], "");
                    var username = getTag(data["username"], "");
                    var email = getTag(data["email"], "");
                    var address = getTag(data["address"], "");
                    var phone = getTag(data["phone"], "");

                    $("#editUsername").val(username);
                    $("#editFirstname").val(firstname);
                    $("#editLastname").val(lastname);
                    $("#editEmail").val(email);
                    $("#editAddress").val(address);
                    $("#editPhone").val(phone);
                }
            });
        }
    , 0);
}

function saveEditProfile(){
    if($("#editUsername").val() == "") $("#editUsername").focus();
    else if($("#editFirstname").val() == "") $("#editFirstname").focus();
    else if($("#editLastname").val() == "") $("#editLastname").focus();
    else if($("#editEmail").val() == "") $("#editEmail").focus();
    else{
        $("#profileLoading").html('<img src="images/loading.gif" />');
        setTimeout(
           function(){
               $.ajax({
                   url: "getdata/profile.php",
                   type: "POST",
                   async: false,
                   dataType: "json",
                   data:{
                       action: "save_profile",
                       firstname: $("#editFirstname").val(),
                       lastname: $("#editLastname").val(),
                       email: $("#editEmail").val(),
                       address: $("#editAddress").val(),
                       telephone: $("#editTelephone").val()
                   },
                   success:function(result){
                       var data = result.data[0];
                       var status = getTag(data["status"], "");

                       if(status == "success"){
                           $("#profileLoading").html('<span style="color: blue;">บันทึกข้อมูลเรียบร้อย</span>');
                           setTimeout(function (){
                               $("#name").html($("#editFirstname").val()+' '+$("#editLastname").val());
                               $("#dialogHome").dialog("close");
                           }, 1000);
                       }
                       else{
                           $("#profileLoading").html('<span style="color: red;">ไม่สามารถบันทึกข้อมูลได้</span>');
                       }
                   }
               });
           }
        , 1000);
    }
}

function changePassword(){
    var html = '<form onsubmit="return false;">'
                + '<fieldset>'
                    + '<table style="width: 600px;" align="center">'
                        + '<tr>'
                            + '<td align="right">รหัสเดิม <div class="required-fill">**</div></td>'
                            + '<td align="center">'
                                + '<fieldset class="inputs" style="border: 0;">'
                                    + '<input id="editPasswordOld" name="editPasswordOld" type="password" autofocus/>'
                                + '</fieldset>'
                            + '</td>'
                        + '</tr>'
                        + '<tr>'
                            + '<td align="right">รหัสใหม่ <div class="required-fill">**</div></td>'
                            + '<td align="center">'
                                + '<fieldset class="inputs" style="border: 0;">'
                                    + '<input id="editPasswordNew1" name="editPasswordNew1" type="password">'
                                + '</fieldset>'
                            + '</td>'
                        + '</tr>'
                        + '<tr>'
                            + '<td align="right">ยืนยันรหัสใหม่ <div class="required-fill">**</div></td>'
                            + '<td align="center">'
                                + '<fieldset class="inputs" style="border: 0;">'
                                    + '<input id="editPasswordNew2" name="editPasswordNew2" type="password">'
                                + '</fieldset>'
                            + '</td>'
                        + '</tr>'
                        + '<tr>'
                            + '<td colspan="2" align="center"><div id="passwordLoading"></div></td>'
                        + '</tr>'
                    + '</table>'
                + '</fieldset>'
            + '</form>';

    $("#dialogHome").html(html).dialog({
        resizable: false,
        title: "เปลี่ยนรหัสผ่าน",
        width: "auto",
        height: "auto",
        draggable: false,
        modal: true,
        buttons: {
            "บันทึก": function() {
                saveChangePassword();
            }
        }
    });
}

function saveChangePassword(){
    if($("#editPasswordOld").val() == "") $("#editPasswordOld").focus();
    else if ($("#editPasswordNew1").val() == "") $("#editPasswordNew1").focus();
    else if ($("#editPasswordNew2").val() == "") $("#editPasswordNew2").focus();
    else if ($("#editPasswordNew1").val() != $("#editPasswordNew2").val()){
        $("#editPasswordNew1").val('').focus();
        $("#editPasswordNew2").val('');
        $("#passwordLoading").html('<span style="color: red;">รหัสใหม่ไม่ตรงกัน</span>');
    }
    else{
        $("#passwordLoading").html('<img src="images/loading.gif" />');
        setTimeout(
            function(){
                $.ajax({
                    url: "getdata/profile.php",
                    type: "POST",
                    async: false,
                    dataType: "json",
                    data:{
                        action: "change_password",
                        password_old: $("#editPasswordOld").val(),
                        password_new: $("#editPasswordNew1").val()
                    },
                    success:function(result){
                        var data = result.data[0];
                        var status = getTag(data["status"], "");

                        if(status == "success"){
                            $("#passwordLoading").html('<span style="color: blue;">บันทึกข้อมูลเรียบร้อย</span>');
                            setTimeout(function (){
                                $("#dialogHome").dialog("close");
                            }, 1000);
                        }
                        else{
                            var message = getTag(data["message"], "");

                            $("#editPasswordOld").val('').focus();
                            $("#editPasswordNew1").val('');
                            $("#editPasswordNew2").val('');
                            $("#passwordLoading").html('<span style="color: red;">'+message+'</span>');
                        }
                    }
                });
            }
        , 1000);
    }
}