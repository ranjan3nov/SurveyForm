<?php
include_once('../db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['code'])) {
    $verificationCode = $_GET['code'];

    // Check if the verification code exists in the database
    $sql = "SELECT email FROM verificationCodes WHERE code = '$verificationCode'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];

        // Update user's account status as verified
        $updateSql = "UPDATE surveyForm SET is_verified = 1 WHERE email = '$email'";
        if ($conn->query($updateSql) === TRUE) {
            echo "Your account has been successfully verified!";
            // You can also delete the verification code from the verificationCodes table
            $deleteSql = "DELETE FROM verificationCodes WHERE code = '$verificationCode'";
            $conn->query($deleteSql);
        } else {
            echo "Error updating account verification status: " . $conn->error;
        }
    } else {
        echo "Invalid verification code.";
    }
} else {
    // echo "Invalid request.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infosecmarketinsights | Survey</title>
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900&display=swap');

        html,
        body {
            font-family: 'Raleway', sans-serif;
        }

        .thankyou-page ._header {
            padding: 0px 0px;
            text-align: center;
        }

        .thankyou-page ._header .logo {
            max-width: 250px;
            margin: 0 auto;
        }

        .thankyou-page ._header .logo img {
            width: 100%;
        }

        .thankyou-page ._body {
            margin: -70px 0 30px;
        }

        .thankyou-page ._body ._box {
            margin: auto;
            max-width: 80%;
            padding: 50px;
            background: white;
            border-radius: 3px;
            box-shadow: 0 0 35px rgba(10, 10, 10, 0.12);
            -moz-box-shadow: 0 0 35px rgba(10, 10, 10, 0.12);
            -webkit-box-shadow: 0 0 35px rgba(10, 10, 10, 0.12);
        }

        .thankyou-page ._body ._box h1 {
            font-size: 35px;
            text-align: center;
            margin: 0;
        }

        .thankyou-page ._body ._box h2 {
            font-size: 20px;
            font-weight: 600;
            color: #FF8C00;
        }

        .thankyou-page ._footer {
            text-align: center;
            padding: 50px 30px;
        }

        /* .thankyou-page ._footer .btn {
            background: #4ab74a;
            color: white;
            border: 0;
            font-size: 14px;
            font-weight: 600;
            border-radius: 0;
            letter-spacing: 0.8px;
            padding: 20px 33px;
            text-transform: uppercase;
        } */
    </style>
</head>

<body>
    <div class="thankyou-page">
        <div class="_header">
            <div class="logo">
                <img src="../logo.png" alt="InfosecmarketInsight" style="margin: -30px 0px 35px 0px;">
            </div>

        </div>
        <div class="_body">
            <div class="_box">
                <h1>Thanks For Verifying your email!</h1>
                <h2 class="text-center">
                    <strong>Your Account is under Process </strong> We will Respond You Soon
                </h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 text-center">
                <p class="fs-copyrigt">
                    <a href="../privacy.html">Panel Privacy Policy</a> |
                    <a href="../terms-of-service.html">Membership </a> |
                    <a href="../terms-rewards.html">Reward Programs Terms & Condition</a>
                </p>
            </div>
            <div class="col-md-6">
                <p class="fs-copyrigt">Copyright &copy; 2023 Infosecmarketinsights. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>

</html>