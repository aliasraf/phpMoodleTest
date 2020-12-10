<?php
class dbClass {

    protected $host;
    private $user;
    private $pass;
    private $db;
    private $dbs;
    public $mysqli;

    public function __construct() {
        $this->db_connect();
    }

    public function db_connect() {
        $this->host = 'localhost';
        $this->user = 'root';
        $this->pass = '';
        $this->db = 'ecommerce';

        $mysqli = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if (mysqli_connect_errno()) {
            printf("Connection failed: %s\ ", mysqli_connect_error());
            exit();
        }
        return 1;
    }

    function task1($mysqli) {
        $query = "SELECT c.`Name` , COUNT( i.Name1 ) AS ItemNumber
                        FROM `category` c
                        LEFT JOIN item_category_relations icr ON icr.categoryId = c.`Id`
                        LEFT JOIN item i ON i.Number = icr.ItemNumber
                        GROUP BY c.`Id` ORDER by ItemNumber DESC";
        $result = $mysqli->query($query);
        return $result;
    }

    function task2($mysqli) {
        $query = "SELECT icr.categoryId,count(icr.ItemNumber) as ItemNumber,c.Name 
                        FROM category c
                        LEFT JOIN item_category_relations icr ON icr.categoryId = c.Id
                        LEFT JOIN item i ON i.Number = icr.ItemNumber
                        GROUP BY icr.categoryId ORDER by ItemNumber DESC";
        $result = $mysqli->query($query);
        return $result;
    }

    function count_number_of_item($categoryId) {
        $query = "SELECT * FROM item_category_relations  WHERE categoryId = '" . $categoryId . "'";

        if ($result = $mysqli->query($query)) {
            return $row = mysqli_num_rows($result);
        }
    }

}
?>
