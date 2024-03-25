<?php 
include 'top.php';
?>

<main> 
    <h2>WELCOME TO THE RESTAURANT ARCHIVE!</h2>
    <?php
    $restaurantId = (isset($_GET['fid'])) ? (int) htmlspecialchars($_GET['fid']) : null;
    if ($restaurantId > 0){
        $sql = 'SELECT pmkRestaurantId, fldRestaurantName, fldRestaurantLocation, fldMustTry ';
        $sql .= 'FROM tblRestaurants ';
        $sql .= 'WHERE pmkRestaurantId = ? ';
        $sql .= 'ORDER BY fldRestaurantName';
        
        $data = array($restaurantId);

        //print $thisDataBaseReader->displaySql($sql, $data);

        $records= $thisDataBaseReader->select($sql, $data);
    }
?>


<main>
    <h2>Restaurant Results for: <?php print $records[0]['fldRestaurantName']; ?> </h2>
    <?php

// Only printing one big record under recipie title
if(is_array($records)){
    foreach($records as $record){
        print '<p>Restaurant Name: ' . $record['fldRestaurantName'] . '</p>';
        print '<p>Restaurant Location: ' . $record['fldRestaurantLocation'] . '</p>';
        print '<p>Must Try Dish: ' . $record['fldMustTry'] . '</p>'; 
       
    }
}
?>

</main>
<?php
include ("../footer.php");
?>