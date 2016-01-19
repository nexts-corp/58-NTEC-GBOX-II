function roleInit(){
    var html = '<div style="min-width: 100%; height: 100%; text-align: center; overflow: auto;">'
                + '<fieldset style="background-color: #ffffff;">'
                    + '<div class="data-table">'
                        + '<table>'
                            + '<thead id="roleDevice">'
                                + '<tr>'
                                    + '<th><b>ไม่พบข้อมูลอุปกรณ์</b></th>'
                                + '</tr>'
                            + '</thead>'
                            + '<tbody id="roleUser">'
                                + '<tr class="odd">'
                                    + '<td><b>ไม่พบข้อมูลผู้ใช้งาน</b></td>'
                                + '</tr>'
                            + '</tbody>'
                        + '</table>'
                    + '</div>'
                + '</fieldset>'
            + '</div>';

    $(".display").html(html);

    $.ajax({
        url: "getdata/roles.php",
        type: "POST",
        async: false,
        dataType: "json",
        data:{
            action: "show_role"
        },
        success:function(result){
            var device_arr = new Array();
            var device_name = new Array();
            if(result.device.length > 0){
                var html = '<th>รายชื่ออุปกรณ์</th>';
                for(var i = 0; i < result.device.length; i++){
                    var device = result.device[i];
                    var device_id = getTag(device["device_id"], "");
                    var device_desc = getTag(device["device_desc"], "");

                    html += '<th>'+device_desc+'</th>';
                    device_arr[i] = device_id;
                    device_name[i] = device_desc;
                }

                $("#roleDevice").html(html);
            }

            if(result.user.length > 0){
                var html = '';
                for(var i = 0; i < result.user.length; i++){
                    var row;
                    if(i % 2 == 0) row = "odd";
                    else row = "even";

                    var user = result.user[i];
                    var user_id = getTag(user["user_id"], "");
                    var firstname = getTag(user["firstname"], "");
                    var lastname = getTag(user["lastname"], "");

                    html += '<tr class="'+row+'">'
                            + '<td>'+firstname+' '+lastname+'</td>';

                    for(var j = 0; j < device_arr.length; j++){
                        html += '<td>'
                                + '<span class="checkbox">'
                                    + '<input id="role_'+device_arr[j]+'_'+user_id+'" type="checkbox" onchange="javascript: changeRole(\''+device_arr[j]+'\', \''+device_name[j]+'\', \''+user_id+'\', \''+firstname+' '+lastname+'\')"/>'
                                    + '<label class="green-background" for="role_'+device_arr[j]+'_'+user_id+'"></label>'
                                + '</span>'
                            + '</td>';
                    }
                    html += '</tr>';
                }

                $("#roleUser").html(html);
            }
            else{
                var rows = result.device.length + 1;
                $("#roleUser").html('<td colspan="'+rows+'"><b>ไม่พบข้อมูลผู้ใช้งาน</b></td>');
            }

            if(result.role.length > 0){
                for(var i = 0; i < result.role.length; i++){
                    var role = result.role[i];
                    var device_id = getTag(role["device_id"], "");
                    var user_id = getTag(role["user_id"], "");

                    $("#role_"+device_id+"_"+user_id).prop("checked", true);
                }
            }
        }
    });
}

function changeRole(device_id, device_name, user_id, user_name){
    if($("#role_"+device_id+"_"+user_id).is(':checked')){
        var html = '<div style="width: 300px;">'
                    + '<span>ต้องการ <font color="blue">เพิ่มสิทธิ์</font> การใช้งาน ?</span>'
                    + '<p>อุปกรณ์ : <font color="blue">'+ device_name+'</font></p>'
                    + '<p>ผู้ใช้งาน : <font color="blue">'+user_name+'</font></p>'
                    + '<div id="roleLoading" style="width: 100%; text-align: center;"></div>'
                + '</div>';
        var bAccepts = false;
        $("#dialogHome").html(html).dialog({
            resizable: false,
            title: "ต้องการเพิ่มสิทธิ์",
            width: "auto",
            height: "auto",
            draggable: false,
            modal: true,
            buttons: {
                "เพิ่มสิทธิ์": function() {
                    addRole(device_id, user_id);
                    bAccepts = true;
                }
            },
            close: function(ev, ui) {
                if(!bAccepts) $("#role_"+device_id+"_"+user_id).prop("checked", false);
            }
        });
    }
    else{
        var html = '<div style="width: 300px;">'
                    + '<span>ต้องการ <font color="red">ลบสิทธิ์</font> การใช้งาน ?</span>'
                    + '<p>อุปกรณ์ : <font color="red">'+ device_name+'</font></p>'
                    + '<p>ผู้ใช้งาน : <font color="red">'+user_name+'</font></p>'
                    + '<div id="roleLoading" style="width: 100%; text-align: center;"></div>'
                + '</div>';
        var bAccepts = false;
        $("#dialogHome").html(html).dialog({
            resizable: false,
            title: "ต้องการลบสิทธิ์",
            width: "auto",
            height: "auto",
            draggable: false,
            modal: true,
            buttons: {
                "ลบสิทธิ์": function() {
                    deleteRole(device_id, user_id);
                    bAccepts = true;
                }
            },
            close: function(ev, ui) {
                if(!bAccepts) $("#role_"+device_id+"_"+user_id).prop("checked", true);
            }
        });
    }
}

function addRole(device_id, user_id){
    $("#roleLoading").html('<img src="images/loading.gif">');

    setTimeout(
        function(){
            $.ajax({
                url: "getdata/roles.php",
                type: "POST",
                async: false,
                dataType: "json",
                data:{
                    action: "add_role",
                    device_id: device_id,
                    user_id: user_id
                },
                success:function(result){
                    var data = result.data[0];
                    var status = data["status"];
                    if(status == "Success"){
                        $("#roleLoading").html('<font color="blue"><b>จัดเก็บข้อมูลเรียบร้อย</b></font>');

                        setTimeout(function(){
                            roleInit();
                            $("#dialogHome").dialog("close");
                        }, 1000);
                    }
                    else{
                        var message = data["message"];
                        $("#roleLoading").html('<font color="red"><b>ไม่สามารถจัดเก็บข้อมูลได้</b></font><br>'+message);
                    }
                }
            });
        }
    , 100);
}

function deleteRole(device_id, user_id){
    $("#roleLoading").html('<img src="images/loading.gif">');

    setTimeout(
        function(){
            $.ajax({
                url: "getdata/roles.php",
                type: "POST",
                async: false,
                dataType: "json",
                data:{
                    action: "delete_role",
                    device_id: device_id,
                    user_id: user_id
                },
                success:function(result){
                    var data = result.data[0];
                    var status = data["status"];
                    if(status == "Success"){
                        $("#roleLoading").html('<font color="blue"><b>จัดเก็บข้อมูลเรียบร้อย</b></font>');

                        setTimeout(function(){
                            roleInit();
                            $("#dialogHome").dialog("close");
                        }, 1000);
                    }
                    else{
                        var message = data["message"];
                        $("#roleLoading").html('<font color="red"><b>ไม่สามารถจัดเก็บข้อมูลได้</b></font><br>'+message);
                    }
                }
            });
        }
    , 100);
}