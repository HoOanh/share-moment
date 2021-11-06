<?php 
    function pdo_get_connection(){
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $charset = 'utf8';
        $dbname = 'share-moment';

        try{
            $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
            $conn = new PDO($dsn,$username,$password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $conn;
        }
        catch(PDOException $e){
            echo "Connection Failed: ".$e->getMessage();
        }
    }


    // include: insert, update, delete.
    function pdo_execute($sql) {
        //Get args
        $sql_args = array_slice(func_get_args(),1);

        try{
            $conn = pdo_get_connection();
            $stmt = $conn->prepare($sql);
            return $stmt->execute($sql_args);
            
        }
        catch(PDOException $e){
            throw $e;
        }
        finally{
            // close connection
            unset($conn);
        }
    }

    //query all rows
    function pdo_get_all_rows($sql) {
        $sql_args = array_slice(func_get_args(),1); 
        try{
            $conn = pdo_get_connection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($sql_args);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e){
            throw $e;
        }
        finally{
            unset($conn);
        }
    }
    //query one rows
    function pdo_get_one_row($sql) {
        $sql_args = array_slice(func_get_args(),1); 
        try{
            $conn = pdo_get_connection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($sql_args);
            
            return $stmt->fetch(PDO::FETCH_ASSOC);

        }
        catch(PDOException $e){
            throw $e;
        }
        finally{
            unset($conn);
        }
    }
    // get value: count(), sum(),...
    function pdo_get_value($sql) {
        $sql_args = array_slice(func_get_args(),1); 
        try{
            $conn = pdo_get_connection();
            $stmt = $conn->prepare($sql);
            return $stmt->execute($sql_args);

        }
        catch(PDOException $e){
            throw $e;
        }
        finally{
            unset($conn);
        }
    }

?>