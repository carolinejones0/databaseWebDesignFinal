<?php
include "top.php"
?>

<main class="delete">
        <h1>Delete recipe request</h1>

        <?php
        //Check for delete
        if(isset($_GET['fid'])){
            $recipieId = htmlspecialchars($_GET['fid']);
        }else{
            $recipieId = 0;
        }
        
        $sql = 'DELETE FROM tblRecipie ';
        $sql .= 'WHERE pmkRecipieId = ?';

        $data = array($recipieId);

        if($thisDataBaseWriter->delete($sql, $data)){
            print '<p>The record has been deleted successfully</p>';
        }else {
            print '<p>The record has NOT been deleted successfully</p>';
        }

        print '<a href = "display.php">Back to recipes</a>';
        ?>
</main>

