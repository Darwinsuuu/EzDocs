<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Includes -->
    <?php
    include("_includes/styles.php");
    include("_includes/scripts.php");
    ?>

</head>

<body>

    <div class="flex flex-col items-center justify-center h-screen w-full">

        <div class="shadow-lg p-5 rounded">

            <div class="mb-4">
                <h1 class="text-[32px] !text-left">Welcome to EzDocs</h1>
                <p class="text-[14px] text-gray-600">
                    Kindly fill up the form for you to use our document request application.
                </p>
            </div>


            <?php

            if (isset($_GET['errorMsg'])) {
                echo "<div class='py-4 px-2 !bg-red-200 !text-red-700 rounded mb-4'>
                        <p class='!m-0 text-center font-medium'>" . $_GET['errorMsg'] . "</p>
                      </div>";
            }

            ?>


            <form class="w-full max-w-[650px]" method="POST" action="backend/be_registration.php">

                <p class="text-[14px] font-medium text-sky-600 mb-2">Personal Information</p>

                <div class="grid grid-cols-4 gap-x-3">
                    <div class="mb-3 col-span-4">
                        <label for="inputStudentId" class="form-label">Student ID</label>
                        <input type="text" class="form-control" id="inputStudentId" aria-describedby="studentId"
                            name="inputStudentId" required value="<?php if (isset($_GET['studentId'])) { echo $_GET['studentId']; } ?>">
                    </div>

                    <div class="mb-3 col-span-2">
                        <label for="inputFirstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="inputFirstname" aria-describedby="firstname"
                            name="inputFirstname" required value="<?php if (isset($_GET['firstname'])) { echo $_GET['firstname']; } ?>">
                    </div>

                    <div class="mb-3 col-span-2">
                        <label for="inputMiddlename" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="inputMiddlename" aria-describedby="middleName"
                            name="inputMiddlename" value="<?php if (isset($_GET['middlename'])) { echo $_GET['middlename']; } ?>">
                    </div>

                    <div class="mb-3 col-span-3">
                        <label for="inputLastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="inputLastname" aria-describedby="lastName"
                            name="inputLastname" required value="<?php if (isset($_GET['lastname'])) { echo $_GET['lastname']; } ?>">
                    </div>

                    <div class="mb-3 col-span-1">
                        <label for="inputSuffix" class="form-label">Suffix</label>
                        <input type="text" class="form-control" id="inputSuffix" aria-describedby="suffix"
                            name="inputSuffix" value="<?php if (isset($_GET['suffix'])) {echo $_GET['suffix']; } ?>">
                    </div>

                    <div class="mb-3 col-span-1">
                        <label for="inputGradeLevel" class="form-label">Grade Level</label>
                        <select class="form-control" name="inputGradeLevel" id="inputGradeLevel" required>
                            <option disabled selected></option>
                            <option value="7" <?php if (isset($_GET['gradeLevel']) && $_GET['gradeLevel'] == '7')
                                echo 'selected'; ?>>Grade 7</option>
                            <option value="8" <?php if (isset($_GET['gradeLevel']) && $_GET['gradeLevel'] == '8')
                                echo 'selected'; ?>>Grade 8</option>
                            <option value="9" <?php if (isset($_GET['gradeLevel']) && $_GET['gradeLevel'] == '9')
                                echo 'selected'; ?>>Grade 9</option>
                            <option value="10" <?php if (isset($_GET['gradeLevel']) && $_GET['gradeLevel'] == '10')
                                echo 'selected'; ?>>Grade 10
                            </option>
                            <option value="11" <?php if (isset($_GET['gradeLevel']) && $_GET['gradeLevel'] == '11')
                                echo 'selected'; ?>>Grade 11
                            </option>
                            <option value="12" <?php if (isset($_GET['gradeLevel']) && $_GET['gradeLevel'] == '12')
                                echo 'selected'; ?>>Grade 12
                            </option>
                        </select>

                    </div>

                    <div class="mb-3 col-span-3">
                        <label for="inputPhoneNumber" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="inputPhoneNumber" aria-describedby="phoneNumber"
                            name="inputPhoneNumber" required value="<?php if (isset($_GET['inputPhoneNumber'])) { echo $_GET['phoneNumber']; } ?>">
                    </div>

                </div>


                <p class="text-[14px] font-medium text-sky-600 mt-4 mb-2">Account Details</p>

                <div class="grid grid-cols-2 gap-x-3">

                    <div class="mb-3 col-span-2">
                        <label for="inputEmailAddress" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="inputEmailAddress" aria-describedby="emailAddress"
                            name="inputEmailAddress" required value="<?php if(isset($_GET['emailAddress'])) { echo $_GET['emailAddress']; } ?>">
                    </div>

                    <div class="mb-3 col-span-1">
                        <label for="inputPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="inputPassword" name="inputPassword" required>
                    </div>

                    <div class="mb-3 col-span-1">
                        <label for="inputConfirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="inputConfirmPassword"
                            name="inputConfirmPassword">
                    </div>

                </div>


                <button type="submit" class="btn btn-primary w-full py-3 mt-2" name="btnCreateAccount">Create
                    Account</button>

            </form>


        </div>

    </div>

</body>

</html>