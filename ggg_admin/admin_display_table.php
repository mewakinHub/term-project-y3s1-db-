<!-- admin_display_table.php -->
<?php

function displayTable($mysqli, $tableName, $columns)
{
    // display the domain(field)
    echo "<table>
            <tr>";

    foreach ($columns as $column) {
        echo "<th>$column</th>";
    }

    echo "<th>Edit</th>
          <th>Delete</th>
          </tr>";

    // fetch every records
    $sql = "SELECT * FROM $tableName";
    $result = $mysqli->query($sql);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";

            foreach ($columns as $column) {
                echo "<td>{$row[$column]}</td>";
            }

            echo "<td><a href='edit_$tableName.php?id={$row[$columns[0]]}'>Edit</a></td>
                  <td><button class='delete-btn' onclick='if(confirmDelete()) window.location.href=\"delete_$tableName.php?id={$row[$columns[0]]}\";'>Delete</button></td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "<p>Error: " . $mysqli->error . "</p>";
    }
}
?>
