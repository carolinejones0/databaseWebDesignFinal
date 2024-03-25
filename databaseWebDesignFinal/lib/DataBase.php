<?php
class DataBase{
    // Debugging constant
    const DB_DEBUG = false; 

    public function __construct($dataBaseUser, $dataBaseName)    {
        $this->pdo = null; 
        include 'pass.php';

        $DataBasePassword = '';

        switch(substr($dataBaseUser, strpos($dataBaseUser, "_") + 1)){
            case 'reader':
                $DataBasePassword = $dbReader;
                break;

            case 'writer':
                $DataBasePassword = $dbWriter;
                break;
        }

        $query = NULL;

        $dsn = "mysql:host=webdb.uvm.edu;dbname=" . $dataBaseName;

        if(self::DB_DEBUG)  {
            print '<p>' . $dataBaseUser . '</p>';
            print '<p>' . $DataBasePassword . '</p>';
            print '<p>' . $dsn . '</p>';
        }

        try{
            $this->pdo = new PDO($dsn, $dataBaseUser, $DataBasePassword);

            if(!$this->pdo)  {
                if (self::DB_DEBUG){
                    print PHP_EOL . '<!-- NOT Connected -->' . PHP_EOL;
                }
                $this->pdo = 0;
            } else {
                if (self::DB_DEBUG)   {
                    print PHP_EOL . '<!-- Connected -->' . PHP_EOL;
                }
            }
        } catch (PDOException $e)   {
            $error_message = $e->getMessage();
            if (self::DB_DEBUG) {
                print '<!-- Error connecting : ' . $error_message . '-->' . PHP_EOL;
            }
        }

        return $this->pdo;
    } // End constructor 

    // Public function to select records 
    public function select($query, $values = '')    {
        $statement = $this->pdo->prepare($query);

        if (is_array($values))  {
            $statement->execute($values);
        }else {
            $statement->execute();
        }

        $recordSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        $statement->closeCursor();

        return $recordSet;
    }

    // Insert/Update
    // Public functions to insert records -- works on Duplicate Key 
    public function insert($query, $values = '')    {
        $statement = $this->pdo->prepare($query);

        if (is_array($values))  {
            $success = $statement->execute($values);
        }else {
            $success = $statement->execute();
        }
        $statement->closeCursor();

        return $success;
    }

    // Public fucntion to update record
    public function update($query, $values = '')    {
        $statement = $this->pdo->prepare($query);

        if (is_array($values))  {
            $success = $statement->execute($values);
        }else {
            $success = $statement->execute();
        }
        $statement->closeCursor();

        return $success;
    }

    // Public function to delete record
    public function delete($query, $values = '')    {
        $statement = $this->pdo->prepare($query);

        if (is_array($values))  {
            $success = $statement->execute($values);
        }else {
            $success = $statement->execute();
        }
        $statement->closeCursor();

        return $success;
    }

    public function displaySql($sql, $values = '')  {
        foreach ($values as $value)   {
            // Look for ? and replace with value
            $pos = strpos($sql, '?');
            if ($pos !== false) {
                $sql = substr_replace($sql, '"' . $value . '"', $pos, strlen('?'));
            }
        }
        return '<p>SQL: ' . $sql . '</p>'; 
    }

    // Insert last id 
    public function lastInsertId()    {
        $statement = $this->pdo->prepare('SELECT LAST_INSERT_ID()');
        
        $statement->execute();        
        $recordSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        $statement->closeCursor();

        return $recordSet[0]['LAST_INSERT_ID()'];


    }
}
?>
