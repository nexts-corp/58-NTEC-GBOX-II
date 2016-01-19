<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <title>New Document</title>
</head>
<body>
    <?php
    if ($fleet == "datarv3d") {
        switch($Date1) {
            case "RV3D" :       $vdoname = "G2014-06-25-09-29-47-0.mp4"; break;
            case "2014-06-25" : $vdoname = "G2014-06-25-09-29-47-0.mp4"; break;
            case "2014-07-08" : $vdoname = "G2014-07-08-17-53-28-0.mp4"; break;
            case "2014-07-15" : $vdoname = "G2014-07-15.mp4"; break;
            case "2014-07-16" : $vdoname = "G2014-07-16.mp4"; break;
            case "2014-07-17" : $vdoname = "G2014-07-17.mp4"; break;
            case "2014-07-22" : $vdoname = "G2014-07-22.mp4"; break;
            case "2014-07-24" : $vdoname = "G2014-07-24.mp4"; break;
        }

        echo "
            <video width='320' height='240' controls='controls'>

                <source src='vdo/$vdoname' type='video/mp4' />
                Your browser does not support the video tag.
            </video>
        ";
    }
    ?>
</body>
</html>
