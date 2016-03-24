<?php
require(dirname(__FILE__)."/../config.php");

$action = GetFromBrowser("action", "");



$value = array("data" => array());
if($action == "show"){

    echo manageRole();

}
else if($action == "select_device"){

    echo device();

}
else if($action == "select_super"){

    $sql = " SELECT id,CONCAT(firstname,' ',lastname) as fullName,telephone,address,device_id ";
    $sql .= " FROM `user` as us left join device_user du on du.user_id = us.id where role_id = 2 ";
    $result = mysql_query($sql);
    $i = 0;


    while($rows = mysql_fetch_array($result)){

        $new_array[$i++] = array(
            'id' => $rows['id'],
            'fullName' => $rows['fullName'],
            'telephone' => $rows['telephone'],
            'address' => $rows['address'],
            'deviceId' => $rows['device_id']
        );
    }

    echo json_encode($new_array);

}
else if($action == "select_user"){

    $sql = " SELECT id,CONCAT(firstname,' ',lastname) as fullName,telephone,address,superuser as sup, ";
    $sql .= " (select CONCAT(firstname,' ',lastname) from `user` where id = sup) as superName,device_id ";
    $sql .= "  FROM `user` as us left join device_user du on du.user_id = us.id where role_id = 1 ";
    $result = mysql_query($sql);

    $i = 0;


    while($rows = mysql_fetch_array($result)){

        $new_array[$i++] = array(
            'id' => $rows['id'],
            'fullName' => $rows['fullName'],
            'telephone' => $rows['telephone'],
            'address' => $rows['address'],
            'superName' => $rows['superName'],
            'deviceId' => $rows['device_id'],
            'superuser' => $rows['superuser']
        );
    }

    echo json_encode($new_array);


}
else if($action == "add_user"){
    $sql = " INSERT INTO device_user(device_id,user_id,date_created) ";
    $sql .= " VALUES ('".$_POST['device']."','".$_POST['superID']."',NOW()) ";
    $result = mysql_query($sql);
}
else if($action == "delete_user"){
    $sql = " DELETE FROM device_user WHERE device_id = '".$_POST['device']."' and user_id = '".$_POST['superID']."' ";
    $result = mysql_query($sql);
}







