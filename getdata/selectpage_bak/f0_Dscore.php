<?php
error_reporting(0);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head><title>TATANAD GPS Supervisory Program</title>
</head>
<!--<body onload="initialize()" onunload="GUnload()">-->
<body>
<table style="width: 800px; height: 17px; text-align: left; margin-left: auto; margin-right: auto;">
<tbody>
<tr>
<td style="vertical-align: middle; text-align: center; height: 13px; background-color: rgb(51, 153, 204); width: 176px;">
<font weight="BOLD" color="white" face="tahoma" size="2"> <b>Driving
Score 2.0 beta </b> </font></td>
<td style="height: 13px; width: 86px;"> <a href="www.nectec.or.th"><img style="border: 0px solid ; width: 100px; height: 22px;" alt="" src="nectec.png"></a> </td>
<td style="background-color: rgb(51, 153, 204); text-align: left; height: 13px; width: 100px;">
<small><span style="font-family: Arial;"><span style="text-decoration: underline;"></span></span></small>&nbsp;
<a style="color: white;" target="_blank" href="www.thairoadsafety.net"><small style="font-family: Arial; font-weight: bold;">WebSite</small></a></td>
<td style="text-align: right; background-color: rgb(51, 153, 204); color: white; font-weight: bold; font-family: Arial; height: 13px; width: 396px;"><small><a style="color: white;" href="./mainpage.php" target="_top">Checklist
</a>&nbsp; &nbsp;</small><small><a style="color: white;" href="f1_integrate.php" target="_blank">Integrate
</a></small><small> &nbsp;
&nbsp;</small><small>&nbsp;</small><small><a href="f1_speedBehavior.php" style="color: white;" target="_blank">Speed</a></small><small>
&nbsp; &nbsp;Accelleration &nbsp;
&nbsp;Zone &nbsp; &nbsp;Turn &nbsp;</small></td>
</tr>
</tbody>
</table>
<form style="height: 690px;" action="f1_main.php" method="post">
<table style="background-color: white; width: 800px; height: 64px; text-align: left; margin-left: auto; margin-right: auto;" border="0" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td style="width: 151px;" colspan="3" rowspan="1"><small><span style="font-weight: bold;"></span></small><small><span style="font-weight: bold;"></span></small><small><span style="font-weight: bold;"></span></small><small>
        <!--<php title="if ($selectT==&quot;Test1&quot;) { $driver = &quot;&amp;#3626;&amp;#3617;&amp;#3626;&amp;#3634;&amp;#3618; &amp;#3626;&amp;#3610;&amp;#3634;&amp;#3618;&amp;#3592;&amp;#3636;&amp;#3605;&quot;; $busid=&quot;&amp;#3585;&amp;#3586; 2675&quot;; $date=&quot;$date1&quot;;} elseif ($selectT==&quot;Test2&quot;) { $driver = &quot;&amp;#3626;&amp;#3617;&amp;#3588;&amp;#3636;&amp;#3604; &amp;#3626;&amp;#3636;&amp;#3609;&amp;#3651;&amp;#3592;&quot;; $busid=&quot;80-3344&quot;; $date=&quot;$date2&quot;;} elseif ($selectT==&quot;Test3&quot;) { $driver = &quot;&amp;#3626;&amp;#3617;&amp;#3620;&amp;#3607;&amp;#3633;&amp;#3618; &amp;#3652;&amp;#3611;&amp;#3626;&amp;#3610;&amp;#3634;&amp;#3618;&quot;; $busid=&quot;81-5566&quot;; $date=&quot;$date3&quot;;} elseif ($selectT==&quot;Test4&quot;) { $driver = &quot;&amp;#3648;&amp;#3594;&amp;#3637;&amp;#3618;&amp;#3591;&amp;#3619;&amp;#3634;&amp;#3618; &amp;#3626;&amp;#3610;&amp;#3634;&amp;#3618;&amp;#3592;&amp;#3636;&amp;#3605;&quot;; $busid=&quot;82-2456&quot;; $date=&quot;$date4&quot;;} elseif ($selectT==&quot;Test5&quot;) { $driver = &quot;&amp;#3626;&amp;#3617;&amp;#3609;&amp;#3638;&amp;#3585; &amp;#3588;&amp;#3638;&amp;#3585;&amp;#3588;&amp;#3633;&amp;#3585;&quot;; $busid=&quot;88-7272&quot;; $date=&quot;$date5&quot;;} else {$driver = &quot;........&quot;; $busid = &quot;.....&quot;; $date99 = &quot;.....&quot;;} echo&quot;$driver&quot;;" xmlns="http://disruptive-innovations.com/zoo/nvu">-->
        <!--<php title="if ($selectT==&quot;Test1&quot;) { $driver = &quot;&amp;#3626;&amp;#3617;&amp;#3626;&amp;#3634;&amp;#3618; &amp;#3626;&amp;#3610;&amp;#3634;&amp;#3618;&amp;#3592;&amp;#3636;&amp;#3605;&quot;; $busid=&quot;&amp;#3585;&amp;#3586; 2675&quot;; $date=&quot;$date1&quot;;} elseif ($selectT==&quot;Test2&quot;) { $rout_1 = &quot;BKK - NRM&quot;; $driver = &quot;&amp;#3626;&amp;#3617;&amp;#3588;&amp;#3636;&amp;#3604; &amp;#3626;&amp;#3636;&amp;#3609;&amp;#3651;&amp;#3592;&quot;; $busid=&quot;80-3344&quot;; $date=&quot;$date2&quot;;} elseif ($selectT==&quot;Test3&quot;) { $rout_1 = &quot;BKK - NRM&quot;; $driver = &quot;&amp;#3626;&amp;#3617;&amp;#3620;&amp;#3607;&amp;#3633;&amp;#3618; &amp;#3652;&amp;#3611;&amp;#3626;&amp;#3610;&amp;#3634;&amp;#3618;&quot;; $busid=&quot;81-5566&quot;; $date=&quot;$date3&quot;;} elseif ($selectT==&quot;Test4&quot;) { $driver = &quot;&amp;#3648;&amp;#3594;&amp;#3637;&amp;#3618;&amp;#3591;&amp;#3619;&amp;#3634;&amp;#3618; &amp;#3626;&amp;#3610;&amp;#3634;&amp;#3618;&amp;#3592;&amp;#3636;&amp;#3605;&quot;; $busid=&quot;82-2456&quot;; $date=&quot;$date4&quot;;} elseif ($selectT==&quot;Test5&quot;) { $driver = &quot;&amp;#3626;&amp;#3617;&amp;#3609;&amp;#3638;&amp;#3585; &amp;#3588;&amp;#3638;&amp;#3585;&amp;#3588;&amp;#3633;&amp;#3585;&quot;; $busid=&quot;88-7272&quot;; $date=&quot;$date5&quot;;} else {$driver = &quot;........&quot;; $busid = &quot;.....&quot;; $date99 = &quot;.....&quot;;} echo&quot;$driver&quot;;" xmlns="http://disruptive-innovations.com/zoo/nvu"></php></php>-->
        </small><small><span style="font-weight: bold;"> <span style="font-style: italic;"></span></span></small><small>
        <!--<php title="$date99 = &quot;2013-01-01&quot;; $TimeBegin = &quot;00:00:00&quot;; $TimeEnd = &quot;00:00:01&quot;; $device=&quot;dg200&quot;; if ($selectT==&quot;Test5&quot;) { $device=&quot;gps01&quot;; switch($date5) { case &quot;Transport&quot; : $date5=&quot;26/07/2013&quot;; $date5_in = &quot;26/07/2013&quot;; $TimeBegin = &quot;08:30:01&quot;; $TimeEnd = &quot;08:30:02&quot;; break; case &quot;26(1)/07/2013&quot; : $date5_in = &quot;26/07/2013&quot;; $TimeBegin = &quot;00:00:01&quot;; $TimeEnd = &quot;08:50:00&quot;; break; case &quot;26(2)/07/2013&quot; : $date5_in = &quot;26/07/2013&quot;; $TimeBegin = &quot;18:45:00&quot;; $TimeEnd = &quot;23:59:30&quot;; break; case &quot;13(1)/09/2013&quot; : $date5_in = &quot;13/09/2013&quot;; $TimeBegin = &quot;13:09:07&quot;; $TimeEnd = &quot;18:19:01&quot;; break; } $date99 = $date5_in; } elseif ($selectT==&quot;Test4&quot;) { $device=&quot;dg200&quot;; switch($date4) { case &quot;Chiangrai&quot; : $date4_in = &quot;01/10/2013&quot;; $TimeBegin = &quot;08:13:41&quot;; $TimeEnd = &quot;08:13:42&quot;; break; case &quot;01(1)/10/2013&quot; : $date4_in = &quot;01/10/2013&quot;; $TimeBegin = &quot;08:13:01&quot;; $TimeEnd = &quot;13:10:00&quot;; break; case &quot;01(2)/10/2013&quot; : $date4_in = &quot;01/10/2013&quot;; $TimeBegin = &quot;13:10:01&quot;; $TimeEnd = &quot;19:44:21&quot;; break; case &quot;02(1)/10/2013&quot; : $date4_in = &quot;02/10/2013&quot;; $TimeBegin = &quot;07:35:03&quot;; $TimeEnd = &quot;13:55:30&quot;; break; case &quot;02(2)/10/2013&quot; : $date4_in = &quot;02/10/2013&quot;; $TimeBegin = &quot;13:55:31&quot;; $TimeEnd = &quot;19:35:28&quot;; break; } $date99 = $date4_in; } elseif ($selectT==&quot;Test3&quot;) { $device=&quot;dg200&quot;; switch($date3) { case &quot;Nakornrachasima&quot; : $date3_in = &quot;02/09/2013&quot;; $TimeBegin = &quot;06:32:12&quot;; $TimeEnd = &quot;06:32:15&quot;; break; case &quot;23(1)/09/2013&quot; : $date3_in = &quot;23/09/2013&quot;; $TimeBegin = &quot;13:13:30&quot;; $TimeEnd = &quot;13:46:44&quot;; break; case &quot;25(1)/08/2013&quot; : $date3_in = &quot;25/08/2013&quot;; $TimeBegin = &quot;05:17:32&quot;; $TimeEnd = &quot;08:20:24&quot;; break; case &quot;25(2)/08/2013&quot; : $date3_in = &quot;25/08/2013&quot;; $TimeBegin = &quot;08:46:35&quot;; $TimeEnd = &quot;12:48:14&quot;; break; case &quot;25(3)/08/2013&quot; : $date3_in = &quot;25/08/2013&quot;; $TimeBegin = &quot;14:01:18&quot;; $TimeEnd = &quot;17:23:46&quot;; break; case &quot;25(4)/08/2013&quot; : $date3_in = &quot;25/08/2013&quot;; $TimeBegin = &quot;18:04:43&quot;; $TimeEnd = &quot;21:36:02&quot;; break; case &quot;04(1)/09/2013&quot; : $date3_in = &quot;04/09/2013&quot;; $TimeBegin = &quot;09:22:40&quot;; $TimeEnd = &quot;12:58:00&quot;; break; case &quot;04(2)/09/2013&quot; : $date3_in = &quot;04/09/2013&quot;; $TimeBegin = &quot;18:00:49&quot;; $TimeEnd = &quot;21:34:56&quot;; break; case &quot;04(3)/09/2013&quot; : $date3_in = &quot;04/09/2013&quot;; $TimeBegin = &quot;05:18:58&quot;; $TimeEnd = &quot;08:49:10&quot;; break; case &quot;04(4)/09/2013&quot; : $date3_in = &quot;04/09/2013&quot;; $TimeBegin = &quot;14:05:37&quot;; $TimeEnd = &quot;17:53:39&quot;; break; case &quot;04(5)/09/2013&quot; : $date3_in = &quot;04/08/2013&quot;; $TimeBegin = &quot;09:21:48&quot;; $TimeEnd = &quot;12:57:19&quot;; break; case &quot;04(6)/09/2013&quot; : $date3_in = &quot;04/08/2013&quot;; $TimeBegin = &quot;17:59:35&quot;; $TimeEnd = &quot;21:34:56&quot;; break; case &quot;04(7)/09/2013&quot; : $date3_in = &quot;04/08/2013&quot;; $TimeBegin = &quot;05:18:33&quot;; $TimeEnd = &quot;08:49:10&quot;; break; case &quot;04(8)/09/2013&quot; : $date3_in = &quot;04/08/2013&quot;; $TimeBegin = &quot;14:05:24&quot;; $TimeEnd = &quot;17:53:39&quot;; break; case &quot;02(1)/09/2013&quot; : $date3_in = &quot;02/08/2013&quot;; $TimeBegin = &quot;10:51:27&quot;; $TimeEnd = &quot;14:34:41&quot;; break; case &quot;02(2)/09/2013&quot; : $date3_in = &quot;02/09/2013&quot;; $TimeBegin = &quot;06:32:12&quot;; $TimeEnd = &quot;10:26:09&quot;; break; case &quot;02(3)/09/2013&quot; : $date3_in = &quot;02/09/2013&quot;; $TimeBegin = &quot;10:51:09&quot;; $TimeEnd = &quot;14:34:30&quot;; break; case &quot;02(4)/09/2013&quot; : $date3_in = &quot;02/08/2013&quot;; $TimeBegin = &quot;06:31:33&quot;; $TimeEnd = &quot;10:26:19&quot;; break; case &quot;05(1)/09/2013&quot; : $date3_in = &quot;05/09/2013&quot;; $TimeBegin = &quot;10:02:59&quot;; $TimeEnd = &quot;14:06:10&quot;; break; case &quot;05(2)/09/2013&quot; : $date3_in = &quot;05/09/2013&quot;; $TimeBegin = &quot;19:22:22&quot;; $TimeEnd = &quot;22:39:46&quot;; break; case &quot;05(3)/09/2013&quot; : $date3_in = &quot;05/09/2013&quot;; $TimeBegin = &quot;06:05:33&quot;; $TimeEnd = &quot;09:25:02&quot;; break; case &quot;05(4)/09/2013&quot; : $date3_in = &quot;05/09/2013&quot;; $TimeBegin = &quot;15:03:56&quot;; $TimeEnd = &quot;18:42:27&quot;; break; case &quot;05(5)/09/2013&quot; : $date3_in = &quot;05/08/2013&quot;; $TimeBegin = &quot;10:03:10&quot;; $TimeEnd = &quot;14:06:10&quot;; break; case &quot;05(6)/09/2013&quot; : $date3_in = &quot;05/08/2013&quot;; $TimeBegin = &quot;19:22:28&quot;; $TimeEnd = &quot;22:39:47&quot;; break; case &quot;05(7)/09/2013&quot; : $date3_in = &quot;05/08/2013&quot;; $TimeBegin = &quot;06:03:03&quot;; $TimeEnd = &quot;09:25:17&quot;; break; case &quot;05(8)/09/2013&quot; : $date3_in = &quot;05/08/2013&quot;; $TimeBegin = &quot;15:03:53&quot;; $TimeEnd = &quot;18:42:32&quot;; break; case &quot;08(1)/09/2013&quot; : $date3_in = &quot;08/09/2013&quot;; $TimeBegin = &quot;09:20:29&quot;; $TimeEnd = &quot;14:06:10&quot;; break; case &quot;08(2)/09/2013&quot; : $date3_in = &quot;08/09/2013&quot;; $TimeBegin = &quot;05:14:38&quot;; $TimeEnd = &quot;08:52:45&quot;; break; case &quot;08(3)/09/2013&quot; : $date3_in = &quot;08/08/2013&quot;; $TimeBegin = &quot;09:20:29&quot;; $TimeEnd = &quot;12:56:33&quot;; break; case &quot;08(4)/09/2013&quot; : $date3_in = &quot;08/08/2013&quot;; $TimeBegin = &quot;05:14:33&quot;; $TimeEnd = &quot;08:52:45&quot;; break; case &quot;09(1)/09/2013&quot; : $date3_in = &quot;09/09/2013&quot;; $TimeBegin = &quot;08:55:53&quot;; $TimeEnd = &quot;12:35:17&quot;; break; case &quot;09(2)/09/2013&quot; : $date3_in = &quot;09/09/2013&quot;; $TimeBegin = &quot;17:30:43&quot;; $TimeEnd = &quot;21:18:09&quot;; break; case &quot;09(3)/09/2013&quot; : $date3_in = &quot;09/09/2013&quot;; $TimeBegin = &quot;05:07:03&quot;; $TimeEnd = &quot;08:46:56&quot;; break; case &quot;09(4)/09/2013&quot; : $date3_in = &quot;09/09/2013&quot;; $TimeBegin = &quot;13:29:31&quot;; $TimeEnd = &quot;17:03:56&quot;; break; case &quot;09(5)/09/2013&quot; : $date3_in = &quot;09/08/2013&quot;; $TimeBegin = &quot;08:55:53&quot;; $TimeEnd = &quot;12:35:17&quot;; break; case &quot;09(6)/09/2013&quot; : $date3_in = &quot;09/08/2013&quot;; $TimeBegin = &quot;17:30:49&quot;; $TimeEnd = &quot;21:19:47&quot;; break; case &quot;09(7)/09/2013&quot; : $date3_in = &quot;09/08/2013&quot;; $TimeBegin = &quot;05:05:21&quot;; $TimeEnd = &quot;08:46:56&quot;; break; case &quot;09(8)/09/2013&quot; : $date3_in = &quot;09/08/2013&quot;; $TimeBegin = &quot;13:29:27&quot;; $TimeEnd = &quot;17:03:56&quot;; break; } $date99 = $date3_in; } elseif ($selectT==&quot;Test1&quot;) { $device=&quot;3dgps01&quot;; switch($date1) { case &quot;KlongLuang&quot; : $date1=&quot;31/05/2012&quot;; $TimeBegin = &quot;01:27:00&quot;; $TimeEnd = &quot;01:27:01&quot;; break; case &quot;31/05/2012&quot; : $TimeBegin = &quot;01:27:00&quot;; $TimeEnd = &quot;01:55:00&quot;; break; case &quot;01/06/2012&quot; : $TimeBegin = &quot;01:19:00&quot;; $TimeEnd = &quot;01:44:30&quot;; break; case &quot;07/06/2012&quot; : $TimeBegin = &quot;01:29:30&quot;; $TimeEnd = &quot;02:12:43&quot;; break; case &quot;11/06/2012&quot; : $TimeBegin = &quot;01:33:20&quot;; $TimeEnd = &quot;02:05:45&quot;; break; case &quot;12/06/2012&quot; : $TimeBegin = &quot;01:14:04&quot;; $TimeEnd = &quot;01:41:45&quot;; break; case &quot;13/06/2012&quot; : $TimeBegin = &quot;01:20:50&quot;; $TimeEnd = &quot;01:42:30&quot;; break; case &quot;14/06/2012&quot; : $TimeBegin = &quot;01:16:54&quot;; $TimeEnd = &quot;01:45:50&quot;; break; case &quot;15/06/2012&quot; : $TimeBegin = &quot;01:33:00&quot;; $TimeEnd = &quot;02:00:00&quot;; break; case &quot;18/06/2012&quot; : $TimeBegin = &quot;01:21:05&quot;; $TimeEnd = &quot;01:48:00&quot;; break; case &quot;19/06/2012&quot; : $TimeBegin = &quot;01:03:50&quot;; $TimeEnd = &quot;01:25:40&quot;; break; case &quot;20/06/2012&quot; : $TimeBegin = &quot;01:13:20&quot;; $TimeEnd = &quot;01:31:25&quot;; break; case &quot;21/06/2012&quot; : $TimeBegin = &quot;01:00:00&quot;; $TimeEnd = &quot;01:23:15&quot;; break; case &quot;22/06/2012&quot; : $TimeBegin = &quot;01:16:45&quot;; $TimeEnd = &quot;01:37:40&quot;; break;$Date1 = &quot;2013-10-01&quot;; case &quot;25/06/2012&quot; : $TimeBegin = &quot;01:54:45&quot;; $TimeEnd = &quot;02:16:40&quot;; break; case &quot;26/06/2012&quot; : $TimeBegin = &quot;01:03:20&quot;; $TimeEnd = &quot;01:29:40&quot;; break; case &quot;27/06/2012&quot; : $TimeBegin = &quot;01:21:00&quot;; $TimeEnd = &quot;01:52:00&quot;; break; case &quot;28/06/2012&quot; : $TimeBegin = &quot;01:24:00&quot;; $TimeEnd = &quot;01:49:45&quot;; break; case &quot;29/06/2012&quot; : $TimeBegin = &quot;01:29:00&quot;; $TimeEnd = &quot;01:59:00&quot;; break; case &quot;02/07/2012&quot; : $TimeBegin = &quot;01:37:00&quot;; $TimeEnd = &quot;02:03:00&quot;; break; case &quot;03/07/2012&quot; : $TimeBegin = &quot;01:34:40&quot;; $TimeEnd = &quot;02:14:00&quot;; break; case &quot;06/07/2012&quot; : $TimeBegin = &quot;01:16:40&quot;; $TimeEnd = &quot;01:40:50&quot;; break; case &quot;09/07/2012&quot; : $TimeBegin = &quot;01:26:45&quot;; $TimeEnd = &quot;01:53:20&quot;; break; case &quot;10/07/2012&quot; : $TimeBegin = &quot;01:22:30&quot;; $TimeEnd = &quot;01:46:15&quot;; break; case &quot;11/07/2012&quot; : $TimeBegin = &quot;01:29:00&quot;; $TimeEnd = &quot;01:58:00&quot;; break; case &quot;12/07/2012&quot; : $TimeBegin = &quot;01:38:40&quot;; $TimeEnd = &quot;02:09:30&quot;; break; case &quot;13/07/2012&quot; : $TimeBegin = &quot;01:53:20&quot;; $TimeEnd = &quot;02:15:20&quot;; break; case &quot;16/07/2012&quot; : $TimeBegin = &quot;01:39:00&quot;; $TimeEnd = &quot;02:02:20&quot;; break; case &quot;17/07/2012&quot; : $TimeBegin = &quot;01:20:15&quot;; $TimeEnd = &quot;01:47:05&quot;; break; case &quot;18/07/2012&quot; : $TimeBegin = &quot;01:18:30&quot;; $TimeEnd = &quot;01:42:45&quot;; break; case &quot;19/07/2012&quot; : $TimeBegin = &quot;01:24:00&quot;; $TimeEnd = &quot;01:45:00&quot;; break; case &quot;27/07/2012&quot; : $TimeBegin = &quot;01:21:30&quot;; $TimeEnd = &quot;01:43:00&quot;; break; case &quot;30/07/2012&quot; : $TimeBegin = &quot;01:15:45&quot;; $TimeEnd = &quot;01:53:00&quot;; break; case &quot;31/07/2012&quot; : $TimeBegin = &quot;01:19:00&quot;; $TimeEnd = &quot;01:45:00&quot;; break; } $date99 = $date1; } elseif ($selectT==&quot;Test2&quot;) { $device=&quot;dg200&quot;; switch($date2) { case &quot;Nakornrachasima0&quot; : $date1 = &quot;15/10/2012&quot;; $TimeBegin = &quot;17:39:09&quot;; $TimeEnd = &quot;17:39:10&quot;; break; case &quot;15(1)/10/2012&quot; : $date1 = &quot;15/10/2012&quot;; $TimeBegin = &quot;14:15:00&quot;; $TimeEnd = &quot;17:45:00&quot;; break; case &quot;16(1)/10/2012&quot; : $date1 = &quot;16/10/2012&quot;; $TimeBegin = &quot;21:10:04&quot;; $TimeEnd = &quot;23:59:59&quot;; break; case &quot;17(1)/10/2012&quot; : $date1 = &quot;17/10/2012&quot;; $TimeBegin = &quot;02:05:02&quot;; $TimeEnd = &quot;05:21:58&quot;; break; case &quot;17(2)/10/2012&quot; : $date1 = &quot;17/10/2012&quot;; $TimeBegin = &quot;07:21:12&quot;; $TimeEnd = &quot;10:42:00&quot;; break; case &quot;17(3)/10/2012&quot; : $date1 = &quot;17/10/2012&quot;; $TimeBegin = &quot;11:13:00&quot;; $TimeEnd = &quot;14:48:04&quot;; break; case &quot;18(1)/10/2012&quot; : $date1 = &quot;18/10/2012&quot;; $TimeBegin = &quot;08:41:28&quot;; $TimeEnd = &quot;12:04:01&quot;; break; case &quot;18(2)/10/2012&quot; : $date1 = &quot;18/10/2012&quot;; $TimeBegin = &quot;12:55:41&quot;; $TimeEnd = &quot;16:38:40&quot;; break; case &quot;19(1)/10/2012&quot; : $date1 = &quot;19/10/2012&quot;; $TimeBegin = &quot;06:19:22&quot;; $TimeEnd = &quot;09:50:00&quot;; break; case &quot;19(2)/10/2012&quot; : $date1 = &quot;19/10/2012&quot;; $TimeBegin = &quot;10:46:34&quot;; $TimeEnd = &quot;14:12:26&quot;; break; case &quot;19(3)/10/2012&quot; : $date1 = &quot;19/10/2012&quot;; $TimeBegin = &quot;23:11:34&quot;; $TimeEnd = &quot;23:59:59&quot;; break; case &quot;20(1)/10/2012&quot; : $date1 = &quot;20/10/2012&quot;; $TimeBegin = &quot;03:07:20&quot;; $TimeEnd = &quot;06:55:29&quot;; break; case &quot;20(2)/10/2012&quot; : $date1 = &quot;20/10/2012&quot;; $TimeBegin = &quot;12:43:00&quot;; $TimeEnd = &quot;16:31:33&quot;; break; case &quot;23(1)/10/2012&quot; : $date1 = &quot;23/10/2012&quot;; $TimeBegin = &quot;07:16:51&quot;; $TimeEnd = &quot;10:36:49&quot;; break; case &quot;23(2)/10/2012&quot; : $date1 = &quot;23/10/2012&quot;; $TimeBegin = &quot;10:58:49&quot;; $TimeEnd = &quot;14:25:18&quot;; break; case &quot;24(1)/10/2012&quot; : $date1 = &quot;24/10/2012&quot;; $TimeBegin = &quot;07:09:52&quot;; $TimeEnd = &quot;10:48:10&quot;; break; case &quot;24(2)/10/2012&quot; : $date1 = &quot;24/10/2012&quot;; $TimeBegin = &quot;11:29:24&quot;; $TimeEnd = &quot;15:10:21&quot;; break; case &quot;25(1)/10/2012&quot; : $date1 = &quot;25/10/2012&quot;; $TimeBegin = &quot;09:56:59&quot;; $TimeEnd = &quot;13:25:25&quot;; break; case &quot;25(2)/10/2012&quot; : $date1 = &quot;25/10/2012&quot;; $TimeBegin = &quot;14:17:06&quot;; $TimeEnd = &quot;17:57:24&quot;; break; case &quot;26(1)/10/2012&quot; : $date1 = &quot;26/10/2012&quot;; $TimeBegin = &quot;11:34:04&quot;; $TimeEnd = &quot;15:17:11&quot;; break; case &quot;26(2)/10/2012&quot; : $date1 = &quot;26/10/2012&quot;; $TimeBegin = &quot;15:35:57&quot;; $TimeEnd = &quot;19:45:39&quot;; break; case &quot;27(1)/10/2012&quot; : $date1 = &quot;27/10/2012&quot;; $TimeBegin = &quot;11:27:28&quot;; $TimeEnd = &quot;14:54:33&quot;; break; case &quot;27(2)/10/2012&quot; : $date1 = &quot;27/10/2012&quot;; $TimeBegin = &quot;15:16:59&quot;; $TimeEnd = &quot;19:15:22&quot;; break; case &quot;28(1)/10/2012&quot; : $date1 = &quot;28/10/2012&quot;; $TimeBegin = &quot;10:33:35&quot;; $TimeEnd = &quot;14:08:30&quot;; break; case &quot;28(2)/10/2012&quot; : $date1 = &quot;28/10/2012&quot;; $TimeBegin = &quot;15:14:45&quot;; $TimeEnd = &quot;18:47:17&quot;; break; case &quot;29(1)/10/2012&quot; : $date1 = &quot;29/10/2012&quot;; $TimeBegin = &quot;07:51:59&quot;; $TimeEnd = &quot;11:53:19&quot;; break; case &quot;29(2)/10/2012&quot; : $date1 = &quot;29/10/2012&quot;; $TimeBegin = &quot;12:25:16&quot;; $TimeEnd = &quot;16:14:40&quot;; break; case &quot;30(1)/10/2012&quot; : $date1 = &quot;30/10/2012&quot;; $TimeBegin = &quot;10:08:16&quot;; $TimeEnd = &quot;13:28:21&quot;; break; case &quot;30(2)/10/2012&quot; : $date1 = &quot;30/10/2012&quot;; $TimeBegin = &quot;13:46:18&quot;; $TimeEnd = &quot;17:19:31&quot;; break; case &quot;01(1)/11/2012&quot; : $date1 = &quot;01/11/2012&quot;; $TimeBegin = &quot;14:09:26&quot;; $TimeEnd = &quot;18:14:12&quot;; break; case &quot;01(2)/11/2012&quot; : $date1 = &quot;01/11/2012&quot;; $TimeBegin = &quot;18:30:21&quot;; $TimeEnd = &quot;22:14:10&quot;; break; } $date99 = $date1; } else {$date99=&quot;01/01/2013&quot;; $TimeBegin = &quot;00:00:00&quot;; $TimeEnd = &quot;00:00:01&quot;; } echo &quot;$date99&quot;;" xmlns="http://disruptive-innovations.com/zoo/nvu">-->
        <!--<php title="$date99 = &quot;2013-01-01&quot;; $TimeBegin = &quot;00:00:00&quot;; $TimeEnd = &quot;00:00:01&quot;; $device=&quot;dg200&quot;; if ($selectT==&quot;Test5&quot;) { $device=&quot;gps01&quot;; switch($date5) { case &quot;Transport&quot; : $date5=&quot;26/07/2013&quot;; $date5_in = &quot;26/07/2013&quot;; $TimeBegin = &quot;08:30:01&quot;; $TimeEnd = &quot;08:30:02&quot;; break; case &quot;26(1)/07/2013&quot; : $date5_in = &quot;26/07/2013&quot;; $TimeBegin = &quot;00:00:01&quot;; $TimeEnd = &quot;08:50:00&quot;; break; case &quot;26(2)/07/2013&quot; : $date5_in = &quot;26/07/2013&quot;; $TimeBegin = &quot;18:45:00&quot;; $TimeEnd = &quot;23:59:30&quot;; break; case &quot;13(1)/09/2013&quot; : $date5_in = &quot;13/09/2013&quot;; $TimeBegin = &quot;13:09:07&quot;; $TimeEnd = &quot;18:19:01&quot;; break; } $date99 = $date5_in; } elseif ($selectT==&quot;Test4&quot;) { $device=&quot;dg200&quot;; switch($date4) { case &quot;Chiangrai&quot; : $date4_in = &quot;01/10/2013&quot;; $TimeBegin = &quot;08:13:41&quot;; $TimeEnd = &quot;08:13:42&quot;; break; case &quot;01(1)/10/2013&quot; : $date4_in = &quot;01/10/2013&quot;; $TimeBegin = &quot;08:13:01&quot;; $TimeEnd = &quot;13:10:00&quot;; break; case &quot;01(2)/10/2013&quot; : $date4_in = &quot;01/10/2013&quot;; $TimeBegin = &quot;13:10:01&quot;; $TimeEnd = &quot;19:44:21&quot;; break; case &quot;02(1)/10/2013&quot; : $date4_in = &quot;02/10/2013&quot;; $TimeBegin = &quot;07:35:03&quot;; $TimeEnd = &quot;13:55:30&quot;; break; case &quot;02(2)/10/2013&quot; : $date4_in = &quot;02/10/2013&quot;; $TimeBegin = &quot;13:55:31&quot;; $TimeEnd = &quot;19:35:28&quot;; break; case &quot;17(1)/09/2013&quot; : $date4_in = &quot;17/09/2013&quot;; $TimeBegin = &quot;07:47:55&quot;; $TimeEnd = &quot;13:30:57&quot;; break; case &quot;17(2)/09/2013&quot; : $date4_in = &quot;17/09/2013&quot;; $TimeBegin = &quot;13:30:57&quot;; $TimeEnd = &quot;20:05:06&quot;; break; case &quot;18(1)/09/2013&quot; : $date4_in = &quot;18/09/2013&quot;; $TimeBegin = &quot;07:37:04&quot;; $TimeEnd = &quot;21:34:12&quot;; break; case &quot;19(1)/09/2013&quot; : $date4_in = &quot;19/09/2013&quot;; $TimeBegin = &quot;08:01:14&quot;; $TimeEnd = &quot;13:19:25&quot;; break; case &quot;19(2)/09/2013&quot; : $date4_in = &quot;19/09/2013&quot;; $TimeBegin = &quot;14:19:26&quot;; $TimeEnd = &quot;19:22:02&quot;; break; case &quot;20(1)/09/2013&quot; : $date4_in = &quot;20/09/2013&quot;; $TimeBegin = &quot;07:54:27&quot;; $TimeEnd = &quot;14:15:34&quot;; break; case &quot;20(2)/09/2013&quot; : $date4_in = &quot;20/09/2013&quot;; $TimeBegin = &quot;14:15:34&quot;; $TimeEnd = &quot;19:53:14&quot;; break; case &quot;21(1)/09/2013&quot; : $date4_in = &quot;21/09/2013&quot;; $TimeBegin = &quot;07:55:19&quot;; $TimeEnd = &quot;13:08:07&quot;; break; case &quot;21(2)/09/2013&quot; : $date4_in = &quot;21/09/2013&quot;; $TimeBegin = &quot;13:08:07&quot;; $TimeEnd = &quot;19:26:36&quot;; break; case &quot;22(1)/09/2013&quot; : $date4_in = &quot;22/09/2013&quot;; $TimeBegin = &quot;07:26:49&quot;; $TimeEnd = &quot;14:02:19&quot;; break; case &quot;22(2)/09/2013&quot; : $date4_in = &quot;22/09/2013&quot;; $TimeBegin = &quot;14:02:19&quot;; $TimeEnd = &quot;19:28:15&quot;; break; } $date99 = $date4_in; } elseif ($selectT==&quot;Test3&quot;) { $device=&quot;dg200&quot;; switch($date3) { case &quot;Nakornrachasima&quot; : $date3_in = &quot;02/09/2013&quot;; $TimeBegin = &quot;06:32:12&quot;; $TimeEnd = &quot;06:32:15&quot;; break; case &quot;23(1)/09/2013&quot; : $date3_in = &quot;23/09/2013&quot;; $TimeBegin = &quot;13:13:30&quot;; $TimeEnd = &quot;13:46:44&quot;; break; case &quot;25(1)/08/2013&quot; : $date3_in = &quot;25/08/2013&quot;; $TimeBegin = &quot;05:17:32&quot;; $TimeEnd = &quot;08:20:24&quot;; break; case &quot;25(2)/08/2013&quot; : $date3_in = &quot;25/08/2013&quot;; $TimeBegin = &quot;08:46:40&quot;; $TimeEnd = &quot;12:48:14&quot;; break; case &quot;25(3)/08/2013&quot; : $date3_in = &quot;25/08/2013&quot;; $TimeBegin = &quot;14:01:18&quot;; $TimeEnd = &quot;17:23:46&quot;; break; case &quot;25(4)/08/2013&quot; : $date3_in = &quot;25/08/2013&quot;; $TimeBegin = &quot;18:04:43&quot;; $TimeEnd = &quot;21:36:02&quot;; break; case &quot;04(1)/09/2013&quot; : $date3_in = &quot;04/09/2013&quot;; $TimeBegin = &quot;09:22:40&quot;; $TimeEnd = &quot;12:58:00&quot;; break; case &quot;04(2)/09/2013&quot; : $date3_in = &quot;04/09/2013&quot;; $TimeBegin = &quot;18:00:49&quot;; $TimeEnd = &quot;21:34:56&quot;; break; case &quot;04(3)/09/2013&quot; : $date3_in = &quot;04/09/2013&quot;; $TimeBegin = &quot;05:18:58&quot;; $TimeEnd = &quot;08:49:10&quot;; break; case &quot;04(4)/09/2013&quot; : $date3_in = &quot;04/09/2013&quot;; $TimeBegin = &quot;14:05:37&quot;; $TimeEnd = &quot;17:53:39&quot;; break; case &quot;04(5)/09/2013&quot; : $date3_in = &quot;04/08/2013&quot;; $TimeBegin = &quot;09:21:48&quot;; $TimeEnd = &quot;12:57:19&quot;; break; case &quot;04(6)/09/2013&quot; : $date3_in = &quot;04/08/2013&quot;; $TimeBegin = &quot;17:59:35&quot;; $TimeEnd = &quot;21:34:56&quot;; break; case &quot;04(7)/09/2013&quot; : $date3_in = &quot;04/08/2013&quot;; $TimeBegin = &quot;05:18:33&quot;; $TimeEnd = &quot;08:49:10&quot;; break; case &quot;04(8)/09/2013&quot; : $date3_in = &quot;04/08/2013&quot;; $TimeBegin = &quot;14:05:24&quot;; $TimeEnd = &quot;17:53:39&quot;; break; case &quot;02(1)/09/2013&quot; : $date3_in = &quot;02/08/2013&quot;; $TimeBegin = &quot;10:51:27&quot;; $TimeEnd = &quot;14:34:41&quot;; break; case &quot;02(2)/09/2013&quot; : $date3_in = &quot;02/09/2013&quot;; $TimeBegin = &quot;06:32:12&quot;; $TimeEnd = &quot;10:26:09&quot;; break; case &quot;02(3)/09/2013&quot; : $date3_in = &quot;02/09/2013&quot;; $TimeBegin = &quot;10:51:09&quot;; $TimeEnd = &quot;14:34:30&quot;; break; case &quot;02(4)/09/2013&quot; : $date3_in = &quot;02/08/2013&quot;; $TimeBegin = &quot;06:31:33&quot;; $TimeEnd = &quot;10:26:19&quot;; break; case &quot;05(1)/09/2013&quot; : $date3_in = &quot;05/09/2013&quot;; $TimeBegin = &quot;10:02:59&quot;; $TimeEnd = &quot;14:06:10&quot;; break; case &quot;05(2)/09/2013&quot; : $date3_in = &quot;05/09/2013&quot;; $TimeBegin = &quot;19:22:22&quot;; $TimeEnd = &quot;22:39:46&quot;; break; case &quot;05(3)/09/2013&quot; : $date3_in = &quot;05/09/2013&quot;; $TimeBegin = &quot;06:05:33&quot;; $TimeEnd = &quot;09:25:02&quot;; break; case &quot;05(4)/09/2013&quot; : $date3_in = &quot;05/09/2013&quot;; $TimeBegin = &quot;15:03:56&quot;; $TimeEnd = &quot;18:42:27&quot;; break; case &quot;05(5)/09/2013&quot; : $date3_in = &quot;05/08/2013&quot;; $TimeBegin = &quot;10:03:10&quot;; $TimeEnd = &quot;14:06:10&quot;; break; case &quot;05(6)/09/2013&quot; : $date3_in = &quot;05/08/2013&quot;; $TimeBegin = &quot;19:22:28&quot;; $TimeEnd = &quot;22:39:47&quot;; break; case &quot;05(7)/09/2013&quot; : $date3_in = &quot;05/08/2013&quot;; $TimeBegin = &quot;06:03:03&quot;; $TimeEnd = &quot;09:25:17&quot;; break; case &quot;05(8)/09/2013&quot; : $date3_in = &quot;05/08/2013&quot;; $TimeBegin = &quot;15:03:53&quot;; $TimeEnd = &quot;18:42:32&quot;; break; case &quot;08(1)/09/2013&quot; : $date3_in = &quot;08/09/2013&quot;; $TimeBegin = &quot;09:20:29&quot;; $TimeEnd = &quot;14:06:10&quot;; break; case &quot;08(2)/09/2013&quot; : $date3_in = &quot;08/09/2013&quot;; $TimeBegin = &quot;05:14:38&quot;; $TimeEnd = &quot;08:52:45&quot;; break; case &quot;08(3)/09/2013&quot; : $date3_in = &quot;08/08/2013&quot;; $TimeBegin = &quot;09:20:29&quot;; $TimeEnd = &quot;12:56:33&quot;; break; case &quot;08(4)/09/2013&quot; : $date3_in = &quot;08/08/2013&quot;; $TimeBegin = &quot;05:14:33&quot;; $TimeEnd = &quot;08:52:45&quot;; break; case &quot;09(1)/09/2013&quot; : $date3_in = &quot;09/09/2013&quot;; $TimeBegin = &quot;08:55:53&quot;; $TimeEnd = &quot;12:35:17&quot;; break; case &quot;09(2)/09/2013&quot; : $date3_in = &quot;09/09/2013&quot;; $TimeBegin = &quot;17:30:43&quot;; $TimeEnd = &quot;21:18:09&quot;; break; case &quot;09(3)/09/2013&quot; : $date3_in = &quot;09/09/2013&quot;; $TimeBegin = &quot;05:07:03&quot;; $TimeEnd = &quot;08:46:56&quot;; break; case &quot;09(4)/09/2013&quot; : $date3_in = &quot;09/09/2013&quot;; $TimeBegin = &quot;13:29:31&quot;; $TimeEnd = &quot;17:03:56&quot;; break; case &quot;09(5)/09/2013&quot; : $date3_in = &quot;09/08/2013&quot;; $TimeBegin = &quot;08:55:53&quot;; $TimeEnd = &quot;12:35:17&quot;; break; case &quot;09(6)/09/2013&quot; : $date3_in = &quot;09/08/2013&quot;; $TimeBegin = &quot;17:30:49&quot;; $TimeEnd = &quot;21:19:47&quot;; break; case &quot;09(7)/09/2013&quot; : $date3_in = &quot;09/08/2013&quot;; $TimeBegin = &quot;05:05:21&quot;; $TimeEnd = &quot;08:46:56&quot;; break; case &quot;09(8)/09/2013&quot; : $date3_in = &quot;09/08/2013&quot;; $TimeBegin = &quot;13:29:27&quot;; $TimeEnd = &quot;17:03:56&quot;; break; } $date99 = $date3_in; } elseif ($selectT==&quot;Test1&quot;) { $device=&quot;3dgps01&quot;; switch($date1) { case &quot;KlongLuang&quot; : $date1=&quot;31/05/2012&quot;; $TimeBegin = &quot;01:27:00&quot;; $TimeEnd = &quot;01:27:01&quot;; break; case &quot;31/05/2012&quot; : $TimeBegin = &quot;01:27:00&quot;; $TimeEnd = &quot;01:55:00&quot;; break; case &quot;01/06/2012&quot; : $TimeBegin = &quot;01:19:00&quot;; $TimeEnd = &quot;01:44:30&quot;; break; case &quot;07/06/2012&quot; : $TimeBegin = &quot;01:29:30&quot;; $TimeEnd = &quot;02:12:43&quot;; break; case &quot;11/06/2012&quot; : $TimeBegin = &quot;01:33:20&quot;; $TimeEnd = &quot;02:05:45&quot;; break; case &quot;12/06/2012&quot; : $TimeBegin = &quot;01:14:04&quot;; $TimeEnd = &quot;01:41:45&quot;; break; case &quot;13/06/2012&quot; : $TimeBegin = &quot;01:20:50&quot;; $TimeEnd = &quot;01:42:30&quot;; break; case &quot;14/06/2012&quot; : $TimeBegin = &quot;01:16:54&quot;; $TimeEnd = &quot;01:45:50&quot;; break; case &quot;15/06/2012&quot; : $TimeBegin = &quot;01:33:00&quot;; $TimeEnd = &quot;02:00:00&quot;; break; case &quot;18/06/2012&quot; : $TimeBegin = &quot;01:21:05&quot;; $TimeEnd = &quot;01:48:00&quot;; break; case &quot;19/06/2012&quot; : $TimeBegin = &quot;01:03:50&quot;; $TimeEnd = &quot;01:25:40&quot;; break; case &quot;20/06/2012&quot; : $TimeBegin = &quot;01:13:20&quot;; $TimeEnd = &quot;01:31:25&quot;; break; case &quot;21/06/2012&quot; : $TimeBegin = &quot;01:00:00&quot;; $TimeEnd = &quot;01:23:15&quot;; break; case &quot;22/06/2012&quot; : $TimeBegin = &quot;01:16:45&quot;; $TimeEnd = &quot;01:37:40&quot;; break;$Date1 = &quot;2013-10-01&quot;; case &quot;25/06/2012&quot; : $TimeBegin = &quot;01:54:45&quot;; $TimeEnd = &quot;02:16:40&quot;; break; case &quot;26/06/2012&quot; : $TimeBegin = &quot;01:03:20&quot;; $TimeEnd = &quot;01:29:40&quot;; break; case &quot;27/06/2012&quot; : $TimeBegin = &quot;01:21:00&quot;; $TimeEnd = &quot;01:52:00&quot;; break; case &quot;28/06/2012&quot; : $TimeBegin = &quot;01:24:00&quot;; $TimeEnd = &quot;01:49:45&quot;; break; case &quot;29/06/2012&quot; : $TimeBegin = &quot;01:29:00&quot;; $TimeEnd = &quot;01:59:00&quot;; break; case &quot;02/07/2012&quot; : $TimeBegin = &quot;01:37:00&quot;; $TimeEnd = &quot;02:03:00&quot;; break; case &quot;03/07/2012&quot; : $TimeBegin = &quot;01:34:40&quot;; $TimeEnd = &quot;02:14:00&quot;; break; case &quot;06/07/2012&quot; : $TimeBegin = &quot;01:16:40&quot;; $TimeEnd = &quot;01:40:50&quot;; break; case &quot;09/07/2012&quot; : $TimeBegin = &quot;01:26:45&quot;; $TimeEnd = &quot;01:53:20&quot;; break; case &quot;10/07/2012&quot; : $TimeBegin = &quot;01:22:30&quot;; $TimeEnd = &quot;01:46:15&quot;; break; case &quot;11/07/2012&quot; : $TimeBegin = &quot;01:29:00&quot;; $TimeEnd = &quot;01:58:00&quot;; break; case &quot;12/07/2012&quot; : $TimeBegin = &quot;01:38:40&quot;; $TimeEnd = &quot;02:09:30&quot;; break; case &quot;13/07/2012&quot; : $TimeBegin = &quot;01:53:20&quot;; $TimeEnd = &quot;02:15:20&quot;; break; case &quot;16/07/2012&quot; : $TimeBegin = &quot;01:39:00&quot;; $TimeEnd = &quot;02:02:20&quot;; break; case &quot;17/07/2012&quot; : $TimeBegin = &quot;01:20:15&quot;; $TimeEnd = &quot;01:47:05&quot;; break; case &quot;18/07/2012&quot; : $TimeBegin = &quot;01:18:30&quot;; $TimeEnd = &quot;01:42:45&quot;; break; case &quot;19/07/2012&quot; : $TimeBegin = &quot;01:24:00&quot;; $TimeEnd = &quot;01:45:00&quot;; break; case &quot;27/07/2012&quot; : $TimeBegin = &quot;01:21:30&quot;; $TimeEnd = &quot;01:43:00&quot;; break; case &quot;30/07/2012&quot; : $TimeBegin = &quot;01:15:45&quot;; $TimeEnd = &quot;01:53:00&quot;; break; case &quot;31/07/2012&quot; : $TimeBegin = &quot;01:19:00&quot;; $TimeEnd = &quot;01:45:00&quot;; break; } $date99 = $date1; } elseif ($selectT==&quot;Test2&quot;) { $device=&quot;dg200&quot;; switch($date2) { case &quot;Nakornrachasima0&quot; : $date1 = &quot;15/10/2012&quot;; $TimeBegin = &quot;17:39:09&quot;; $TimeEnd = &quot;17:39:10&quot;; break; case &quot;15(1)/10/2012&quot; : $date1 = &quot;15/10/2012&quot;; $TimeBegin = &quot;14:15:00&quot;; $TimeEnd = &quot;17:45:00&quot;; break; case &quot;16(1)/10/2012&quot; : $date1 = &quot;16/10/2012&quot;; $TimeBegin = &quot;21:10:04&quot;; $TimeEnd = &quot;23:59:59&quot;; break; case &quot;17(1)/10/2012&quot; : $date1 = &quot;17/10/2012&quot;; $TimeBegin = &quot;02:05:02&quot;; $TimeEnd = &quot;05:21:58&quot;; break; case &quot;17(2)/10/2012&quot; : $date1 = &quot;17/10/2012&quot;; $TimeBegin = &quot;07:21:12&quot;; $TimeEnd = &quot;10:42:00&quot;; break; case &quot;17(3)/10/2012&quot; : $date1 = &quot;17/10/2012&quot;; $TimeBegin = &quot;11:13:00&quot;; $TimeEnd = &quot;14:48:04&quot;; break; case &quot;18(1)/10/2012&quot; : $date1 = &quot;18/10/2012&quot;; $TimeBegin = &quot;08:41:28&quot;; $TimeEnd = &quot;12:04:01&quot;; break; case &quot;18(2)/10/2012&quot; : $date1 = &quot;18/10/2012&quot;; $TimeBegin = &quot;12:55:41&quot;; $TimeEnd = &quot;16:38:40&quot;; break; case &quot;19(1)/10/2012&quot; : $date1 = &quot;19/10/2012&quot;; $TimeBegin = &quot;06:19:22&quot;; $TimeEnd = &quot;09:50:00&quot;; break; case &quot;19(2)/10/2012&quot; : $date1 = &quot;19/10/2012&quot;; $TimeBegin = &quot;10:46:34&quot;; $TimeEnd = &quot;14:12:26&quot;; break; case &quot;19(3)/10/2012&quot; : $date1 = &quot;19/10/2012&quot;; $TimeBegin = &quot;23:11:34&quot;; $TimeEnd = &quot;23:59:59&quot;; break; case &quot;20(1)/10/2012&quot; : $date1 = &quot;20/10/2012&quot;; $TimeBegin = &quot;03:07:20&quot;; $TimeEnd = &quot;06:55:29&quot;; break; case &quot;20(2)/10/2012&quot; : $date1 = &quot;20/10/2012&quot;; $TimeBegin = &quot;12:43:00&quot;; $TimeEnd = &quot;16:31:33&quot;; break; case &quot;23(1)/10/2012&quot; : $date1 = &quot;23/10/2012&quot;; $TimeBegin = &quot;07:16:51&quot;; $TimeEnd = &quot;10:36:49&quot;; break; case &quot;23(2)/10/2012&quot; : $date1 = &quot;23/10/2012&quot;; $TimeBegin = &quot;10:58:49&quot;; $TimeEnd = &quot;14:25:18&quot;; break; case &quot;24(1)/10/2012&quot; : $date1 = &quot;24/10/2012&quot;; $TimeBegin = &quot;07:09:52&quot;; $TimeEnd = &quot;10:48:10&quot;; break; case &quot;24(2)/10/2012&quot; : $date1 = &quot;24/10/2012&quot;; $TimeBegin = &quot;11:29:24&quot;; $TimeEnd = &quot;15:10:21&quot;; break; case &quot;25(1)/10/2012&quot; : $date1 = &quot;25/10/2012&quot;; $TimeBegin = &quot;09:56:59&quot;; $TimeEnd = &quot;13:25:25&quot;; break; case &quot;25(2)/10/2012&quot; : $date1 = &quot;25/10/2012&quot;; $TimeBegin = &quot;14:17:16&quot;; $TimeEnd = &quot;17:57:00&quot;; break; case &quot;26(1)/10/2012&quot; : $date1 = &quot;26/10/2012&quot;; $TimeBegin = &quot;11:34:04&quot;; $TimeEnd = &quot;15:17:11&quot;; break; case &quot;26(2)/10/2012&quot; : $date1 = &quot;26/10/2012&quot;; $TimeBegin = &quot;15:35:57&quot;; $TimeEnd = &quot;19:45:39&quot;; break; case &quot;27(1)/10/2012&quot; : $date1 = &quot;27/10/2012&quot;; $TimeBegin = &quot;11:27:28&quot;; $TimeEnd = &quot;14:54:33&quot;; break; case &quot;27(2)/10/2012&quot; : $date1 = &quot;27/10/2012&quot;; $TimeBegin = &quot;15:16:59&quot;; $TimeEnd = &quot;19:15:22&quot;; break; case &quot;28(1)/10/2012&quot; : $date1 = &quot;28/10/2012&quot;; $TimeBegin = &quot;10:33:35&quot;; $TimeEnd = &quot;14:08:30&quot;; break; case &quot;28(2)/10/2012&quot; : $date1 = &quot;28/10/2012&quot;; $TimeBegin = &quot;15:14:45&quot;; $TimeEnd = &quot;18:47:17&quot;; break; case &quot;29(1)/10/2012&quot; : $date1 = &quot;29/10/2012&quot;; $TimeBegin = &quot;07:51:59&quot;; $TimeEnd = &quot;11:53:19&quot;; break; case &quot;29(2)/10/2012&quot; : $date1 = &quot;29/10/2012&quot;; $TimeBegin = &quot;12:25:16&quot;; $TimeEnd = &quot;16:14:40&quot;; break; case &quot;30(1)/10/2012&quot; : $date1 = &quot;30/10/2012&quot;; $TimeBegin = &quot;10:08:16&quot;; $TimeEnd = &quot;13:28:21&quot;; break; case &quot;30(2)/10/2012&quot; : $date1 = &quot;30/10/2012&quot;; $TimeBegin = &quot;13:46:18&quot;; $TimeEnd = &quot;17:19:31&quot;; break; case &quot;01(1)/11/2012&quot; : $date1 = &quot;01/11/2012&quot;; $TimeBegin = &quot;14:09:26&quot;; $TimeEnd = &quot;18:14:12&quot;; break; case &quot;01(2)/11/2012&quot; : $date1 = &quot;01/11/2012&quot;; $TimeBegin = &quot;18:30:21&quot;; $TimeEnd = &quot;22:14:10&quot;; break; } $date99 = $date1; } else {$date99=&quot;01/01/2013&quot;; $TimeBegin = &quot;00:00:00&quot;; $TimeEnd = &quot;00:00:01&quot;; } echo &quot;$date99&quot;;" xmlns="http://disruptive-innovations.com/zoo/nvu">-->
    <!--</php></php>--></small><small><span style="font-weight: bold;"><span style="font-style: italic;"> &nbsp;</span></span></small><small><span style="font-weight: bold;">
        <!--<php title="$InDate = explode(&quot;/&quot;,$date99); $day1Array = array(&quot;$InDate[2]&quot;,&quot;$InDate[1]&quot;,&quot;$InDate[0]&quot;); $DateBegin = implode(&quot;-&quot;,$day1Array); $DateEnd = $DateBegin; $year3 = (int)$InDate[2] + 543; $objConnect = mysqli_connect(&quot;localhost&quot;,&quot;tatanad&quot;,&quot;tata789&quot;) or die(&quot;Error Connect to Database&quot;); $objDB = mysqli_select_db(&quot;selectable&quot;); $sql =&quot;use selectable&quot;; $strSQL = &quot;INSERT INTO `2555` (`number`,`user`,`timestp`,`device`,`date1`,`time1`,`date2`,`time2`) VALUES ('01','user1',NOW( ),'$device','$DateBegin','$TimeBegin','$DateEnd','$TimeEnd' );&quot;; $objQuery = mysqli_query($strSQL); $db = mysqli_connect(&quot;localhost&quot;,&quot;tatanad&quot;,&quot;tata789&quot;); $myDB = &quot;$device&quot;; mysqli_select_db($myDB, $db); $exe1 = &quot;SELECT Time,Latitude,Longitude,Speed,DirAlt FROM `$year3` WHERE `Date` = '$DateBegin' AND `Time` &gt;= '$TimeBegin' AND `Time` &lt;= '$TimeEnd' ORDER BY `Time` ASC&quot;; $result1 = mysqli_query($exe1)or die(mysqli_error()); $num_rows = mysqli_numrows($result1); $speed_max=0; $num_rows = $num_rows-1; for ($i=1; $i&lt;=$num_rows; $i++) { list($time,$lat,$long,$speed,$direction) = mysqli_fetch_row($result1); $speed_i[$i] = $speed; $time_i[$i] = $time; if ($speed_i[$i]&gt;=$speed_max) { $speed_max = $speed_i[$i]; } $time_i[$i] = $time; $lat_i[$i] = $lat; $lon_i[$i] = $long; $speed_i[$i] = $speed; $dir_i[$i] = $direction; if ($i==5) {$lat_begin = $lat;} else {$lat_end = $lat;} } /*========== Create (speed.txt) Temp File for Map/Chart =============*/ $file_turn = &quot;speed.txt&quot;; $fp = fopen(&quot;./Data/speed.txt&quot;, &quot;w&quot;); for ($i=1; $i&lt;=$num_rows; $i++) { $date0 = $DateBegin; $time0 = $time_i[$i]; $lat0 = $lat_i[$i]; $lon0 = $lon_i[$i]; $spd0 = $speed_i[$i]; $alt0 = $dir_i[$i]; $dat_db_array= array(&quot;$device&quot; ,$date0 ,$time0 ,$lat0 ,$lon0 ,$spd0 ,$alt0); $dat_db = implode(&quot;,&quot;,$dat_db_array); fputs ($fp, &quot;$dat_db\r\n&quot;); } fclose ($fp);" xmlns="http://disruptive-innovations.com/zoo/nvu">-->
    <?php
