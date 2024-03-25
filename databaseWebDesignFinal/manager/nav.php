<nav>
    <a class="<?php
    if (PATH_PARTS['filename'] == "index"){
        print'activePage';
    }
    ?>" href="display.php">Display Recipes</a>

    <a class="<?php
        if (PATH_PARTS['filename'] == "about"){
            print'activePage';
        }
        ?>" href="form.php">Add Recipe</a>

    <a class="<?php
        if (PATH_PARTS['filename'] == "displayRest"){
            print'activePage';
        }
        ?>" href="displayRest.php">Display Restaurants</a>

    <a class="<?php
        if (PATH_PARTS['filename'] == "about"){
            print'activePage';
        }
        ?>" href="restaurantForm.php">Add Restaurant Rec</a>




    <a class="<?php
        if (PATH_PARTS['filename'] == "contact"){
            print'activePage';
        }
        ?>" href="../index.php">Home</a>

</nav>
