function exportGBox(){
    var windowH = $(window).height()-75;
    var columnH = windowH+"px";

    var d = new Date();
    var timeStart = d.getHours()+":"+d.getMinutes();
    var html = '<div style="min-width: 100%; height: 100%; text-align: center;">'
                + '<fieldset style="color: #000000; background-color: #ffffff;">'
                    + '<h2>ระบบ Export ข้อมูล MiniGBox</h2>'
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
                            + '<td>ไฟล์ <div class="required-fill">**</div></td>'
                            + '<td>'
                                + '<div class="styled-select">'
                                    + '<select id="typeGBox" name="typeGBox">'
                                        + '<option value="csv">CSV</option>'
                                        + '<option value="txt">Text</option>'
                                    + '</select>'
                                + '</div>'
                            + '</td>'
                        + '</tr>'
                        + '<tr>'
                            + '<td>วันที่</td>'
                            + '<td>'
                                + '<div id="dateExport" class="input-append date" style="padding: 0 !important;">'
                                    + '<input type="text">'
                                    + '<span class="add-on">'
                                        + '<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>'
                                    + '</span>'
                                + '</div>'
                            + '</td>'
                        + '</tr>'
                        + '<tr>'
                            + '<td>เวลา</td>'
                            + '<td>'
                                + '<div id="timeExport1" class="input-append time" style="display: inline;">'
                                    + '<input data-format="hh:mm:ss" type="text" value="00:00" style="width: 100px;">'
                                    + '<span class="add-on">'
                                        + '<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>'
                                    + '</span>'
                                + '</div>'
                                + '<span style="margin-left: 10px; margin-right: 10px; text-align: center; font-weight: bolder;">:</span>'
                                + '<div id="timeExport2" class="input-append time" style="display: inline;">'
                                    + '<input data-format="hh:mm:ss" type="text" value="23:59" style="width: 100px;">'
                                    + '<span class="add-on">'
                                        + '<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>'
                                    + '</span>'
                                + '</div>'
                            + '</td>'
                        + '</tr>'
                        + '<tr>'
                            + '<td colspan="2" align="center"><div id="loadingGBox"></div></td>'
                        + '</tr>'
                        + '<tr>'
                            + '<td colspan="2" align="right">'
                                + '<button class="button" onclick="javascript: saveExportGBox();">Export</button>'
                            + '</td>'
                        + '</tr>'
                    + '</table>'
                + '</fieldset>'
            + '</div>';

    $(".display").html(html);

    $("#dateExport").datetimepicker({
        format: 'dd/MM/yyyy',
        pickTime: false,
        weekStart: 1,
        endDate: new Date(),
        autoClose: true
    }).data("datetimepicker").setLocalDate(new Date());;

    $("#timeExport1, #timeExport2").datetimepicker({
        format: 'hh:mm',
        pickSeconds: false,
        pickDate: false
    });

    $.ajax({
        url: "getdata/exportGBox.php",
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

function saveExportGBox(){
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
    else{
        $("#loadingGBox").html('loading...').show();

        window.location = "getdata/exportGBox.php?"
                    + "action=export_GBox"
                    + "&device_id="+$("#deviceIdGBox").val()
                    + "&type="+$("#typeGBox").val()
                    + "&date="+$("#dateExport input").val()
                    + "&time1="+$("#timeExport1 input").val()
                    + "&time2="+$("#timeExport2 input").val();

        window.addEventListener('focus', HideDownloadMessage, false);
    }
}

function HideDownloadMessage(){
    window.removeEventListener("focus", HideDownloadMessage, false);
    $('#loadingGBox').hide();
}