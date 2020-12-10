<?php

//include 'class/dbClass.php';
//$db = new dbClass();

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

?>