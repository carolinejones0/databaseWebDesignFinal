<?php

    $dataIsGood = false;
// Intialize variables to default settings
// Set primary key to null
    $recipieId = null;
    $recipieTitle= ' ';
    $recipieDescription = ' ';
    $prepTime = ' ';
    $cookTime = ' ';
    $ingredients = ' ';
    $tools = ' ';
    $typeMeal = ' ';
    $vegetarian = 0; // allows boxes to be unchecked at the start
    $vegan = 0;
    $glutenFree = 0;
    $DNA = 0;

    // Need to inclue foreign key
    $userId = null;
    $fkuserId = $userId;
    $first = '';
    $last = '';
    $email = '';
    $location = '';
    

// Check for update
// Initialize variables  to default settings from database 
//print "<p>". $RegisterId."</p>";
if($managerLoggedIn){
    $recipieId = (isset($_GET['fid'])) ? (int) htmlspecialchars($_GET['fid']) : null;

    if($recipieId > 0){
        $sql1 = 'SELECT pmkRecipieId, 
            fldRecipieTitle,
            fldRecipieDescription,
            fldPrepTime,
            fldCookTime,
            fldIngredients,
            fldTools,
            fldMealType,
            fldVegetarian,
            fldVegan,
            fldGF,
            fldDNA,
            pfkUserId ';

        $sql1 .= 'FROM tblRecipie ';
        $sql1 .= 'WHERE pmkRecipieId = ? ';
        $data1 = array($recipieId);


        $records = $thisDataBaseWriter->select($sql1, $data1); 

        // Set variables from database values
        // Primary Key (pmkRegisterId) already set
        //$recipieId = $records[0]['pmkRecipieId'];
        $recipieTitle = $records[0]['fldRecipieTitle'];
        $recipieDescription = $records[0]['fldRecipieDescription'];
        $prepTime = $records[0]['fldPrepTime'];
        $cookTime = $records[0]['fldCookTime'];
        $ingredients = $records[0]['fldIngredients'];
        $tools = $records[0]['fldTools'];
        $typeMeal = $records[0]['fldMealType'];
        $vegetarian = $records[0]['fldVegetarian'];
        $vegan = $records[0]['fldVegan'];
        $glutenFree = $records[0]['fldGF']; 
        $DNA = $records[0]['fldDNA'];
        $fkuserId = $records[0]['pfkUserId']; 
        
    }
    $userId = (isset($_GET['fid'])) ? (int) htmlspecialchars($_GET['fid']) : null;

    if($userId > 0){
        $sql2 = 'SELECT pmkUserId, fldFirstName, fldLastName, 
        fldEmail, fldLocation ';
        /* pmkUserId, fldFirstName, fldLastName, 
        fldEmail, fldLocation*/
        
        $sql2 .= 'FROM tblUser ';
        $sql2 .= 'WHERE pmkUserId = ? ';
        $data2 = array($userId);

        $records = $thisDataBaseWriter->select($sql2, $data2); 

        // Set variables from database values
        // Primary Key (pmkRegisterId) already set
        $userId = $records[0]['pmkUserId'];
        $first = $records[0]['fldFirstName'];
        $last = $records[0]['fldLastName'];
        $email = $records[0]['fldEmail'];
        $location = $records[0]['fldLocation'];
    }
}

//SANITIZE function for both tables
function getData($field) {
    if (!isset($_POST[$field])) {
        $data1 = "";
        $data2 = "";
    } else {
        $data1 = trim($_POST[$field]);
        $data1 = htmlspecialchars($data1);
        $data2 = trim($_POST[$field]);
        $data2 = htmlspecialchars($data2);
    }
    return $data1;
    return $data2;
}

function verifyAlphaNum($testString) {
    // Check for letters, numbers and dash, period, space and single quote only.
    // added & ; and # as a single quote sanitized with html entities will have 
    // this in it bob's will be come bob's
    return (preg_match("/^([[:alnum:]]|-|\.| |\'|&|;|#)+$/", $testString));
}


