<?php
    session_start();
    if (!isset($_SESSION['data'])||isset($_POST['random'])) {
        session_destroy();
        session_start();
        $random = range(1, 50);
        shuffle($random );
        $data_1 = array_slice($random ,0,10);
        $data_2 = array_slice($random ,11,20);

        sort($data_1);
        sort($data_2);

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
        // sort($random);
        $_SESSION["data"] = $mydata;
        $_SESSION["data_1"] = $data_1;
        $_SESSION["data_2"] = $data_2;

        header("Location: index.php");
    }
    $data = $_SESSION["data"];
    $data_1 = $_SESSION["data_1"];
    $data_2 = $_SESSION["data_2"];

    // // render
    // if (isset($_POST['render'])) {
            
    //     if ($_POST['cluster'] < 1) {
    //         echo '<script> alert("cluster harus nilai > 0 !!!") </script>';
    //     }else{
            
    //     }

    //     // header("Location: index.php");
    // }
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
                <div class="col-sm-6">
                    <form action="index.php" method="POST">
                        <div class="form-row">
                            <div class="form-group col-sm-2">
                                <label>K-Means</label>
                                <input type="number" name="cluster" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group col-sm-2">
                                <label>Clustering</label>
                                <input type="submit" name="render" class="btn btn-primary btn-sm" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6">
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
        <div id="input-random" class="container mt-3">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">data_1</th>
                        <th scope="col">data_2</th>
                        <th scope="col">claster</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        for ($i=0; $i < count($data) ; $i++) { 
                    ?>
                    <tr>
                        <th scope="row"><?php echo $i+1; ?></th>
                        <td><?php echo $data[$i][0]; ?></td>
                        <td><?php echo $data[$i][1]; ?></td>
                        <td>?</td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
    // render
        if (isset($_POST['render'])) {
            if ($_POST['cluster'] < 2) {
                echo '<script> alert("cluster harus nilai > 1 !!!") </script>';
            }else{
                // K
                $cluster = $_POST['cluster'];

                $keys = array_rand( $data_1, $cluster ); 
                
                for ($i=0; $i < $cluster ; $i++) { 
                    echo $data_1[$keys[$i]];  
                }

            } 
        }           
    ?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/jquery-3.4.1.slim.min.js"></script>
    <script src="assets/popper.min.js"></script>
    <script src="assets/bootstrap-4.4.1/js/bootstrap.min.js"></script>
</body>

</html>