require(dirname(__FILE__)."/../../config.php");
$deviceid = $_GET["deviceid"];
$Date1 = $_GET["date1"];
$time1 = $_GET["time1"];
$time2 = $_GET["time2"];

$Time1 = $time1;
$Time2 = $time2;

if($_GET["over_index"] != "") $over_index = $_GET["over_index"];

include("f2_getdata_gbox.php");

$time_sec1 = explode(":", $Time1);
$sec1 = ((($time_sec1[0])*3600) + (($time_sec1[1])*60) + ($time_sec1[2]));
$time_sec2 = explode(":", $Time2);
$sec2 = ((($time_sec2[0])*3600) + (($time_sec2[1])*60) + ($time_sec2[2]));
$deltaT = $sec2-$sec1;


$TimeBegin = $time_i[0];
$TimeEnd = $time_i[$num_rows-1]; 
$speed_maxy=$speed_max;
$latB1 = DMStoDECLn($lat_begin);
$latB2 = DMStoDECLn($lat_end);
$lonB1 = DMStoDECLn($lon_begin);
$lonB2 = DMStoDECLn($lon_end);

if (($latB1>=14.0070) AND ($latB1<=14.0230)) { $tripdir = "A - B "; } elseif (($latB1>=14.0725) AND ($latB1<=14.0768)) { $tripdir = "B - A "; }
elseif (($latB1>=14.7496) AND ($latB1<=14.9898) AND ($latB2>=13.8120) AND ($latB2<=13.8841)) { $tripdir = "NRM - BKK "; } elseif (($latB1>=13.8100) AND ($latB1<=13.8841) AND ($latB2>=14.7496) AND ($latB2<=14.9900)) { $tripdir = "BKK - NRM"; }
elseif (($latB1>=16.4599) AND ($latB1<=17.2220) AND ($latB2>=19.8111) AND ($latB2<=19.8690) ) { $tripdir = "PNL - CHR"; }
elseif (($latB1>=19.8111) AND ($latB1<=19.8690) AND ($latB2>=16.4599) AND ($latB2<=16.9620) ) { $tripdir = "CHR - PNL"; }
elseif (($latB1>=13.8041) AND ($latB1<=13.8841) AND ($latB2>=16.4599) AND ($latB2<=16.8220) AND ($lonB2>=98.6824) ) { $tripdir = "BKK - PNL"; } elseif (($latB1>=16.4599) AND ($latB1<=16.9620) AND ($lonB1>=98.7890) AND ($latB2>=13.8100) AND ($latB2<=13.8841) ) { $tripdir = "PNL - BKK"; }
elseif (($latB1>=13.8041) AND ($latB1<=13.8841) AND ($latB2>=16.4599) AND ($latB2<=17.2958) AND ($lonB2<=99.8660) AND ($lonB2>=99.7166) ) { $tripdir = "BKK - SKT"; }
elseif (($latB2>=13.8041) AND ($latB2<=13.8841) AND ($latB1>=16.4599) AND ($latB1<=17.2958) AND ($lonB1<=99.8860) AND ($lonB1>=99.7166) ) { $tripdir = "SKT - BKK"; }
elseif (($latB1<=13.8200) AND ($latB2>=18.4112) AND ($latB2<19.7364) AND ($lonB2<=100.0699) ) { $tripdir = "BKK - CHM "; } elseif (($latB2<=13.8141) AND ($latB1>=18.7500) AND ($latB1<=18.9500) ) { $tripdir = "CHM - BKK "; }
elseif (($latB1>=19.6064) AND ($latB2<=13.9051)) { $tripdir = "CHR - BKK "; }
elseif (($latB1<=13.9051) AND ($latB2>=19.7364)) { $tripdir = "BKK - CHR "; } elseif (($latB1<=13.8151) AND ($latB2>=16.6353 ) AND ($lonB2<=98.682422)) { $tripdir = "BKK - MSD "; }
elseif (($latB2<=13.8151) AND ($latB1>=16.6353 ) AND ($lonB1<=99.2000)) { $tripdir = "MSD - BKK "; }
elseif (($latB2>=13.7178 ) AND ($latB1>=9.1379 ) AND ($latB1<=10.0110)) { $tripdir = "SRT - BKK "; }
elseif (($latB1>=13.7178 ) AND ($latB2>=9.1379 ) AND ($latB2<=9.4194)) { $tripdir = "BKK - SRT "; }
elseif (($latB1>=13.7178 ) AND ($latB2>=10.455651 ) AND ($latB2<=10.564052)) { $tripdir = "BKK - CMP "; }
else {$tripdir = "UnKnow";}