//process form when submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dataIsGood = true;

    $first = getData('txtFirstName');
    $last = getData('txtLastName');
    $email = getData('txtEmail');
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $location = getData('lstLocation');
    //server-side SANITIZE 
    //$recipieId = getData("pmkRecipieId");
    // $recipieId = 6; //getData("pmkRecipieId");
    $recipieTitle = getData("txtRecipieTitle");
    $recipieDescription = getData("txtRecipieDescription");
    $prepTime = getData("txtPrepTime");
    $cookTime = getData("txtCookTime");
    $ingredients = getData("txtIngredients");
    $tools = getData("txtTools");
    $typeMeal = getData("radType");
    $vegetarian = getData("chkVegetarian");
    $vegan = getData("chkVegan");
    $glutenFree = getData("chkGF"); 
    $DNA = getData("chkNone");
    $fkuserId = $userId; 

//server-side VALIDATION
    // Text validation
    if ($first == "") {
        print '<p class="mistake">Please enter your first name.</p>';
        $dataIsGood = false;
    } elseif (!verifyAlphaNum($first)) { //regular expression 
        print '<p class="mistake">Your first name appears to be incorrect.</p>';
        $dataIsGood = false;
    }
    if ($last == "") {
        print '<p class="mistake">Please enter your last name.</p>';
        $dataIsGood = false;
    } elseif (!verifyAlphaNum($last)) { //regular expression 
        print '<p class="mistake">Your last name appears to be incorrect.</p>';
        $dataIsGood = false;
    }
    // Validate email
    if ($email == "") {
        print '<p class="mistake">Please enter your email address.</p>';
        $dataIsGood = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        print '<p class="mistake">Your email appears to be incorrect.</p>';
        $dataIsGood = false;
    }

    // listbox validation
    if (empty($_POST['lstLocation'])) {
        $location = "Please select your continent of residence";
        $error = true;
    } else {
        $location = $_POST['lstLocation'];
    }

    if ($recipieTitle == "") {
        print '<p class="mistake">Please enter your recipie\'s title.</p>';
        $dataIsGood = false;
    } elseif (!verifyAlphaNum($recipieTitle)) { //regular expression 
        print '<p class="mistake">Your recipie title is invalid. Please enter an alphanumeric response.</p>';
        $dataIsGood = false;
    }
    if ($recipieDescription == "") {
        print '<p class="mistake">Please enter a response.</p>';
        $dataIsGood = false;
    }
    if ($prepTime == "") {
        print '<p class="mistake">Please enter the prep time necessary for your recipie.</p>';
        $dataIsGood = false;
    } elseif (!verifyAlphaNum($prepTime)) { //regular expression 
        print '<p class="mistake">Your prep time is invalid. Please enter an alphanumeric response.</p>';
        $dataIsGood = false;
    }
    if ($cookTime == "") {
        print '<p class="mistake">Please enter the cook time necessary for your recipie.</p>';
        $dataIsGood = false;
    } elseif (!verifyAlphaNum($cookTime)) { //regular expression 
        print '<p class="mistake">Your cook time is invalid. Please enter an alphanumeric response.</p>';
        $dataIsGood = false;
    }

    //textarea validation
    if ($ingredients == "") {
        print '<p class="mistake">Please enter a response.</p>';
        $dataIsGood = false;
    }

    if ($tools == "") {
        print '<p class="mistake">Please enter a response.</p>';
        $dataIsGood = false;
    }

    // "TYPE" radio button validation
    if ($typeMeal != 'breakfast' AND $typeMeal != 'lunch' AND $typeMeal != 'snack' AND $typeMeal != 'dinner' AND $typeMeal != 'dessert') {
        print '<p class="mistake">Please choose a category.</p>';
        $dataIsGood = false;
    }

    // checkbox validation
    if ($vegetarian != 'vegetarian' AND $vegan != 'vegan' AND $glutenFree != 'GF' AND $DNA != 'none') {
        print '<p class="mistake">Please choose at least one option.</p>';
        $dataIsGood = false;
    }
    
} 
    

   

    // SAVE DATA
    if ($dataIsGood) {
        try {
            $sql2 = 'INSERT INTO tblUser SET pmkUserId = ?, 
                    fldFirstName = ?, 
                    fldLastName = ?, 
                    fldEmail = ?, 
                    fldLocation = ?
                    ON DUPLICATE KEY UPDATE
                    fldFirstName = ?, 
                    fldLastName = ?, 
                    fldEmail = ?, 
                    fldLocation = ?';

        $data2 = array($userId, $first, $last, $email, $location, $first, $last, $email, $location); 

            if ($thisDataBaseWriter->insert($sql2, $data2)){
                $message = '<h2>Thank you, your information has been received!</h2>';
                // get the autonumber user id
                $fkuserId = $thisDataBaseWriter->lastInsertId();

            } else  {
                $message = '<p>Your record has not been saved correctly</p>';
            }  

            $sql1 = 'INSERT INTO tblRecipie SET pmkRecipieId = ?,
            fldRecipieTitle = ?,
            fldRecipieDescription = ?,
            fldPrepTime = ?,
            fldCookTime = ?,
            fldIngredients = ?,
            fldTools = ?,
            fldMealType = ?,
            fldVegetarian = ?,
            fldVegan = ?,
            fldGF = ?,
            fldDNA = ?,
            pfkUserId = ?
            ON DUPLICATE KEY UPDATE
            fldRecipieTitle = ?,
            fldRecipieDescription = ?,
            fldPrepTime = ?,
            fldCookTime = ?,
            fldIngredients = ?,
            fldTools = ?,
            fldMealType = ?, 
            fldVegetarian = ?,
            fldVegan = ?,
            fldGF = ?,
            fldDNA = ?,
            pfkUserId = ?';

        // add pfkUserId back in $userId
        $data1 = array($recipieId, $recipieTitle, $recipieDescription, $prepTime, $cookTime, $ingredients, $tools, $typeMeal, $vegetarian, $vegan, $glutenFree, $DNA, $fkuserId, $recipieTitle, $recipieDescription, $prepTime, $cookTime, $ingredients, $tools, $typeMeal, $vegetarian, $vegan, $glutenFree, $DNA, $fkuserId);

            if ($thisDataBaseWriter->insert($sql1, $data1)){
                $message = '<h2>Thank you, your information has been received!</h2>';


            } else  {
                $message = '<p>Your record has not been saved correctly</p>';

            }  
       
        }
     catch (PDOException $e) {
        $message = '<p>Couldn\'t insert the record.' .  $e . '</p>';
    }
    print $message;
}

        /*} catch (PDOException $e) {
            $message = '<p>Couldn\'t insert the record.' .  $e . '</p>';
        }
        print $message;
        */


    // Email contents

