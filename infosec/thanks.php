<?php
require_once('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $checkBox1 = isset($_POST['checkBox1']) ? 'Yes' : 'No';
    $checkBox2 = isset($_POST['checkBox2']) ? 'Yes' : 'No';
    $checkBox3 = isset($_POST['checkBox3']) ? 'Yes' : 'No';
    $checkBox4 = isset($_POST['checkBox4']) ? 'Yes' : 'No';

    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $gender = $_POST['gender'];
    $maritalStatus = $_POST['maritalStatus'];
    $age = $_POST['age'];

    $email = $_POST['email'];
    $dialCode = $_POST['dialCode'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $jPosition = $_POST['jPosition'];
    $industry = $_POST['industry'];
    $hIncome = $_POST['hIncome'];
    $revenue = $_POST['revenue'];

    $country = $_POST['country'];
    $state = $_POST['state'];
    $pAddress = $_POST['pAddress'];
    $pZipCode = $_POST['pZipCode'];

    $sql = "INSERT INTO surveyForm (checkBox1, checkBox2, checkBox3, checkBox4, fName, lName, gender, maritalStatus, age, email, dialCode, phone, password, jPosition, industry, hIncome, revenue, country, state, pAddress, pZipCode) 
        VALUES ('$checkBox1', '$checkBox2', '$checkBox3', '$checkBox4', '$fName', '$lName', '$gender', '$maritalStatus', $age, '$email', '$dialCode', '$phone', '$password', '$jPosition', '$industry', '$hIncome', '$revenue', '$country', '$state', '$pAddress', '$pZipCode')";
    $insert = $conn->query($sql);
    if ($conn->query($sql) === TRUE) {
        // Data inserted successfully, now call the verification email functions
        sendVerificationEmail($conn, $email);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
function sendVerificationEmail($conn, $email)
{
    $verificationCode = generateVerificationCode();
    $verificationLink = "https://surveyform.infosecmarketinsights.com/verification/?code=" . $verificationCode;

    // echo $verificationLink;
    // Send email with verification link
    $subject = "Account Verification";
    // $message = "Click the following link to verify your account: $verificationLink";
    $message = "
            <html>
            <head>
                <style>
                    .button {
                        display: inline-block;
                        padding: 10px 20px;
                        background-color: #007bff;
                        color: #ffffff;
                        text-decoration: none;
                        border-radius: 4px;
                    }
                </style>
            </head>
            <body>
                <p>Click the button below to verify your account:</p>
                <a class='button' href='$verificationLink'>Verify Account</a>
            </body>
            </html>";
    $headers = "From: survey@infosecmarketinsights.com\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    if (mail($email, $subject, $message, $headers)) {
        storeVerificationCodeInDatabase($conn, $email, $verificationCode);
        return true;
    } else {
        return false;
    }
}

// Function to generate a random verification code
function generateVerificationCode()
{
    $length = 6;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $verificationCode = '';

    for ($i = 0; $i < $length; $i++) {
        $verificationCode .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $verificationCode;
}

function storeVerificationCodeInDatabase($conn, $email, $verificationCode)
{
    $email = $conn->real_escape_string($email);
    $verificationCode = $conn->real_escape_string($verificationCode);

    $sql = "INSERT INTO verificationCodes (email, code) VALUES ('$email', '$verificationCode')";

    if ($conn->query($sql) !== TRUE) {
        echo "Error storing verification code: " . $conn->error;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infosecmarketinsights | Survey</title>
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
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
                <img src="logo.png" alt="InfosecmarketInsight" style="margin: -30px 0px 35px 0px;">
            </div>

        </div>
        <div class="_body">
            <div class="_box">
                <h1>Thank You!</h1>
                <h2 class="text-center">
                    <strong>Please check your email</strong> We will Respond You Soon
                </h2>
                <p>
                    Thanks a bunch for filling that out. It means a lot to us, just like you do! We really appreciate you giving us a moment of your time today. Thanks for being you.
                </p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 text-center">
                <p class="fs-copyrigt">
                    <a href="privacy.html">Panel Privacy Policy</a> |
                    <a href="terms-of-service.html">Membership </a> |
                    <a href="terms-rewards.html">Reward Programs Terms & Condition</a>
                </p>
            </div>
            <div class="col-md-6">
                <p class="fs-copyrigt">Copyright &copy; 2023 Infosecmarketinsights. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>

</html>
<?php
$conn->close();
