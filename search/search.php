<?php
// Establish SQLite database connection
try {
    $db = new SQLite3('music_catalog.db');
} catch (Exception $ex) {
    die($ex->getMessage());
}

// Retrieve search query from URL
$query = $_GET['search'];

// Execute SQL query to search for music catalog entries
$stmt = $db->prepare("SELECT * FROM music_catalog WHERE title LIKE '%' || :query || '%' OR artist LIKE '%' || :query || '%'");
$stmt->bindValue(':query', $query, SQLITE3_TEXT);
$result = $stmt->execute();

// Output search results
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    echo "Title: " . $row["title"] . "<br>";
    echo "Artist: " . $row["artist"] . "<br>";
    // Add more fields as needed
}

// Close database connection
$db->close();
?>
