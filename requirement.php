<?php
include 'upload.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>The Hazeley Academy - Reprographics</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" media="all" href="http://www.thehazeleyacademy.com/wp-content/themes/hazeley/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $(':input').change(function() {
                $(this).closest('div').find('span').hide();
            });
        });
    </script>

</head>

<body>

    <div id="top">
        <div id="header">
            <div id="headerL">
                <a href="http://www.thehazeleyacademy.com"><img src="http://www.thehazeleyacademy.com/wp-content/themes/hazeley/images/logo.png" alt="The Hazeley Academy"></a>
            </div>
        </div>
    </div>

    <h1 style="text-align: center;">Reprographic Requirement Form</h1>
    <strong>
        <p style="text-align: center;">Please use this form to request printing or copying, etc</p>
    </strong>
    <section>

        <div class="container mt-3">
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6">

                    <div class="required row">
                        <div class="col-sm-2"></div>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" role="form" enctype="multipart/form-data" id="requirmentForm" name="requirmentForm">
                        <div class="form-group required row">
                            <div class="col-md-2"></div>
                            <div class="col-md-9">
                                <label for="firstname" class="control-label">Name:</label>
                                <input type="text" class="form-control form-control-sm" id="firstname" placeholder="Enter Your Name" name="firstname" value="<?php echo isset($_POST["firstname"]) ? $_POST["firstname"] : ''; ?>">
                                <?php if (isset($_SESSION['errors']['firstnameError'])) echo ' <span for="firstname" class="errorText">' . $_SESSION['errors']['firstnameError'] . '</span>'; ?>
                            </div>

                        </div>

                        <div class="form-group required row">
                            <div class="col-md-2"></div>
                            <div class="col-md-9">
                                <label for="department" class="control-label">Budget/Department:</label>
                                <select name="department" class="form-control form-control-sm" id="department">
                                    <option value="">--Please select--</option>
                                    <option value="Administration" <?php if (isset($_POST["department"]) && $_POST["department"] == "Administration") print(" selected") ?>>Administration</option>
                                    <option value="6th Form" <?php if (isset($_POST["department"]) && $_POST["department"] == "6th Form") print(" selected") ?>>Administration/6th Form</option>
                                    <option value="Admissions" <?php if (isset($_POST["department"]) && $_POST["department"] == "Admissions") print(" selected") ?>>Administration/Admissions</option>
                                    <option value="Parents Evening" <?php if (isset($_POST["department"]) && $_POST["department"] == "Parents Evening") print(" selected") ?>>Administration/Parents Evening</option>
                                    <option value="Preferences" <?php if (isset($_POST["department"]) && $_POST["department"] == "Preferences") print(" selected") ?>>Administration/Preferences</option>
                                    <option value="Principals Office" <?php if (isset($_POST["department"]) && $_POST["department"] == "Principals office") print(" selected") ?>>Administration/Principals Office</option>
                                    <option value="Prom" <?php if (isset($_POST["department"]) && $_POST["department"] == "Prom") print(" selected") ?>>Administration/Prom</option>
                                    <option value="Reception" <?php if (isset($_POST["department"]) && $_POST["department"] == "Reception") print(" selected") ?>>Administration/Reception</option>
                                    <option value="Transition" <?php if (isset($_POST["department"]) && $_POST["department"] == "Transition") print(" selected") ?>>Administration/Transition</option>
                                    <option value="Trips" <?php if (isset($_POST["department"]) && $_POST["department"] == "Trips") print(" selected") ?>>administration/Trips</option>
                                    <option value="Work Experience" <?php if (isset($_POST["department"]) && $_POST["department"] == "Work Experience") print(" selected") ?>>Administration/Work Experience</option>
                                    <option value="Art" <?php if (isset($_POST["department"]) && $_POST["department"] == "Art") print(" selected") ?>>Art</option>
                                    <option value="BusinessStudies" <?php if (isset($_POST["department"]) && $_POST["department"] == "BusinessStudies") print(" selected") ?>>Business Studies</option>
                                    <option value="Catering" <?php if (isset($_POST["department"]) && $_POST["department"] == "Catering") print(" selected") ?>>Catering</option>
                                    <option value="Computer Science" <?php if (isset($_POST["department"]) && $_POST["department"] == "Computer Science") print(" selected") ?>>Computer Science</option>
                                    <option value="Cover" <?php if (isset($_POST["department"]) && $_POST["department"] == "Cover") print(" selected") ?>>Cover</option>
                                    <option value="Creative" <?php if (isset($_POST["department"]) && $_POST["department"] == "Creative") print(" selected") ?>>Creative</option>
                                    <option value="Dance" <?php if (isset($_POST["department"]) && $_POST["department"] == "Dance") print(" selected") ?>>Dance</option>
                                    <option value="Design" <?php if (isset($_POST["department"]) && $_POST["department"] == "Design") print(" selected") ?>>Design</option>
                                    <option value="DropDownDay" <?php if (isset($_POST["department"]) && $_POST["department"] == "DropDownDay") print(" selected") ?>>Drop Down Day</option>
                                    <option value="Duke of Edinburgh" <?php if (isset($_POST["department"]) && $_POST["department"] == "Duke of Edinburgh") print(" selected") ?>>Duke of Edinburgh</option>
                                    <option value="English" <?php if (isset($_POST["department"]) && $_POST["department"] == "English") print(" selected") ?>>English</option>
                                    <option value="Exams" <?php if (isset($_POST["department"]) && $_POST["department"] == "Exams") print(" selected") ?>>Exams</option>
                                    <option value="Excellence" <?php if (isset($_POST["department"]) && $_POST["department"] == "Excellence") print(" selected") ?>>Excellence</option>
                                    <option value="Finance" <?php if (isset($_POST["department"]) && $_POST["department"] == "Finance") print(" selected") ?>>Finance</option>
                                    <option value="Geography" <?php if (isset($_POST["department"]) && $_POST["department"] == "Geography") print(" selected") ?>>Geography</option>
                                    <option value="Hazeley Plus" <?php if (isset($_POST["department"]) && $_POST["department"] == "Hazeley Plus") print(" selected") ?>>Hazeley Plus</option>
                                    <option value="Health and Social" <?php if (isset($_POST["department"]) && $_POST["department"] == "Health and Social") print(" selected") ?>>Health and Social</option>
                                    <option value="History" <?php if (isset($_POST["department"]) && $_POST["department"] == "History") print(" selected") ?>>History</option>
                                    <option value="HR" <?php if (isset($_POST["department"]) && $_POST["department"] == "HR") print(" selected") ?>>HR</option>
                                    <option value="Humanities" <?php if (isset($_POST["department"]) && $_POST["department"] == "Humanities") print(" selected") ?>>Humanities</option>
                                    <option value="ICT" <?php if (isset($_POST["department"]) && $_POST["department"] == "ICT") print(" selected") ?>>ICT</option>
                                    <option value="Inset Training " <?php if (isset($_POST["department"]) && $_POST["department"] == "Inset Training") print(" selected") ?>>Inset Training</option>
                                    <option value="Intervention" <?php if (isset($_POST["department"]) && $_POST["department"] == "Intervention") print(" selected") ?>>Intervention</option>
                                    <option value="IT Support" <?php if (isset($_POST["department"]) && $_POST["department"] == "IT Support") print(" selected") ?>>IT Support</option>
                                    <option value="Law" <?php if (isset($_POST["department"]) && $_POST["department"] == "Law") print(" selected") ?>>Law</option>
                                    <option value="Library" <?php if (isset($_POST["department"]) && $_POST["department"] == "Library") print(" selected") ?>>Library</option>
                                    <option value="Maths" <?php if (isset($_POST["department"]) && $_POST["department"] == "Mathss") print(" selected") ?>>Maths</option>
                                    <option value="Media" <?php if (isset($_POST["department"]) && $_POST["department"] == "Media") print(" selected") ?>>Media</option>
                                    <option value="MFL" <?php if (isset($_POST["department"]) && $_POST["department"] == "MFL") print(" selected") ?>>MFL</option>
                                    <option value="MKHA" <?php if (isset($_POST["department"]) && $_POST["department"] == "MKHA") print(" selected") ?>>MKHA</option>
                                    <option value="Music" <?php if (isset($_POST["department"]) && $_POST["department"] == "Music") print(" selected") ?>>Music</option>
                                    <option value="Office" <?php if (isset($_POST["department"]) && $_POST["department"] == "Office") print(" selected") ?>>Office</option>
                                    <option value="Pastoral" <?php if (isset($_POST["department"]) && $_POST["department"] == "Pastoral") print(" selected") ?>>Pastoral</option>
                                    <option value="PE" <?php if (isset($_POST["department"]) && $_POST["department"] == "PE") print(" selected") ?>>PE</option>
                                    <option value="Personalisation" <?php if (isset($_POST["department"]) && $_POST["department"] == "Personalisation") print(" selected") ?>>Personalisation</option>
                                    <option value="Planners/Report Cards" <?php if (isset($_POST["department"]) && $_POST["department"] == "Planners/Report Cards") print(" selected") ?>>Personalisation/Planners/Report Cards</option>
                                    <option value="Summer 2019 Ready" <?php if (isset($_POST["department"]) && $_POST["department"] == "Summer 2019 Ready") print(" selected") ?>>Personalisation/Summer 2019 Ready</option>
                                    <option value="PSHE/Citezenship" <?php if (isset($_POST["department"]) && $_POST["department"] == "PSHE/Citezenship") print(" selected") ?>>PSHE/Citezenship</option>
                                    <option value="Psychology" <?php if (isset($_POST["department"]) && $_POST["department"] == "Psychology") print(" selected") ?>>Psychology</option>
                                    <option value="R2L" <?php if (isset($_POST["department"]) && $_POST["department"] == "R2L") print(" selected") ?>>R2L</option>
                                    <option value="Reprographics" <?php if (isset($_POST["department"]) && $_POST["department"] == "Reprographics") print(" selected") ?>>Reprographics</option>
                                    <option value="Science" <?php if (isset($_POST["department"]) && $_POST["department"] == "Science") print(" selected") ?>>Science</option>
                                    <option value="Senior Leadership Team" <?php if (isset($_POST["department"]) && $_POST["department"] == "Senior Leadership Team") print(" selected") ?>>Senior Leadership Team</option>
                                    <option value="Site Team" <?php if (isset($_POST["department"]) && $_POST["department"] == "Site Team") print(" selected") ?>>Site Team</option>
                                    <option value="SLT" <?php if (isset($_POST["department"]) && $_POST["department"] == "SLT") print(" selected") ?>>SLT</option>
                                    <option value="Sociology" <?php if (isset($_POST["department"]) && $_POST["department"] == "Sociology") print(" selected") ?>>Sociology</option>
                                    <option value="Students" <?php if (isset($_POST["department"]) && $_POST["department"] == "Students") print(" selected") ?>>Students</option>
                                    <option value="Textiles" <?php if (isset($_POST["department"]) && $_POST["department"] == "Textiles") print(" selected") ?>>Textiles</option>
                                    <option value="Wellbeing" <?php if (isset($_POST["department"]) && $_POST["department"] == "Wellbeing") print(" selected") ?>>Wellbeing</option>
                                    <option value="Other" <?php if (isset($_POST["department"]) && $_POST["department"] == "Other") print(" selected") ?>>Other</option>
                                </select>
                                <?php if (isset($_SESSION['errors']['departmentError'])) echo ' <span class="errorText">' . $_SESSION['errors']['departmentError'] . '</span>'; ?>
                            </div>
                        </div>



                        <div class="form-group required row">
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <label for="printCopies" class="control-label">Number of Copies:</label>
                                <input class="form-control form-control-sm" type="number" name="printCopies" value="<?php echo isset($_POST["printCopies"]) ? $_POST["printCopies"] : ''; ?>" min="1" maxlength="1000" placeholder="Copies to Print">
                                <?php if (isset($_SESSION['errors']['printCopiesError'])) echo ' <span class="errorText">' . $_SESSION['errors']['printCopiesError'] . '</span>'; ?>
                            </div>
                        </div>

                        <div class="form-group required row">
                            <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <label for="Dates" class="control-label">Date Required:</label>
                                <input class="form-control form-control-sm" type="date" id="Dates" value='<?php echo isset($_POST["Dates"]) ? $_POST["Dates"] : ''; ?>' onkeydown="return false" name="Dates" min="<?php echo date('Y-m-d') ?>" data-date-format="DD MMMM YYYY">
                                <?php if (isset($_SESSION['errors']['printDateError'])) echo ' <span class="errorText">' . $_SESSION['errors']['printDateError'] . '</span>'; ?>
                            </div>
                        </div>

                        <div class="form-group required row">
                            <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <label for="period" class="control-label">Period Required:</label>
                                <select name="period" class="form-control form-control-sm">
                                    <option value="">--Please select--</option>
                                    <option value="Period1" <?php if (isset($_POST["period"]) && $_POST["period"] == "Period1") print(" selected") ?>>Period1</option>
                                    <option value="Period2" <?php if (isset($_POST["period"]) && $_POST["period"] == "Period2") print(" selected") ?>>Period2</option>
                                    <option value="Break" <?php if (isset($_POST["period"]) && $_POST["period"] == "Break") print(" selected") ?>>Break</option>
                                    <option value="Period3" <?php if (isset($_POST["period"]) && $_POST["period"] == "Period3") print(" selected") ?>>Period3</option>
                                    <option value="Period4" <?php if (isset($_POST["period"]) && $_POST["period"] == "Period4") print(" selected") ?>>Period4</option>
                                    <option value="Period5" <?php if (isset($_POST["period"]) && $_POST["period"] == "Period5") print(" selected") ?>>Period5</option>
                                    <option value="Period6" <?php if (isset($_POST["period"]) && $_POST["period"] == "Period6") print(" selected") ?>>Period6</option>
                                </select>
                                <?php if (isset($_SESSION['errors']['periodError'])) echo ' <span class="errorText">' . $_SESSION['errors']['periodError'] . '</span>'; ?>

                            </div>
                        </div>

                        <div class="form-group required row">
                            <div class="col-md-2"></div>
                            <div class="col-md-9">
                                <p class="form-check-label">Urgently Required :</p>
                                <div class="form-check-inline">
                                    <input type="radio" class="form-check-input form-control-sm" value="Yes" name="urgentlyRequired" <?php if (isset($_POST["urgentlyRequired"]) && $_POST["urgentlyRequired"] == "Yes") print(" checked") ?>>Yes
                                </div>

                                <div class="form-check-inline">
                                    <input type="radio" class="form-check-input form-control-sm" value="No" name="urgentlyRequired" <?php if (isset($_POST["urgentlyRequired"]) && $_POST["urgentlyRequired"] == "No") print(" checked") ?>>No
                                </div>

                                <div>
                                    <?php if (isset($_SESSION['errors']['urgentlyRequiredError'])) echo ' <span class="errorText">' . $_SESSION['errors']['urgentlyRequiredError'] . '</span>'; ?>
                                </div>


                            </div>

                        </div>


                        <div class="form-group required row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-9">

                                <div class="card">
                                    <div class="card-header">
                                        <h6>Print Requirements</h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-title">Standard prints will be double sided and black & white, If you need anything different from this please enter the specific details below.</p>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <div class="required row">
                                                <div class="col-sm-9">
                                                    <label class="checkbox">Colour</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="checkbox" name="check_list[]" value="Colour">
                                                </div>
                                            </div>



                                        </li>
                                        <li class="list-group-item">
                                            <div class="required row">
                                                <div class="col-sm-9">
                                                    <label class="checkbox">Size-A3</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="checkbox" name="check_list[]" value="A3">
                                                </div>
                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <div class="required row">
                                                <div class="col-sm-9">
                                                    <label class="checkbox">Size-A4</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="checkbox" name="check_list[]" value="A4">
                                                </div>
                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <div class="required row">
                                                <div class="col-sm-9">
                                                    <label class="checkbox">Size-A5</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="checkbox" name="check_list[]" value="A5">
                                                </div>
                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <div class="required row">
                                                <div class="col-sm-9">
                                                    <label class="checkbox">Stapled-Top Left</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="checkbox" name="check_list[]" value="StapledTopLeft">
                                                </div>
                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <div class="required row">
                                                <div class="col-sm-9">
                                                    <label class="checkbox">Stapled-Left Edge</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="checkbox" name="check_list[]" value="StapledLeftEdge">
                                                </div>
                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <div class="required row">
                                                <div class="col-sm-9">
                                                    <label class="checkbox">Hole Punched-Left x 4</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="checkbox" name="check_list[]" value="HolePunchedLeft4">
                                                </div>
                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <div class="required row">
                                                <div class="col-sm-9">
                                                    <label class="checkbox">Hole Punched-Left x 2</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="checkbox" name="check_list[]" value="HolePunchedLeft2">
                                                </div>
                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <div class="required row">
                                                <div class="col-sm-9">
                                                    <label class="checkbox">Booklet-A4</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="checkbox" name="check_list[]" value="BookletA4">
                                                </div>
                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <div class="required row">
                                                <div class="col-sm-9">
                                                    <label class="checkbox">Booklet-A5</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="checkbox" name="check_list[]" value="BookletA5">
                                                </div>
                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <div class="required row">
                                                <div class="col-sm-9">
                                                    <label class="checkbox">Laminated</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="checkbox" name="check_list[]" value="Laminated">
                                                </div>
                                            </div>

                                        </li>
                                    </ul>
                                </div>


                            </div>
                        </div>

                        <div class="form-group required row" id="specialRequirementContainer">
                            <div class="col-md-2"></div>
                            <div class="col-md-9">
                                <label for="specialRequirement" class="control-label">Special Requirements:</label>
                                <textarea class="form-control form-control-sm" rows="5" id="specialRequirement" name="specialRequirement"></textarea>

                                <strong><span class="help-block">Please list other requirements not listed already,such
                                        as
                                        colored paper/card,laminated,binding
                                        etc.</span>
                                </strong>
                            </div>
                        </div>

                        <div class="form-group required row">
                            <div class="col-md-2"></div>
                            <div class="col-md-9">
                                <label for="uploadDocument" class="control-label">Upload Document:</label>
                                <input type="file" name="uploadDocument[]" class="form-control-file border" id="uploadDocument" multiple>
                                <div>
                                    <?php if (isset($_SESSION['errors']['uploadDocumentError'])) echo ' <span class="errorText">' . $_SESSION['errors']['uploadDocumentError'] . '</span>'; ?>
                                </div>

                            </div>

                        </div>


                        <div class="form-group row">
                            <div class="col-md-2"></div>
                            <div class="col-md-9">
                                <input type="submit" id="submit" name="submit" class="btn btn-primary btn-block" value="Submit">
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </section>

    <footer></footer>
</body>

</html>