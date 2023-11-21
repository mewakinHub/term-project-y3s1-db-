<?php
function displayTable($mysqli, $tableName, $columns)
{
    echo "<table>";
    echo "<tr>";
    foreach ($columns as $column) {
        echo "<th>$column</th>";
    }
    echo "<th>Edit</th>"; // Add column for edit
    echo "<th>Delete</th>"; // Add column for delete
    echo "</tr>";

    $sql = "SELECT * FROM $tableName";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($columns as $column) {
                // Check if the column is icon or poster
                if ($column == 'icon' || $column == 'poster' || $column == 'profilePicFile' || $column == 'file') {
                    // Limit the displayed content to a fixed size
                    $limitedContent = substr($row[$column], 0, 50); // Adjust the length as needed
                    echo "<td>$limitedContent...</td>";
                } else {
                    echo "<td>{$row[$column]}</td>";
                }
            }
            // GET: use url as the way to send variable
            echo "<td><a href='edit_$tableName.php?id={$row[$columns[0]]}'>Edit</a></td>";
            echo "<td><a href='delete_$tableName.php?id={$row[$columns[0]]}' class='delete-btn' onclick='return confirmDelete();'>Delete</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='" . (count($columns) + 2) . "'>No records found</td></tr>";
    }

    echo "</table>";
}
?>
