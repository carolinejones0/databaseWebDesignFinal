<?php 
include 'top.php'; 
?>

<main> 
    <h2>ADMIN REPORTS</h2>

<?php
    $orderBy = isset($_GET["sortField"]) ? htmlspecialchars($_GET["sortField"]) : 'fldRecipieTitle';

    $sortDirection = isset($_GET["sortDirection"]) ? htmlspecialchars($_GET["sortDirection"]) : 'ASC';

   
    $start = isset($_GET['start']) ? (int) htmlspecialchars($_GET['start']) : 0;
    $DISPLAY_NUM = 10; 

    $sql = 'SELECT pmkRecipieId, fldRecipieTitle, fldRecipieDescription, fldPrepTime, fldCookTime, fldIngredients, fldTools, fldMealType, fldVegetarian, fldVegan, fldGF, fldDNA, pfkUserId ';
    $sql .= 'FROM tblRecipie ';
    $sql .= 'ORDER BY ' . $orderBy . ' ' . $sortDirection; 
    $sql .= ' LIMIT ' . $start . ', ' . $DISPLAY_NUM;

    //print $thisDataBaseWriter->displaySql($sql);
    $records = $thisDataBaseWriter->select($sql);

    $end = $start + $DISPLAY_NUM;
    $showing = $end - $start;
    $next = $end;
    $previous = $start - $showing;

    $previousGetString = '?sortField=' . $orderBy . '&sortOrder=' . $sortDirection . '&start=' . $previous;
    $nextGetString = '?sortField=' . $orderBy . '&sortOrder=' . $sortDirection . '&start=' . $next;
    
    if($sortDirection == 'ASC'){
        $sortDirection = 'DESC';
    }else{
        $sortDirection = 'ASC';
    }

    $sql = 'SELECT COUNT(pmkRecipieId) AS NumberOfRecipes FROM tblRecipie';
    $totalRecords = $thisDataBaseWriter->select($sql);
    $totalRecipes = $totalRecords[0]['NumberOfRecipes'];
    ?>
    <main>   
    <h2><a href='display.php?sortField=fldRecipieTitle&sortDirection=<?php print $sortDirection;?>'>Recipe Title</h2></p>
    <?php
        
        foreach($records as $record){
            // Make each individual submission a link to view
            print '<p>';
            print '<a href = "displayResults.php?fid=' . $record['pmkRecipieId'] . '">View</a> : ';
            // Link to update record 
            print '<a href = "form.php?fid=' . $record['pmkRecipieId'] . '">Update Record</a> : ' . PHP_EOL;
            print '<a href = "delete.php?fid=' . $record['pmkRecipieId'] . '" onclick="return confirm(\'Are you sure?\');">Delete Record</a>' . PHP_EOL;


            print $record['fldRecipieTitle'] . ', ';
            print $record['fldRecipieDescription'] . ', ';
            print $record['fldPrepTime'] . ', ';
            print $record['fldCookTime'] . ', ';
            print $record['fldIngredients'] . ', ';
            print $record['fldTools'] . ', ';
            print $record['fldMealType'] . ', ';
            print $record['fldVegetarian'] . ', ';
            print $record['fldVegan'] . ', ';
            print $record['fldGF'] . ', '; 
            print $record['fldDNA'] . ', ';
            // print $record['pfkUserId'] . ', '; 
            
            
            // make whole paragraph a link
            print '</p>';
    }
?>
</table>
<?php
include ("../footer.php");
?>
</main>