?>&nbsp;
            <!--</php>--></span></small><small><span style="font-weight: bold;"><span style="font-style: italic;">Driving Score</span>
&nbsp;Function&nbsp;</span></small><small style="font-family: Arial;">
        <!--<php title="$time_s = explode(&quot;:&quot;, $time_i[1]); $sec1 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2])); $time_s = explode(&quot;:&quot;, $time_i[$num_rows]); $sec2 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2])); $deltaT = $sec2 - $sec1; $hour_trip = floor($deltaT/3600); $min_trip = ((floor($deltaT/60)) - ($hour_trip*60)); if ($deltaT&lt;60) {$sec_trip = $deltaT;} elseif ((60&lt;=$deltaT) AND ($deltaT&lt;3600)) {$sec_trip = ($deltaT- ($min_trip*60));} elseif ($deltaT&gt;=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));} echo &quot;$hour_trip hr $min_trip min $sec_trip sec&quot;; $dis_sum = 0; for ($i=1; $i&lt;($num_rows); $i++) { $time_s = explode(&quot;:&quot;, $time_i[$i-1]); $sec1 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2])); $time_s = explode(&quot;:&quot;, $time_i[$i]); $sec2 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2])); $sec_del = $sec2 - $sec1; if ($sec_del&lt;=3) { $velocity = (($speed_i[$i]+$speed_i[$i-1])/2) * (1000/3600); } $distance = $velocity * $sec_del; $dis_sum = $distance + $dis_sum; } if ($deltaT!=0) {$speed_avg2 = ($dis_sum/$deltaT) * (3600/1000);} " xmlns="http://disruptive-innovations.com/zoo/nvu">-->
        <!--<php title="$time_s = explode(&quot;:&quot;, $time_i[1]); $sec1 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2])); $time_s = explode(&quot;:&quot;, $time_i[$num_rows]); $sec2 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2])); $deltaT = $sec2 - $sec1; $hour_trip = floor($deltaT/3600); $min_trip = ((floor($deltaT/60)) - ($hour_trip*60)); if ($deltaT&lt;60) {$sec_trip = $deltaT;} elseif ((60&lt;=$deltaT) AND ($deltaT&lt;3600)) {$sec_trip = ($deltaT- ($min_trip*60));} elseif ($deltaT&gt;=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));} echo &quot;$hour_trip hr $min_trip min $sec_trip sec&quot;; $dis_sum = 0; for ($i=1; $i&lt;($num_rows); $i++) { $time_s = explode(&quot;:&quot;, $time_i[$i-1]); $sec1 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2])); $time_s = explode(&quot;:&quot;, $time_i[$i]); $sec2 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2])); $sec_del = $sec2 - $sec1; if ($sec_del&lt;=3) { $velocity = (($speed_i[$i]+$speed_i[$i-1])/2) * (1000/3600); } $distance = $velocity * $sec_del; $dis_sum = $distance + $dis_sum; } if ($deltaT!=0) {$speed_avg2 = ($dis_sum/$deltaT) * (3600/1000);} " xmlns="http://disruptive-innovations.com/zoo/nvu">-->
        <!--<php title="$time_s = explode(&quot;:&quot;, $time_i[1]); $sec1 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2])); $time_s = explode(&quot;:&quot;, $time_i[$num_rows]); $sec2 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2])); $deltaT = $sec2 - $sec1; $hour_trip = floor($deltaT/3600); $min_trip = ((floor($deltaT/60)) - ($hour_trip*60)); if ($deltaT&lt;60) {$sec_trip = $deltaT;} elseif ((60&lt;=$deltaT) AND ($deltaT&lt;3600)) {$sec_trip = ($deltaT- ($min_trip*60));} elseif ($deltaT&gt;=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));} $dis_sum = 0; for ($i=1; $i&lt;($num_rows); $i++) { $time_s = explode(&quot;:&quot;, $time_i[$i-1]); $sec1 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2])); $time_s = explode(&quot;:&quot;, $time_i[$i]); $sec2 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2])); $sec_del = $sec2 - $sec1; if ($sec_del&lt;=3) { $velocity = (($speed_i[$i]+$speed_i[$i-1])/2) * (1000/3600); } $distance = $velocity * $sec_del; $dis_sum = $distance + $dis_sum; } if ($deltaT!=0) {$speed_avg2 = ($dis_sum/$deltaT) * (3600/1000);} echo &quot;&lt;font face='Arial' size='2'&gt; &lt;b&gt;$device : &lt;/b&gt;$num_rows num rows&quot;" xmlns="http://disruptive-innovations.com/zoo/nvu">-->
        <!--<php title="$time_s = explode(&quot;:&quot;, $time_i[1]); $sec1 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2])); $time_s = explode(&quot;:&quot;, $time_i[$num_rows]); $sec2 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2])); $deltaT = $sec2 - $sec1; $hour_trip = floor($deltaT/3600); $min_trip = ((floor($deltaT/60)) - ($hour_trip*60)); if ($deltaT&lt;60) {$sec_trip = $deltaT;} elseif ((60&lt;=$deltaT) AND ($deltaT&lt;3600)) {$sec_trip = ($deltaT- ($min_trip*60));} elseif ($deltaT&gt;=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));} $dis_sum = 0; for ($i=1; $i&lt;($num_rows); $i++) { $time_s = explode(&quot;:&quot;, $time_i[$i-1]); $sec1 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2])); $time_s = explode(&quot;:&quot;, $time_i[$i]); $sec2 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2])); $sec_del = $sec2 - $sec1; if ($sec_del&lt;=3) { $velocity = (($speed_i[$i]+$speed_i[$i-1])/2) * (1000/3600); } $distance = $velocity * $sec_del; $dis_sum = $distance + $dis_sum; } if ($deltaT!=0) {$speed_avg2 = ($dis_sum/$deltaT) * (3600/1000);} if ($num_rows&lt;0) {$n=0;} else {$n=$num_rows;} echo &quot;&lt;font face='Arial' size='2'&gt; &lt;b&gt;$device : &lt;/b&gt;$n num rows&quot;" xmlns="http://disruptive-innovations.com/zoo/nvu">-->
        <?php $time_s = explode(":", $time_i[1]);
