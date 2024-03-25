<?php 
include 'top.php';
?>

<main> 
    <h2>WELCOME TO THE RECIPE ARCHIVE!</h2>
    
<?php

//<------ Lab 5 record display ------>//
//$sortField = isset   ?   sanitize   : 'fldName';
$sortField = isset($_GET['sortField']) ? htmlspecialchars($_GET['sortField']) : 'fldRecipieTitle';
$sortOrder = isset($_GET['sortOrder']) ? htmlspecialchars($_GET['sortOrder']) : 'ASC';
$start = isset($_GET['start']) ? (int) htmlspecialchars($_GET['start']) : 0;
$DISPLAY_NUM = 10; 

//$data = array(4);

$sql = 'SELECT pmkRecipieId, fldRecipieTitle, fldRecipieDescription, fldPrepTime, fldCookTime, fldIngredients, fldTools, fldMealType, fldVegetarian, fldVegan, fldGF, fldDNA, pfkUserId, pmkUserId, fldFirstName, fldLastName, fldEmail, fldLocation ';
$sql .= 'FROM tblRecipie ';
$sql .= 'JOIN tblUser ON pmkUserId = pfkUserId ';
$sql .= 'ORDER BY ' . $sortField . ' ' . $sortOrder; 
$sql .= ' LIMIT ' . $start . ', ' . $DISPLAY_NUM;

$records = $thisDataBaseWriter->select($sql);

   
// $sql = 'SELECT pmkRecipieId, fldRecipieTitle, fldRecipieDescription, fldPrepTime, fldCookTime, fldIngredients, fldTools, fldMealType, fldVegetarian, fldVegan, fldGF, fldDNA ';
// $sql .= 'FROM tblRecipie ';
// $sql .= 'ORDER BY ' . $sortField . ' ' . $sortOrder; 
// $sql .= ' LIMIT ' . $start . ', ' . $DISPLAY_NUM;
//$records = $thisDataBaseWriter->select($sql);

//start paging
$end = $start + $DISPLAY_NUM;
$showing = $end - $start;
$next = $end;
$previous = $start - $showing;

$previousGetString = '?sortField=' . $sortField . '&sortOrder=' . $sortOrder . '&start=' . $previous;

$nextGetString = '?sortField=' . $sortField . '&sortOrder=' . $sortOrder . '&start=' . $next;

//$sql = 'SELECT COUNT(pmkRecipieId) AS NumberOfRecipies FROM tblRecipie ';
//$totalRecords = $thisDataBaseWriter->select($sql);
$totalRecipies = count($records); //$totalRecords[0]['NumberOfRecipies'];

// Flip ascending/descending
if($sortOrder == 'ASC'){
    $sortOrder = 'DESC';
}
else{
    $sortOrder = 'ASC';
}
?>


<?php
print '<caption class = "rec"><strong>Showing Records ' . $start+1 . ' to ' . $end . ' of ' . $totalRecipies . '</strong></caption>'
?>
<table class ="centered">
<tr> 
    <th><a href= "Recipes.php?sortField=fldRecipieTitle&sortOrder=<?php print $sortOrder . '&start=' . $start; ?>">Recipe Title</a></th>
    <th><a href= "Recipes.php?sortField=fldCookTime&sortOrder=<?php print $sortOrder . '&start=' . $start; ?>">Cook Time</a></th>
    <th>View More</th>
</tr>

    <?php

foreach($records as $record){
   
        print "<tr><td>".$record['fldRecipieTitle']."</td>";

        print "<td>".$record['fldCookTime']."</td>";
 
        print '<td><a href = "displayResults.php?fid=' . $record['pmkRecipieId'] . '">Click Here</a></td>';
        print "</tr>" . PHP_EOL;
    }

    // prev and next links
    print "<tr><td>";
    if($previous >= 0){
        print '<a href = "Recipes.php' . $previousGetString . '">Previous</a>';
    }else{
        print "Previous";
    }
    print "</td><td></td>";
    print "<td>";
    if($next <= $totalRecipies){
        print '<a href = "Recipes.php' . $nextGetString . '">Next</a>';
    }else{
        print "Next</tr>";
    }



?>
</table>
</main>
<?php
include 'footer.php';
?>
