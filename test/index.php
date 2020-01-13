<?php
include "data.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>K-Means</title>
</head>

<body>
    <br>
    <div class="container">
        <table class="table table-bordered">
            <caption>Dataset</caption>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Data 1</th>
                    <th>Data 2</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($array); $i++) {
                    ?>
                    <tr>
                        <td scope="row"><?= 1 + $i ?></td>
                        <td><?= $array[$i][0] ?></td>
                        <td><?= $array[$i][1] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <br>
    <div class="container">
        <table class="table table-bordered">
            <tr>
                <th rowspan="2">Dataset</th>
                <th colspan="2">Distance</th>
                <th rowspan="2">Cluster</th>
            </tr>
            <tr>
                <th>X</th>
                <th>Y</th>
            </tr>
            <tr>
                <th>K1(<?= $array[0][0] . ", " . $array[0][1] ?>)</th>
                <td><?= $c1; ?></td>
                <td><?= number_format($centroidX, 2); ?></td>
                <td>1</td>
            </tr>
            <tr>
                <th>K1(<?= $array[1][0] . ", " . $array[1][1] ?>)</th>
                <td><?= number_format($centroidY, 2) ?></td>
                <td><?= $c2 ?></td>
                <td>2</td>
            </tr>
            <caption>Centroid / Patokan cluster</caption>
        </table>
    </div>


    <br>
    <div class="container">
        <table class="table table-bordered">
            <tr>
                <th rowspan="2">Dataset</th>
                <th colspan="2">Distance</th>
                <th rowspan="2">Kelompok Cluster</th>
            </tr>
            <tr>
                <th>X</th>
                <th>Y</th>
            </tr>
            <tr>
                <th>100, 50</th>
                <td>0</td>
                <td>60, 83</td>
                <td>1</td>
            </tr>
            <tr>
                <th>40, 60</th>
                <td>60, 83</td>
                <td>0</td>
                <td>2</td>
            </tr>
            <?php
            $q = 3;
            for ($i = 2; $i < count($array); $i++) {
                $cluster1;
                $cluster2;


                $cluster1 = sqrt(pow($array[$i][0] - $array[0][0], 2) + pow($array[$i][1] - $array[0][1], 2));
                $cluster2 = sqrt(pow($array[$i][0] - $array[1][0], 2) + pow($array[$i][1] - $array[1][1], 2));

                if ($cluster2 < $cluster1) {

                    $update2_data1 = ($array[$i][0] + $array[1][0]) / 2;
                    $update2_data2 = ($array[$i][1] + $array[1][1]) / 2;

                    $array[1][0] = $update2_data1;
                    $array[1][1] = $update2_data2;
                } else if ($cluster1 < $cluster2) {

                    $update1_data1 = ($array[$i][0] + $array[0][0]) / 2;
                    $update1_data2 = ($array[$i][1] + $array[0][1]) / 2;

                    $array[0][0] = $update1_data1;
                    $array[0][1] = $update1_data2;
                }
                ?>
                <tr>
                    <th><?= $array[$i][0] . ", " . $array[$i][1]; ?></th>
                    <td><?= number_format($cluster1, 2); ?></td>
                    <td><?= number_format($cluster2, 2) ?></td>
                    <td>
                        <?php
                            if ($cluster1 < $cluster2) {
                                echo "1";
                            } else {
                                echo "2";
                            }
                            ?>
                    </td>
                </tr>
            <?php
            }
            ?>


            <caption>Final Result</caption>
        </table>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>