$sec1 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
$time_s = explode(":", $time_i[$num_rows]);
$sec2 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
$deltaT = $sec2 - $sec1;
$hour_trip = floor($deltaT/3600);
$min_trip = ((floor($deltaT/60)) - ($hour_trip*60));
if ($deltaT<60) {$sec_trip = $deltaT;}
elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip = ($deltaT- ($min_trip*60));}
elseif ($deltaT>=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));}
$dis_sum = 0;
for ($i=1; $i<($num_rows); $i++) {
$time_s = explode(":", $time_i[$i-1]);
$sec1 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
$time_s = explode(":", $time_i[$i]);
$sec2 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
$sec_del = $sec2 - $sec1;
if ($sec_del<=3) { $velocity = (($speed_i[$i]+$speed_i[$i-1])/2) * (1000/3600); }
$distance = $velocity * $sec_del;
$dis_sum = $distance + $dis_sum; }
if ($deltaT!=0) {$speed_avg2 = ($dis_sum/$deltaT) * (3600/1000);} if ($num_rows<0) {$n=0;}
else {$n=$num_rows;}
echo "<font face='Arial' size='1'> ($n)"?>
        <!--</php></php></php></php>--></small>
</td>
<td style="text-align: left; width: 162px;" rowspan="1" colspan="3"><small><span style="font-weight: bold;">Name</span>
:&nbsp;</small><small>
        <!--<php style="color: red;" title="if ($selectT==&quot;Test1&quot;) { $driver = &quot;&amp;#3626;&amp;#3617;&amp;#3626;&amp;#3634;&amp;#3618; &amp;#3626;&amp;#3610;&amp;#3634;&amp;#3618;&amp;#3592;&amp;#3636;&amp;#3605;&quot;; $busid=&quot;&amp;#3585;&amp;#3586; 2675&quot;; $date=&quot;$date1&quot;;} elseif ($selectT==&quot;Test2&quot;) { $driver = &quot;&amp;#3626;&amp;#3617;&amp;#3588;&amp;#3636;&amp;#3604; &amp;#3626;&amp;#3636;&amp;#3609;&amp;#3651;&amp;#3592;&quot;; $busid=&quot;80-3344&quot;; $date=&quot;$date2&quot;;} elseif ($selectT==&quot;Test3&quot;) { $driver = &quot;&amp;#3626;&amp;#3617;&amp;#3620;&amp;#3607;&amp;#3633;&amp;#3618; &amp;#3652;&amp;#3611;&amp;#3626;&amp;#3610;&amp;#3634;&amp;#3618;&quot;; $busid=&quot;81-5566&quot;; $date=&quot;$date3&quot;;} elseif ($selectT==&quot;Test4&quot;) { $driver = &quot;&amp;#3648;&amp;#3594;&amp;#3637;&amp;#3618;&amp;#3591;&amp;#3619;&amp;#3634;&amp;#3618; &amp;#3626;&amp;#3610;&amp;#3634;&amp;#3618;&amp;#3592;&amp;#3636;&amp;#3605;&quot;; $busid=&quot;82-2456&quot;; $date=&quot;$date4&quot;;} elseif ($selectT==&quot;Test5&quot;) { $driver = &quot;&amp;#3626;&amp;#3617;&amp;#3609;&amp;#3638;&amp;#3585; &amp;#3588;&amp;#3638;&amp;#3585;&amp;#3588;&amp;#3633;&amp;#3585;&quot;; $busid=&quot;88-7272&quot;; $date=&quot;$date5&quot;;} else {$driver = &quot;........&quot;; $busid = &quot;.....&quot;; $date99 = &quot;.....&quot;;} echo&quot;$driver&quot;;" xmlns="http://disruptive-innovations.com/zoo/nvu">-->
        <?php echo "$deviceid ($num_rows)";?>
        <!--</php>-->
