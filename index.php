<?php
$conn = mysqli_connect('localhost', 'root', NULL, 'survey_data');

if (!$conn) {
    echo 'Connection Error: ' . mysqli_connect_error();
}


$today = date("Y-m-d");
$minDate = date("Y-m-d", strtotime("-120 years", strtotime($today)));
$maxDate = date("Y-m-d", strtotime("-5 years", strtotime($today)));

//get last userID
function getLastUser($conn) {
    $sql = "SELECT MAX(userID) as lastID FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastUserID = $row['lastID'];
        return $lastUserID;
    } else {
        echo "No results";
    }
}


$lastUser = getLastUser($conn);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    //Users Table
    $user_name = $_POST["user_name"];
    $user_email = $_POST["user_email"];
    $user_dob = $_POST["user_dob"];
    $user_contact_number = $_POST["user_contact_number"];

    //Data Table
    
    $favoriteFood = implode(", ", $_POST["food"]);
    $moviesRating = $_POST["movies"];
    $radioRating = $_POST["radio"];
    $eatOutRating = $_POST["eat_out"];
    $tvRating = $_POST["watch_tv"];
    $userID = $lastUser + 1;
    

if (empty($user_name) || empty($user_email) || empty($user_dob) || empty($user_contact_number) ) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Please fill out all the fields.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
      
} else {
    // Insert data into the database
    $sql1 = "INSERT INTO users (userID, userName,userEmail,userDOB,userContact) VALUES ('$userID', '$user_name', '$user_email', '$user_dob', '$user_contact_number')";

    if ($conn->query($sql1) === TRUE) {
        

        $sql2 = "INSERT INTO userdata (userID,favoriteFood,moviesRating,radioRating,eatOutRating,tvRating) VALUES ('$userID', '$favoriteFood', '$moviesRating', '$radioRating', '$eatOutRating', '$tvRating')";

        if ($conn->query($sql2) === TRUE) {

            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Great!</strong> You have successfully submitted your survey details.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';

        } else {
            echo "Error: " . $sql1 . "<br>" . $conn->error;
        };


    } else {
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    }
}
    // Close the database connection
    $conn->close();
}
?>



<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Survey</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
</head>

