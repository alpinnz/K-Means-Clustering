<?php
    session_start();
    if (!isset($_SESSION['data'])||isset($_POST['random'])) {
        session_destroy();
        session_start();
        $random = range(1, 20);
        shuffle($random );
        $data_1 = array_slice($random ,0,10);
        $data_2 = array_slice($random ,10,20);

        // $data_1 = array(1.56,6.20,6.14,5.15,5.89,5.20,5.95,4.98,3.98,6.78);
        // $data_2 = array(-2.36,6.90,6.34,3.41,6.82,5.84,6.46,5.94,4.54,7.01);
        

        // sort($data_1);
        // sort($data_2);

        $mydata = array(
            // Default key for each will 
            // start from 0 
            array($data_1[0],$data_2[0]),
            array($data_1[1],$data_2[1]),
            array($data_1[2],$data_2[2]),
            array($data_1[3],$data_2[3]),
            array($data_1[4],$data_2[4]),
            array($data_1[5],$data_2[5]),
            array($data_1[6],$data_2[6]),
            array($data_1[7],$data_2[7]),
            array($data_1[8],$data_2[8]),
            array($data_1[9],$data_2[9]),
        ); 

        // $mydata = array(
        //     array(1.56,-2.36),
        //     array(6.20,6.90),
        //     array(6.14,6.34),
        //     array(5.15,3.41),
        //     array(5.89,6.82),
        //     array(5.20,5.84),
        //     array(5.95,6.46),
        //     array(4.98,5.94),
        //     array(3.98,4.54),
        //     array(6.78,7.01),
        // ); 
        // sort($random);
        $_SESSION["data"] = $mydata;
        $_SESSION["data_1"] = $data_1;
        $_SESSION["data_2"] = $data_2;

        header("Location: index.php");
    }
    $data = $_SESSION["data"];
    $data_1 = $_SESSION["data_1"];
    $data_2 = $_SESSION["data_2"];

    
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap-4.4.1/css/bootstrap.min.css">

    <title>K-Means-Clustering</title>
</head>

