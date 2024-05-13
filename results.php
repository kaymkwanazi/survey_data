<?php
$conn = mysqli_connect('localhost', 'root', NULL, 'survey_data');

if (!$conn) {
    echo 'Connection Error: ' . mysqli_connect_error();
}

//total number of surveys
function getTotalSurveys($conn) {
    $sql = "SELECT COUNT(userDataID) as totalSurveys FROM userData;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $numSurveys = $row['totalSurveys'];
        return $numSurveys;
    } else {
        echo "No results";
    }
}
$totalSurveys = getTotalSurveys($conn);
//print_r($totalSurveys);

//max age
function getMaxAge($conn) {
    $sql = "SELECT MAX(TIMESTAMPDIFF(YEAR, u.userDOB, CURDATE())) AS max_age FROM userData d
    join users u 
    on u.userID = d.userID;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $age = $row['max_age'];
        return $age;
    } else {
        echo "No results";
    }
}
$maxAge = getMaxAge($conn);

//min age
function getMinAge($conn) {
    $sql = "SELECT MIN(TIMESTAMPDIFF(YEAR, u.userDOB, CURDATE())) AS min_age FROM userData d
    join users u 
    on u.userID = d.userID;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $age = $row['min_age'];
        return $age;
    } else {
        echo "No results";
    }
}
$minAge = getMinAge($conn);

//avarage age
function getAveAge($conn) {
    $sql = "SELECT ROUND(AVG(TIMESTAMPDIFF(YEAR, u.userDOB, CURDATE())), 1) AS average_age 
    FROM userData d 
    JOIN users u ON u.userID = d.userID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $age = $row['average_age'];
        return $age;
    } else {
        echo "No results";
    }
}
$averageAge = getAveAge($conn);


//number of people who like pizza
function getPizzaLovers($conn) {
    $sql = "SELECT COUNT(userDataID) as pizzaLovers FROM userData
    WHERE favoriteFood LIKE '%Pizza%';";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $age = $row['pizzaLovers'];
        return $age;
    } else {
        echo "No results";
    }
}
$numPizzaLovers = getPizzaLovers($conn);

$pizzaLoversPerc = ($numPizzaLovers/$totalSurveys) * 100;


//number of people who like pasta
function getPastaLovers($conn) {
    $sql = "SELECT COUNT(userDataID) as pastaLovers FROM userData
    WHERE favoriteFood LIKE '%Pasta%';";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $age = $row['pastaLovers'];
        return $age;
    } else {
        echo "No results";
    }
}
$numPastaLovers = getPastaLovers($conn);

$pastaLoversPerc = ($numPastaLovers/$totalSurveys) * 100;


//number of people who like pap
function getPapLovers($conn) {
    $sql = "SELECT COUNT(userDataID) as papLovers FROM userData
    WHERE favoriteFood LIKE '%Pap%';";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $age = $row['papLovers'];
        return $age;
    } else {
        echo "No results";
    }
}
$numPapLovers = getPapLovers($conn);

$papLoversPerc = ($numPapLovers/$totalSurveys) * 100;



//Average moview ratings
function getMoviesAvg($conn) {
    $sql = "SELECT  ROUND(AVG(moviesRating),1) as averageMovies FROM userData";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $age = $row['averageMovies'];
        return $age;
    } else {
        echo "No results";
    }
}
$movieLovers = getMoviesAvg($conn);

//Average radio ratings
function getRadioAvg($conn) {
    $sql = "SELECT  ROUND(AVG(radioRating),1) as averageRadio FROM userData";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $age = $row['averageRadio'];
        return $age;
    } else {
        echo "No results";
    }
}
$radioLovers = getRadioAvg($conn);

//Average eat out ratings
function getEOAvg($conn) {
    $sql = "SELECT  ROUND(AVG(eatOutRating),1) as averageEO FROM userData";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $age = $row['averageEO'];
        return $age;
    } else {
        echo "No results";
    }
}
$EOLovers = getEOAvg($conn);


//Average eat out ratings
function getTVAvg($conn) {
    $sql = "SELECT  ROUND(AVG(tvRating),1) as averageTV FROM userData";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $age = $row['averageTV'];
        return $age;
    } else {
        echo "No results";
    }
}
$TVLovers = getTVAvg($conn);


$conn->close();
?>

<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Software dev kamo</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
</head>

<body>
    <section>
        <div class="container">
            <div>
                <nav class="navbar navbar-expand-md bg-body">
                    <div class="container-fluid"><a class="navbar-brand" style="font-weight: bold;">_Surveys</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse justify-content-end" id="navcol-1">
                            <ul class="navbar-nav">
                                <li class="nav-item"><a class="nav-link" href="index.php">Fill Out Survey</a></li>
                                <li class="nav-item"><a class="nav-link active" href="results.php">View Survey Results</a></li>
                                <li class="nav-item"></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="container">

            <div>
                 <p class="lead text-center" style="margin-left: 50px;margin-right: 50px;margin-bottom: 0px;">Survey Results</p>
            </div>

            <div>
                <p style="margin-right: 100px;margin-left: 100px;margin-top: 50px;margin-bottom: 0px; width: 900px">Total number of surveys:<span class="float-end"><?php echo $totalSurveys ?></span></p>
                <p style="margin-right: 100px;margin-left: 100px;margin-top: 2px;margin-bottom: 0px; width: 900px">Average Age:<span class="float-end"><?php echo $averageAge ?></span></p>
                <p style="margin-right: 100px;margin-left: 100px;margin-top: 2px;margin-bottom: 0px; width: 900px">Oldest person who participated in the survey:<span class="float-end"><?php echo $maxAge ?> years old.</span></p>
                <p style="margin-right: 100px;margin-left: 100px;margin-top: 2px;margin-bottom: 0px; width: 900px">Youngest person who participated in the survey:<span class="float-end"><?php echo $minAge ?> years old.</span></p>

                <p style="margin-right: 100px;margin-left: 100px;margin-top: 50px;margin-bottom: 0px; width: 900px">Percentage of people who like Pizza:<span class="float-end"><?php echo round($pizzaLoversPerc,2) ?>%</span></p>
                <p style="margin-right: 100px;margin-left: 100px;margin-top: 2px;margin-bottom: 0px; width: 900px">Percentage of people who like Pasta:<span class="float-end"><?php echo round($pastaLoversPerc,2) ?>%</span></p>
                <p style="margin-right: 100px;margin-left: 100px;margin-top: 2px;margin-bottom: 0px; width: 900px">Percentage of people who like Pap and Wors:<span class="float-end"><?php echo round($papLoversPerc,2) ?>%</span></p>

                <p style="margin-right: 100px;margin-left: 100px;margin-top: 50px;margin-bottom: 0px; width: 900px">People who like to watch movies:<span class="float-end"><?php echo $movieLovers ?></span></p>
                <p style="margin-right: 100px;margin-left: 100px;margin-top: 2px;margin-bottom: 0px; width: 900px">People who like to listen to the radio:<span class="float-end"><?php echo $radioLovers ?></span></p>
                <p style="margin-right: 100px;margin-left: 100px;margin-top: 2px;margin-bottom: 0px; width: 900px">People who like to eat out:<span class="float-end"><?php echo $EOLovers ?></span></p>
                <p style="margin-right: 100px;margin-left: 100px;margin-top: 2px;margin-bottom: 0px; width: 900px">People who like to watch TV:<span class="float-end"><?php echo $TVLovers ?></span></p>
            </div>

        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>