&nbsp;<span style="font-weight: bold;">
ID</span> : </small><small>
        <!--<php title="if ($selectT==&quot;Test1&quot;) { $driver = &quot;&#3626;&#3617;&#3626;&#3640;&#3586; &#3626;&#3609;&#3640;&#3585;&#3648;&#3629;&#3618;&quot;; } elseif ($selectT==&quot;Test2&quot;) { $driver = &quot;&#3626;&#3617;&#3594;&#3634;&#3618; &#3626;&#3610;&#3634;&#3618;&#3592;&#3636;&#3605;&quot;; } elseif ($selectT==&quot;Test3&quot;) { $driver = &quot;&#3626;&#3617;&#3588;&#3636;&#3604; &#3605;&#3636;&#3604;&#3651;&#3592;&quot;; } else {$driver = &quot;........................&quot;;} echo&quot;$driver&quot;;" xmlns="http://disruptive-innovations.com/zoo/nvu"></php>-->
    </small><small>
        <!--<php style="color: red;" title="echo &quot;$busid&quot;;" xmlns="http://disruptive-innovations.com/zoo/nvu">-->
        <?php echo "$busid / $selectT";?>
        <!--</php>-->&nbsp;&nbsp;
<span style="font-weight: bold;">Date</span>
:
&nbsp;<small style="color: black;"><?php $DateBegin = $Date1;
echo "$Date1";
$datev1 = $Date1;
$speed_max_new = $speed_max;
?></small>
&nbsp;<span style="font-weight: bold;">Time&nbsp;</span><small>
            <!--<php title="echo &quot;$TimeBegin - $TimeEnd&quot;;" xmlns="http://disruptive-innovations.com/zoo/nvu">-->
            <!--<php title="echo &quot;$TimeBegin - $TimeEnd&quot;;" xmlns="http://disruptive-innovations.com/zoo/nvu">-->
            <?php $TimeBegin = $time1;
$TimeEnd =  $time2;
echo "$TimeBegin - $TimeEnd";

if (($TimeBegin>="06:00:00") AND ($TimeBegin<="18:00:00")) {
  echo " <img src='sun.png' width='20' height='20'/>"; $daylight="noon";}

else {
  echo " <img src='moon.png' width='20' height='20'/>";
 $daylight="night";}
?>
            <!--</php></php>--></small></small><small>&nbsp;</small>&nbsp;<small><small>
            <!--<php title="if ($selectT==&quot;Test1&quot;) { $dis_a = 18.5153; $time_a = &quot;24 min 35 sec&quot;; $spd_a = 41.79; $score_a = 3.86; $spd_SA = 0.73; $acc_SA = 0.09; $turn_SA = 1.52; $zone_SA = 14.61; $score_SA = 3.86; $spdMax=1.2; $accMax=1; $turnMax=4; $zoneMax=20;$scoreMax = 40.1; echo &quot;&lt;font face='Arial' size='1'&gt; &lt;b&gt; KlongLuang &lt;/b&gt;&quot;; } elseif (($selectT==&quot;Test2&quot;) OR ($selectT==&quot;Test3&quot;) OR ($selectT==&quot;Test4&quot;)) { $dis_a = 245.00; $time_a = &quot;3hr 25 min&quot;; $spd_a = 68.44; $score_a = 23.26; $spd_SA = 11.08; $acc_SA = 3.09; $turn_SA = 3.06; $zone_SA = 65.82; $score_SA = 23.26; $spdMax=18; $accMax=10; $turnMax=12; $zoneMax=50;$scoreMax = 57.9; $rout_1 = &quot;BKK - NRM&quot;; echo &quot;&lt;font face='Arial' size='1'&gt; &lt;b&gt; BKK - NRM &lt;/b&gt;&quot;; } " xmlns="http://disruptive-innovations.com/zoo/nvu">-->
            <!--<php title="if ($selectT==&quot;Test1&quot;) { $dis_a = 18.5153; $time_a = &quot;24 min 35 sec&quot;; $spd_a = 41.79; $score_a = 3.86; $spd_SA = 0.73; $acc_SA = 0.09; $turn_SA = 1.52; $zone_SA = 14.61; $score_SA = 3.86; $spdMax=1.2; $accMax=1; $turnMax=4; $zoneMax=20;$scoreMax = 40.1; echo &quot;&lt;font face='Arial' size='1'&gt; &lt;b&gt; KlongLuang &lt;/b&gt;&quot;; } elseif (($selectT==&quot;Test2&quot;) OR ($selectT==&quot;Test3&quot;) OR ($selectT==&quot;Test4&quot;)) { $dis_a = 245.00; $time_a = &quot;3hr 25 min&quot;; $spd_a = 68.44; $score_a = 23.26; $spd_SA = 11.08; $acc_SA = 3.09; $turn_SA = 3.06; $zone_SA = 65.82; $score_SA = 23.26; $spdMax=18; $accMax=10; $turnMax=12; $zoneMax=50;$scoreMax = 57.9; $rout_1 = &quot;BKK - NRM&quot;; } " xmlns="http://disruptive-innovations.com/zoo/nvu">-->
            <!--<php title="if ($selectT==&quot;Test1&quot;) { $dis_a = 18.5153; $time_a = &quot;24 min 35 sec&quot;; $spd_a = 41.79; $score_a = 3.86; $spd_SA = 0.73; $acc_SA = 0.09; $turn_SA = 1.52; $zone_SA = 14.61; $score_SA = 3.86; $spdMax=1.2; $accMax=1; $turnMax=4; $zoneMax=20;$scoreMax = 40.1; echo &quot;&lt;font face='Arial' size='1'&gt; &lt;b&gt; KlongLuang &lt;/b&gt;&quot;; } elseif (($selectT==&quot;Test2&quot;) OR ($selectT==&quot;Test3&quot;) OR ($selectT==&quot;Test4&quot;)) { $dis_a = 245.00; $time_a = &quot;3hr 25 min&quot;; $spd_a = 68.44; $score_a = 23.26; $spd_SA = 11.08; $acc_SA = 3.09; $turn_SA = 3.06; $zone_SA = 65.82; $score_SA = 23.26; $spdMax=18; $accMax=10; $turnMax=12; $zoneMax=50;$scoreMax = 57.9; $rout_1 = &quot;BKK - NRM&quot;; } " xmlns="http://disruptive-innovations.com/zoo/nvu">-->
&nbsp;&nbsp;
            <!--</php></php></php>--></small></small><small><span style="font-family: Arial;">
            <!--<php title="$InDate = explode(&quot;/&quot;,$date99); $day1Array = array(&quot;$InDate[2]&quot;,&quot;$InDate[1]&quot;,&quot;$InDate[0]&quot;); $DateBegin = implode(&quot;-&quot;,$day1Array); $DateEnd = $DateBegin; $year3 = (int)$InDate[2] + 543; $objConnect = mysqli_connect(&quot;localhost&quot;,&quot;tatanad&quot;,&quot;tata789&quot;) or die(&quot;Error Connect to Database&quot;); $objDB = mysqli_select_db(&quot;selectable&quot;); $sql =&quot;use selectable&quot;; $strSQL = &quot;INSERT INTO `2555` (`number`,`user`,`timestp`,`device`,`date1`,`time1`,`date2`,`time2`) VALUES ('01','user1',NOW( ),'$device','$DateBegin','$TimeBegin','$DateEnd','$TimeEnd' );&quot;; $objQuery = mysqli_query($strSQL); " xmlns="http://disruptive-innovations.com/zoo/nvu"></php>--></span></small></td>
