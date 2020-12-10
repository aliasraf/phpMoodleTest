<?php
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


        <!--<h2>Task 1</h2>-->
        <h2><a href="task1.php">Task 1</a></h2>
        <h2><a href="task2.php">Task 2</a></h2>

        <table>
            <tr>
                <th>Category Name</th>
                <th>Total Items</th>
            </tr>
            <?php
            $query = "SELECT c.Name , COUNT( i.Name1 ) AS ItemNumber
                        FROM category c
                        LEFT JOIN item_category_relations icr ON icr.categoryId = c.Id
                        LEFT JOIN item i ON i.Number = icr.ItemNumber
                        GROUP BY c.Id ORDER by ItemNumber DESC";
            if ($result = $mysqli->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    if ($row["ItemNumber"] > 0) {
                        ?>
                        <tr>
                            <td><?php echo $row["Name"]; //."====".$row["categoryId"];     ?></td>
                            <td><?php echo $row["ItemNumber"]; ?></td>
                        </tr>
                        <?php
                    }
                }
                $result->free();
            }
            ?>
        </table>
    </body>
</html>


