<?php
include 'class/dbClass.php';
$db = new dbClass();
//$db->task1($db);
//$db->task2($db);
$mysqli = mysqli_connect("localhost", "root", "", "ecommerce");
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
?>
<html>
    <head>
        <style>
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 60%;
                margin-left: 20%;
            }
            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }
            tr:nth-child(even) {
                background-color: #dddddd;
            }
        </style>
    </head>
    <body>
        <!--<h2>Task List:</h2>-->
        <h2><a href="task1.php">Task 1</a></h2>
        <h2><a href="task2.php">Task 2</a></h2>
        <table>
            <tr>
                <th>Category Name</th>
                <th>Total Items</th>
            </tr>
            <?php
            $query = "SELECT item_category_relations.categoryId,count(item_category_relations.ItemNumber) as ItemNumber,category.Name FROM item_category_relations JOIN category ON category.id = item_category_relations.categoryId GROUP BY item_category_relations.categoryId ORDER by ItemNumber DESC";
            if ($result = $mysqli->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $row["Name"];  ?></td>
                        <td><?php echo $row["ItemNumber"]; ?></td>
                    </tr>
                    <?php
                }
                $result->free();
            }
            ?>

        </table>

    </body>
</html>