if ($dataIsGood) {
    $to = $email;
    $from = 'CS 148 Team Members Amelia Gillian and Caroline <Amelia.Berlandi@uvm.edu>';
    $subject = 'Thank you for your contribution!';
    $mailMessage = '<p style="font: 14pt serif;">Thank you for taking the time to fill out this survey and share your recipe with us! We can\t wait to give your submission a taste!!</p><p>Best,<br><span style="color: black;">Amelia Berlandi, Gillian Foster, and Caroline Jones</span></p>';
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "From: " . $from . "\r\n";

    $mailedSent = mail($to, $subject, $mailMessage, $headers);

    if ($mailedSent) {
        print"<p>Email sent successfully!</p>";
    }
    die();
}
?> 

<!-- start of HTML : STICKY FORM -->
<body class="indexSurvey">
    <h2>Share your recipes with us!</h2>
    <p class="form-heading">You and your kitchen are a great match, and an even better match when you're experimenting! Puruse this page for new recipes and new fun!</p>

    <form action = "#"
          id = "frmRecipie"
          method = "post">

          <h2>Who are you?</h2>
    <p class="form-heading">We want to know...</p>
    <fieldset class = "contact">
            <legend>Contact Information</legend>

            <p>
                <label class="required" for="txtFirstName">First Name</label>
                <input type="text" name="txtFirstName" id="txtFirstName" value="<?php print $first; ?>"reqired>
            </p>

            <p>
                <label class="required" for="txtLastName">Last Name</label>
                <input type="text" name="txtLastName" id="txtLastName" value="<?php print $last; ?>"required>

            </p>
            <p>
                <label class = "required" for = "txtEmail">Please enter your email</label>
                <input id = "txtEmail"     
                       maxlength = "45"
                       name = "txtEmail"
                       onfocus = "this.select()"
                       tabindex = "120"
                       type = "email"
                       value="<?php print $email; ?>"
                       required>
            </p> 
            
            
            <p>    
                <label class = "required" for = "lstLocation">Where are you from?</label>
                <select class="area-select" name="lstLocation">
                    <option value="usa" <?php if($location == "usa") print 'selected'; ?>>United States </option> 
                    <option value="africa" <?php if($location == "africa") print 'selected'; ?>>Africa </option>
                    <option value="austrailia" <?php if($location == "austrailia") print 'selected'; ?>>Australia </option>
                    <option value="asia" <?php if($location == "africa") print 'selected'; ?>>Asia</option>
                    <option value="canada" <?php if($location == "canada") print 'selected'; ?>>Canada </option>
                    <option value="europe"  <?php if($location == "europe") print 'selected'; ?>>Europe</option>
                    <option value="southAmerica" <?php if($location == "southAmerica") print 'selected'; ?>>South America </option>     
                </select>
            </p>
         
        </fieldset>

        <fieldset class = "details">
            <legend>Give us the rundown...</legend>
            <!-- Recipie Title -->
            <p>
                <label class="required" for="txtRecipieTitle">Title of Recipe</label>
                <input type="text" name="txtRecipieTitle" id="txtRecipieTitle" value="<?php print $recipieTitle; ?>"reqired>
            </p>

            <!-- Ingredients --> 
            <p>
                <label for="txtIngredients">Ingredients, please!</label>
                <textarea id="txtIngredients" name="txtIngredients" id="txtIngredients" placeholder="" ><?php print $ingredients; ?></textarea>
            </p>
           
            <!-- Prep and Cook Times -->
            <p>
                <label class="required" for="txtPrepTime">Prep Time (in minutes):</label>
                <input type="text" name="txtPrepTime" id="txtPrepTime" value="<?php print $prepTime; ?>"reqired>
            </p>
            <p>
                <label class="required" for="txtCookTime">Cook Time (in minutes):</label>
                <input type="text" name="txtCookTime" id="txtCookTime" value="<?php print $cookTime; ?>"reqired>
            </p>

            <!-- Recipie Description -->   
            <p>
                <label for="txtRecipieDescription">Instructions, please!</label>
                <textarea id="txtRecipieDescription" name="txtRecipieDescription" id="txtRecipieDescription" placeholder="" ><?php print $recipieDescription; ?></textarea>
            </p> 

            <!-- Tools -->   
            <p>
                <label for="txtTools">Please list the tools needed to create such a masterpiece</label>
                <textarea id="txtTools" name="txtTools" id="txtTools" placeholder="" ><?php print $tools; ?></textarea>
            </p> 

            <!-- Category RADIO BUTTONS--> 
            <label for="radType">Dishes don't always fall into categories, but if they do.....</label> 
            <p>
                <input type="radio" name="radType" value="breakfast" id="radBre" <?php if($typeMeal == "breakfast") print 'checked'; ?>>
                <label for="radBre">Breakfast</label></p>
            <p>
                <input type="radio" name="radType" value="lunch" id="radLun"<?php if($typeMeal == "lunch") print 'checked'; ?>>
                <label for="radLun">Lunch</label></p>
            <p>
                <input type="radio" name="radType" value="scack" id="radSna" <?php if($typeMeal == "snack") print 'checked'; ?>>
                <label for="radSna">Snack</label>
            </p>
            <p>
                <input type="radio" name="radType" value="dinner" id="radDin" <?php if($typeMeal == "dinner") print 'checked'; ?>>
                <label for="radDin">Dinner</label>
            </p>
            <p>
                <input type="radio" name="radType" value="dessert" id="radDes" <?php if($typeMeal == "dessert") print 'checked'; ?>>
                <label for="radDes">Dessert</label>
            </p>

            <!-- Dietary CHECKBOX--> 
            <label>Dietary restrictions?</label> 
            <p>
                <input type="checkbox" name="chkVegetarian" id="chkVegetarian" value="vegetarian" <?php if($vegetarian) print 'checked'; ?>> 
                <label for="chkVegetarian">Vegetarian</label>
            </p>

            <p>
                <input type="checkbox" name="chkVegan" id="chkVegan" value="vegan" <?php if($vegan) print 'checked'; ?>>
                <label for="chkVegan">Vegan</label>
            </p>
            <p>
                <input type="checkbox" name="chkGF" id="chkGF" value="GF" <?php if($glutenFree) print 'checked'; ?>>
                <label for="chkGF">Gluten Free</label>
            </p>
            <p>
                <input type="checkbox" name="chkNone" id="chkNone" value="none" <?php if($DNA) print 'checked'; ?>>
                <label for="chkNone">Does Not Apply</label>
            </p>
            
            
        </fieldset>

    <!-- Submit Button --> 
    <fieldset class="buttons">
        <legend></legend>
        <input class = "button" id = "btnSubmit" name = "btnSubmit" tabindex = "900" type = "submit" value = "Submit" >
    </fieldset>
</form>
</body>
</html>
