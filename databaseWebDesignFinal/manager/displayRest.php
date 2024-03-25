<?php 
include 'top.php';
?>

<main> 
    <h2>WELCOME TO THE RESTAURANT ARCHIVE!</h2>
    <?php
    $orderBy = isset($_GET["sortField"]) ? htmlspecialchars($_GET["sortField"]) : 'fldRestaurantName';

    $sortDirection = isset($_GET["sortDirection"]) ? htmlspecialchars($_GET["sortDirection"]) : 'ASC';

    $start = isset($_GET['start']) ? (int) htmlspecialchars($_GET['start']) : 0;
    $DISPLAY_NUM = 10; 


    $sql = 'SELECT pmkRestaurantId, fldRestaurantName, fldRestaurantLocation, fldMustTry ';
    $sql .= 'FROM tblRestaurants ';
    $sql .= 'ORDER BY ' . $orderBy . ' '. $sortDirection;
    $sql .= ' LIMIT ' . $start . ', ' . $DISPLAY_NUM;

    $records= $thisDataBaseReader->select($sql);

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

    $sql = 'SELECT COUNT(pmkRestaurantId) AS NumberOfRecipes FROM tblRestaurants';
    $totalRecords = $thisDataBaseWriter->select($sql);
    //$totalRecipes = $totalRecords[0]['NumberOfRestaurants'];

?>

<main>
<h2><a href='displayRest.php?sortField=fldRestaurantName&sortDirection=<?php print $sortDirection;?>'>Restaurant Name</h2></p>

<?php
// View, Update, Delete Records
foreach($records as $record){
    // Make each individual submission a link to view
    print '<p>';
    print '<a href = "displayRestResults.php?fid=' . $record['pmkRestaurantId'] . '">View</a> : ';
    // Link to update record 
    print '<a href = "restaurantForm.php?fid=' . $record['pmkRestaurantId'] . '">Update Record</a> : ' . PHP_EOL;
    print '<a href = "delete.php?fid=' . $record['pmkRestaurantId'] . '" onclick="return confirm(\'Are you sure?\');">Delete Record</a>' . PHP_EOL;
// Only printing one big record under recipie title
    print '<p>Restaurant Name: ' . $record['fldRestaurantName'] . '</p>';

    print '<p>Restaurant Location: ' . $record['fldRestaurantLocation'] . '</p>';

    print '<p>Must Try Dish: ' . $record['fldMustTry'] . '</p>';
       
    }
?>

</main>
<?php
//include ("footer.php");
?>
    