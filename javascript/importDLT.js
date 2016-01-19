function importDLT(){
    var windowH = $(window).height()-75;
    var columnH = windowH+"px";

    var html = '<div style="min-width: 100%; height: 100%; text-align: center;">'
                + '<fieldset style="color: #000000; background-color: #ffffff;">'
                    + '<form id="formDLT" method="POST" enctype="multipart/form-data" action="getdata/importDLT.php" onsubmit="return false;">'
                        + '<h2>ระบบนำเข้าข้อมูล DLT</h2>'
                        + '<table border="0" cellpadding="8" align="center" style="margin-top: 20px;">'
                            + '<tr>'
                                + '<td>อุปกรณ์ <div class="required-fill">**</div></td>'
                                + '<td align="left">'
                                    + '<div class="styled-select">'
                                        + '<select id="deviceIdDLT" name="deviceIdDLT">'
                                            + '<option value=""></option>'
                                        + '</select>'
                                    + '</div>'
                                + '</td>'
                            + '</tr>'
                            + '<tr>'
                                + '<td>ไฟล์ <div class="required-fill">**</div><p>&nbsp;&nbsp;(ไฟล์ .csv เท่านั้น)</p></td>'
                                + '<td>'
                                    + '<fieldset class="inputs" style="border: 0;">'
                                        + '<input id="fileDLT" name="fileDLT" type="file">'
                                    + '</fieldset>'
                                + '</td>'
                            + '</tr>'
                            + '<tr>'
                                + '<td colspan="2" align="center"><div id="loadingDLT"></div></td>'
                            + '</tr>'
                            + '<tr>'
                                + '<td colspan="2" align="right">'
                                    + '<button class="button" onclick="javascript: saveImportDLT();">Import</button>&nbsp;&nbsp;'
                                    + '<button class="button-clear" onclick="javascript: clearDLT();">ยกเลิก</button>'
                                + '</td>'
                            + '</tr>'
                        + '</table>'
                    + '</form>'
                + '</fieldset>'
            + '</div>';

    $(".display").html(html);

    $.ajax({
        url: "getdata/importDLT.php",
        type: "POST",
        async: false,
        dataType: "json",
        data:{
            action: "get_DLT"
        },
        success:function(result){
            var html;
            for(var i = 0; i < result.data.length; i++){
                var data = result.data[i];
                var device_id = data["device_id"];
                var device_desc = data["device_desc"];

                html += '<option value="'+device_id+'">'+device_desc+'</option>';

                $("#deviceIdDLT").html(html);
            }
            if(result.data.length == 0){
                html += '<option value="">ไม่มีอุปกรณ์</option>';

                $("#deviceIdDLT").html(html);
            }
        }
    });
}

function saveImportDLT(){
    var ext = $("#fileDLT").val().split('.').pop().toLowerCase();

    if($("#deviceIdDLT").val() == ""){
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
    else if($("#fileDLT").val()  == ""){
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
    else if($.inArray(ext, ['csv']) == -1) {
        $("#dialogHome").html('<div style="width: 250px;">กรุณาเลือกไฟล์ข้อมูล .csv เท่านั้น</div>').dialog({
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
        $("#loadingDLT").html('<img src="images/loading.gif" />');

        $("#formDLT").ajaxForm({
            type: "POST",
            data: {
                action: "import_DLT",
                device_id: $("#deviceIdDLT").val()
            },
            success: function(result){
                var data = result.data[0];
                var status = data["status"];
                if(status == "Success"){
                    $("#loadingDLT").html('<font color="blue"><b>จัดเก็บข้อมูลเรียบร้อย</b></font>');
                }
                else{
                    var message = data["message"];
                    $("#loadingDLT").html('<font color="red"><b>'+message+'</b></font>');
                }
            }
        }).submit();
    }
}

function clearDLT(){
    $("#deviceIdDLT :nth-child(0)").prop("selected", true);
    $("#fileDLT").val('');
    $("#loadingDLT").html('');
}