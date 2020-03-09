<?php
$IsEmailSent = false;
include "./imports.php";
unset($_SESSION["ULanding"]); //clear session variable
?>
<!DOCTYPE html>
<html>

<head>
    <title>The Hazeley Academy - Reprographics</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="/Images/Badge.png" type="image/png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $(':input').change(function() {
                $(this).closest('div').find('span').hide();
                $('#errorHeader').hide();
            });
        });
    </script>

</head>

<body>
    <header>
        <img src="/Images/hazeleybanner.jpg" width=100% height=150px alt="badge" />
    </header>

    <nav>
        <div class="row mt-2">
            <div class="col align-self-start">
                <a href="/choices.php"><img src=/Images/ButtonHome.png width="100"></a>
            </div>
            <div class="col-6 align-self-center">

            </div>
            <div class="col align-self-end">
                <?php
                echo "<b>" . $_SESSION['LFirstname'] . " " . $_SESSION['LLastname'] . "</b>";
                ?>
                <a href="/Includes/LogOut.php"><img src=/Images/ButtonLogOut.png width="100"></a>

            </div>

        </div>

    </nav>

    <section class="container w-75">
        <div class="row">
            <div class="col">
                <h4 style="text-align: left;display: block;">Reprographic Requirement Form</h4>
                <h6 style="text-align: left; display: block;">Please use this form to request printing or copying, etc</h5>
                    <?php echo isset($_SESSION['errors']) ?  ' <span class="errorText">Please correct the fields in error and continue.</span>' :  ''; ?>
                    <?php if ($IsEmailSent === TRUE)    echo '<strong><span class="errorText">Your request has been emailed to Reprographics.</span></strong>'; ?>

            </div>
        </div>
        <hr />
        <div class="row justify-content-center">
            <form class="col" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" role="form" enctype="multipart/form-data" id="requirmentForm" name="requirmentForm">
                <input type="hidden" id="firstname" name="firstname" value="<?php echo isset($_SESSION['LUser']) ? $_SESSION['LFirstname'] . " " . $_SESSION['LLastname'] : ''; ?>">
                <input type="hidden" id="fromEmail" name="fromEmail" value="<?php echo isset($_SESSION['LUser']) ? $_SESSION['LEmail'] : ''; ?>">
                <div class="form-group required w-25">
                    <label for="department" class="control-label">Budget/Department:</label>
                    <select name="department" class="form-control" id="department">
                        <option value="">--Please select--</option>
                        <?php
                        foreach ($DEPARTMENT_CONFIG as $key => $value) {
                            if (isset($_POST["department"]) && $_POST["department"] == $value) {
                                echo "<option value='$key' selected>$value</key>";
                            } else {
                                echo "<option value='$key'>$value</key>";
                            }
                        }
                        ?>
                    </select>
                    <?php if (isset($_SESSION['errors']['departmentError'])) echo ' <span class="errorText">' . $_SESSION['errors']['departmentError'] . '</span>'; ?>

                </div>
                <div class="form-group required w-25">
                    <label for="printCopies" class="control-label">Number of Copies:</label>
                    <input class="form-control" type="number" name="printCopies" value="<?php echo isset($_POST["printCopies"]) ? $_POST["printCopies"] : ''; ?>" min="1" maxlength="1000" placeholder="Copies to Print">
                    <?php if (isset($_SESSION['errors']['printCopiesError'])) echo ' <span class="errorText">' . $_SESSION['errors']['printCopiesError'] . '</span>'; ?>
                </div>
                <div class="form-group required w-25">
                    <label for="Dates" class="control-label">Date Required:</label>
                    <input class="form-control" type="date" id="Dates" value='<?php echo isset($_POST["Dates"]) ? $_POST["Dates"] : ''; ?>' onkeydown="return false" name="Dates" min="<?php echo date('Y-m-d') ?>" data-date-format="DD MMMM YYYY">
                    <?php if (isset($_SESSION['errors']['printDateError'])) echo ' <span class="errorText">' . $_SESSION['errors']['printDateError'] . '</span>'; ?>
                </div>
                <div class="form-group required w-25">
                    <label for="period" class="control-label">Period Required:</label>
                    <select name="period" class="form-control">
                        <option value="">--Please select--</option>
                        <?php
                        foreach ($PERIOD_CONFIG as $key => $value) {
                            if (isset($_POST["period"]) && $_POST["period"] == $value) {
                                echo "<option value='$key' selected>$value</key>";
                            } else {
                                echo "<option value='$key'>$value</key>";
                            }
                        }
                        ?>
                    </select>
                    <?php if (isset($_SESSION['errors']['periodError'])) echo ' <span class="errorText">' . $_SESSION['errors']['periodError'] . '</span>'; ?>
                </div>

                <div class="form-group required w-25">
                    <p class="form-check-label">Urgently Required :</p>
                    <div class="form-check-inline">
                        <input type="radio" class="form-check-input" value="Yes" name="urgentlyRequired" <?php if (isset($_POST["urgentlyRequired"]) && $_POST["urgentlyRequired"] == "Yes") print(" checked") ?>>Yes
                    </div>

                    <div class="form-check-inline">
                        <input type="radio" class="form-check-input" value="No" name="urgentlyRequired" <?php if (isset($_POST["urgentlyRequired"]) && $_POST["urgentlyRequired"] == "No") print(" checked") ?>>No
                    </div>

                    <div>
                        <?php if (isset($_SESSION['errors']['urgentlyRequiredError'])) echo ' <span class="errorText">' . $_SESSION['errors']['urgentlyRequiredError'] . '</span>'; ?>
                    </div>

                </div>


                <div class="form-group required w-50">
                    <div class="card">
                        <div class="card-header">
                            <h6>Print Requirements</h6>
                        </div>
                        <div class="card-body">
                            <p class="card-title">Standard prints will be double sided and black & white, If you need anything different from this please enter the specific details below.</p>
                        </div>
                        <ul class="list-group list-group-flush">

                            <?php
                            foreach ($PRINT_TYPE_CONFIG as $key => $value) {

                                if (!empty($_POST['check_list'])) {
                                    if (in_array($value, $_POST['check_list']) === true) {
                                        echo
                                            "<li class='list-group-item py-0'>
                                                <div class='required row'>
                                                    <div class='col'>
                                                    <label class='checkbox'>$value</label>
                                                    </div>
                                                    <div class='col'>
                                                    <input type='checkbox' name='check_list[]' checked value=$value>
                                                    </div>
                                                </div>
                                            </li>";
                                    } else {
                                        echo
                                            "<li class='list-group-item py-0'>
                                        <div class='required row'>
                                            <div class='col'>
                                            <label class='checkbox'>$value</label>
                                            </div>
                                            <div class='col'>
                                            <input type='checkbox' name='check_list[]' value=$value>
                                            </div>
                                        </div>
                                    </li>";
                                    }
                                } else {
                                    echo
                                        "<li class='list-group-item py-0'>
                                        <div class='required row'>
                                            <div class='col'>
                                            <label class='checkbox'>$value</label>
                                            </div>
                                            <div class='col'>
                                            <input type='checkbox' name='check_list[]' value=$value>
                                            </div>
                                        </div>
                                    </li>";
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>

                <div class="form-group required w-50" id="specialRequirementContainer">

                    <label for="specialRequirement" class="control-label-optional">Special Requirements:</label>
                    <?php
                    if (isset($_POST["specialRequirement"])) {
                        echo "<textarea class='form-control' rows='5' id='specialRequirement'  name='specialRequirement'  >" . $_POST['specialRequirement'] . "</textarea>";
                    } else {
                        echo "<textarea class='form-control' rows='5' id='specialRequirement'  name='specialRequirement'></textarea>";
                    }
                    ?>
                    <strong><span class="help-block">Please list other requirements not listed already, such
                            as
                            colored paper/card, laminated, binding
                            etc.</span>
                    </strong>

                </div>

                <div class="form-group required w-50" id="url">
                    <label for="url" class="control-label-optional">URL for print copies:</label>
                    <textarea class="form-control form-control-sm" rows="2" id="url" name="url"></textarea>
                </div>

                <div class="form-group required w-50">
                    <label for="uploadDocument" class="control-label-optional">Upload Document:</label>
                    <input type="file" name="uploadDocument[]" class="form-control-file border" id="uploadDocument" multiple>
                    <div>
                        <?php if (isset($_SESSION['errors']['uploadDocumentError'])) echo ' <span class="errorText">' . $_SESSION['errors']['uploadDocumentError'] . '</span>'; ?>
                    </div>
                </div>
                <div class="form-group w-25">
                    <input type="submit" id="submit" name="submit" class="btn btn-primary btn-block" value="Submit">
                </div>

            </form>
        </div>



    </section>

</body>

</html>