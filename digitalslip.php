<!DOCTYPE html>
<html lang="en">
<?php
include_once("_conn/connection.php");
include_once("_conn/session.php");
include("backend/be_digislip.php");
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Request Slip</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }

        .container {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            gap: 0;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header img {
            height: 50px;
        }

        .header .school-name {
            text-align: center;
        }

        .header .school-name h1 {
            margin: 0;
            font-size: 24px;
        }

        .header .school-address {
            text-align: right;
        }

        .box {
            flex: 1 1 calc(50% - 20px);
            padding: 15px;
            background-color: #fff;
            border: 1px solid #dddddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            min-width: 300px;
            margin-bottom: 20px;
        }

        .box h3 {
            text-align: center;
            margin-bottom: 15px;
            font-size: 18px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 10px;
        }

        .row .column {
            flex: 1;
        }

        .box input[type="text"],
        .box input[type="date"] {
            width: 300px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-top: 5px;
        }

        .letter-format {
            padding: 20px;
            background-color: #fff;
            border: 1px solid #dddddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            white-space: pre-wrap;
            margin: auto;
            width: 100%;
        }

        .letter-format p {
            margin: 0;
            padding: 0;
        }

        .letter-format .line {
            border-bottom: 1px solid #000;
            margin: 10px 0;
            height: 1px;
        }

        .signature-section {
            margin-top: 20px;
            text-align: right;
        }

        .signature-section .line {
            border-bottom: 1px solid #000;
            width: 200px;
            height: 2px;
            margin-top: 5px;
            display: inline-block;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
        }

        @media (max-width: 100%) {
            .box {
                flex: 1 1 100%;
            }
        }

        @page {
            size: 8.5in 11in;
            margin: 1in;
        }

        .bond-paper {
            width: 8.5in;
            height: 11in;
            padding: 1in;
            box-sizing: border-box;
        }
    </style>
</head>


<body>
    <div class="bond-paper">
        <div class="header">
            <img src="https://scontent.fmnl17-5.fna.fbcdn.net/v/t39.30808-6/242176111_831726460847177_4684566616663501396_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=6ee11a&_nc_ohc=PEbMgDS12I4Q7kNvgGxWibl&_nc_ht=scontent.fmnl17-5.fna&_nc_gid=AFIfoWI4xwmnTLZBdT6W3a-&oh=00_AYC0FxZ_A4iWMS2anxa3vFhOV3OAmrNtE6yqh-XB9Jk1Dw&oe=66E353A7" alt="School Logo">
            <div class="school-name">
                <h1>San Pablo National High School</h1>
                <p>San Pablo, Jaen, Nueva Ecija</p>
            </div>
            <img src="https://upload.wikimedia.org/wikipedia/commons/f/fa/Seal_of_the_Department_of_Education_of_the_Philippines.png" alt="Other Logo">
        </div>


        <div class="container">
            <div class="box">
                <h3>Student Information</h3>
                <div class="row">
                    <div class="column">
                        <label for="lrn"><strong>LRN: </strong><?php echo $_SESSION['studentId'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label for="name"><strong>Name: </strong><?php echo $_SESSION['fullName'] ?></label>
                    </div>
                    <div class="column">
                        <label for="gradeLevel"><strong>Grade Level: </strong><?php echo $row['gradelvl'] ?></label>
                    </div>
                </div>
            </div>
            <!-- CHANGE TO TABLE FOR MULTIPLE CLAIM REQUEST -->
            <div class="box">
                <h3>Document Details</h3>
                <div class="row">
                    <div class="column">
                        <label for="gradeLevel"><strong>Grade Level</strong></label>
                        <br>
                        <?php echo $row['gradelvl'] ?>
                    </div>
                    <div class="column">
                        <label for="document"><strong>Document</strong></label>
                        <br>
                        <?php echo $row['reqDoc'] ?>
                    </div>
                    <div class="column">
                        <label for="dateRequested"><strong>Date Requested</strong></label>
                        <br>
                        <?php echo $row['reqDate'] ?>
                    </div>
                </div>
            </div>

            <div class="letter-format">
                <p>To Whom It May Concern,</p>
                <p style="font-size:14px">
                <p>I, <i style="font-family:'Courier New'; text-decoration: underline;"><?php echo $_SESSION['fullName'] ?><i style="font-size:12px;">(student name)</i> </i>, hereby authorize <i style="font-family:'Courier New'"><i style="font-size:12px;">(authorized person)</i></i></i> ____________________________ to claim my document on my behalf.</p>
                </p>

                <div class="signature-section">
                    <div class="line"></div>
                    <i>Student Signature </i>

                </div>
            </div>
        </div>
        <div class="footer">
            <p>Thank you for your request!</p>
            <p><em>Please keep this slip for your records.</em></p>
        </div>
    </div>
</body>

</html>