<?php
    $random = range(1, 100);
    shuffle($random );


    $data = array(
        // Default key for each will 
        // start from 0 
        array_slice($random ,0,2),
        array_slice($random ,3,5),
        array_slice($random ,6,8),
        array_slice($random ,9,11),
        array_slice($random ,12,14),
        array_slice($random ,15,17),
        array_slice($random ,18,20),
        array_slice($random ,21,23),
        array_slice($random ,24,26),
        array_slice($random ,27,29)
    ); 
    // print_r($data);
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
            <form>
                <div class="form-row">
                    <div class="form-group col-sm-1">
                        <label>K-Means</label>
                        <input type="number" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group col-sm-1">
                        <label>Clustering</label>
                        <input type="submit" class="btn btn-primary btn-sm" value="Submit">
                    </div>
                </div>
            </form>
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



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/jquery-3.4.1.slim.min.js"></script>
    <script src="assets/popper.min.js"></script>
    <script src="assets/bootstrap-4.4.1/js/bootstrap.min.js"></script>
</body>

</html>