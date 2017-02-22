<?php 
class Db {
    // The database connection
    protected static $connection;
    

    /**
     * Connect to the database
     * 
     * @return bool false on failure / mysqli MySQLi object instance on success
     */
    public function connect() {    
        // Try and connect to the database
        if(!isset(self::$connection)) {
            // Load configuration as an array. Use the actual location of your configuration file
            $config = parse_ini_file('config.ini'); 
            self::$connection = new mysqli($config['host'],$config['username'],$config['password'],$config['dbname']);
        }

        // If connection was not successful, handle the error
        if(self::$connection === false) {
            // Handle error - notify administrator, log to a file, show an error screen, etc.
            echo "Database Connection Error";
            return false;
        }
        return self::$connection;
    }

    public function dbPrefix(){
        $config = parse_ini_file('config.ini'); 
        return $config['tbl_prefix'];
    }

    /**
     * Query the database
     *
     * @param $query The query string
     * @return mixed The result of the mysqli::query() function
     */
    public function query($query) {
        // Connect to the database
        $connection = $this -> connect();

        // Query the database
        $result = $connection -> query($query);

        return $result;
    }

    /**
     * Fetch rows from the database (SELECT query)
     *
     * @param $query The query string
     * @return bool False on failure / array Database rows on success
     */
    public function select($query) {
        $rows = array();
        $result = $this -> query($query);
        if($result === false) {
            return false;
        }
        while ($row = $result -> fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * Fetch the last error from the database
     * 
     * @return string Database error message
     */
    public function error() {
        $connection = $this -> connect();
        return $connection -> error;
    }

    /**
     * Quote and escape value for use in a database query
     *
     * @param string $value The value to be quoted and escaped
     * @return string The quoted and escaped string
     */
    public function quote($value) {
        $connection = $this -> connect();
        return "'" . $connection -> real_escape_string($value) . "'";
    }



    /**
     * Insert Into Data Base
     *
     * @param $query The query string
     * @return mixed The result of the mysqli::query() function
     */
    public function insert($array = array(),$table_name="") {
        // Connect to the database

        $connection = $this -> connect();
        $dbPrefix = $this -> dbPrefix();
        $table_name=$dbPrefix.$table_name;
        if(count($array)>0){
            $feilds = array();
            $values = array();
            foreach ($array as $key => $value) {
              $feilds[]=$key;
              $values[]=$this -> quote($value);
            }
            $date = new DateTime( 'now', new DateTimeZone('Asia/Dhaka') );
            $feilds[]='created';
            $values[]=$this -> quote($date->format('Y-m-d H:i:s'));
            $feilds[]='updated';
            $values[]=$this -> quote($date->format('Y-m-d H:i:s'));
            $feilds[]='deleted';
            $values[]=0;
            
           
            $feilds_string=implode(",", $feilds);
            $values_string=implode(",", $values);
            $query="INSERT INTO $table_name(".$feilds_string.") VALUES (".$values_string.")";
            $results = $connection -> query($query);
            $object = new stdClass();
            if ($results === false) {
             $object->type = 'error';
             $object->msg = 'Wrong Feilds/Table Name For Query';
            }else{

                $object->type = 'success';
                $object->msg = 'Data Inserted Successfully';
                $object->last_row = $connection->insert_id;
            }
           
            
        

        }else{
            $object = new stdClass();
            $object->type = 'error';
            $object->msg = 'Posted Array is Null';
            

        }
        return $object;
    }


    /**
     * Update Data On Data Base
     *
     * @param $query The query string
     * @return mixed The result of the mysqli::query() function
     */
    public function update($array = array(),$table_name="",$where = array()) {
        // Connect to the database

        $connection = $this -> connect();
        $dbPrefix = $this -> dbPrefix();
        $table_name=$dbPrefix.$table_name;
      
        if(count($where)>0){
            if(count($array)>0){
                $feilds = array();
                $wheres = array();
                foreach ($array as $key => $value) {
                  $feilds[]=$key."=".$this -> quote($value);
                 
                }
                
                $date = new DateTime( 'now', new DateTimeZone('Asia/Dhaka') );
             
                $feilds[]='updated'."=".$this -> quote($date->format('Y-m-d H:i:s'));
                
                $feilds_string=implode(",", $feilds);


                foreach ($where as $key => $value) {
                  $wheres[]=$key."=".$this -> quote($value);
                 
                }
                $wheres_string=implode(" && ", $wheres);
                $wheres_string=" && ".$wheres_string;
                
                $query="UPDATE $table_name SET ".$feilds_string." WHERE 1".$wheres_string;
                $results = $connection -> query($query);
                $object = new stdClass();
                if ($results === false) {
                 $object->type = 'error';
                 $object->msg = 'Wrong Feilds/Table Name For Query';
                }else{

                    $object->type = 'success';
                    $object->msg = 'Data Updated Successfully';
                    $object->last_row = $connection->affected_rows;
                }
               
                
            

            }else{
                $object = new stdClass();
                $object->type = 'error';
                $object->msg = 'Posted Array is Null';
                

            }
        }
        return $object;
    }

}


?>