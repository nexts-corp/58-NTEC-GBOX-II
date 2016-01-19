function deviceInit(){
    var html = '<div style="min-width: 100%; height: 100%; text-align: center;">'
                + '<fieldset style="background-color: #ffffff;">'
                    + '<div id="deviceOption" style="margin-bottom: 10px;">'
                        + '<button class="button" onclick="javascript: deviceInsert();">เพิ่มอุปกรณ์</button>'
                    + '</div>'
                    + '<div class="data-table">'
                        + '<table>'
                            + '<thead>'
                                + '<tr>'
                                    + '<th width="10%">ลำดับที่</th>'
                                    + '<th width="15%">ชื่ออุปกรณ์</th>'
                                    + '<th width="10%">ชนิดของอุปกรณ์</th>'
                                    + '<th width="20%">หมายเลขประจำตัว</th>'
                                    + '<th width="10%">ทะเบียนรถ</th>'
                                    + '<th width="15%">ประเภทของรถ</th>'
                                    + '<th colspan="2" width="20%">แก้ไข/ลบ</th>'
                                + '</tr>'
                            + '</thead>'
                            + '<tbody id="deviceTable">'
                                + '<tr class="odd">'
                                    + '<td colspan="8"><b>ไม่พบข้อมูลอุปกรณ์</b></td>'
                                + '</tr>'
                            + '</tbody>'
                        + '</table>'
                    + '</div>'
                + '</fieldset>'
            + '</div>';

    $(".display").html(html);

    $.ajax({
        url: "getdata/device.php",
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
                    var device_id = getTag(data["device_id"], "-");
                    var device_serial = getTag(data["device_serial"], "-");
                    var device_desc = getTag(data["device_desc"], "-");
                    var device_car = getTag(data["device_car"], "-");
                    var car_type = getTag(data["car_type"], "-");
                    var device_type = getTag(data["device_type"], "-");

                    var row;
                    if(i % 2 == 0) row = "odd";
                    else row = "even";

                    html += '<tr class="'+row+'">'
                            + '<td>'+count+'</td>'
                            + '<td>'+device_desc+'</td>'
                            + '<td>'+device_type+'</td>'
                            + '<td>'+device_serial+'</td>'
                            + '<td>'+device_car+'</td>'
                            + '<td>'+car_type+'</td>'
                            + '<td align="center"><button class="button" onclick="javascript: deviceUpdate('+device_id+');">แก้ไข</button></td>'
                            + '<td align="center"><button class="button-clear" onclick="javascript: deviceDelete('+device_id+');">ลบข้อมูล</button></td>'
                        + '</tr>';
                }
            }
            else{
                html = '<tr class="odd">'
                        + '<td colspan="7"><b>ไม่พบข้อมูลอุปกรณ์</b></td>'
                    + '</tr>';
            }
            $("#deviceTable").html(html);
        }
    });
}

function deviceInsert(){
    deviceForm();
    $("#dialogHome").dialog({
        resizable: false,
        title: "เพิ่มข้อมูลอุปกรณ์",
        width: "auto",
        height: "auto",
        draggable: false,
        modal: true,
        buttons: {
            "บันทึก": function() {
                deviceSaveInsert();
            }
        }
    });
}

function deviceUpdate(device_id){
    deviceForm();
    $("#dialogHome").dialog({
        resizable: false,
        title: "แก้ไขข้อมูลอุปกรณ์",
        width: "auto",
        height: "auto",
        draggable: false,
        modal: true,
        buttons: {
            "บันทึก": function() {
                deviceSaveUpdate(device_id);
            }
        }
    });

    $.ajax({
        url: "getdata/device.php",
        type: "POST",
        async: false,
        dataType: "json",
        data:{
            action: "select",
            device_id: device_id
        },
        success:function(result){
            if(result.data.length > 0){
                var data = result.data[0];
                var device_serial = getTag(data["device_serial"], "");
                var device_desc = getTag(data["device_desc"], "");
                var device_car = getTag(data["device_car"], "");
                var car_type_id = getTag(data["car_type_id"], "");
                var device_type_id = getTag(data["device_type_id"], "");

                $("#deviceSerial").val(device_serial).attr("disabled", "disabled");
                $("#deviceName").val(device_desc);
                $("#deviceCar").val(device_car);
                $("#deviceCarTypeId").val(car_type_id);
                $("#deviceTypeId").val(device_type_id);
            }
        }
    });
}

