<?php
require_once "connect.php";


$whereClauses = [];
$params = [];

$filterType = $_GET['filter_type'] ?? null;
$filterValue = $_GET['filter_value'] ?? null;


if ($filterType == 'genre' && $filterValue !== 'All') {
    $sql = "CALL FilterGamesByGenre(:value)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':value', $filterValue);
    $stmt->execute();
    $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Check for other filters and build query
    if (isset($_GET['keywords']) && !empty($_GET['keywords'])) {
        $whereClauses[] = 'game.name LIKE :keywords';
        $params[':keywords'] = '%' . $_GET['keywords'] . '%';
    }
if (isset($_GET['graphics']) && $_GET['graphics'] !== 'All') {
    $whereClauses[] = 'graphics.type = :graphics';
    $params[':graphics'] = $_GET['graphics'];
}
if (isset($_GET['company']) && $_GET['company'] !== 'All') {
    $whereClauses[] = 'studio.name = :company';
    $params[':company'] = $_GET['company'];
}
if (isset($_GET['genre']) && $_GET['genre'] !== 'All') {
    $whereClauses[] = 'FIND_IN_SET(:genre, genres) > 0';
    $params[':genre'] = $_GET['genre'];
}
$sql = 'SELECT game. * FROM game';
if (!empty($whereClauses)) {
    $sql .= ' WHERE ' . implode(' AND ', $whereClauses);
}
// Add sorting
$sort = $_GET['sort'] ?? 'name'; // Default to sorting by name if no sort is provided
$sql .= ' ORDER BY game.' . $sort;

// Prepare the SQL statement
$stmt = $db->prepare($sql);

// Bind the parameters
foreach ($params as $key => &$val) {
    $stmt->bindParam($key, $val);
}

// Execute the query
$stmt->execute();

// Fetch the results
$games = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Output the games if any
if (isset($games)) {
foreach ($games as $game) {
    echo htmlspecialchars($game['name']) . '<br>';
}
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Filter Form</title>
</head>
<body>
<form action="" method="get">
        <!-- Sorting Dropdown -->
        <label for="sort">Sort:</label>
        <select id="sort" name="sort">
            <option value="name">Alphabetical</option>
            <option value="price">Price</option>
            <option value="releaseDate">Release Date</option>
        </select>

        <!-- Keyword Search -->
        <label for="keywords">Keywords:</label>
        <input type="text" id="keywords" name="keywords" placeholder="Enter keywords">

        <!-- Graphics Dropdown -->
        <label for="graphics">Graphics:</label>
        <select id="graphics" name="graphics">
            <option value="All">All</option>
            <option value="2D">2D</option>
            <option value="3D">3D</option>
            <!-- Add more graphics options here -->
        </select>

        <!-- Company Dropdown -->
        <label for="company">Company:</label>
        <select id="company" name="company">
            <option value="All">All</option>
            <!-- Dynamically populate company options here -->
        </select>

        <!-- Genre Dropdown -->
        <label for="genre">Genres:</label>
        <select id="genre" name="genre">
            <option value="All">All</option>
            <option value="Horror">Horror</option>
            <option value="MMO">MMO</option>
            <option value="Platformer">Platformer</option>
            <option value="Puzzle">Puzzle</option>
            <option value="RPG">RPG</option>
            <!-- Add more genre options here -->
        </select>

        <!-- Submit Button -->
        <input type="submit" value="Filter Games">
    </form>
</body>
</html>
