<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('partials/head.php'); ?>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center logo-row">
            <div class="col-md-12 text-center">
                <img src="logo.png" alt="Watermark Logo" class="logo" style="width: 200px;">
            </div>
        </div>
        <!-- MultiStep Form -->
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form id="msform" action="thanks.php" method="POST">
                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active">Terms & Condition</li>
                        <li>Personal Information</li>
                        <li>Contact Information</li>
                        <li>Occupation Details</li>
                        <li>Address</li>
                    </ul>
                    <fieldset>
                        <h2 class="fs-title">Terms and Conditions</h2>
                        <h3 id="termsWarning">All Terms & Condition are required </h3>
                        <label class="checkBox">
                            <input name="checkBox1" type="checkbox" required>
                            Yes, I have read and understand the
                            <a class="corp-blue" target="_blank" href="privacy.php"><strong>Privacy Policy
                                </strong></a>
                        </label>
                        <label class="checkBox">
                            <input name="checkBox2" type="checkbox" required>
                            Yes, I have read and understand the
                            <a class="corp-blue" target="_blank" href="terms-of-service.php"><strong> Membership Terms & Conditions
                                </strong></a>
                        </label>
                        <label class="checkBox">
                            <input name="checkBox3" type="checkbox" required>
                            Yes, I have read and understand the
                            <a class="corp-blue" target="_blank" href="terms-rewards.php"><strong> Rewards Program Terms
                                </strong></a>
                        </label>
                        <label class="checkBox">
                            <input name="checkBox4" type="checkbox" required>
                            Yes, I agree to be contacted by Infosecmarketinsights about updates, services, and offers.
                            We promise no third parties will contact you
                        </label>
                        <input type="button" name="next" id="checkTermsButton" class="next action-button" value="Next" disabled />
                    </fieldset>

                    <fieldset>
                        <h2 class="fs-title">Personal Information</h2>
                        <h3 class="fs-warning">*All Fields are required</h3>
                        <label for="fname">First Name</label>
                        <input type="text" id="fname" name="fName" placeholder="First Name" required />
                        <label for="lName">Last Name</label>
                        <input type="text" id="lName" name="lName" placeholder="Last Name" required />
                        <label for="gender">Gender</label>
                        <select name="gender" class="form-input" id="gender" required>
                            <option value="m">Male</option>
                            <option value="f">Female</option>
                            <option value="o" selected>Other</option>
                        </select>
                        <label for="mStatus">Marital Status</label>
                        <select name="maritalStatus" class="form-input" id="mStatus" required>
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="widowed">Widowed</option>
                            <option value="divorced">Divorced</option>
                            <option value="separated">Separated</option>
                            <option value="na" selected>Not To Disclose</option>
                        </select>
                        <label for="age">Age</label>
                        <input type="number" name="age" id="age" placeholder="Please Enter Your Age" required />
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        <input type="button" name="next" class="next action-button" value="Next" />
                    </fieldset>

                    <fieldset>
                        <h2 class="fs-title">Contact Information</h2>
                        <h3 class="fs-warning">*All Fields are required</h3>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Email" required />
                        <label for="phone">Phone Number</label>
                        <div class="input-group">
                            <div class="input-group-btn">
                                <select class="form-control" id="countryCode" style="min-height: 51px; min-width: 100px;" name="dialCode" required>
                                </select>
                            </div>
                            <input type="number" id="phone" name="phone" placeholder="Contact Number" required />
                        </div>
                        <label for="password">Create Password</label>
                        <div class="input-group">
                            <input type="password" id="password" name="password" placeholder="Create Password" required />
                            <span class="input-group-btn">
                                <button class="btn btn-default toggle-password" type="button" style="min-height: 50px; margin-top: -10px;">
                                    <i class='fa fa-eye-slash'></i>
                                </button>
                            </span>
                        </div>
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        <input type="button" name="next" class="next action-button" value="Next" />
                    </fieldset>

                    <fieldset>
                        <h2 class="fs-title">Occupation Details</h2>
                        <h3 class="fs-warning">*All Fields are required</h3>
                        <label for="jPosition">Job Position</label>
                        <input type="text" id="jPosition" name="jPosition" placeholder="Enter Your Job Position" required />
                        <label for="industry">Industry Where You Work</label>
                        <input type="text" id="industry" name="industry" placeholder="Industry Where You Work" required />
                        <label for="hIncome">Household Income</label>
                        <input type="text" id="hIncome" name="hIncome" placeholder="Household Income" required />
                        <label for="revenue">Company Last Year Revenue</label>
                        <input type="text" id="revenue" name="revenue" placeholder="Company Revenue" required />
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        <input type="button" name="next" class="next action-button" value="Next" />
                    </fieldset>

                    <fieldset>
                        <h2 class="fs-title">Address</h2>
                        <h3 class="fs-warning">*All Fields are required</h3>
                        <label for="country">Country Name</label>
                        <select class="form-input" id="country" name="country" required>
                        </select>
                        <label for="state">State</label>
                        <input type="text" id="state" name="state" placeholder="Enter Your State" required />
                        <label for="pAddress">Address</label>
                        <input type="text" id="pAddress" name="pAddress" placeholder="Permanent Location" required />
                        <label for="pZipCode">Zip Code</label>
                        <input type="text" id="pZipCode" name="pZipCode" placeholder="Zip Code" required />
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        <input type="submit" name="submit" class="submit action-button" />
                    </fieldset>
                </form>
            </div>
        </div>

        <div class="row justify-content-center align-items-center copyright-row ">
            <div class="col-md-6 text-center">
                <p class="fs-copyrigt">
                    <a href="privacy.php">Privacy Policy</a> |
                    <a href="terms-of-service.php">Membership </a> |
                    <a href="terms-rewards.php">Reward Programs Terms & Condition</a>
                </p>
            </div>
            <div class="col-md-6">
                <p class="fs-copyrigt">Copyright &copy; 2023 Infosecmarketinsights. All rights reserved.</p>
            </div>
        </div>
    </div>
    <!-- maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js -->
    <script src="asset/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>

</html