<?php
$mysqli = mysqli_connect("localhost", "root", "", "ecommerce");
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

function count_number_of_item($categoryId) {
    $mysqli = mysqli_connect("localhost", "root", "", "ecommerce");

    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }
    $query = "SELECT * FROM item_category_relations  WHERE categoryId = '" . $categoryId . "'";

    if ($result = $mysqli->query($query)) {
        return $row = mysqli_num_rows($result);
    }
}
?>
<html>
    <head>
        <style>
            ul, #myUL {
                list-style-type: none;
            }

            #myUL {
                margin: 0;
                padding: 0;
                margin-left: 20%;
            }

            .caret {
                cursor: pointer;
                -webkit-user-select: none; 
                -moz-user-select: none; 
                -ms-user-select: none; 
                user-select: none;
            }

            .caret::before {
                content: "\25B6";
                color: black;
                display: inline-block;
                margin-right: 6px;
            }

            .caret-down::before {
                -ms-transform: rotate(90deg); 
                -webkit-transform: rotate(90deg); 
                transform: rotate(90deg);  
            }

        </style>
    </head>
    <body>

        <h2><a href="task1.php">Task 1</a></h2>
        <h2><a href="task2.php">Task 2</a></h2>

        <ul id="myUL">
            <?php
            $query = "SELECT icr.categoryId,count(icr.ItemNumber) as ItemNumber,c.Name 
                        FROM category c
                        LEFT JOIN item_category_relations icr ON icr.categoryId = c.Id
                        LEFT JOIN item i ON i.Number = icr.ItemNumber
                        GROUP BY icr.categoryId ORDER by ItemNumber DESC";
            if ($result = $mysqli->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    ?>

                    <li><span class="caret"><?php echo $row["Name"]; ?> &nbsp;&nbsp;(<?php echo count_number_of_item($row['categoryId']); //echo $row["ItemNumber"];    ?>)</span>
                        <ul class="nested">
                            <?php
                            $query2 = "SELECT catetory_relations.categoryId,catetory_relations.ParentcategoryId,category.Name "
                                    . "FROM catetory_relations "
                                    . "JOIN category ON category.id = catetory_relations.categoryId "
                                    . " WHERE catetory_relations.ParentcategoryId = '" . $row['categoryId'] . "' ORDER by categoryId DESC";

                            if ($result2 = $mysqli->query($query2)) {
                                while ($row2 = $result2->fetch_assoc()) {
                                    ?>  
                                    <li><?php echo $row2["Name"]; ?> &nbsp;&nbsp;(<?php echo count_number_of_item($row2['categoryId']); ?>)</li>

                                    <?php
                                }
                            }
                            ?>

                        </ul>
                    </li>
                    <?php
                }
                $result->free();
            }
            ?>

        </ul>
    </body>
</html>