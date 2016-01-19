function callMapTest(){
    var windowH = $(window).height()-75;
    var columnH = windowH+"px";

    $(".display").html("<iframe id='iframe' src='getdata/selectpage/mapTest.php?id="+$("#deviceId").val()+"&day1="+$("#datetimepicker input").val()+"&time1="+$("#time1 input").val()+"&time2="+$("#time2 input").val()+"' width='100%' height='"+columnH+"' frameborder='0' scrolling='no'></iframe>");

    var iframe = document.getElementById('iframe');
    iframe.src = iframe.src;
}

function getSpeed(){
    var windowH = $(window).height()-75;
    var columnH = windowH+"px";

    $(".display").html("<iframe id='iframe' src='getdata/selectpage/f0_speed_report.php?deviceid="+$("#deviceId").val()+"&date1="+$("#datetimepicker input").val()+"&time1="+$("#time1 input").val()+"&time2="+$("#time2 input").val()+"' width='100%' height='"+columnH+"' frameborder='0'></iframe>");

    var iframe = document.getElementById('iframe');
    iframe.src = iframe.src;
}

function getAcc(){
    var windowH = $(window).height()-75;
    var columnH = windowH+"px";

    $(".display").html("<iframe id='iframe' src='getdata/selectpage/f0_acc_report.php?deviceid="+$("#deviceId").val()+"&date1="+$("#datetimepicker input").val()+"&time1="+$("#time1 input").val()+"&time2="+$("#time2 input").val()+"' width='100%' height='"+columnH+"' frameborder='0'></iframe>");

    var iframe = document.getElementById('iframe');
    iframe.src = iframe.src;
}

function getTurn(){
    var windowH = $(window).height()-75;
    var columnH = windowH+"px";

    $(".display").html("<iframe id='iframe' src='getdata/selectpage/f0_turn_report.php?deviceid="+$("#deviceId").val()+"&date1="+$("#datetimepicker input").val()+"&time1="+$("#time1 input").val()+"&time2="+$("#time2 input").val()+"' width='100%' height='"+columnH+"' frameborder='0'></iframe>")

    var iframe = document.getElementById('iframe');
    iframe.src = iframe.src;
}

function getZone(){
    var windowH = $(window).height()-75;
    var columnH = windowH+"px";

    $(".display").html("<iframe id='iframe' src='getdata/selectpage/f0_zone_report.php?deviceid="+$("#deviceId").val()+"&date1="+$("#datetimepicker input").val()+"&time1="+$("#time1 input").val()+"&time2="+$("#time2 input").val()+"' width='100%' height='"+columnH+"' frameborder='0'></iframe>")

    var iframe = document.getElementById('iframe');
    iframe.src = iframe.src;
}

function getScore(){
    var windowH = $(window).height()-75;
    var columnH = windowH+"px";

    $(".display").html("<iframe id='iframe' src='getdata/selectpage/f0_Dscore.php?deviceid="+$("#deviceId").val()+"&date1="+$("#datetimepicker input").val()+"&time1="+$("#time1 input").val()+"&time2="+$("#time2 input").val()+"' width='100%' height='"+columnH+"' frameborder='0'></iframe>")

    var iframe = document.getElementById('iframe');
    iframe.src = iframe.src;
}

function getStyle(){
    var windowH = $(window).height()-75;
    var columnH = windowH+"px";

    $(".display").html("<iframe id='iframe' src='getdata/selectpage/f0_Style.php?deviceid="+$("#deviceId").val()+"&date1="+$("#datetimepicker input").val()+"&time1="+$("#time1 input").val()+"&time2="+$("#time2 input").val()+"' width='100%' height='"+columnH+"' frameborder='0'></iframe>")

    var iframe = document.getElementById('iframe');
    iframe.src = iframe.src;
}

function getIntegrate(){
    var windowH = $(window).height()-75;
    var columnH = windowH+"px";

    $(".display").html("<iframe id='iframe' src='getdata/selectpage/f1_integrate.php?deviceid="+$("#deviceId").val()+"&date1="+$("#datetimepicker input").val()+"&time1="+$("#time1 input").val()+"&time2="+$("#time2 input").val()+"' width='100%' height='"+columnH+"' frameborder='0'></iframe>")

    var iframe = document.getElementById('iframe');
    iframe.src = iframe.src;
}

/*function getEvent(){
    var windowH = $(window).height()-75;
    var columnH = windowH+"px";

    $(".display").html("<iframe id='iframe' src='getdata/selectpage/f0_adc_report.php?deviceid="+$("#deviceId").val()+"&date1="+$("#datetimepicker input").val()+"&time1="+$("#time1 input").val()+"&time2="+$("#time2 input").val()+"' width='100%' height='"+columnH+"' frameborder='0'></iframe>")

    var iframe = document.getElementById('iframe');
    iframe.src = iframe.src;
}*/