function manageRole(){



?>
    <div id="openModal" class="modalbg">
        <div class="dialog">

            <a href="#close" title="Close" class="close">X</a>
            <div class="con-dialog">
                <table id="tb_device" class="table">
                    <tbody>
                    <tr>
                        <th class="first_th">Device</th>
                        <th class="first_th">Car</th>
                        <th class="first_th">Car Type</th>
                        <th class="first_th">Action</th>
                    </tr>

                    <!-- This is our clonable table line -->
                    <?php
                    $first = false;
                    $sql = " SELECT id,device_desc,device_car,car_type_id as carId, ";
                    $sql .= " (SELECT car_type from lk_car_type where id = carId) as carType ";
                    $sql .= " FROM device ";
                    $result = mysql_query($sql);

                    while($rows = mysql_fetch_array($result)){
                        if(!$first){
                            $first = true;
                            ?>

                            <tr class="select_dv" data-device="<?php echo $rows['id'] ?>">
                                <td contenteditable="true"><?php echo $rows['device_desc'] ?></td>
                                <td contenteditable="true"><?php echo $rows['device_car'] ?></td>
                                <td>
                                    <?php echo $rows['carType'] ?>
                                </td>
                                <td class="center">
                                    <a href="#close" data-device="<?php echo $rows['id'] ?>" class="bt_sl_dv">select</a>
                                </td>
                            </tr>

                        <?php
                        }else{
                            ?>

                            <tr data-device="<?php echo $rows['id'] ?>">
                                <td contenteditable="true"><?php echo $rows['device_desc'] ?></td>
                                <td contenteditable="true"><?php echo $rows['device_car'] ?></td>
                                <td>
                                    <?php echo $rows['carType'] ?>
                                </td>
                                <td class="center">
                                    <a href="#close" data-device="<?php echo $rows['id'] ?>" class="bt_sl_dv">select</a>
                                </td>
                            </tr>

                        <?php
                        }
                    }

                    ?>


                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div id="openSuper" class="modalbg">
        <div class="dialog">

            <a href="#close" title="Close" class="close">X</a>
            <div class="con-dialog">
                <table id="tb_super" class="table">
                    <thead>

                        <tr>
                            <th class="first_th">Name</th>
                            <th class="first_th">Phone</th>
                            <th class="first_th">address</th>
                            <th class="first_th">Action</th>
                        </tr>

                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div id="openUser" class="modalbg">
        <div class="dialog">

            <a href="#close" title="Close" class="close">X</a>
            <div class="con-dialog">
                <table id="tb_user" class="table">
                    <thead>
                        <tr>
                            <th class="first_th">Name</th>
                            <th class="first_th">Phone</th>
                            <th class="first_th">address</th>
                            <th class="first_th">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="bl_delete">
        <a id="delete" href="login.php"></a>
    </div>

    <div id="delete" class="modalbg">
        <div class="dialog">

            <a href="#close" title="Close" class="close">X</a>
            <div class="con-dialog">
                <table id="tb_user" class="table">
                    <thead>
                    <tr>
                        <th class="first_th">Name</th>
                        <th class="first_th">Phone</th>
                        <th class="first_th">address</th>
                        <th class="first_th">Action</th>
                    </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="content-section">
        <!-- Widget template -->
        <div id="github-widget" data-username="piotrl" class="gh-profile-widget">
            <div class="profile">


                <a href="https://github.com/piotrl" class="name">Device</a>

                <div>

                </div>
                <ul class="languages">
                    <li>device_desc : <span id="dv_name"></span></li>
                    <br>
                    <li>device_car : <span id="dv_car"></span></li>
                    <br>
                    <li>carType : <span id="dv_type"></span></li>
                </ul>

                <div class="con_bt_sl">
                    <a class="button" href="#openModal">Select Devices</a>
                </div>

            </div>


        </div>

    </div>





    <div class="content-section">
        <!-- Widget template -->
        <div id="github-widget" data-username="piotrl" class="gh-profile-widget">
            <div class="profile">

                <a href="https://github.com/piotrl" class="name">Super User</a>
                <div class="followMe">

                </div>

                <div>

                </div>
                <ul class="languages">
                    <li>name : <span id="sp_name"></span></li>
                    <br>
                    <li>phone : <span id="sp_car"></span></li>
                    <br>
                    <li>address : <span id="sp_type"></span></li>
                </ul>
            </div>
            <div class="repos">
                <span class="header">Parent

                    <a class="ad-parent" href="#openSuper">
                        <div class="worksplus openSuper" >
                            <div class="lr" >
                                <div class="rl">
                                </div>
                            </div>
                        </div>
                    </a>


                </span>
                <div id="pa_super"></div>

            </div>

        </div>

    </div>    <div class="content-section">
        <!-- Widget template -->
        <div id="github-widget" data-username="piotrl" class="gh-profile-widget">
            <div class="profile">

                <a href="https://github.com/piotrl" class="name">User</a>
                <div class="followMe">

                </div>

                <div>

                </div>
                <ul class="languages">
                    <li>name : <span id="us_name"></span></li>
                    <br>
                    <li>phone : <span id="us_car"></span></li>
                    <br>
                    <li>address : <span id="us_type"></span></li>
                </ul>

            </div>
            <div class="repos">
                <span class="header">Parent

                                        <a class="ad-parent" href="#openUser">
                                            <div class="worksplus openUser" >
                                                <div class="lr" >
                                                    <div class="rl">
                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                </span>
                <div id="pa_user"></div>

            </div>

        </div>

    </div>

<script type="text/javascript">
    device = new Array();
    superUser = new Array();
    User = new Array();

    var device_id = '';
    $('.bt_sl_dv').click(function(){

        device = new Array();
        superUser = new Array();
        User = new Array();

        $('#tb_device').find('tbody').find('tr').removeClass('select_dv');
        var My_tb = $(this).parent().parent().addClass('select_dv');

        result_user(result_super());

        /*var My_tb = $('#tb_device').find('tbody').find('tr');
         var rowIndex = $(this).parent().parent().index('#tb_device tbody tr');
         var tdIndex = $(this).index('#tb_device tbody tr:eq('+rowIndex+') td');
         //alert(rowIndex+' '+tdIndex);
         var $myRows = $(My_tb[rowIndex]);
         $('#dv_name').html($myRows.find('td:eq(0)').html());
         $('#dv_car').html($myRows.find('td:eq(1)').html());
         $('#dv_type').html($myRows.find('td:eq(2)').html());*/

    });

    $(document).ready(function(){

        //eventSelected();

        /*$('.worksplus.openUser').click(function(){
            alert('a');
        });*/
        //result_user(result_super());
        result_user(result_super());






    });

    function result_super(){

        var MyRows = $('#tb_device').find('tbody').find('tr');

        for (var i = 0; i < MyRows.length; i++) {
            //var MyIndexValue = $(MyRows[i]).find('td:eq(0)').html();
            var select = $(MyRows[i]).attr('class');
            if(select == 'select_dv'){

                device_id = $(MyRows[i]).attr('data-device');

                /*device[i] = {
                 id:$(MyRows[i]).find('td:eq(0)').html(),
                 price:$(MyRows[i]).find('td:eq(3)').html(),
                 qty:$(MyRows[i]).find('td:eq(4)').html()
                 }*/
                $('#dv_name').html($(MyRows[i]).find('td:eq(0)').html());
                $('#dv_car').html($(MyRows[i]).find('td:eq(1)').html());
                $('#dv_type').html($(MyRows[i]).find('td:eq(2)').html());
            }

        }


        $.ajax({
            url: "getdata/roles.php",
            type: "POST",
            async: false,
            dataType: "json",
            data:{
                action: "select_super",
                device: device_id
            },
            success:function(result){
                superUser = result;
                var sel='';
                var unsel='';
                if(result!=null){

                    for(var i = 0; i < result.length; i++){
                        var $data = result[i];

                        if($data['deviceId'] == device_id){



                            if(i!=0){
                                sel +='<a href="javascript:void(0)" onclick="detailSuper('+$data['id']+')" data-super="'+$data['id']+'">';
                            }else{
                                sel +='<a href="javascript:void(0)" onclick="detailSuper('+$data['id']+')" data-super="'+$data['id']+'"  class="fr_user">';
                            }

                            sel += '<span class="repo-name">'+$data['fullName']+'</span>'
                                +'<span class="updated">Phone : '+$data['telephone']+'</span>'
                                +'<span class="star delete" onclick="delSuper('+$data['id']+')" >Delete</span>'
                                +'</a>';

                        }else{

                            unsel += '<tr data-device="'+$data['id']+'">'
                                +'<td contenteditable="true">'+$data['fullName']+'</td>'
                                +'<td contenteditable="true">'+$data['telephone']+'</td>'
                                +'<td>'+$data['address']+'</td>'
                                +'<td class="center"><a href="#close" onclick="addSuper('+$data['id']+')" data-device="'+$data['id']+'" class="bt_ad_super">select</a></td>'
                                +'</tr>';

                        }


                    }
                    $("#pa_super").html(sel);
                    $("#tb_super tbody").html(unsel);




                }else{
                    $("#pa_super").html(sel);
                    $('#sp_name').html('');
                    $('#sp_car').html('');
                    $('#sp_type').html('');
                }


                update_super();



            }
        });





        return device_id;

    }

    function result_user(device_id){

        $.ajax({
            url: "getdata/roles.php",
            type: "POST",
            async: false,
            dataType: "json",
            data:{
                action: "select_user",
                device: device_id
            },
            success:function(result){
                User = result;
                var sel='';
                var unsel='';
                if(result!=null){

                    for(var i = 0; i < result.length; i++){
                        var $data = result[i];

                        if($data['deviceId'] == device_id){


                            if(i!=0){
                                sel +='<a href="javascript:void(0)" onclick="detailUser('+$data['id']+')" data-user="'+$data['id']+'">';
                            }else{
                                sel +='<a href="javascript:void(0)" onclick="detailUser('+$data['id']+')" data-user="'+$data['id']+'"  class="fr_user">';
                            }

                            sel +='<span class="repo-name">'+$data['fullName']+'</span>'
                                +'<span class="updated">Super User : '+$data['superName']+'</span>'
                                +'<span class="star delete" onclick="delUser('+$data['id']+')">select</span>'
                                +'</a>';
                        }else{


                            unsel = '<tr data-device="'+$data['id']+'">'
                                +'<td contenteditable="true">'+$data['fullName']+'</td>'
                                +'<td contenteditable="true">'+$data['telephone']+'</td>'
                                +'<td>'+$data['superName']+'</td>'
                                +'<td class="center"><a href="#close" onclick="addUser('+$data['id']+')" data-device="'+$data['id']+'" class="bt_ad_user">Delete</a></td>'
                                +'</tr>';

                        }


                    }


                    $("#pa_user").html(sel);
                    $("#tb_user tbody").html(unsel);


                }else{
                    $("#pa_user").html(sel);
                    $('#us_name').html('');
                    $('#us_car').html('');
                    $('#us_type').html('');

                }

                update_user();

            }
        });

    }


    function delSuper(id){

        var r = confirm("Are you sure to delete?");
        if (r == true) {

            $.post("getdata/roles.php",{action: "delete_user",device: device_id ,superID : id},function(data,status){});

            var MyRows = $('#pa_super').find('a');

            for (var i = 0; i < MyRows.length; i++) {
                //var MyIndexValue = $(MyRows[i]).find('td:eq(0)').html();
                var select = $(MyRows[i]).attr('data-super');
                if(id == select){
                    //alert();
                    $(MyRows[i]).remove();
                    break;
                }
            }


            for(var i= 0; i<superUser.length ; i++){
                var $item = superUser[i];
                if(id == $item['id']){
                    var unsel = '<tr data-device="'+$item['id']+'">'
                        +'<td contenteditable="true">'+$item['fullName']+'</td>'
                        +'<td contenteditable="true">'+$item['telephone']+'</td>'
                        +'<td>'+$item['address']+'</td>'
                        +'<td class="center"><a href="#close" onclick="addSuper('+$item['id']+')" data-device="'+$item['id']+'" class="bt_ad_super">select</a></td>'
                        +'</tr>';

                    $("#tb_super tbody").append(unsel);

                }
            }

        }else {

        }



    }


    function addSuper(id){

        for(var i= 0; i<superUser.length ; i++){
            var $item = superUser[i];
            if(id == $item['id']){
                var superId = $item['id'];
                var name = $item['fullName'];
                var phone = $item['telephone'];
                var address = $item['address'];
                break;
            }
        }

        var MyRows = $('#tb_super').find('tbody').find('tr');

        for (var i = 0; i < MyRows.length; i++) {
            var select = $(MyRows[i]).attr('data-device');
            if(select == id){

                $(MyRows[i]).remove();
                break;
            }

        }




        var tem ='<a href="javascript:void(0)" onclick="detailSuper('+superId+')" data-super="'+superId+'">'
            //+'<a href="#super_user" data-super="'+$data['id']+'"  class="fr_user">'
            +'<span class="repo-name">'+name+'</span>'
            +'<span class="updated">Phone : '+phone+'</span>'
            +'<span class="star delete" onclick="delSuper('+id+')">Delete</span>'
            +'</a>';


        $("#pa_super").append(tem);

        $.post("getdata/roles.php",{action: "add_user",device: device_id ,superID : superId},function(data,status){});

    }

    function detailSuper(id){

        $('#pa_super').find('a').removeClass('fr_user');

        var MyRows = $('#pa_super').find('a');

        for (var i = 0; i < MyRows.length; i++) {
            //var MyIndexValue = $(MyRows[i]).find('td:eq(0)').html();
            var select = $(MyRows[i]).attr('data-super');
            if(id == select){
                $(MyRows[i]).addClass('fr_user');
            }
        }
        update_super();
    }





















































    function delUser(id){

        var r = confirm("Are you sure to delete?");
        if (r == true) {

            $.post("getdata/roles.php",{action: "delete_user",device: device_id ,superID : id},function(data,status){});

            var MyRows = $('#pa_user').find('a');

            for (var i = 0; i < MyRows.length; i++) {
                //var MyIndexValue = $(MyRows[i]).find('td:eq(0)').html();
                var select = $(MyRows[i]).attr('data-user');
                if(id == select){
                    //alert();
                    $(MyRows[i]).remove();
                    break;
                }
            }



            for(var i= 0; i<User.length ; i++){
                var $item = User[i];
                if(id == $item['id']){
                    var unsel = '<tr data-device="'+$item['id']+'">'
                        +'<td contenteditable="true">'+$item['fullName']+'</td>'
                        +'<td contenteditable="true">'+$item['telephone']+'</td>'
                        +'<td>'+$item['superName']+'</td>'
                        +'<td class="center"><a href="#close" onclick="addUser('+$item['id']+')" data-device="'+$item['id']+'" class="bt_ad_user">select</a></td>'
                        +'</tr>';

                    $("#tb_user tbody").append(unsel);

                }
            }

        }else {

        }



    }


    function addUser(id){




        for(var i= 0; i<User.length ; i++){
            var $item = User[i];
            if(id == $item['id']){
                var superId = $item['id'];
                var name = $item['fullName'];
                var phone = $item['telephone'];
                var address = $item['superName'];
                break;
            }
        }

        var MyRows = $('#tb_user').find('tbody').find('tr');

        for (var i = 0; i < MyRows.length; i++) {
            var select = $(MyRows[i]).attr('data-device');
            if(select == id){

                $(MyRows[i]).remove();
                break;
            }

        }


        var tem ='<a href="javascript:void(0)" onclick="detailUser('+superId+')" data-user="'+superId+'">'
            //+'<a href="#super_user" data-super="'+$data['id']+'"  class="fr_user">'
            +'<span class="repo-name">'+name+'</span>'
            +'<span class="updated">Super User : '+phone+'</span>'
            +'<span class="star delete" onclick="delUser('+id+')">Delete</span>'
            +'</a>';


        $("#pa_user").append(tem);

        $.post("getdata/roles.php",{action: "add_user",device: device_id ,superID : superId},function(data,status){});

    }



    function detailUser(id){

        $('#pa_user').find('a').removeClass('fr_user');

        var MyRows = $('#pa_user').find('a');

        for (var i = 0; i < MyRows.length; i++) {
            //var MyIndexValue = $(MyRows[i]).find('td:eq(0)').html();
            var select = $(MyRows[i]).attr('data-user');
            if(id == select){
                $(MyRows[i]).addClass('fr_user');
            }
        }
        update_user();

    }



































































    function update_super(){

        var MyRows = $('#pa_super').find('a');

        for (var i = 0; i < MyRows.length; i++) {
            //var MyIndexValue = $(MyRows[i]).find('td:eq(0)').html();
            var select = $(MyRows[i]).attr('class');
            if(select == 'fr_user'){
                var super_id = $(MyRows[i]).attr('data-super');
                for(var j = 0; j < superUser.length; j++){
                    var $data = superUser[j];

                    if(parseInt($data['id'])==parseInt(super_id)){
                        $('#sp_name').html($data['fullName']);
                        $('#sp_car').html($data['telephone']);
                        $('#sp_type').html($data['address']);
                    }
                }

            }
        }

    }



    function update_user(){

        var MyRows = $('#pa_user').find('a');

        for (var i = 0; i < MyRows.length; i++) {
            //var MyIndexValue = $(MyRows[i]).find('td:eq(0)').html();
            var select = $(MyRows[i]).attr('class');
            if(select == 'fr_user'){

                var super_id = $(MyRows[i]).attr('data-user');

                for(var j = 0; j < User.length; j++){
                    var $data = User[j];

                    if(parseInt($data['id'])==parseInt(super_id)){
                        $('#us_name').html($data['fullName']);
                        $('#us_car').html($data['telephone']);
                        $('#us_type').html($data['address']);
                    }
                }

            }
        }

    }





</script>


<?php

}



function device(){

}


?>