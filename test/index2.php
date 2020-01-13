<?php
include "data2.php";
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
    <title>KNN</title>
</head>

<body>
    <br>
    <div class="container">
        <h3>Contoh soal Perhitungan KNN</h3>
        <h4>Diberikan data Training berua dua atribut Bad dan Good untuk mengklasiikasikan sebuah data apakah tergolong Bad atau Good</h4>
        <h4>Data yang akan diperiksa adalah = <?= $dataBaru[0] . " dan " . $dataBaru[1] ?></h4>
        <table class="table table-bordered">
            <caption>Dataset</caption>
            <thead>
                <tr>
                    <th>X</th>
                    <th>Y</th>
                    <th>Kategori</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($array); $i++) {
                    ?>
                    <tr>
                        <td><?= $array[$i][1] ?></td>
                        <td><?= $array[$i][2] ?></td>
                        <td><?= $array[$i][3] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <br>
        <table class="table table-bordered">
            <tr>
                <th>X</th>
                <th>Y</th>
                <th>Euclidean Distance (<?php echo $dataBaru[0] . ", " . $dataBaru[1] ?>)</th>
            </tr>
            <?php
            for ($i = 0; $i < count($array); $i++) {

                $distance = sqrt(pow($array[$i][1] - $dataBaru[0], 2) + pow($array[$i][2] - $dataBaru[1], 2));
                $array[$i][0] = number_format($distance, 2);
                $arrayx[$i][0] = number_format($distance, 2);

                ?>
                <tr>
                    <td><?= $arrayx[$i][1] ?></td>
                    <td><?= $arrayx[$i][2] ?></td>
                    <td><?= number_format($distance, 2) ?></td>
                </tr>
            <?php
            }
            ?>
            <caption>Euclidean Distance</caption>
        </table>
    </div>

    <br>
    <div class="container">
        <table class="table table-bordered">
            <tr>
                <th>Euclidean Distance (<?php echo $dataBaru[0] . ", " . $dataBaru[1] ?>)</th>
                <th>X</th>
                <th>Y</th>
                <th style="background-color: orange;">Urutan Distance</th>
                <th>Apakah Termasuk 3-NN?</th>
                <th>Kategori</th>
            </tr>
            <?php
            asort($arrayx);
            $i = 1;
            foreach ($arrayx as $key) {
                ?>
                <tr>
                    <td><?= $key[0] ?></td>
                    <td><?= $key[1] ?></td>
                    <td><?= $key[2] ?></td>
                    <td><?= $i++ ?></td>
                    <td>
                        <?php
                            if ($i - 1 < $k) {
                                echo "Ya (K < 3)";
                            } else if ($i - 1 == $k) {
                                echo "Ya (K = 3)";
                            } else {
                                echo "Tidak (K > 3)";
                            }
                            ?>
                    </td>
                    <td><?= $key[3] ?></td>
                </tr>
            <?php
            }
            ?>
            <caption>3 Data (K = 3)</caption>
        </table>



        <strong>
            <h3>
                <?php
                asort($array);
                $range = array_slice($array, 0, $k);
                for ($i = 0; $i < $k; $i++) {
                    if ($range[$i][3] == "Good") {
                        array_push($good, "Good");
                        // echo var_dump($good);
                    } else if ($range[$i][3] == "Bad") {
                        array_push($bad, "Bad");
                        // echo var_dump($bad);
                    }
                }
                if (count($good) > count($bad)) {
                    echo "Sehingga data tersebut (" . $dataBaru[0] . ", " . $dataBaru[1] . ") berada pada kategori Good";
                } else if (count($good) < count($bad)) {
                    echo "Sehingga data tersebut (" . $dataBaru[0] . ", " . $dataBaru[1] . ") berada pada kategori Bad";
                }
                ?>
            </h3>
        </strong>
    </div>
    <br>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>