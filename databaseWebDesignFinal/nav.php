<nav>
    <a class="<?php
    if (PATH_PARTS['filename'] == "index"){
        print'activePage';
    }
    ?>" href="index.php">Home</a>

    <a class="<?php
        if (PATH_PARTS['filename'] == "aboutUs"){
            print'activePage';
        }
        ?>" href="aboutUs.php">About Us</a>

    <a class="<?php
        if (PATH_PARTS['filename'] == "gallery"){
            print'activePage';
        }
        ?>" href="gallery.php">Gallery</a>

     <a class="<?php
        if (PATH_PARTS['filename'] == "Recipe"){
            print'activePage';
        }
        ?>" href="Recipes.php">Recipes</a>


    <a class="<?php
        if (PATH_PARTS['filename'] == "form"){
            print'activePage';
        }
        ?>" href="form.php">Submit your recipe!</a>

<a class="<?php
        if (PATH_PARTS['filename'] == "restaurant"){
            print'activePage';
        }
        ?>" href="restaurantForm.php">Restaurant Recs</a>

</nav>