function deviceDelete(device_id){
    deviceForm();
    $("#dialogHome").dialog({
        resizable: false,
        title: "ลบข้อมูลอุปกรณ์",
        width: "auto",
        height: "auto",
        draggable: false,
        modal: true,
        buttons: {
            "ยืนยันการลบ": function() {
                deviceSaveDelete(device_id);
            }
        }
    });

    $.ajax({
        url: "getdata/device.php",
        type: "POST",
        async: false,
        dataType: "json",
        data:{
            action: "select",
            device_id: device_id
        },
        success:function(result){
            if(result.data.length > 0){
                var data = result.data[0];
                var device_serial = getTag(data["device_serial"], "");
                var device_desc = getTag(data["device_desc"], "");
                var device_car = getTag(data["device_car"], "");
                var car_type_id = getTag(data["car_type_id"], "");
                var device_type_id = getTag(data["device_type_id"], "");

                $("#deviceSerial").val(device_serial).attr("disabled", "disabled").blur();
                $("#deviceName").val(device_desc).attr("disabled", "disabled");
                $("#deviceCar").val(device_car).attr("disabled", "disabled");
                $("#deviceCarTypeId").val(car_type_id).attr("disabled", "disabled");
                $("#deviceTypeId").val(device_type_id).attr("disabled", "disabled");
            }
        }
    });
}

function deviceSaveInsert(){
    if($("#deviceName").val() == "") $("#deviceName").focus();
    else if($("#deviceSerial").val() == "") $("#deviceSerial").focus();
    else if($("#deviceCarTypeId").val() == "") $("#deviceCarTypeId").focus();
    else{
        $("#deviceStatusLoading").html('<img src="images/loading.gif">');

        setTimeout(
            function(){
                $.ajax({
                    url: "getdata/device.php",
                    type: "POST",
                    async: false,
                    dataType: "json",
                    data:{
                        action: "insert",
                        device_serial: $("#deviceSerial").val(),
                        device_desc: $("#deviceName").val(),
                        device_car: $("#deviceCar").val(),
                        car_type_id: $("#deviceCarTypeId").val(),
                        device_type_id: $("#deviceTypeId").val()
                    },
                    success:function(result){
                        var data = result.data[0];
                        var status = data["status"];
                        if(status == "Success"){
                            $("#deviceStatusLoading").html('<font color="blue"><b>จัดเก็บข้อมูลเรียบร้อย</b></font>');
                            setTimeout(function(){
                                deviceInit();
                                $("#dialogHome").dialog("close");
                            }, 1000);
                        }
                        else{
                            var message = data["message"];
                            $("#deviceStatusLoading").html('<font color="red"><b>ไม่สามารถจัดเก็บข้อมูลได้</b></font><br>'+message);
                        }
                    }
                });
            }
        , 1000);
    }
}

function deviceSaveUpdate(device_id){
    if($("#deviceSerial").val() == "") $("#deviceSerial").focus();
    else if($("#deviceName").val() == "") $("#deviceName").focus();
    else if($("#deviceCarTypeId").val() == "") $("#deviceCarTypeId").focus();
    else{
        $("#deviceStatusLoading").html('<img src="images/loading.gif">');

        setTimeout(
            function(){
                $.ajax({
                    url: "getdata/device.php",
                    type: "POST",
                    async: false,
                    dataType: "json",
                    data:{
                        action: "update",
                        device_id: device_id,
                        device_serial: $("#deviceSerial").val(),
                        device_desc: $("#deviceName").val(),
                        device_car: $("#deviceCar").val(),
                        car_type_id: $("#deviceCarTypeId").val(),
                        device_type_id: $("#deviceTypeId").val()
                    },
                    success:function(result){
                        var data = result.data[0];
                        var status = data["status"];
                        if(status == "Success"){
                            $("#deviceStatusLoading").html('<font color="blue"><b>จัดเก็บข้อมูลเรียบร้อย</b></font>');
                            setTimeout(function(){
                                deviceInit();
                                $("#dialogHome").dialog("close");
                            }, 1000);
                        }
                        else{
                            var message = data["message"];
                            $("#deviceStatusLoading").html('<font color="red"><b>ไม่สามารถจัดเก็บข้อมูลได้</b></font><br>'+message);
                        }
                    }
                });
            }
        , 1000);
    }
}

