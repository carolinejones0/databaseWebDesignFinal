
// User CREATE
<pre>
CREATE TABLE tblUser (
    pmkUserId int,
    fldFirstName VARCHAR(30),
    fldLastName VARCHAR(30),
    fldEmail VARCHAR(30), 
    fldLocation VARCHAR(30)
)
</pre>


// User INSERT
<pre>
INSERT INTO tblUser SET pmkUserId = ?, 
            fldFirstName = ?, 
            fldLastName = ?, 
            fldEmail = ?, 
            fldLocation = ?
            ON DUPLICATE KEY UPDATE
            fldFirstName = ?, 
            fldLastName = ?, 
            fldEmail = ?, 
            fldLocation = ?
</pre> 

// User SELECT
SELECT pmkUserId, fldFirstName, fldLastName, 
        fldEmail, fldLocation
        FROM tblUser
        WHERE pmkUserId = ?
</pre>

// Recipe CREATE
<pre>
CREATE TABLE tblRecipie (
    pmkRecipieId int,
    fldRecipieTitle text,
    fldRecipieDescription text,
    fldPrepTime double,
    fldCookTime double,
    fldIngredients text,
    fldTools = text,
    fldPhoto varbinary(100),
    pfkUserId int
)
</pre>

// Recipe INSERT
<pre>
INSERT INTO tblRecipie SET pmkRecipieId = ?,
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
            pfkUserId = ?
</pre>

// Recipie SELECT
<pre>
SELECT pmkRecipieId, 
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
            pfkUserId'
        FROM tblRecipie
        WHERE pmkRecipieId = ?

// Delete function
<pre>
DELETE FROM tblRecipie
WHERE pmkRecipieId = ?
</pre>

// Restaurant CREATE
<pre>
CREATE TABLE tblRestaurant (
    pmkRestaurantId int,
    fldRestaurantId varchar(30),
    fldRestaurantLocation varchar(30),
    fldMustTry varchar(30),
)
</pre>
// restaurant insert
<pre>
INSERT INTO tblRestaurants SET pmkRestaurantId = ?,  
            fldRestaurantName = ?, 
            fldRestaurantLocation = ?, 
            fldMustTry = ?
            ON DUPLICATE KEY UPDATE
            fldRestaurantName = ?, 
            fldRestaurantLocation = ?, 
            fldMustTry = ?;
</pre>
<pre>
SELECT pmkRestaurantId, 
        fldRestaurantName, 
        fldRestaurantLocation, 
        fldMustTry ;
        FROM tblRestaurants ;
        WHERE pmkRestaurantId = ? ;
        $data = array($restaurantId);
</pre>