<body>
    <section>
        <div class="container">
            <div>
                <nav class="navbar navbar-expand-md bg-body">
                    <div class="container-fluid"><a class="navbar-brand" href="#" style="font-weight: bold;">_Surveys</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse justify-content-end" id="navcol-1">
                            <ul class="navbar-nav">
                                <li class="nav-item"><a class="nav-link active" href="index.php">Fill Out Survey</a></li>
                                <li class="nav-item"><a class="nav-link" href="results.php">View Survey Results</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="container">
            <div>
                <p class="lead text-center" style="margin-left: 50px;margin-right: 50px;margin-bottom: 0px;">Personal Details</p>
            </div>
            <div style="margin-right: 50px;margin-left: 50px;">
                <form class="justify-content-center align-items-center align-content-center" method="post">
                    <label class="form-label" style="margin-bottom: 0px;">Full Names</label>
                    <input class="form-control form-control-sm" type="text" required name="user_name" style="width: 40%;margin-bottom: 10px;">

                    <label class="form-label" style="margin-bottom: 0px;">Email</label>
                    <input class="form-control form-control-sm" required type="email" name="user_email" style="width: 40%;margin-bottom: 10px;">

                    <label class="form-label" style="margin-bottom: 0px;">Date Of Birth</label>
                    <input class="form-control form-control-sm" required type="date" name="user_dob" min="<?php echo $minDate; ?>" max="<?php echo $maxDate; ?>" style="width: 3%; margin-bottom: 10px;">

                    <label class="form-label" style="margin-bottom: 0px;">Contact Number</label>
                    <input class="form-control form-control-sm" required type="text" name="user_contact_number" minlength="9" maxlength="11" style="width: 40%;margin-bottom: 10px;">

                    <p class="lead text-center" style="margin-left: 50px;margin-right: 50px;margin-bottom: 0px;margin-top: 50px;">What Is Your Favorite Food?&nbsp;</p>

                    <div class="d-flex justify-content-center" style="margin-top: 10px;">
                        <div class="form-check" style="margin-bottom: 10px;margin-right: 20px;">
                            <input class="form-check-input" type="checkbox" id="formCheck-1" name="food[]" value="Pizza">
                            <label class="form-check-label" for="formCheck-1">Pizza</label>
                        </div>

                        <div class="form-check" style="margin-bottom: 10px;margin-right: 20px;">
                            <input class="form-check-input" type="checkbox" id="formCheck-4" name="food[]" value="Pasta">
                            <label class="form-check-label" for="formCheck-4">Pasta</label>
                        </div>

                        <div class="form-check" style="margin-bottom: 10px;margin-right: 20px;">
                            <input class="form-check-input" type="checkbox" id="formCheck-3" name="food[]" value="Pap and Wors">
                            <label class="form-check-label" for="formCheck-3">Pap and Wors</label>
                        </div>

                        <div class="form-check" style="margin-bottom: 10px;margin-right: 20px;">
                            <input class="form-check-input" type="checkbox" id="formCheck-2" name="food[]" value="Other">
                            <label class="form-check-label" for="formCheck-2">Other</label>
                        </div>
                    </div>

                    <div>
                        <p class="lead text-center" style="margin-left: 50px;margin-right: 50px;margin-bottom: 0px;margin-top: 50px;font-size: 18px;">Please rate your level of agreement on a scale of 1 to 5, with 1 being "strongly agree" and 5 being "Strongly disagree."</p>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th></th>
                                        <th>Strongly Agree</th>
                                        <th><strong>Agree</strong></th>
                                        <th>Neutral</th>
                                        <th><strong>Disagree</strong></th>
                                        <th><strong>Strongly Disagree</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>I like to watch movies</td>
                                        <td class="text-center"><input type="radio" name="movies" value="1" required></td>
                                        <td class="text-center"><input type="radio" name="movies" value="2"></td>
                                        <td class="text-center"><input type="radio" name="movies" value="3"></td>
                                        <td class="text-center"><input type="radio" name="movies" value="4"></td>
                                        <td class="text-center"><input type="radio" name="movies" value="5"></td>
                                    </tr>
                                    <tr>
                                        <td>I like to listen to radio</td>
                                        <td class="text-center"><input type="radio" name="radio" value="1" required></td>
                                        <td class="text-center"><input type="radio" name="radio" value="2"></td>
                                        <td class="text-center"><input type="radio" name="radio" value="3"></td>
                                        <td class="text-center"><input type="radio" name="radio" value="4"></td>
                                        <td class="text-center"><input type="radio" name="radio" value="5"></td>
                                    </tr>
                                    <tr>
                                        <td>I like to eat out</td>
                                        <td class="text-center"><input type="radio" name="eat_out" value="1" required></td>
                                        <td class="text-center"><input type="radio" name="eat_out" value="2"></td>
                                        <td class="text-center"><input type="radio" name="eat_out" value="3"></td>
                                        <td class="text-center"><input type="radio" name="eat_out" value="4"></td>
                                        <td class="text-center"><input type="radio" name="eat_out" value="5"></td>
                                    </tr>
                                    <tr>
                                        <td>I like to watch TV</td>
                                        <td class="text-center"><input type="radio" name="watch_tv" value="1" required></td>
                                        <td class="text-center"><input type="radio" name="watch_tv" value="2"></td>
                                        <td class="text-center"><input type="radio" name="watch_tv" value="3"></td>
                                        <td class="text-center"><input type="radio" name="watch_tv" value="4"></td>
                                        <td class="text-center"><input type="radio" name="watch_tv" value="5"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit" value="Submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>