</tr>
<tr>
<td style="background-color: rgb(102, 204, 204); text-align: center; width: 47px;" colspan="1" rowspan="2"><br></td>
<td colspan="1" rowspan="2" style="text-align: center; background-color: rgb(102, 204, 204); width: 98px;"><small><small>
            <!--<php title="if ($selectT==&quot;Test1&quot;) { $dis_a = 18.5153; $time_a = &quot;24 min 35 sec&quot;; $spd_a = 41.79; $score_a = 3.86; $spd_SA = 0.73; $acc_SA = 0.09; $turn_SA = 1.52; $zone_SA = 14.61; $score_SA = 3.86; $spdMax=1.2; $accMax=1; $turnMax=4; $zoneMax=20;$scoreMax = 40.1; echo &quot;&lt;font face='Arial' size='1'&gt; &lt;b&gt; KlongLuang &lt;/b&gt;&quot;; } elseif (($selectT==&quot;Test2&quot;) OR ($selectT==&quot;Test3&quot;) OR ($selectT==&quot;Test4&quot;)) { $dis_a = 245.00; $time_a = &quot;3hr 25 min&quot;; $spd_a = 68.44; $score_a = 23.26; $spd_SA = 11.08; $acc_SA = 3.09; $turn_SA = 3.06; $zone_SA = 65.82; $score_SA = 23.26; $spdMax=18; $accMax=10; $turnMax=12; $zoneMax=50;$scoreMax = 57.9; $rout_1 = &quot;BKK - NRM&quot;; echo &quot;&lt;font face='Arial' size='1'&gt; &lt;b&gt; BKK - NRM &lt;/b&gt;&quot;; } " xmlns="http://disruptive-innovations.com/zoo/nvu"></php>-->
        </small></small><small style="font-weight: bold;"><small><span style="font-family: Arial;"><span style="font-style: italic;"></span><big><?php if ($selectT=="Test1") {
$dis_a = 18.5153; $time_a = "24 min 35 sec"; $spd_a = 41.79; $score_a = 3.86;
$spd_SA = 0.73; $acc_SA = 0.09; $turn_SA = 1.52; $zone_SA = 14.61; $score_SA = 3.86;
$spdMax=1.2; $accMax=1; $turnMax=4; $zoneMax=20;$scoreMax = 40.1;
}
elseif (($selectT=="Test2") OR ($selectT=="Test3") OR ($selectT=="Test4")) {
$dis_a = 245.00; $time_a = "3hr 25 min"; $spd_a = 68.44; $score_a = 23.26;
$spd_SA = 11.08; $acc_SA = 3.09; $turn_SA = 3.06; $zone_SA = 65.82; $score_SA = 23.26;
$spdMax=18; $accMax=10; $turnMax=12; $zoneMax=50;$scoreMax = 57.9;
$rout_1 = "BKK - NRM";
}
elseif ($selectT=="Test5") {
$rout_1 = "CHR - BKK";
}
?><span style="color: white;">&nbsp;</span></big></span></small></small><small><small><span style="font-family: Arial;"></span></small></small><small style="font-weight: bold;"><small><span style="font-family: Arial;"><big><span style="color: white;">
</span><br>
&nbsp;<?php $latB1 = DMStoDECLn($lat_begin);
$latB2 = DMStoDECLn($lat_end);
$lonB1 = DMStoDECLn($lon_begin);
$lonB2 = DMStoDECLn($lon_end);
if (($latB1>=14.0070) AND ($latB1<=14.0230)) { $tripdir = "A - B "; } elseif (($latB1>=14.0725) AND ($latB1<=14.0768)) { $tripdir = "B - A "; }
elseif (($latB1>=14.7496) AND ($latB1<=14.9898) AND ($latB2>=13.8120) AND ($latB2<=13.8841)) { $tripdir = "NRM - BKK "; } elseif (($latB1>=13.8100) AND ($latB1<=13.8841) AND ($latB2>=14.7496) AND ($latB2<=14.9900)) { $tripdir = "BKK - NRM"; }
elseif (($latB1>=16.4599) AND ($latB1<=17.2220) AND ($latB2>=19.8111) AND ($latB2<=19.8690) ) { $tripdir = "PNL - CHR"; }
elseif (($latB1>=19.8111) AND ($latB1<=19.8690) AND ($latB2>=16.4599) AND ($latB2<=16.9620) ) { $tripdir = "CHR - PNL"; }
elseif (($latB1>=13.8041) AND ($latB1<=13.8841) AND ($latB2>=16.4599) AND ($latB2<=16.8220) AND ($lonB2>=98.6824) ) { $tripdir = "BKK - PNL"; } elseif (($latB1>=16.4599) AND ($latB1<=16.9620) AND ($lonB1>=98.7890) AND ($latB2>=13.8100) AND ($latB2<=13.8841) ) { $tripdir = "PNL - BKK"; }
elseif (($latB1>=13.8041) AND ($latB1<=13.8841) AND ($latB2>=16.4599) AND ($latB2<=17.2958) AND ($lonB2<=99.8660) AND ($lonB2>=99.7166) ) { $tripdir = "BKK - SKT"; }
elseif (($latB2>=13.8041) AND ($latB2<=13.8841) AND ($latB1>=16.4599) AND ($latB1<=17.2958) AND ($lonB1<=99.8860) AND ($lonB1>=99.7166) ) { $tripdir = "SKT - BKK"; }
elseif (($latB1<=13.8200) AND ($latB2>=18.4112) AND ($latB2<19.7364) AND ($lonB2<=100.0699) ) { $tripdir = "BKK - CHM "; } elseif (($latB2<=13.8141) AND ($latB1>=18.7500) AND ($latB1<=18.9500) ) { $tripdir = "CHM - BKK "; }
elseif (($latB1>=19.6064) AND ($latB2<=13.9051)) { $tripdir = "CHR - BKK "; }
elseif (($latB1<=13.9051) AND ($latB2>=19.7364)) { $tripdir = "BKK - CHR "; } elseif (($latB1<=13.8151) AND ($latB2>=16.6353 ) AND ($lonB2<=98.682422)) { $tripdir = "BKK - MSD "; }
elseif (($latB2<=13.8151) AND ($latB1>=16.6353 ) AND ($lonB1<=99.2000)) { $tripdir = "MSD - BKK "; }
elseif (($latB2>=13.7178 ) AND ($latB1>=9.1379 ) AND ($latB1<=10.0110)) { $tripdir = "SRT - BKK "; }
elseif (($latB1>=13.7178 ) AND ($latB2>=9.1379 ) AND ($latB2<=9.4194)) { $tripdir = "BKK - SRT "; }
elseif (($latB1>=13.7178 ) AND ($latB2>=10.455651 ) AND ($latB2<=10.564052)) { $tripdir = "BKK - CMP "; }
else {$tripdir = "UnKnow";}
$tripdir1=$tripdir;
echo "<font face='Arial' size='2'> $tripdir <br> ";?></big></span></small></small><small style="font-weight: bold;"><small><span style="font-family: Arial;">
    <!--<php title="echo &quot;$rout_1&quot;;" xmlns="http://disruptive-innovations.com/zoo/nvu"></php>--></span></small></small></td>
<td colspan="1" rowspan="1" style="background-color: rgb(102, 204, 204); text-align: left; width: 151px;"><small><small><span style="font-family: Arial;">&nbsp;<span style="font-weight: bold;">&nbsp;</span><span style="color: white; font-weight: bold;">&#3588;&#3632;&#3649;&#3609;&#3609;&#3648;&#3593;&#3621;&#3637;&#3656;&#3618;</span></span></small></small><span style="color: white;">
</span><small style="color: white;"><small><span style="font-family: Arial;">
                <!--<php title="echo &quot;&lt;font face='Arial' size='1'&gt; $score_a &quot;; if ($score_a&lt;=10) { $GYR = &quot;light0.png&quot;;} elseif ((10&lt;$score_a) AND ($score_a&lt;=20)) { $GYR = &quot;light1.png&quot;;} elseif ((20&lt;$score_a) AND ($score_a&lt;=30)) { $GYR = &quot;light2.png&quot;;} elseif ($score_a&gt;30) { $GYR = &quot;light3.png&quot;;} echo &quot;&lt;img src='$GYR' width='12' height='12'/&gt;&quot;;">-->
                <?php /*include ("f2_avg_function.php");*/
echo "<font face='Arial' size='2' color='white'> $score_SA ($num_score)";
?>
    <!--</php>--></span></small></small><small><small><span style="font-family: Arial;"></span></small></small></td>
<td style="text-align: center; background-color: rgb(102, 204, 204); color: white; font-weight: bold; width: 162px;"><small><small><span style="font-family: Arial;">&#3619;&#3632;&#3618;&#3632;&#3607;&#3634;&#3591;</span><span style="font-family: Arial;"></span></small></small>
<?php echo "<font face='Arial' size='1'> $dis_a km";
?></td>
<td style="text-align: center; background-color: rgb(102, 204, 204); color: white; font-weight: bold; width: 164px;"><small style="font-family: Arial;"><small>&#3588;&#3623;&#3634;&#3617;&#3648;&#3619;&#3655;&#3623;</small></small>
<?php $speed_avg = $speed_avg*$spd_unit; 
$speed_avg = round($speed_avg,2); 
echo "$speed_avg";
?></td>
<td colspan="1" rowspan="1" style="text-align: center; background-color: rgb(102, 204, 204); width: 164px; color: white; font-weight: bold;">&nbsp;<small><small>&#3619;&#3632;&#3618;&#3632;&#3648;&#3623;&#3621;&#3634; &nbsp;<?php $deltaT = $time_a;
$hour_trip = floor($deltaT/3600);
$min_trip = ((floor($deltaT/60)) - ($hour_trip*60));
if ($deltaT<60) {$sec_trip = $deltaT;}
elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip = ($deltaT- ($min_trip*60));}
elseif ($deltaT>=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));}
$sec_trip = round($sec_trip,0);
echo "<font face='Arial' size='1'> $hour_trip hr $min_trip min $sec_trip sec";?>
            <!--<php title="echo &quot;&lt;font face='Arial' size='1'&gt; $time_a&quot;; $time_s = explode(&quot;:&quot;, $time_i[1]); $sec1 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2])); $time_s = explode(&quot;:&quot;, $time_i[$num_rows]); $sec2 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2])); $deltaT = $sec2 - $sec1; $hour_trip = floor($deltaT/3600); $min_trip = ((floor($deltaT/60)) - ($hour_trip*60)); if ($deltaT&lt;60) {$sec_trip = $deltaT;} elseif ((60&lt;=$deltaT) AND ($deltaT&lt;3600)) {$sec_trip = ($deltaT- ($min_trip*60));} elseif ($deltaT&gt;=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));} echo &quot;&lt;font face='Arial' size='1'&gt; ($hour_trip hr $min_trip min $sec_trip sec)&quot;;" xmlns="http://disruptive-innovations.com/zoo/nvu"></php>--></small></small><small><small><span style="font-family: Arial;"></span></small></small></td>
</tr>
<tr>
<td style="background-color: rgb(204, 255, 255); text-align: right; width: 151px;"><small><small style="font-weight: bold; color: black;">&#3619;&#3632;&#3618;&#3632;&#3607;&#3637;&#3656;&#3607;&#3635;&#3652;&#3604;&#3657; <img style="width: 15px; height: 15px;" alt="" src="ar.png">
&nbsp; </small></small></td>
<td style="text-align: center; background-color: rgb(204, 255, 255); width: 162px;"><small><small><span style="font-family: Arial;">&#3619;&#3632;&#3618;&#3632;&#3607;&#3634;&#3591;</span><span style="font-family: Arial;"> &nbsp;</span></small></small><?php $dis_sum_km = round(($dis_sum/1000),4);
echo "$dis_sum_km";?></td>
<td style="text-align: center; background-color: rgb(204, 255, 255); width: 164px;"><small><small><span style="font-family: Arial;">&#3588;&#3623;&#3634;&#3617;&#3648;&#3619;&#3655;&#3623;</span><span style="font-family: Arial;"> &nbsp;</span></small></small><?php $speed_avg = $speed_avg*$spd_unit; 
$speed_avg = round($speed_avg,2); 
echo "$speed_avg";?></td>
<td colspan="1" rowspan="1" style="text-align: center; background-color: rgb(204, 255, 255); width: 164px;"><small><small><span style="font-family: Arial;">&#3619;&#3632;&#3618;&#3632;&#3648;&#3623;&#3621;&#3634;</span><span style="font-family: Arial;"> &nbsp;</span></small></small><?php $time_s = explode(":", $TimeBegin);
$sec1 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));

$time_s = explode(":", $TimeEnd);
$sec2 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
$deltaT = $sec2 - $sec1;
$sum_time = $deltaT;

$hour_trip = floor($deltaT/3600);
$min_trip = ((floor($deltaT/60)) - ($hour_trip*60));
if ($deltaT<60) {$sec_trip = $deltaT;}
elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip = ($deltaT- ($min_trip*60));}
elseif ($deltaT>=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));}

echo "$hour_trip hr $min_trip min $sec_trip sec";

$dis_sum = 0;
for ($i=0; $i<($num_rows-1); $i++) {
$time_s = explode(":", $time_i[$i-1]);
$sec1 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
$time_s = explode(":", $time_i[$i]);
$sec2 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
$sec_del = $sec2 - $sec1;

if ($sec_del<=3) { $velocity = (($speed_i[$i]+$speed_i[$i-1])/2) * (1000/3600); }
$distance = $velocity * $sec_del;
$dis_sum = $distance + $dis_sum; }

if ($deltaT!=0) {$speed_avg = ($dis_sum/$deltaT) * (3600/1000);} ?></td>
</tr>


</tbody>
</table>
<table style="text-align: left; margin-left: auto; margin-right: auto; width: 800px; height: 542px;" border="0" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td style="background-color: rgb(255, 255, 204); width: 355px; height: 542px;" valign="top">
<table style="text-align: left; width: 350px;" border="0" cellpadding="2" cellspacing="2">
<tbody>
<tr align="center">
<td style="background-color: rgb(153, 153, 153); width: 195px;" colspan="4" rowspan="1"><b style="color: rgb(255, 255, 255); font-family: Arial; font-size: small; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(153, 153, 153);">&#3649;&#3610;&#3610;&#3611;&#3619;&#3632;&#3648;&#3617;&#3636;&#3609;&#3614;&#3620;&#3605;&#3636;&#3585;&#3619;&#3619;&#3617;&#3585;&#3634;&#3619;&#3586;&#3633;&#3610;&#3586;&#3637;&#3656;</b></td>
</tr>
<tr>
<td colspan="2" rowspan="1" style="background-color: rgb(255, 255, 153); text-align: left; width: 195px;"><b style="color: rgb(0, 0, 0); font-family: Arial; font-size: small; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153);">&nbsp;&#3619;&#3634;&#3618;&#3585;&#3634;&#3619;&#3611;&#3619;&#3632;&#3648;&#3617;&#3636;&#3609;</b></td>
<td style="background-color: rgb(255, 255, 153); text-align: center; width: 64px;"><b style="color: rgb(0, 0, 0); font-family: Arial; font-size: small; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153);">star</b></td>
<td style="background-color: rgb(255, 255, 153); text-align: center; width: 36px;"><b style="color: rgb(0, 0, 0); font-family: Arial; font-size: small; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153);">score</b></td>
</tr>
<tr>
<td style="width: 195px;"><span style="color: rgb(0, 0, 0); font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 201); display: inline ! important; float: none;">&nbsp;1.&#3585;&#3634;&#3619;&#3648;&#3619;&#3656;&#3591;&#3649;&#3621;&#3632;&#3594;&#3632;&#3621;&#3629;&#3607;&#3637;&#3656;&#3609;&#3640;&#3656;&#3617;&#3609;&#3623;&#3621;<?php include ("f2_acc_function.php");
$sc1 = $acc_num_1;?></span></td>
<td style="width: 9px;" align="undefined" valign="undefined"></td>
<td style="vertical-align: middle; width: 64px; text-align: right;"><?php if ($sc1<2) { $score1_i = 3; }
elseif (($sc1>=2) AND ($sc1<3)) { $score1_i = 2; }
elseif (($sc1>=3) AND ($sc1<4)) { $score1_i = 1; }
elseif (($sc1>=4) AND ($sc1<5)) { $score1_i = 0; }
elseif ($sc1>=5) { $score1_i = 0; }
for ($j=1; $j<=$score1_i; $j++) { echo " <img src='star.png' width='16' height='16'/>"; }?></td>
<td style="text-align: center; width: 36px;" valign="undefined"><a href="f0_acc_report.php" target="_blank"><?php echo " <font face='Arial' size='2'> <b> $acc_num_1 </b>";
$count1 = $acc_num_1;?></a></td>
</tr>
<tr>
<td style="background-color: rgb(255, 255, 153); width: 195px;"><span style="color: rgb(0, 0, 0); font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153); display: inline ! important; float: none;">&nbsp;2.&#3588;&#3623;&#3634;&#3617;&#3648;&#3619;&#3655;&#3623;&#3605;&#3634;&#3617;&#3585;&#3635;&#3627;&#3609;&#3604;&nbsp;
&nbsp;<?php include ("f2_speed_function.php");