function deviceSaveDelete(device_id){
    $("#deviceStatusLoading").html('<img src="images/loading.gif">');

    setTimeout(
        function(){
            $.ajax({
                url: "getdata/device.php",
                type: "POST",
                async: false,
                dataType: "json",
                data:{
                    action: "delete",
                    device_id: device_id
                },
                success:function(result){
                    var data = result.data[0];
                    var status = data["status"];
                    if(status == "Success"){
                        $("#deviceStatusLoading").html('<font color="blue"><b>จัดเก็บข้อมูลเรียบร้อย</b></font>');
                        setTimeout(function(){
                            deviceInit();
                            $("#dialogHome").dialog("close");
                        }, 1000);
                    }
                    else{
                        var message = data["message"];
                        $("#deviceStatusLoading").html('<font color="red"><b>ไม่สามารถจัดเก็บข้อมูลได้</b></font><br>'+message);
                    }
                }
            });
        }
    , 100);
}

function deviceForm(){
    var html = '<form onsubmit="return false;">'
                + '<fieldset>'
                    + '<table width="600px" border="0" cellpadding="0" align="center">'
                        + '<tr>'
                            + '<td>ชื่ออุปกรณ์ <div class="required-fill">**</div></td>'
                            + '<td>'
                                + '<fieldset class="inputs" style="border: 0;">'
                                    + '<input id="deviceName" name="deviceName" type="text" autofocus>'
                                + '</fieldset>'
                            + '</td>'
                        + '</tr>'
                        + '<tr>'
                            + '<td>ชนิดของอุปกรณ์ <div class="required-fill">**</div></td>'
                            + '<td>'
                                + '<div class="styled-select">'
                                    + '<select id="deviceTypeId" name="deviceTypeId">'
                                        + '<option value=""></option>'
                                    + '</select>'
                                + '</div>'
                            + '</td>'
                        + '</tr>'
                        + '<tr>'
                            + '<td>หมายเลขประจำตัว <div class="required-fill">**</div></td>'
                            + '<td>'
                                + '<fieldset class="inputs" style="border: 0;">'
                                    + '<input id="deviceSerial" name="deviceSerial" type="text">'
                                + '</fieldset>'
                            + '</td>'
                        + '</tr>'
                        + '<tr>'
                            + '<td>ทะเบียนรถ</td>'
                            + '<td>'
                                + '<fieldset class="inputs" style="border: 0;">'
                                    + '<input id="deviceCar" name="deviceCar" type="text">'
                                + '</fieldset>'
                            + '</td>'
                        + '</tr>'
                        + '<tr>'
                            + '<td>ประเภทของรถ <div class="required-fill">**</div></td>'
                            + '<td>'
                                + '<div class="styled-select">'
                                    + '<select id="deviceCarTypeId" name="deviceCarTypeId">'
                                        + '<option value=""></option>'
                                    + '</select>'
                                + '</div>'
                            + '</td>'
                        + '</tr>'
                        + '<tr>'
                            + '<td colspan="2" align="center">'
                                + '<div id="deviceStatusLoading"></div>'
                            + '</td>'
                        + '</tr>'

                    + '</table>'
                + '</fieldset>'
            + '</form>';

    $("#dialogHome").html(html);

    $.ajax({
        url: "getdata/device.php",
        type: "POST",
        async: false,
        dataType: "json",
        data:{
            action: "get_device_type"
        },
        success:function(result){
            var html = '';
            if(result.data.length > 0){
                for(var i = 0; i < result.data.length; i++){
                    var data = result.data[i];
                    var id = data["device_type_id"];
                    var device_type = data["device_type"];

                    html += '<option value="'+id+'">'+device_type+'</option>'
                }
            }

            $("#deviceTypeId").html(html);
        }
    });

    $.ajax({
        url: "getdata/device.php",
        type: "POST",
        async: false,
        dataType: "json",
        data:{
            action: "get_car_type"
        },
        success:function(result){
            var html = '';
            if(result.data.length > 0){
                for(var i = 0; i < result.data.length; i++){
                    var data = result.data[i];
                    var id = data["type_id"];
                    var car_type = data["car_type"];

                    html += '<option value="'+id+'">'+car_type+'</option>'
                }
            }

            $("#deviceCarTypeId").html(html);
        }
    });
}
