<?php
require(dirname(__FILE__)."/config.php");
$id = GetFromBrowser("id", "ID0002");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mini GBox</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">


    <script src="jquery-ui/js/jquery-1.10.2.js"></script>
    <script src="jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>

    <script>
        function refreshData(){
            $.ajax({
                url: "getdata/getADC.php",
                type: "POST",
                async: false,
                dataType: "json",
                data:{
                    action: "countpage",
                    id: "<?php print $id;?>"
                },
                success:function(result){
                    var html = '';
                    for(var i = 0; i < result.data.length; i++){
                        var data = result.data[i];
                        var page = data["page"];
                        var start = data["start"];
                        var stop = data["stop"];

                        html += '<option value="'+start+'">'+page+'</option>'
                    }
                    $("#page").html(html);
                }
            });

            getResult();
        }

        function getResult(){
            $("#showResult").html('<div style="width: 100%; height: 85%; margin-top: 20px; text-align: center;"><img src="images/loading.gif" alt="Loading..."/></div>');

            setTimeout(
                    function(){
                        $.ajax({
                            url: "getdata/getADC.php",
                            type: "POST",
                            async: false,
                            dataType: "json",
                            data:{
                                action: "showdata",
                                start: $("#page").val(),
                                id: "<?php print $id;?>"
                            },
                            success:function(result){
                                var html = '<div class="temptable" style="margin-top: 20px; width: 100%;">'
                                        + '<table align="center" style="width: 70%;">'
                                        + '<tr>'
                                        + '<td>Device</td>'
                                        + '<td>เวลา GPS</td>'
                                        + '<td>เวลาที่ส่งข้อมูล</td>'
                                        + '<td>เวลาที่รับข้อมูล</td>'
                                        + '<td>Active</td>'
                                        + '<td>Latitude</td>'
                                        + '<td>Longitude</td>'
                                        + '<td>Alt.</td>'
                                        + '<td>Speed</td>'
                                        + '<td>ADC 1</td>'
                                        + '<td>ADC 2</td>'
                                        + '</tr>';
                                if(result.data.length == 0){
                                    html += '<tr>'
                                            + '<td colspan="10">ไม่พบข้อมูล</td>'
                                            + '</tr>';
                                }
                                else{
                                    for(var i = 0; i < result.data.length; i++){
                                        var data = result.data[i];
                                        var device = data["device"];
                                        var time_gps = data["timeGPS"];
                                        var time = data["time"];
                                        var timeserver = data["timeserver"];
                                        var active = data["active"];
                                        var lat = data["lat"];
                                        var lng = data["lng"];
                                        var alt = data["alt"];
                                        var speed = data["speed"];
                                        var adc1 = data["adc1"];
                                        var adc2 = data["adc2"];


                                        html += '<tr align="center">'
                                                + '<td>'+device+'</td>'
                                                + '<td>'+time_gps+'</td>'
                                                + '<td>'+time+' น.</td>'
                                                + '<td>'+timeserver+' น.</td>'
                                                + '<td>'+active+'</td>'
                                                + '<td>'+lat+'</td>'
                                                + '<td>'+lng+'</td>'
                                                + '<td>'+alt+'</td>'
                                                + '<td>'+speed+'</td>'
                                                + '<td align="left">'+GetWrapedText(adc1, 50)+'</td>'
                                                + '<td align="left">'+GetWrapedText(adc2, 50)+'</td>'
                                                + '</tr>';
                                    }
                                }
                                html += '</table>'
                                        + '</div>';

                                $("#showResult").html(html);
                            }
                        });
                    }, 1000);
        }



        function GetWrapedText(text, maxlength) {
            if(text != null){
                var resultText = [""];
                var len = text.length;
                if (maxlength >= len) {
                    return text;
                }
                else {
                    var totalStrCount = parseInt(len / maxlength);
                    if (len % maxlength != 0) {
                        totalStrCount++
                    }

                    for (var i = 0; i < totalStrCount; i++) {
                        if (i == totalStrCount - 1) {
                            resultText.push(text);
                        }
                        else {
                            var strPiece = text.substring(0, maxlength);
                            resultText.push(strPiece);
                            resultText.push("<br>");
                            text = text.substring(maxlength, text.length);
                        }
                    }
                }
                return resultText.join("");
            }
            else{
                return null;
            }
        }
    </script>
    <link rel="stylesheet" type="text/css" href="jquery-ui/development-bundle/themes/south-street/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="css/template.css" />
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }
    </style>
</head>
<body onload="refreshData()">
    <div style="width: 100%; text-align: center; margin-top: 30px;">
        <select id="page" name="page" style="width: 30px; !important;" onchange="javascript: getResult();">
            <option value=""></option>
        </select>&nbsp;&nbsp;
        <a class="button button-big" onclick="javascript: refreshData();">Refresh</a>
    </div>
    <div id="showResult" style="width: 100%; height: 85%; margin-top: 20px; overflow: auto;"></div>
</body>
</html>