$sc2 = $score2; $sc2_1 = $score2_1; $sc2_2 = $score2_2; $sc2_3 = $score2_3; $sc2_4 = $score2_4;
for ($t=1; $t<=$over; $t++) {
$spdp1 = $spd_pint1[$t];
$spdp2 = $spd_pint2[$t];
$spdotime = $speed_time[$t];

if ($spdType[$i]==1) {$spdotyp = "Lane Changing";}
elseif ($spdType[$i]==2) {$spdotyp = "Curve";}
elseif ($spdType[$i]==0) {$spdotyp = "Straight";}
else {$spdotyp = "Other";}

/*mysqli_connect("53476f055e81994c02000008-nectec.clouddd.in.th:38096","adminlYkzegJ","MaLQvrNyPEpn");*/
 $objConnect = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD) or die("Error Connect to Database");
$objDB = mysqli_select_db(DB_NAME);

$strSQL = "INSERT INTO `speedscore` (`test`,`timestp`,`date`,`overindex`,`spdp1`,`spdp2`,`overtype`,`overtime`)
VALUES ( '$selectT', NOW( ), '$spddate', '$t','$spdp1','$spdp2','$spdotyp','$spdotime');;";
$objQuery = mysqli_query($strSQL);
}
for ($t=1; $t<=$dowsy_cnt; $t++) {
$spdp1 = $dowsy_point1[$t];
$spdp2 = $dowsy_point2[$t];
$spdotyp = $unControl[$t];
$spdotime = $dowsy_time[$t];
$strSQL = "INSERT INTO `speedscore` (`test`,`timestp`,`date`,`overindex`,`spdp1`,`spdp2`,`overtype`,`overtime`)
VALUES ( '$selectT', NOW( ), '$spddate', '$t','$spdp1','$spdp2','$spdotyp','$spdotime');;";
$objQuery = mysqli_query($strSQL);
}?></span></td>
<td style="background-color: rgb(255, 255, 153); width: 9px;"></td>
<td colspan="1" rowspan="5" style="background-color: rgb(255, 255, 153); vertical-align: middle; width: 64px; text-align: right;"><?php if ($sc2<2) { $score2_i = 4; }
elseif (($sc2>=2) AND ($sc2<7)) { $score2_i = 3; }
elseif (($sc2>=7) AND ($sc2<13)) { $score2_i = 2; }
elseif (($sc2>=13) AND ($sc2<18)) { $score2_i = 1; }
elseif ($sc2>=18) { $score2_i = 0; }
for ($j=1; $j<=$score1_i; $j++) { echo " <img src='star.png' width='16' height='16'/>"; }?></td>
<td style="background-color: rgb(255, 255, 153); text-align: center; width: 36px;"><a href="f0_speed_report.php" target="_blank"><?php $speed_over = $osp1+ $osp2+$osp3 +$osp4;
echo "<font face='Arial' size='2'> <b> $score2 </b>";
$count2 = $speed_over;?></a></td>
</tr>
<tr>
<td style="background-color: rgb(255, 255, 153); width: 195px; color: rgb(153, 153, 153);"><span style="font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153); display: inline ! important; float: none;"><span class="Apple-converted-space">&nbsp;</span></span><font style="font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153);" face="Arial" size="2"> 2.1 &#3648;&#3585;&#3636;&#3609;
81-88 &#3585;&#3617;./&#3594;&#3617; &nbsp;</font></td>
<td style="background-color: rgb(255, 255, 153); width: 9px; color: rgb(153, 153, 153);"></td>
<td style="background-color: rgb(255, 255, 153); text-align: center; width: 36px; color: rgb(153, 153, 153);"><?php echo "<font face='Arial' size='2' color='gray'> $osp1";
$count3 = $osp1;?></td>
</tr>
<tr>
<td style="background-color: rgb(255, 255, 153); width: 195px; color: rgb(153, 153, 153);"><span style="font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153); display: inline ! important; float: none;">&nbsp;
2.2
&#3648;&#3585;&#3636;&#3609; 89-96 &#3585;&#3617;./&#3594;&#3617;</span></td>
<td style="background-color: rgb(255, 255, 153); width: 9px; color: rgb(153, 153, 153);"></td>
<td style="background-color: rgb(255, 255, 153); text-align: center; width: 36px; color: rgb(153, 153, 153);"><?php echo "<font face='Arial' size='2' color='gray'> $osp2";
$count4 = $osp2;?></td>
</tr>
<tr>
<td style="background-color: rgb(255, 255, 153); width: 195px; color: rgb(153, 153, 153);">&nbsp;
<span style="font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153); display: inline ! important; float: none;">2.3
&#3648;&#3585;&#3636;&#3609; 97-104 &#3585;&#3617;./&#3594;&#3617;</span></td>
<td style="background-color: rgb(255, 255, 153); width: 9px; color: rgb(153, 153, 153);"></td>
<td style="background-color: rgb(255, 255, 153); text-align: center; width: 36px; color: rgb(153, 153, 153);"><?php echo "<font face='Arial' size='2' color='gray'> $osp3";
$count5 = $osp3;?></td>
</tr>
<tr>
<td style="background-color: rgb(255, 255, 153); width: 195px; color: rgb(153, 153, 153);">&nbsp;
<span style="font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153); display: inline ! important; float: none;">2.4
&#3648;&#3585;&#3636;&#3609; 104 &#3585;&#3617;./&#3594;&#3617;.</span> </td>
<td style="background-color: rgb(255, 255, 153); width: 9px; color: rgb(153, 153, 153);"></td>
<td style="background-color: rgb(255, 255, 153); text-align: center; width: 36px; color: rgb(153, 153, 153);"><?php echo "<font face='Arial' size='2' color='gray'> $osp4";
$count6 = $osp4;?></td>
</tr>
<tr>
<td style="width: 195px;" align="undefined" valign="undefined"><span style="color: rgb(0, 0, 0); font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 201); display: inline ! important; float: none;">&nbsp;3.&#3585;&#3634;&#3619;&#3648;&#3621;&#3637;&#3657;&#3618;&#3623;&#3629;&#3618;&#3656;&#3634;&#3591;&#3609;&#3640;&#3656;&#3617;&#3609;&#3623;&#3621;
&nbsp;<?php include ("f2_turn_function.php");
$sc3 = $total2;
$sc4 = $total3;
$count7_1 = $total2;
$count7_2 = $total3;?></span></td>
<td style="width: 9px;" align="undefined" valign="undefined"></td>
<td colspan="1" rowspan="3" style="vertical-align: middle; width: 64px; text-align: right;"><?php $scT=$sc3+$sc4;
if ($scT<2) { $score1_i = 3; }
elseif (($scT>=2) AND ($scT<3)) { $score1_i = 2; }
elseif (($scT>=3) AND ($scT<4)) { $score1_i = 1; }
elseif (($scT>=4) AND ($scT<5)) { $score1_i = 0; }
elseif ($scT>=5) { $score1_i = 0; }
for ($j=1; $j<=$score1_i; $j++) { echo " <img src='star.png' width='16' height='16'/>"; }?></td>
<td style="width: 36px; text-align: center;" valign="undefined"><small><a href="f0_turn_report.php" target="_blank"><?php $totalL = $total2+$total3;
echo "<font face='Arial' size='2'> <b> $totalL </b>";
?></a></small></td>
</tr>
<tr>
<td style="color: rgb(153, 153, 153);" align="undefined" valign="undefined">&nbsp;<span style="font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 201); display: inline ! important; float: none;">
3.1 &#3585;&#3634;&#3619;&#3648;&#3621;&#3637;&#3657;&#3618;&#3623;&#3629;&#3618;&#3656;&#3634;&#3591;&#3609;&#3640;&#3656;&#3617;&#3609;&#3623;&#3621;&nbsp;</span></td>
<td align="undefined" valign="undefined"></td>
<td style="text-align: center;" valign="undefined"><?php echo "<font face='Arial' size='2'> $sc3 ";?></td>
</tr>
<tr>
<td style="width: 195px; color: rgb(153, 153, 153);" align="undefined" valign="undefined"><span style="font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 201); display: inline ! important; float: none;">&nbsp;
3.2 &#3585;&#3634;&#3619;&#3585;&#3621;&#3633;&#3610;&#3619;&#3606;&#3629;&#3618;&#3656;&#3634;&#3591;&#3611;&#3621;&#3629;&#3604;&#3616;&#3633;&#3618;&nbsp;</span></td>
<td style="width: 9px;" align="undefined" valign="undefined"></td>
<td style="width: 36px; text-align: center;" valign="undefined"><?php echo "<font face='Arial' size='2'> $sc4 ";?></td>
</tr>
<tr>
<td style="background-color: rgb(255, 255, 153); width: 195px;" align="undefined" valign="undefined"><span style="color: rgb(0, 0, 0); font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153); display: inline ! important; float: none;">&nbsp;4.&#3585;&#3634;&#3619;&#3611;&#3619;&#3632;&#3614;&#3620;&#3605;&#3636;&#3651;&#3609;&#3648;&#3586;&#3605;&#3607;&#3637;&#3656;&#3585;&#3635;&#3627;&#3609;&#3604;<?php include ("f2_zone_function.php"); 

?></span></td>
<td style="background-color: rgb(255, 255, 153); width: 9px;" align="undefined" valign="undefined"></td>
<td colspan="1" rowspan="6" style="vertical-align: middle; width: 64px; text-align: right; background-color: rgb(255, 255, 153);"><?php if ($scz<2) { $score8_i = 4; } elseif (($scz>=2) AND ($scz<7)) { $score8_i = 3; } elseif (($scz>=7) AND ($scz<13)) { $score8_i = 2; } elseif (($scz>=13) AND ($scz<18)) { $score8_i = 1; } elseif ($scz>=18) { $score8_i = 0; } for ($j=1; $j<=$score8_i; $j++) { echo "<img src='star.png' width='16' height='16'/>"; } ?></td>
<td style="background-color: rgb(255, 255, 153); text-align: center; width: 36px;" valign="undefined"><a target="_blank" href="f0_cross_report.php"><small><?php $totalL2 = ($spd_zone_cnt + $cross_cnt3 + $stop_cnt2 + $tstop_cnt2 + $nstop_cnt2)/10;
echo "<font face='Arial' size='2'> <b> $totalL2 </b>";?></small></a></td>
</tr>
<tr>
<td style="background-color: rgb(255, 255, 153); color: rgb(153, 153, 153);">&nbsp;
<span style="font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153); display: inline ! important; float: none;">&nbsp;4.1
&#3585;&#3634;&#3619;&#3651;&#3594;&#3657;&#3588;&#3623;&#3634;&#3617;&#3648;&#3619;&#3655;&#3623;&#3607;&#3637;&#3656;&#3648;&#3627;&#3617;&#3634;&#3632;&#3626;&#3617;&nbsp;</span></td>
<td style="background-color: rgb(255, 255, 153); color: rgb(153, 153, 153);"></td>
<td style="background-color: rgb(255, 255, 153); text-align: center; color: rgb(153, 153, 153);"><?php echo "<font face='Arial' size='2'> <b> $spd_zone_cnt </b>";
$count8 = $spd_zone_cnt;
$sc5 = $spd_zone_cnt;?></td>
</tr>
<tr>
<td style="background-color: rgb(255, 255, 153); width: 195px; color: rgb(153, 153, 153);" align="undefined" valign="undefined"><span style="font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153); display: inline ! important; float: none;">&nbsp;
&nbsp;4.2 &#3614;&#3619;&#3657;&#3629;&#3617;&#3607;&#3637;&#3656;&#3592;&#3632;&#3627;&#3618;&#3640;&#3604;&#3607;&#3637;&#3656;&#3607;&#3634;&#3591;&#3649;&#3618;&#3585;</span></td>
<td style="background-color: rgb(255, 255, 153); width: 9px; color: rgb(153, 153, 153);" align="undefined" valign="undefined"></td>
<td style="background-color: rgb(255, 255, 153); text-align: center; width: 36px; color: rgb(153, 153, 153);" valign="undefined"><?php echo "<font face='Arial' size='2'> <b> $cross_cnt3 </b>";
$count9 = $cross_cnt3;
$sc6 = $cross_cnt3;?></td>
</tr>
<tr>
<td style="background-color: rgb(255, 255, 153); width: 195px; color: rgb(153, 153, 153);" align="undefined" valign="undefined"><span style="font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153); display: inline ! important; float: none;">&nbsp;
&nbsp;4.3 &#3627;&#3618;&#3640;&#3604;&#3619;&#3606;&#3607;&#3637;&#3656;&#3652;&#3615;&#3626;&#3633;&#3597;&#3597;&#3634;&#3603;</span></td>
<td style="background-color: rgb(255, 255, 153); width: 9px; color: rgb(153, 153, 153);" align="undefined" valign="undefined"></td>
<td style="background-color: rgb(255, 255, 153); text-align: center; width: 36px; color: rgb(153, 153, 153);" valign="undefined"><?php echo "<font face='Arial' size='2'> <b> $stop_cnt2 </b>";
$count10 = $stop_cnt2;
$sc7 = $stop_cnt2;?></td>
</tr>
<tr>
<td colspan="2" rowspan="1" style="background-color: rgb(255, 255, 153); width: 170px; color: rgb(153, 153, 153);"><span style="font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153); display: inline ! important; float: none;">&nbsp;
&nbsp;4.4 &#3592;&#3629;&#3604;&#3629;&#3618;&#3656;&#3634;&#3591;&#3611;&#3621;&#3629;&#3604;&#3616;&#3633;&#3618;&#3651;&#3585;&#3621;&#3657;&#3607;&#3634;&#3591;&#3619;&#3606;&#3652;&#3615;</span></td>
<td style="background-color: rgb(255, 255, 153); text-align: center; width: 36px; color: rgb(153, 153, 153);" valign="undefined"><?php echo "<font face='Arial' size='2'> <b> $tstop_cnt2 </b>";
$count11 = $tstop_cnt2;
$sc9 = $tstop_cnt2;
?></td>
</tr>
<tr>
<td style="background-color: rgb(255, 255, 153); width: 195px; color: rgb(153, 153, 153);" align="undefined" valign="undefined"><span style="font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153); display: inline ! important; float: none;">&nbsp;&nbsp;
4.5 &#3585;&#3634;&#3619;&#3592;&#3629;&#3604;&#3619;&#3606;&#3651;&#3609;&#3607;&#3637;&#3656;&#3627;&#3657;&#3634;&#3617;&#3592;&#3629;&#3604;</span></td>
<td style="background-color: rgb(255, 255, 153); width: 9px; color: rgb(153, 153, 153);" align="undefined" valign="undefined"></td>
<td style="background-color: rgb(255, 255, 153); text-align: center; width: 36px; color: rgb(153, 153, 153);" valign="undefined"><?php echo "<font face='Arial' size='2'> <b> $nstop_cnt2 </b>";
$count12 = $nstop_cnt2;
$sc8 = $nstop_cnt2;
$scz = $sc5+$sc6+$sc7+$sc8+$sc9;?></td>
</tr>
<tr>
<td style="background-color: rgb(255, 255, 204);"><span style="color: rgb(0, 0, 0); font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; display: inline ! important; float: none;">5.&#3585;&#3634;&#3619;&#3611;&#3619;&#3632;&#3614;&#3620;&#3605;&#3636;&#3651;&#3609;&#3607;&#3634;&#3591;&#3621;&#3634;&#3604;&#3594;&#3633;&#3609;</span></td>
<td align="undefined" valign="undefined"></td>
<td align="undefined" valign="undefined"></td>
<td style="text-align: center;" valign="undefined"><a target="_blank" href="f0_slope_report.php">0</a></td>
</tr>
<tr>
<td style="background-color: rgb(204, 204, 204); text-align: right; font-weight: bold; width: 195px;" valign="undefined">
<div style="text-align: center;"><small><span style="font-family: Arial;">&#3588;&#3632;&#3649;&#3609;&#3609;&#3619;&#3623;&#3617;&#3585;&#3634;&#3619;&#3621;&#3632;&#3648;&#3617;&#3636;&#3604;</span></small><br>
<small><span style="font-family: Arial;"></span></small></div>
<div style="text-align: center;"><small><span style="font-family: Arial;"><span style="color: red;">&#3648;&#3626;&#3657;&#3609;&#3607;&#3634;&#3591;
</span><?php echo "<font face='Arial' size='2' color='#FF0066'> $tripdir1 <br> ";
echo "<font face='Arial' size='1' color='#FF0066'> Begine : $latB1 - $lonB1 <br>";
echo "<font face='Arial' size='1' color='#FF0066'> End : $latB2 - $lonB2";
?></span></small><small><span style="font-family: Arial;"></span></small></div>
</td>
<td style="background-color: white; font-weight: bold; text-align: center; width: 9px;" valign="undefined"><?php if (($TimeBegin>="06:00:00") AND ($TimeEnd<="18:30:00")) {
$dayfont = "&#9788"; $daycolor = "#FF4000"; $daylight = "sun.png"; }
else {
$dayfont = "&#9789"; $daycolor = "#FFFF00"; $daylight = "moon.png";}
echo "<img src='$daylight' width='22' height='22'/>";?></td>
<td style="background-color: white; text-align: center; width: 64px;" valign="undefined"><?php $totlescore = $sc1+$sc2+$sc3+$sc4+ $totalL2;
if ($totlescore<=10) { $star_i = 3;}
elseif ((10<$totlescore) AND ($totlescore<=20)) { $star_i = 2; }
elseif ((20<$totlescore) AND ($totlescore<=30)) { $star_i = 1;;}
elseif ($totlescore>30) { $star_i = 0;}
for ($j=1; $j<=$star_i; $j++) { echo "<img src='bus.png' width='30' height='30'/>"; }?><br>
</td>
<td style="width: 36px; text-align: center; background-color: rgb(204, 204, 204); vertical-align: middle;"><?php if ($totlescore<=10) { $GYR = "light0.png";}
elseif ((10<$totlescore) AND ($totlescore<=20)) { $GYR = "light1.png";}
elseif ((20<$totlescore) AND ($totlescore<=30)) { $GYR = "light2.png";}
elseif ($totlescore>30) { $GYR = "light3.png";}
echo "<font face='Arial' size='2'> <b> $totlescore </b>";
echo "<img src='$GYR' width='20' height='20'/>";?>
<br>
</td>
</tr>
</tbody>
</table>
</td>
<td style="text-align: center; width: 425px; vertical-align: top; height: 542px;">
<div style="text-align: center;">
<table style="width: 100%; text-align: left; margin-left: auto; margin-right: 0px;" border="0" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td style="background-color: rgb(51, 204, 255);"></td>
<td colspan="5" rowspan="1" style="text-align: center; background-color: rgb(51, 204, 255);"><small style="font-family: Arial; font-weight: bold;"><small>&#3619;&#3632;&#3604;&#3633;&#3610;&#3588;&#3632;&#3649;&#3609;&#3609;&#3607;&#3637;&#3656;&#3652;&#3604;&#3657;&#3648;&#3611;&#3619;&#3637;&#3618;&#3610;&#3648;&#3607;&#3637;&#3618;&#3610;&nbsp;<span style="font-style: italic;">&#3588;&#3632;&#3649;&#3609;&#3609;&#3648;&#3593;&#3621;&#3637;&#3656;&#3618;</span> (NORM)
&#3586;&#3629;&#3591;&#3648;&#3626;&#3657;&#3609;&#3607;&#3634;&#3591; </small></small><small style="font-family: Arial; font-weight: bold;"><small>
            <!--<php title="echo &quot;$rout_1&quot;;">-->
            <img src="chrome://editor/content/images/tag-PHP.gif"><?php echo "$rout_1";?>
            <!--</php>--></small></small></td>
