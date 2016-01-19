function importDG200(){
    var windowH = $(window).height()-75;
    var columnH = windowH+"px";

    var html = '<div style="min-width: 100%; height: 100%; text-align: center;">'
                + '<fieldset style="color: #000000; background-color: #ffffff;">'
                    + '<form id="formDG200" method="POST" enctype="multipart/form-data" action="getdata/importDG200.php" onsubmit="return false;">'
                        + '<h2>ระบบนำเข้าข้อมูล DG200</h2>'
                        + '<table border="0" cellpadding="8" align="center" style="margin-top: 20px;">'
                            + '<tr>'
                                + '<td>อุปกรณ์ <div class="required-fill">**</div></td>'
                                + '<td align="left">'
                                    + '<div class="styled-select">'
                                        + '<select id="deviceIdDG200" name="deviceIdDG200">'
                                            + '<option value=""></option>'
                                        + '</select>'
                                    + '</div>'
                                + '</td>'
                            + '</tr>'
                            + '<tr>'
                                + '<td>ไฟล์ <div class="required-fill">**</div><p>&nbsp;&nbsp;(ไฟล์ .csv เท่านั้น)</p></td>'
                                + '<td>'
                                    + '<fieldset class="inputs" style="border: 0;">'
                                        + '<input id="fileDG200" name="fileDG200" type="file">'
                                    + '</fieldset>'
                                + '</td>'
                            + '</tr>'
                            + '<tr>'
                                + '<td colspan="2" align="center"><div id="loadingDG200"></div></td>'
                            + '</tr>'
                            + '<tr>'
                                + '<td colspan="2" align="right">'
                                    + '<button class="button" onclick="javascript: saveImportDG200();">Import</button>&nbsp;&nbsp;'
                                    + '<button class="button-clear" onclick="javascript: clearDG200();">ยกเลิก</button>'
                                + '</td>'
                            + '</tr>'
                        + '</table>'
                    + '</form>'
                + '</fieldset>'
            + '</div>';

    $(".display").html(html);

    $.ajax({
        url: "getdata/importDG200.php",
        type: "POST",
        async: false,
        dataType: "json",
        data:{
            action: "get_DG200"
        },
        success:function(result){
            var html;
            for(var i = 0; i < result.data.length; i++){
                var data = result.data[i];
                var device_id = data["device_id"];
                var device_desc = data["device_desc"];

                html += '<option value="'+device_id+'">'+device_desc+'</option>';

                $("#deviceIdDG200").html(html);
            }
            if(result.data.length == 0){
                html += '<option value="">ไม่มีอุปกรณ์</option>';

                $("#deviceIdDG200").html(html);
            }
        }
    });
}

function saveImportDG200(){
    var ext = $("#fileDG200").val().split('.').pop().toLowerCase();

    if($("#deviceIdDG200").val() == ""){
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
    else if($("#fileDG200").val() == ""){
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
        $("#loadingDG200").html('<img src="images/loading.gif" />');

        $("#formDG200").ajaxForm({
            type: "POST",
            data: {
                action: "import_DG200",
                device_id: $("#deviceIdDG200").val()
            },
            success: function(result){
                var data = result.data[0];
                var status = data["status"];
                if(status == "Success"){
                    $("#loadingDG200").html('<font color="blue"><b>จัดเก็บข้อมูลเรียบร้อย</b></font>');
                }
                else{
                    var message = data["message"];
                    $("#loadingDG200").html('<font color="red"><b>'+message+'</b></font>');
                }
            }
        }).submit();
    }
}

function clearDG200(){
    $("#deviceIdDG200 :nth-child(0)").prop("selected", true);
    $("#fileDG200").val('');
    $("#loadingDG200").html('');
}