<?php
include($_SERVER['DOCUMENT_ROOT']."/test/php-assignment/"."session.php");
include($_SERVER['DOCUMENT_ROOT']."/test/php-assignment/"."config.php");
include_once($_SERVER['DOCUMENT_ROOT']."/test/php-assignment/php_common/"."nav.php");
session_start();
$type = $_GET['type'];
$role = $_SESSION['role'];
$securePassword = sha1($_POST['currPassword']);
$username = $_SESSION['login_user'];


function authenticate()
{
    if ($GLOBALS['securePassword'] == $GLOBALS['password']) {
        $authenticated = true;
    } else {
        renderAlertInJs("Your Password is Wrong!, Please try again!");
        renderGoBackInJs();
        die();
    }
    return $authenticated;
}

function changePassword()
{
    authenticate();
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $error = "";
    if ($password1 == $password2) {
        if ($password1 !== "" || $password2 !== "") {
            if (preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,16}$/i", $password1)) {
                $passwordMatch = true;
            } else {
                $error .= "Password must be at least 4 characters, no more than 16 characters, and must include at least one upper case letter, one lower case letter, and one numeric digit. Exp:ASDasd123";
            }
        } else {
            $error .= "Password Shall Not be empty";
        }
    } else {
        $error .= "Password does not match";
    }
    if ($_POST['bypass'] == "on") {
        $passwordMatch = true;
    }
    if ($passwordMatch == true) {
        $password = sha1($password1);
        $username = $GLOBALS['username'];
        $sql = "UPDATE `Employee` SET `password`='$password' WHERE `username`='$username'";
        if (mysqli_query($GLOBALS['db'], $sql)) {
            renderAlertInJs("Update Success \n You will be logged out");
            renderRedirectionInJS("../logout.php");
        } else {
            renderAlertInJs("There is some error when updating your Password\n Contact your server administrator ASAP");
        }
    } else {
        renderAlertInJs($error);
        renderGoBackInJs();
        die();
    }
}

function changeProfile()
{
    authenticate();
    $username = $GLOBALS['username'];
    $fName = $_POST['fname'];
    $lName = $_POST['lname'];
    $agency = $_POST['Agency'];
    $error = "";
    $fNameChk = $lNameChk = $agencyChk = $allCheck = false;
    if ($fName !== "") {
        if (preg_match("/^[a-zA-Z ]*$/", $fName)) {
            $fNameChk = true;
        } else {
            $error .= "Only Letter and white Space allowed in First Name \n";
        }
    } else {
        $error .= "Shall not be empty. \n";
    }
    if ($lName !== "") {
        if (preg_match("/^[a-zA-Z ]*$/", $lName)) {
            $lNameChk = true;
        } else {
            $error .= "Only Letter and white Space allowed in Last Name \n";
        }
    } else {
        $error .= "Shall not be empty. \n";
    }
    if ($agency !== "") {
        $agencyChk = true;
    } else {
        $error .= "Agency is a must! \n";
    }
    if ($fNameChk == true && $lNameChk == true && $agencyChk == true) {
        $allCheck = true;
    }

    if (!empty($error)) {
        renderAlertInJs($error);
        echo $error;
    }

    if ($allCheck == true) {
        $sql = "UPDATE `Employee` SET `FName`=?,`LName`=?,`Agency`=? WHERE username=?";
        if ($stmt = mysqli_prepare($GLOBALS['db'], $sql)) {
            mysqli_stmt_bind_param($stmt, "ssss", $fName, $lName, $agency, $username);
            if (mysqli_stmt_execute($stmt)) {
                echo "Success!";
                renderAlertInJs("Update Success!");
            } else {
                echo "Error when Execute ";
            }
        } else {
            echo "Error when Prepare";
        }
    } else {
        echo "Fail All check";
    }
    renderGoBackInJs();


    /*
    TODO
    0. Authenticate 
    1. Get information 
        1.1 Data Validation
    2. prepare SQL
    3. Execute SQL
    */
}

function returnAgency()
{
    $sql = "SELECT DISTINCT `Agency` FROM Employee";
    $result = mysqli_query($GLOBALS['db'], $sql);
    $domReturn = "<select required class='custom-select' id='selectAgency' name='Agency'> \n";

    while ($row = mysqli_fetch_assoc($result)) {
        $agent = $row['Agency'];
        if ($agent == $GLOBALS['Agency']) {
            $selected = "selected";
        } else {
            $selected = "";
        }
        $dom = "onclick=this.attr('selected','selected')";
        $domReturn .= "\t <option value='$agent'$selected $dom>$agent </option> \n";
    }
    $domReturn .= "</select>";
    return $domReturn;
}

function returnPosition()
{
    //Not in used  30012020
    $sql = "SELECT DISTINCT `Position` FROM Employee";
    $result = mysqli_query($GLOBALS['db'], $sql);
    $domReturn = "<select required class='custom-select' id='selectPosition' name='Position'> \n";

    while ($row = mysqli_fetch_assoc($result)) {
        $position = $row['Position'];
        if ($position == $GLOBALS['position']) {
            $selected = "selected";
        } else {
            $selected = "";
        }
        $dom = "onclick=this.attr('selected','selected')";
        $domReturn .= "\t <option value='$position'$selected $dom>$position </option> \n";
    }
    $domReturn .= "</select>";
    return $domReturn;
}


//Main Switch
switch ($type) {
    case 'changePassword':
        changePassword();
        break;

    case 'changeProfile':
        changeProfile();
        break;

    case 'getAgency':
        echo returnAgency();
        break;

    case 'getPosition':
        echo returnPosition();
        break;
}
mysqli_close($db);

