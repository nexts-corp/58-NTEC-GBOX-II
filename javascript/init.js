var index = 'Map';
$(function() {
    /*$( "#time1" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd-mm-yy',
        onClose: function( selectedDate ) {
            //$( "#time1" ).datepicker( "option", "minDate", selectedDate );
        }
    }).datepicker("setDate", "0");*/
    $("#profileOption > a").click(function(event){
        if(!($(this).hasClass("active"))){
            $("#optionBox").show("blind", "", 100);
            $(this).addClass("active");
        }
        else{
            $("#optionBox").hide("fade", "", 100);
            $(this).removeClass("active");
        }
        event.stopPropagation();
    });

    $("body").click(function(event){
        $("#optionBox").hide("fade", "", 100);
        $("#profileOption > a").removeClass("active");
    });


    $('#datetimepicker').datetimepicker({
        format: 'yyyy-MM-dd',
        pickTime: false,
        weekStart: 1,
        endDate: new Date(),
        autoClose: true

    });
    /*.on('changeDate', function(selected){
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('.to_date').datepicker('setStartDate', startDate);
    });*/

    $('#time1 , #time2').datetimepicker({
        format: 'hh:mm',
        pickSeconds: false,
        pickDate: false
    });

    /*$('#datetimepicker').datetimepicker({
        format: 'hh:mm:ss',
        language: 'en',
        pickTime: false

    });*/


    var picker = $('#datetimepicker').data('datetimepicker');
    picker.setLocalDate(new Date());

    /*$('#datetimepicker').on('changeDate', function(e) {
        console.log(e.date.toString());
        console.log(e.localDate.toString());
    });*/


    $(".navigator-left ul li a").click(function(){
        $(".navigator-left ul li a").removeClass("active");
        $(this).addClass("active");

        index = $(this).attr("href").substr(1);

        changeInput();
    });

    listDevice();
    callMapTest();

    $("#deviceId").change(function() {
        changeInput();
    });

    $("#datetimepicker").on('changeDate', function(ev) {
        changeInput();
    });

    $("#time1").on('changeDate', function(ev) {
        changeInput();
    });

    $("#time2").on('changeDate', function(ev) {
        changeInput();
    });
});

function changeInput(){
    if(index == 'Map'){
        callMapTest();
    }else if(index == 'Speed'){
        getSpeed();
    }else if(index == 'Acceleration'){
        getAcc();
    }else if(index == 'Turn'){
        getTurn();
    }else if(index == 'Zone'){
        getZone();
    }else if(index == 'Score'){
        getScore();
    }else if(index == 'Style'){
        getStyle();
    }else if(index == 'Integrate'){
        getIntegrate();
    }else if(index == 'DG'){
        importDG200();
    }else if(index == 'DLT'){
        importDLT();
    }else if(index == "RV3D"){
        importRV3D();
    }else if(index == "ExportGBox"){
        exportGBox();
    }else if(index == 'Devices'){
        deviceInit();
    }else if(index == 'Users'){
        userInit();
    }else if(index == 'Roles'){
        roleInit();
    }
    /*else if(index == 'Event'){
     getEvent();
     }*/
}
function listDevice(){
    $.ajax({
        url: "getdata/device.php",
        type: "POST",
        async: false,
        dataType: "json",
        data:{
            action: "show"
        },
        success:function(result){
            var html = '';
            if(result.data.length > 0){
                for(var i = 0; i < result.data.length; i++){
                    var data = result.data[i];
                    var id = data["device_id"];
                    var serial = data["device_serial"];
                    var desc = data["device_desc"];

                    html += '<option value="'+id+'">'+desc+'</option>'
                }
            }
            else{
                html = '<option value="">ไม่มีอุปกรณ์</option>';
            }

            $("#deviceId").html(html);
        }
    });
}