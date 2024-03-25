<?php 
include 'top.php';
?>

<main> 
    <h2>WELCOME TO THE RECIPE ARCHIVE!</h2>
    <?php
    $recipieId = (isset($_GET['fid'])) ? (int) htmlspecialchars($_GET['fid']) : null;
    
    if ($recipieId > 0){
        $sql = 'SELECT pmkRecipieId, fldRecipieTitle, fldRecipieDescription, fldPrepTime, fldCookTime, fldIngredients, fldTools, fldMealType, fldVegetarian, fldVegan, fldGF, fldDNA, pfkUserId, fldFirstName, fldLastName, fldEmail, fldLocation ';
        $sql .= 'FROM tblRecipie ';
        $sql .= 'JOIN tblUser ON pmkUserId = pfkUserId ';
        $sql .= 'WHERE pmkRecipieId = ? ';
        $sql .= 'ORDER BY fldRecipieTitle';
        
        $data = array($recipieId);

        //print $thisDataBaseReader->displaySql($sql, $data);

        $records= $thisDataBaseReader->select($sql, $data);
    }
?>


<main>
    <h2>Recipe Results for: <?php print $records[0]['fldRecipieTitle']; ?> </h2>
    <?php

// Only printing one big record under recipie title
if(is_array($records)){
    foreach($records as $record){
        print '<p>First Name: ' . $record['fldFirstName'] . '</p>';
        print '<p>Last Name: ' . $record['fldLastName'] . '</p>';
        print '<p>Email: ' . $record['fldEmail'] . '</p>';
        print '<p>Location: ' . $record['fldLocation'] . '</p>';
        print '<p>Recipe Title: ' . $record['fldRecipieTitle'] . '</p>';
        print '<p>Recipe Ingredients: ' . $record['fldIngredients'] . '</p>';
        print '<p>Prep Time: ' . $record['fldPrepTime'] . '</p>';
        print '<p>Cook Time: ' . $record['fldCookTime'] . '</p>';
        print '<p>Recipe Instructions: ' . $record['fldRecipieDescription'] . '</p>';
        print '<p>Tools Required: ' . $record['fldTools'] . '</p>';
        print '<p>Type of meal: ' . $record['fldMealType'] . '</p>' ;
        print '<p>Is vegetarian?: ' . $record['fldVegetarian'] . '</p>'; 
        print '<p>Is vegan?: ' . $record['fldVegan'] . '</p>';
        print '<p>Is gluten free?: ' . $record['fldGF'] . '</p>';
        print '<p>Does not apply: ' . $record['fldDNA'] . '</p>';
        
       
    }
}
?>

</main>
<?php
include ("../footer.php");
?>