function importGBox(){
    var windowH = $(window).height()-75;
    var columnH = windowH+"px";

    var html = '<div style="min-width: 100%; height: 100%; text-align: center;">'
                + '<fieldset style="color: #000000; background-color: #ffffff;">'
                    + '<form id="formGBox" method="POST" enctype="multipart/form-data" action="getdata/importGBox.php" onsubmit="return false;">'
                        + '<h2>ระบบนำเข้าข้อมูล GBox</h2>'
                        + '<table border="0" cellpadding="8" align="center" style="margin-top: 20px;">'
                            + '<tr>'
                                + '<td>อุปกรณ์ <div class="required-fill">**</div></td>'
                                + '<td align="left">'
                                    + '<div class="styled-select">'
                                        + '<select id="deviceIdGBox" name="deviceIdGBox">'
                                            + '<option value=""></option>'
                                        + '</select>'
                                    + '</div>'
                                + '</td>'
                            + '</tr>'
                            + '<tr>'
                                + '<td>ไฟล์ <div class="required-fill">**</div><p>&nbsp;&nbsp;(ไฟล์ .csv เท่านั้น)</p></td>'
                                + '<td>'
                                    + '<fieldset class="inputs" style="border: 0;">'
                                        + '<input id="fileGBox" name="fileGBox" type="file">'
                                    + '</fieldset>'
                                + '</td>'
                            + '</tr>'
                            + '<tr>'
                                + '<td colspan="2" align="center"><div id="loadingGBox"></div></td>'
                            + '</tr>'
                            + '<tr>'
                                + '<td colspan="2" align="right">'
                                    + '<button class="button" onclick="javascript: saveImportGBox();">Import</button>&nbsp;&nbsp;'
                                    + '<button class="button-clear" onclick="javascript: clearGBox();">ยกเลิก</button>'
                                + '</td>'
                            + '</tr>'
                        + '</table>'
                    + '</form>'
                + '</fieldset>'
            + '</div>';

    $(".display").html(html);

    $.ajax({
        url: "getdata/importGBox.php",
        type: "POST",
        async: false,
        dataType: "json",
        data:{
            action: "get_GBox"
        },
        success:function(result){
            var html;
            for(var i = 0; i < result.data.length; i++){
                var data = result.data[i];
                var device_id = data["device_id"];
                var device_desc = data["device_desc"];

                html += '<option value="'+device_id+'">'+device_desc+'</option>';

                $("#deviceIdGBox").html(html);
            }
            if(result.data.length == 0){
                html += '<option value="">ไม่มีอุปกรณ์</option>';

                $("#deviceIdGBox").html(html);
            }
        }
    });
}

function saveImportGBox(){
    var ext = $("#fileGBox").val().split('.').pop().toLowerCase();

    if($("#deviceIdGBox").val() == ""){
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
    else if($("#fileGBox").val() == ""){
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
        $("#loadingGBox").html('<img src="images/loading.gif" />');

        $("#formGBox").ajaxForm({
            type: "POST",
            data: {
                action: "import_GBox",
                device_id: $("#deviceIdGBox").val()
            },
            success: function(result){
                var data = result.data[0];
                var status = data["status"];
                if(status == "Success"){
                    $("#loadingGBox").html('<font color="blue"><b>จัดเก็บข้อมูลเรียบร้อย</b></font>');
                }
                else{
                    var message = data["message"];
                    $("#loadingGBox").html('<font color="red"><b>'+message+'</b></font>');
                }
            }
        }).submit();
    }
}

function clearGBox(){
    $("#deviceIdGBox :nth-child(0)").prop("selected", true);
    $("#fileGBox").val('');
    $("#loadingGBox").html('');
}