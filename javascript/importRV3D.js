function importRV3D(){
    var windowH = $(window).height()-75;
    var columnH = windowH+"px";

    var html = '<div style="min-width: 100%; height: 100%; text-align: center;">'
                + '<fieldset style="color: #000000; background-color: #ffffff;">'
                    + '<form id="formRV3D" method="POST" enctype="multipart/form-data" action="getdata/importRV3D.php" onsubmit="return false;">'
                        + '<h2>ระบบนำเข้าข้อมูล RV3D</h2>'
                        + '<table border="0" cellpadding="8" align="center" style="margin-top: 20px;">'
                            + '<tr>'
                                + '<td>อุปกรณ์ <div class="required-fill">**</div></td>'
                                + '<td align="left">'
                                    + '<div class="styled-select">'
                                        + '<select id="deviceIdRV3D" name="deviceIdRV3D">'
                                            + '<option value=""></option>'
                                        + '</select>'
                                    + '</div>'
                                + '</td>'
                            + '</tr>'
                            + '<tr>'
                                + '<td>ไฟล์ <div class="required-fill">**</div><p>&nbsp;&nbsp;(ไฟล์ .kml เท่านั้น)</p></td>'
                                + '<td>'
                                    + '<fieldset class="inputs" style="border: 0;">'
                                        + '<input id="fileRV3D" name="fileRV3D" type="file">'
                                    + '</fieldset>'
                                + '</td>'
                            + '</tr>'
                            + '<tr>'
                                + '<td colspan="2" align="center"><div id="loadingRV3D"></div></td>'
                            + '</tr>'
                            + '<tr>'
                                + '<td colspan="2" align="right">'
                                    + '<button class="button" onclick="javascript: saveImportRV3D();">Import</button>&nbsp;&nbsp;'
                                    + '<button class="button-clear" onclick="javascript: clearRV3D();">ยกเลิก</button>'
                                + '</td>'
                            + '</tr>'
                        + '</table>'
                    + '</form>'
                + '</fieldset>'
            + '</div>';

    $(".display").html(html);

    $.ajax({
        url: "getdata/importRV3D.php",
        type: "POST",
        async: false,
        dataType: "json",
        data:{
            action: "get_RV3D"
        },
        success:function(result){
            var html;
            for(var i = 0; i < result.data.length; i++){
                var data = result.data[i];
                var device_id = data["device_id"];
                var device_desc = data["device_desc"];

                html += '<option value="'+device_id+'">'+device_desc+'</option>';

                $("#deviceIdRV3D").html(html);
            }
            if(result.data.length == 0){
                html += '<option value="">ไม่มีอุปกรณ์</option>';

                $("#deviceIdRV3D").html(html);
            }
        }
    });
}

function saveImportRV3D(){
    var ext = $("#fileRV3D").val().split('.').pop().toLowerCase();

    if($("#deviceIdRV3D").val() == ""){
        $("#dialogHome").html('<div style="width: 250px;">กรุณาเลือกอุปกรณ์</div>').dialog({
            resizable: false,
            title: "แจ้งบอก",
            width: "auto",
            height: "auto",
            draggable: false,
            modal: true,
            buttons: {
                "ยกเลิก": function() {
                    $(this).dialog("close");
                }
            }
        });
    }
    else if($("#fileRV3D").val() == ""){
        $("#dialogHome").html('<div style="width: 250px;">กรุณาเลือกไฟล์ข้อมูล</div>').dialog({
            resizable: false,
            title: "แจ้งบอก",
            width: "auto",
            height: "auto",
            draggable: false,
            modal: true,
            buttons: {
                "ยกเลิก": function() {
                    $(this).dialog("close");
                }
            }
        });
    }
    else if($.inArray(ext, ['kml']) == -1) {
        $("#dialogHome").html('<div style="width: 250px;">กรุณาเลือกไฟล์ข้อมูล .kml เท่านั้น</div>').dialog({
            resizable: false,
            title: "แจ้งบอก",
            width: "auto",
            height: "auto",
            draggable: false,
            modal: true,
            buttons: {
                "ยกเลิก": function() {
                    $(this).dialog("close");
                }
            }
        });
    }
    else{
        $("#loadingRV3D").html('<img src="images/loading.gif" />');

        $("#formRV3D").ajaxForm({
            type: "POST",
            data: {
                action: "import_RV3D",
                device_id: $("#deviceIdRV3D").val()
            },
            success: function(result){
                var data = result.data[0];
                var status = data["status"];
                if(status == "Success"){
                    $("#loadingRV3D").html('<font color="blue"><b>จัดเก็บข้อมูลเรียบร้อย</b></font>');
                }
                else{
                    var message = data["message"];
                    $("#loadingRV3D").html('<font color="red"><b>'+message+'</b></font>');
                }
            }
        }).submit();
    }
}

function clearRV3D(){
    $("#deviceIdRV3D :nth-child(0)").prop("selected", true);
    $("#fileRV3D").val('');
    $("#loadingRV3D").html('');
}