<body>
    <div id="wrapper" class="container-fluid mt-5 mb-5">
        <div id="input" class="container">
            <div class="row">
                <div class="col-sm-5 offset-sm-1">
                    <form action="index.php" method="POST">
                        <div class="form-row">
                            <div class="form-group col-sm-2 offset-sm-2">
                                <label>K-Means</label>
                                <input type="number" name="cluster" value="4" readonly class="form-control form-control-sm"
                                    required>
                            </div>
                            <div class="form-group col-sm-2">
                                <label>Clustering</label>
                                <input type="submit" name="render" class="btn btn-primary btn-sm" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-5 offset-sm-1">
                    <form action="index.php" method="POST">
                        <div class="form-row">
                            <div class="form-group col-sm-2 offset-sm-10">
                                <label></label>
                                <input type="submit" name="random" class="btn btn-primary btn-sm" value="random">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        $K = array();
        // render
        $stop=false;

            if (isset($_POST['render'])) {

                if ($_POST['cluster'] < 2) {
                    echo '<script> alert("cluster harus nilai > 1 !!!") </script>';
                }
                else{
                    // K
                    $cluster = $_POST['cluster'];

                    // random 
                    $K = range(0, 9);
                    shuffle($K );
                    $K = array_slice($K ,0,$cluster);
                    sort($K);
                    
                    echo '<div id="input-random" class="container mt-3">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-4 offset-sm-1">';
                    echo '<table class="table table-sm table-bordered text-center">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col">#</th>';
                    echo '<th scope="col">claster</th>';
                    echo '<th scope="col">index data</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                        for ($i=0; $i < count($K) ; $i++) { 

                    echo '<tr>';
                    echo '<th scope="row">'.($i+1).'</th>';
                    echo '<td>K-'.($i+1).'</td>';
                    echo '<td>'.$K[$i].'</td>';
                    echo '</tr>';

                    }
                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';

                    echo '<div class="col-sm-4 offset-sm-2">';
                    echo '<table class="table table-sm table-bordered text-center">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col">#</th>';         
                    echo '<th scope="col">data_1</th>';
                    echo '<th scope="col">data_2</th>';
                    echo '<th scope="col">claster</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    for ($i=0; $i < count($data) ; $i++) { 
                        
                        echo '<tr>';
                        echo '<th scope="row">'.($i+1).'</th>';
                        echo '<td>'.$data[$i][0].'</td>';
                        echo '<td>'.$data[$i][1].'</td>';
                        echo '<td>?</td>';
                        echo '</tr>';

                        }
                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';


                    $tempAll = array();
                    $tempData = array();
                    $temp = array();
                    $historyAll = array();
                    $history = array();

                    $newData = array();

                    for ($x=0; $x < 10; $x++) { 

                        for ($j=0; $j < count($data_1) ; $j++) { 
                            // interasi
                            for ($i=0; $i < count($K); $i++) { 
                                // cluster
                                if ($x == 0) {
                                    $temp[$i] = sqrt( ( pow ( ( $data_1[$j] - $data_1[$K[$i]] ) , 2)) + ( pow ( ( $data_2[$j] - $data_2[$K[$i]] ) , 2 )) );
                                
                                }else{
                                    
                                    $temp[$i] = sqrt( ( pow ( ( $data_1[$j] - $newData[$i][0] ) , 2)) + ( pow ( ( $data_2[$j] - $newData[$i][1] ) , 2 )) );
                                }
                                
                            }
                            for ($ii=0; $ii < count($temp); $ii++) { 
                                // add cluster colom history
                                if (min($temp) == $temp[$ii]) {
                                    array_push($history, $ii+1);
                                }
                            }
                            
                            array_push($tempData, $temp);
                            $temp = array();
                        }

                        $storage = array();
                        for ($xz = 0; $xz < count($data) ; $xz++) {  
                            $result = array();
                            for ($i =0 ; $i < count($K) ; $i++) {
                                if ($history[$xz]-1 == ($i)) {
                                    $result[$i][0] = $data_1[$xz];
                                    $result[$i][1] = $data_2[$xz];
                                }else{
                                    $result[$i][0] = 0;
                                    $result[$i][1] = 0;
                                }
                            }
                            array_push($storage, $result);
                        }
                    
                        $sum = array(
                            array(0,0),
                            array(0,0),
                            array(0,0),
                            array(0,0)
                        );

                        $countif = array(
                            array(0,0),
                            array(0,0),
                            array(0,0),
                            array(0,0)
                        );

                        $newData = array(
                            array(0,0),
                            array(0,0),
                            array(0,0),
                            array(0,0)
                        );

                        for ($i=0; $i < count($storage); $i++) {
                            for ($ii=0; $ii < count($storage[$i]); $ii++) {
                                if ($ii==0) {
                                    $sum[$ii][0] = $sum[$ii][0] + $storage[$i][$ii][0];
                                    if ($storage[$i][$ii][0] != 0) {
                                        $countif[$ii][0] = $countif[$ii][0] + 1;
                                    }
                                    $sum[$ii][1] = $sum[$ii][1] + $storage[$i][$ii][1];
                                    if ($storage[$i][$ii][1] != 0) {
                                        $countif[$ii][1] = $countif[$ii][1] + 1;
                                    }
                                }elseif ($ii==1) {
                                    $sum[$ii][0] = $sum[$ii][0] + $storage[$i][$ii][0];
                                    if ($storage[$i][$ii][0] != 0) {
                                        $countif[$ii][0] = $countif[$ii][0] + 1;
                                    }
                                    $sum[$ii][1] = $sum[$ii][1] + $storage[$i][$ii][1];
                                    if ($storage[$i][$ii][1] != 0) {
                                        $countif[$ii][1] = $countif[$ii][1] + 1;
                                    }
                                }elseif ($ii==2) {
                                    $sum[$ii][0] = $sum[$ii][0] + $storage[$i][$ii][0];
                                    if ($storage[$i][$ii][0] != 0) {
                                        $countif[$ii][0] = $countif[$ii][0] + 1;
                                    }
                                    $sum[$ii][1] = $sum[$ii][1] + $storage[$i][$ii][1];
                                    if ($storage[$i][$ii][1] != 0) {
                                        $countif[$ii][1] = $countif[$ii][1] + 1;
                                    }
                                }elseif ($ii==3) {
                                    $sum[$ii][0] = $sum[$ii][0] + $storage[$i][$ii][0];
                                    if ($storage[$i][$ii][0] != 0) {
                                        $countif[$ii][0] = $countif[$ii][0] + 1;
                                    }
                                    $sum[$ii][1] = $sum[$ii][1] + $storage[$i][$ii][1];
                                    if ($storage[$i][$ii][1] != 0) {
                                        $countif[$ii][1] = $countif[$ii][1] + 1;
                                    }
                                }
                            } 
                        }

                        for ($i=0; $i < count($sum) ; $i++) { 
                            for ($ii=0; $ii < count($sum[$i]); $ii++) { 
                                $newData[$i][$ii] = $sum[$i][$ii] / $countif[$i][$ii];
                            }
                        }

                        

                        if (end($historyAll) == $history) {
                            echo 'valid Literasi ke '.($x+1).' ->';
                            $stop = true;
                            print_r($history);
                        }
                        
                        
                        echo '<div class="output">';
                        echo '<div class="container">';
                        echo '<h4 class="ml-5">interasi ke '.($x+1).'</h4>';
                        echo '<table class="table table-sm table-bordered text-center">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th scope="col">#</th>';
                        for ($i=0; $i < count($K); $i++) { 
                            echo '<th>K-'.($i+1).'</th>';
                        }
                        echo '<th>cluster</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        for ($i=0; $i < count($tempData); $i++) { 
                            $log = 0;
                            echo '<tr>';
                            echo '<td scope="row">'.($i+1).'</td>';
                            for ($j=0; $j < count($K); $j++) { 
                                echo '<td>'.round($tempData[$i][$j], 2).'</td>';
                                if (min($tempData[$i]) == $tempData[$i][$j]) {
                                    $log = $j;
                                }
                            }
                            echo '<td>K-'.($log+1).'</td>';
                            echo '</tr>';
                        }
                        echo '</tbody>';
                        echo '</table>';
                        echo '</div>';
                        echo '<div class="container">';
                        echo '<table class="table table-sm table-bordered text-center">';
                        echo ' <thead>';
                        echo '<tr>';
                                echo '<th scope="col" rowspan="2">#</th>';
                                for ($i=0; $i < count($K); $i++) { 
                                    echo '<th colspan="2">cluster-'.($i+1).'</th>';
                                }
                                echo '</tr>';
                                echo '<tr>';
                                
                                for ($i=0; $i < count($K); $i++) { 
                                    echo '<th rowspan="2">x</th>';
                                    echo '<th>y</th>';
                                }
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        for ($i=0; $i < 10; $i++) { 
                            echo '<tr>';
                            echo '<td scope="row">'.($i+1).'</td>';
                            for ($j=0; $j < count($storage[$i]); $j++) { 
                                for ($ji=0; $ji < count($storage[$i][$j]); $ji++) {
                                    echo '<td>'.$storage[$i][$j][$ji].'</td>';
                                }
                            }
                            echo '</tr>';
                        }
                        
                            echo '<tr>';
                            echo '<td scope="row">Total</td>';
                        for ($i=0; $i < count($sum); $i++) {
                            for ($ii=0; $ii < count($sum[$i]); $ii++) {
                                echo '<td>'.$sum[$i][$ii].'</td>';
                            }
                        }
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td scope="row">Avg</td>';
                        for ($i=0; $i < count($countif); $i++) {
                            for ($ii=0; $ii < count($countif[$i]); $ii++) {
                                echo '<td>'.$countif[$i][$ii].'</td>';
                            }
                        }
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td scope="row">newData</td>';
                        for ($i=0; $i < count($newData); $i++) {
                            for ($ii=0; $ii < count($newData[$i]); $ii++) {
                                echo '<td>'.round($newData[$i][$ii],2).'</td>';
                            }
                        }
                            echo '</tr>';
                        echo '</tbody>';
                        echo '</table>';
                        echo '</div>';
                        echo '</div>';

                        array_push($historyAll, $history);
                        $history = array();

                        array_push($tempAll, $tempData);
                        $tempData = array();

                        if ($stop) {
                            $x=10000;
                        }
                    }
                } 
                
            } 
        ?>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/jquery-3.4.1.slim.min.js"></script>
    <script src="assets/popper.min.js"></script>
    <script src="assets/bootstrap-4.4.1/js/bootstrap.min.js"></script>
</body>

</html>