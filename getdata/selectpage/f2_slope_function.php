<html>
<head>
    <title>JavaScript Datepicker Test</title>

</head>

<body>

<?php

$sl1 = 0;
$dist_sl1 = 0;
$sl2 = 0;
$dist_sl2 = 0;
$sl3 = 0;
$dist_sl3 = 0;

$sec = 0;
$sec0 = 0;
$speed_ms[0] = 0;

for ($i = 0; $i < $num_rows; $i++) {

    $date0 = $DateBegin;
    $time0 = $time_i[$i];
    $lat0 = $lat_i[$i];
    $lon0 = $lon_i[$i];
    $spd0 = $speed_i[$i];
    $dir0 = $dir_i[$i];
    $alt0 = $alt_i[$i];

    $altitudE = $alt_i[$i];

    $time = $time0;
    $speed = $spd0 * $spd_unit;
    $direction = $dir0;

    $time_s = explode(":", $time0);
    $sec = ((($time_s[0]) * 3600) + (($time_s[1]) * 60) + ($time_s[2]));
    $sec_del = $sec - $sec0;                                       /* second */

    if (($sec_del <= 0) OR ($i == 0)) {
        $sec_del = 0;
    }
    $sec0 = $sec;

    $lat01 = DMStoDECLn($lat_i[$i]);
    $lon01 = DMStoDECLn($lon_i[$i]);

    if ($i >= 1) {

        $speed_ms[$i] = $speed * (1000 / 3600);
        $delta_t = $sec_del;
        $delta_v = $speed_ms[$i] - $speed_ms[$i - 1];
        $delta_a = $alt_i[$i] - $alt_i[$i - 1];
        $delta_s = $speed_ms[$i] * $delta_t;
        $delta_d = $dir_i[$i] - $dir_i[$i - 1];

        if ($delta_s != 0) {
            $slope = abs($delta_a) / abs($delta_s);
        } else {
            $slpoe = 0;
        }

        if ($delta_t != 0) {
            $acc_sec = ($delta_v / $delta_t);
        }

        /* --------------------------------------- */
        if ($slope <= 0.005) {
            $sl1 = 1;
            $dist_sl1 = $dist_sl1 + $delta_s;
        } elseif (($slope > 0.005) AND ($slope < 0.04)) {   /* Low Slope */
            $sl2 = 1;
            $dist_sl2 = $dist_sl2 + $delta_s;
        } /* Hight Slope */
        elseif ($slope >= 0.04) {
            $dist_sl3 = $dist_sl3 + $delta_s;
            $sl3 = 1;

        }

        $total_dis = $total_dis + $delta_s;

        /* --- Slope Start Detected------------------------------ */

        if (($slope >= 0.04) AND ($sl3_logic == 0)) {

            $sl3_logic = 1;
            $point1 = $i;
            $lat01b = $lat01;
            $lon01b = $lon01;
        } /* --- Integrate parameter ------------------------------ */

        elseif (($slope >= 0.04) AND ($sl3_logic == 1)) {

            if ($speed > $v_max) {
                $v_max = $speed;
            }
            if ($acc_sec > $acc_max) {
                $acc_max = $acc_sec;
            }

            $int_d = $delta_d + $int_d;

            $s3 = $s3 + $delta_s;
            $a3 = $a3 + $delta_a;
            $sl_stop_cnt = 0;

        } /* --- End of Slope & Keep parameter ------------------ */

        elseif (($slope < 0.04) AND ($sl3_logic == 1)) {

            $sl_stop_cnt = $sl_stop_cnt + 1;

            if ($sl_stop_cnt >= 15) {       /* Confirm end of slope 15 count*/

                if ($s3 != 0) {
                    $slope_filter = $a3 / $s3;
                } else {
                    $slope_filter = 0;
                }

                if (($s3 != 0) AND (abs($slope_filter < 0.25) AND (abs($slope_filter) > 0.01))) {    /* Slope Over shoot Filter */

                    $sl3_cnt = $sl3_cnt + 1;

                    $latslBe[$sl3_cnt] = $lat01b;
                    $lonslBe[$sl3_cnt] = $lon01b;

                    $latslEn[$sl3_cnt] = $lat01;
                    $lonslEn[$sl3_cnt] = $lon01;

                    $sl3_p1[$sl3_cnt] = $point1;
                    $sl3_p2[$sl3_cnt] = $i;

                    $distance_sl3[$sl3_cnt] = $s3;
                    $altitude_sl3[$sl3_cnt] = $a3;
                    $slope_sl3[$sl3_cnt] = round($slope_filter, 4);

                    $slope_Vmax3[$sl3_cnt] = $v_max;
                    $slope_Accmax3[$sl3_cnt] = round($acc_max, 2);
                    $slope_Dir3[$sl3_cnt] = round($int_d, 2);

                    $dis3_total = $dis3_total + $s3;
                }

                /*  elseif (($s3!=0)  AND (abs($slope_filter)<=0.01)) {

                     $sl2_cnt = $sl2_cnt + 1;
                     $sl2_p1[$sl2_cnt] = $point1;
                     $sl2_p2[$sl2_cnt] = $i;

                     $distance_sl2[$sl2_cnt] = $s3;
                     $altitude_sl2[$sl2_cnt] = $a3;
                     $slope_sl2[$sl2_cnt] = round($slope_filter,4);
                     $dis2_total = $dis2_total + $s3;
                  }
               */

                $s3 = 0;
                $a3 = 0;
                $sl3_logic = 0;
                $sl_stop_cnt = 0;
                $v_max = 0;
                $acc_max = 0;
                $int_d = 0;
            }

        }

        /* ------------------------------------------------------------------ */
        if (($slope >= 0.01) AND ($slope < 0.04) AND ($sl2_logic == 0)) {

            $sl2_logic = 1;
            $point12 = $i;

        } elseif (($slope >= 0.01) AND ($slope < 0.04) AND ($sl2_logic == 1)) {

            $s2 = $s2 + $delta_s;
            $a2 = $a2 + $delta_a;
            $sl_stop_cnt2 = 0;

            if ($speed > $v_max2) {
                $v_max2 = $speed;
            }
            if ($acc_sec > $acc_max2) {
                $acc_max2 = $acc_sec;
            }

            $int_d2 = $delta_d + $int_d2;

        } elseif (($slope < 0.01) AND ($slope < 0.04) AND ($sl2_logic == 1)) {
            $s2 = $s2 + $delta_s;
            $a2 = $a2 + $delta_a;
            $sl_stop_cnt2 = $sl_stop_cnt2 + 1;

            if ($sl_stop_cnt2 >= 15) {

                if ($s2 != 0) {
                    $slope_filter = $a2 / $s2;
                } else {
                    $slope_filter = 0;
                }

                if (($s2 != 0) AND (abs($slope_filter) < 0.01)) {

                    $sl2_cnt = $sl2_cnt + 1;

                    $sl2_p1[$sl2_cnt] = $point12;
                    $sl2_p2[$sl2_cnt] = $i;

                    $distance_sl2[$sl2_cnt] = $s2;
                    $altitude_sl2[$sl2_cnt] = $a2;
                    $slope_sl2[$sl2_cnt] = round($slope_filter, 4);

                    $slope_Vmax2[$sl2_cnt] = round($v_max2, 2);
                    $slope_Accmax2[$sl2_cnt] = round($acc_max2, 2);

                    $slope_Dir2[$sl2_cnt] = round($int_d2, 2);

                    $dis2_total = $dis2_total + $s2;
                }

                /*  elseif (($s3!=0)  AND (abs($slope_filter)<=0.01)) {

                     $sl2_cnt = $sl2_cnt + 1;
                     $sl2_p1[$sl2_cnt] = $point1;
                     $sl2_p2[$sl2_cnt] = $i;

                     $distance_sl2[$sl2_cnt] = $s3;
                     $altitude_sl2[$sl2_cnt] = $a3;
                     $slope_sl2[$sl2_cnt] = round($slope_filter,4);
                     $dis2_total = $dis2_total + $s3;
                  }
               */
                $v_max2 = 0;
                $acc_max2 = 0;
                $int_d2 = 0;
                $s2 = 0;
                $a2 = 0;
                $sl2_logic = 0;
                $sl_stop_cnt2 = 0;
            }

        }

        /* ========================================*/

        /* Time @sec calculation */


    }        /* End if 1 */
}             /* End for */

