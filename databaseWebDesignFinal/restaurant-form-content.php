<?php
$dataIsGood = false;

// Intialize variables to default settings
// Set primary key to null
    $restaurantId = null;
    $restaurantName = '';
    $restaurantLocation = '';
    $mustTry = '';



// Check for update
// Initialize variables  to default settings from database 
//print "<p>". $RegisterId."</p>";
if($managerLoggedIn){
    $restaurantId = (isset($_GET['fid'])) ? (int) htmlspecialchars($_GET['fid']) : null;

    if($restaurantId > 0){
        $sql = 'SELECT pmkRestaurantId, 
        fldRestaurantName, 
        fldRestaurantLocation, 
        fldMustTry ';
        $sql .= 'FROM tblRestaurants ';
        $sql .= 'WHERE pmkRestaurantId = ? ';
        $data = array($restaurantId);

        $records = $thisDataBaseWriter->select($sql, $data); 

        // Set variables from database values
        // Primary Key already set
        $restaurantName = $records[0]['fldRestaurantName'];
        $restaurantLocation = $records[0]['fldRestaurantLocation'];
        $mustTry = $records[0]['fldMustTry'];

    }
}


//SANITIZE function
function getData($field) {
    if (!isset($_POST[$field])) {
        $data = "";
    } else {
        $data = trim($_POST[$field]);
        $data = htmlspecialchars($data);
    }
    return $data;
}

function verifyAlphaNum($testString) {
    // Check for letters, numbers and dash, period, space and single quote only.
    // added & ; and # as a single quote sanitized with html entities will have 
    // this in it bob's will be come bob's
    return (preg_match("/^([[:alnum:]]|-|\.| |\'|&|;|#)+$/", $testString));
}

//print '<p>Post Array:</p><pre>';
//print_r($_POST);
//print '</pre>';

//process form when submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dataIsGood = true;
    $restaurantName = getData("txtRestaurantName");
    $restaurantLocation = getData("txtRestaurantLocation");
    $mustTry = getData("txtMustTry");


//server-side VALIDATION
    // Validate first and last name
    if ($restaurantName == "") {
        print '<p class="mistake">Please enter the restaurant\'s name.</p>';
        $dataIsGood = false;
    } elseif (!verifyAlphaNum($restaurantName)) { //regular expression 
        print'<p class="mistake">The restaurant name appears to be incorrect.</p>';
        $dataIsGood = false;
    }
    if ($restaurantLocation == "") {
        print '<p class="mistake">Please enter the restaurant\'s location.</p>';
        $dataIsGood = false;
    } elseif (!verifyAlphaNum($restaurantLocation)) { //regular expression 
        print'<p class="mistake">The restaurant location appears to be incorrect.</p>';
        $dataIsGood = false;
    }
    if ($mustTry == "") {
        print '<p class="mistake">Please enter a must try dish.</p>';
        $dataIsGood = false;
    } elseif (!verifyAlphaNum($mustTry)) { //regular expression 
        print'<p class="mistake">Your must try dish appears to be incorrect.</p>';
        $dataIsGood = false;
    }
    


    // SAVE DATA
    if ($dataIsGood) {
        try {
            $sql = 'INSERT INTO tblRestaurants SET pmkRestaurantId = ?,  
            fldRestaurantName = ?, 
            fldRestaurantLocation = ?, 
            fldMustTry = ?
            ON DUPLICATE KEY UPDATE
            fldRestaurantName = ?, 
            fldRestaurantLocation = ?, 
            fldMustTry = ?';

            $data = array($restaurantId, $restaurantName, $restaurantLocation, $mustTry, $restaurantName, $restaurantLocation, $mustTry); 
            

            // Undefined PDO variable?? 
            // $statement = $pdo->prepare($sql);
            
            if ($thisDataBaseWriter->insert($sql, $data)){
                $message = '<h2>Thank you, your information has been received! Feel free to browse the rest of the site!</h2>';

            } else  {
                $message = '<p>Your record has not been saved correctly</p>';
            }  

        } catch (PDOException $e) {
            $message = '<p>Couldn\'t insert the record.' .  $e . '</p>';
        }

        print $message; 

    }

}

?> 

<!-- start of HTML : STICKY FORM -->

<body class="indexSurvey">
    <h2>The traveler's inside scoop!</h2>
    <p class="form-heading">Share with us your favorite restaurants, near and far...</p>

    <form action = "#"
          id = "frmRegister"
          method = "post">

        <fieldset class = "contact">
            <legend>Restaurant Information</legend>

            <p>
                <label class="required" for="txtRestaurantName">Restaurant Name</label>
                <input type="text" name="txtRestaurantName" id="txtRestaurantName" value="<?php print $restaurantName; ?>"reqired>
            </p>

            <p>
                <label class="required" for="txtRestaurantLocation">Restaurant Location</label>
                <input type="text" name="txtRestaurantLocation" id="txtRestaurantLocation" value="<?php print $restaurantLocation; ?>"required>

            </p>

            <p>
                <label class="required" for="txtMustTry">A must try dish!</label>
                <input type="text" name="txtMustTry" id="txtMustTry" value="<?php print $mustTry; ?>"required>

            </p>

    <fieldset class="buttons">
        <legend></legend>
        <input class = "button" id = "btnSubmit" name = "btnSubmit" tabindex = "900" type = "submit" value = "Submit" >
    </fieldset>
    </fieldset>
</form>

</body>
</html>