</tr>
<tr>
<td align="undefined" valign="undefined"></td>
<td style="text-align: center; font-family: Arial;" valign="undefined"><small><small>Speed</small></small></td>
<td style="text-align: center; font-family: Arial;" valign="undefined"><small><small>Acc</small></small></td>
<td style="text-align: center;" valign="undefined"><small><small style="font-family: Arial;">Turn</small></small></td>
<td style="font-family: Arial; text-align: center;" valign="undefined"><small><small>Zone</small></small></td>
<td style="font-family: Arial; text-align: center;" valign="undefined"><small><small>Total</small></small></td>
</tr>
<tr>
<td style="background-color: rgb(204, 255, 255);"><small><small style="font-family: Arial;">max.</small></small></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='1'> $spdMax";?></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='1'> $accMax";?></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='1'> $turnMax ";?></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='1'> $spdMax ";?></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='1'> $scoreMax77 ";?></td>
</tr>
<tr>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><small><small style="font-family: Arial;">avg.</small></small></td>
<td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='1'> $spd_SA ";?></td>
<td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='1'> $acc_SA ";?></td>
<td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='1'> $turn_SA";?></td>
<td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='1'> $zone_SA ";?></td>
<td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='1'> $score_SA ";?></td>
</tr>
<tr>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><small><small style="font-family: Arial;">scr.</small></small></td>
<td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='1'> $score2";?></td>
<td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='1'> $acc_num_1";?></td>
<td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='1'> $totalL ";?></td>
<td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='1'> $totalL2 ";?></td>
<td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='1'> $totlescore ";
if ($totlescore<=10) { $GYR = "light0.png";}
elseif ((10<$totlescore) AND ($totlescore<=20)) { $GYR = "light1.png";}
elseif ((20<$totlescore) AND ($totlescore<=30)) { $GYR = "light2.png";}
elseif ($totlescore>30) { $GYR = "light3.png";}
echo "<img src='$GYR' width='12' height='12'/>";?></td>
</tr>
<tr>
<td align="undefined" valign="undefined"></td>
<td style="text-align: center;"><?php if ($spdMax!=0) {$spd_2 = ($score2/$spdMax)*100;}
else {$spd_2 = 0;}
$spd_2j = 100-$spd_2;
$spd_2 = round($spd_2,2);
for ($i=1; $i<=9; $i++) {
$jk2 = $i*10;
$jk1 = $jk2-10;
if ($spd_2j<$jk2) {echo "<img src='a2.png'/><br>"; }
else {echo "<img src='a1.png'/><br>";}
}
$speed_2 = $spd_2;?></td>
<td style="text-align: center;"><!--<php title="$k = $j3;
$kk = 5-$k;
for ($i=1; $i&lt;=$kk; $i++) {
echo &quot;&lt;img src='u5.png'/&gt;&lt;br&gt;&quot;;
}
for ($i=1; $i&lt;=$k; $i++) {
echo &quot;&lt;img src='u6.png'/&gt;&lt;br&gt;&quot;;
}" xmlns="http://disruptive-innovations.com/zoo/nvu">-->
    <?php if ($accMax!=0) {$spd_2 = ($acc_num_1/$accMax)*100;}
else {$spd_2 = 0;}
$spd_2j = 100-$spd_2;
$spd_2 = round($spd_2,2);
for ($i=1; $i<=9; $i++) {
$jk2 = $i*10;
$jk1 = $jk2-10;
if ($spd_2j<$jk2) {echo "<img src='a2.png'/><br>"; }
else {echo "<img src='a1.png'/><br>";}
}
$acc_2 = $spd_2;?><!--</php>--></td>
<td style="text-align: center;"><!--<php title="$k = $j2;
$kk = 5-$k;
for ($i=1; $i&lt;=$kk; $i++) {
echo &quot;&lt;img src='u5.png'/&gt;&lt;br&gt;&quot;;
}
for ($i=1; $i&lt;=$k; $i++) {
echo &quot;&lt;img src='u6.png'/&gt;&lt;br&gt;&quot;;
}" xmlns="http://disruptive-innovations.com/zoo/nvu">--><?php if ($turnMax!=0) {$spd_2 = ($totalL/$turnMax)*100;}
else {$spd_2 = 0;}
$spd_2j = 100-$spd_2;
$spd_2 = round($spd_2,2);
for ($i=1; $i<=9; $i++) {
$jk2 = $i*10;
$jk1 = $jk2-10;
if ($spd_2j<$jk2) {echo "<img src='a2.png'/><br>"; }
else {echo "<img src='a1.png'/><br>";}
}
$turn_2 = $spd_2;?>
    <!--</php>--></td>
<td style="text-align: center;">
    <!--<php title="if ($j1&gt;=6) {$j1=6;} $k = $j1; $kk = 5-$k; for ($i=1; $i&lt;=$kk; $i++) { echo &quot;&lt;img src='u5.png'/&gt;&lt;br&gt;&quot;; } for ($i=1; $i&lt;=$k; $i++) { echo &quot;&lt;img src='u6.png'/&gt;&lt;br&gt;&quot;; }" xmlns="http://disruptive-innovations.com/zoo/nvu">--><?php if ($zoneMax!=0) {$spd_2 = ($totalL2/$zoneMax)*100;}
else {$spd_2 = 0;}
$spd_2j = 100-$spd_2;
$spd_2 = round($spd_2,2);
for ($i=1; $i<=9; $i++) {
$jk2 = $i*10;
$jk1 = $jk2-10;
if ($spd_2j<$jk2) {echo "<img src='a2.png'/><br>"; }
else {echo "<img src='a1.png'/><br>";}
}
$zone_2 = $spd_2;?>
    <!--</php>--></td>
<td style="text-align: center;">
    <!--<php title="if ($j0&gt;=6) {$j0=6;} $k = $j0; $kk = 5-$k; for ($i=1; $i&lt;=$kk; $i++) { echo &quot;&lt;img src='u5.png'/&gt;&lt;br&gt;&quot;; } for ($i=1; $i&lt;=$k; $i++) { echo &quot;&lt;img src='u6.png'/&gt;&lt;br&gt;&quot;; }" xmlns="http://disruptive-innovations.com/zoo/nvu">--><?php if ($totlescore>=60) {$ty = 60;}
else {$ty = $totlescore;}
$spd_2 = ($ty/60)*100;
$spd_2j = 100-$spd_2;
$spd_2 = round($spd_2,2);
if ($ty>=40) {echo "<img src='a4.png'/><br>"; }
else {echo "<img src='a3.png'/><br>"; }
if (($ty>=30) AND ($ty<40)) {echo "<img src='a4.png'/><br>"; }
else {echo "<img src='a3.png'/><br>"; }
if (($ty<30) AND ($ty>=27.5)) {echo "<img src='a5.png'/><br>"; }
else {echo "<img src='a6.png'/><br>"; }
if (($ty<27.5) AND ($ty>=25)) {echo "<img src='a5.png'/><br>"; }
else {echo "<img src='a6.png'/><br>"; }
if (($ty<25) AND ($ty>=22.5)) {echo "<img src='a5.png'/><br>"; }
else {echo "<img src='a6.png'/><br>"; }
if (($ty<22.5) AND ($ty>=20)) {echo "<img src='a5.png'/><br>"; }
else {echo "<img src='a6.png'/><br>"; }
if (($ty<20) AND ($ty>=16.67)) {echo "<img src='a2.png'/><br>"; }
else {echo "<img src='a1.png'/><br>"; }
if (($ty<16.67) AND ($ty>=13.33)) {echo "<img src='a2.png'/><br>"; }
else {echo "<img src='a1.png'/><br>"; }
if (($ty<13.33) AND ($ty>=10)) {echo "<img src='a2.png'/><br>"; }
else {echo "<img src='a1.png'/><br>"; }
?>
    <!--</php>--></td>
</tr>
<tr>
<td align="undefined" valign="undefined"></td>
<td style="text-align: center; font-family: Arial; font-weight: bold;" valign="undefined"><small><small><br>
Speed<br>
<?php echo "<font face='Arial' size='1'>($speed_2%)";?><br>
</small></small></td>
<td style="text-align: center; font-family: Arial; font-weight: bold;" valign="undefined"><small><small><br>
Acc<br>
<?php echo " <font face='Arial' size='1'> ($acc_2%)";?></small></small></td>
<td style="text-align: center; font-family: Arial; font-weight: bold;" valign="undefined"><small><small><br>
&nbsp;Turn<br>
<?php echo " <font face='Arial' size='1'>($turn_2%)";?></small></small></td>
<td style="text-align: center; font-family: Arial; font-weight: bold;" valign="undefined"><small><small><br>
Zone<br>
<?php echo " <font face='Arial' size='1'> ($zone_2%)";
?></small></small></td>
<td style="text-align: center; font-family: Arial; font-weight: bold;" valign="undefined"><small><small><br>
Total<br>
<?php echo "$deviceD";?></small></small></td>
</tr>
</tbody>
</table>
</div>
&nbsp;<?php if ($totlescore<=10) { $GYR = "light0.png";}
elseif ((10<$totlescore) AND ($totlescore<=20)) { $GYR = "light1.png";}
elseif ((20<$totlescore) AND ($totlescore<=30)) { $GYR = "light2.png";}
elseif ($totlescore>30) { $GYR = "light3.png";}
if (($timeStp>="06:00:00") AND ($timeStp<="18:30:00")) {
$dayfont = "&#9788"; $daycolor = "#FF4000"; $daylight = "sun.png";
}
else {
$dayfont = "&#9789"; $daycolor = "#FFFF00"; $daylight = "moon.png";}
/* Write Total Score to Database/File */
$score_pack1 = array($sc1,$sc2,$sc2_1,$sc2_2,$sc2_3,$sc2_4,$sc3,$sc4,$sc5,$sc6,$sc7,$sc8,$sc9,$totlescore);
$score_pk1 = implode(":" , $score_pack1);
$score_pack2 = array($count1,$count2,$count3,$count4,$count5,$count6,$count7_1,$count7_2,$count8,$count9,$count10,$count11,$count12);
$score_pk2 = implode(":" , $score_pack2);

/*  $db = mysqli_connect("53476f055e81994c02000008-nectec.clouddd.in.th:38096","adminlYkzegJ","MaLQvrNyPEpn");  */
$objConnect = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD) or die("Error Connect to Database");

$objDB = mysqli_select_db(DB_NAME);
$strSQL = "INSERT INTO `selectscore` (`timestmp`,`index`,`device`,`date`,`time1`,`time2`,`pack1`,`pack2`,`tripdir`,`daylight`,`speedavg`,`distanceavg`,`timeavg` )
VALUES ( NOW( ), '3', '$deviceD','$DateBegin','$TimeBegin','$TimeEnd','$score_pk1','$score_pk2','$tripdir1','$daylight','$speed_avg3','$dis_sum_km','$deltaT');;";
$objQuery = mysqli_query($strSQL);
mysqli_close($objConnect);
?><?php /* include ("f2_map_function.php"); */
/*include ("f2_int_speedG1_function.php");*/
echo "<font face='Arial' size='120' color='#0489B1'> <b> Score $totlescore </b>";?></td>
</tr>
</tbody>
</table>
</form>
</body></html>