for ($i = 1; $i <= $sl3_cnt; $i++) {
    $dis1[$i] = round($distance_sl3[$i], 2);
    $alt1[$i] = round($altitude_sl3[$i], 2);
    $ssl1[$i] = $slope_sl3[$i] * 100;

    if ($ssl1 > 4) {
        $colorS[$i] = "d1.png";
    } elseif ($ssl1 <= 4) {
        $colorS[$i] = "d2.png";
    }

    if ($slope_Vmax3[$i] > 80) {
        $colorv[$i] = "d1.png";
    } elseif (($slope_Vmax3[$i] <= 80) AND ($slope_Vmax3[$i] > 60)) {
        $colorv[$i] = "d2.png";
    } elseif (($slope_Vmax3[$i] <= 60) AND ($slope_Vmax3[$i] > 40)) {
        $colorv[$i] = "d3.png";
    }

    $absAcc = abs($slope_Accmax3[$i]);

    if ($absAcc > 0.15) {
        $colorA[$i] = "d1.png";
    } elseif ($absAcc <= 0.15) {
        $colorA[$i] = "d2.png";
    }

    if (($ssl1 > 4) AND ($slope_Vmax3[$i] > 80)) {
        $colorT[$i] = "d1.png";

        $slope_dan = $slope_dan + 1;

    }

}


/* ========= Speed Type Detection============================================= */


?>


</body>
</html>



