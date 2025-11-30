<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $type = $_POST['type'];
    $duration = $_POST['duration'];
    $distance = $_POST['distance'];
    $notes = $_POST['notes'];

    $stmt = $conn->prepare("INSERT INTO Workouts (workout_date, workout_type, duration_minutes, distance_km, notes) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdds", $date, $type, $duration, $distance, $notes);
    $stmt->execute();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Trening Tracker</title>
</head>
<body>
<h1>Dodaj trening</h1>
<form method="post" action="">
    Data: <input type="date" name="date" required><br>
    Typ: <input type="text" name="type" required><br>
    Czas (minuty): <input type="number" name="duration"><br>
    Dystans (km): <input type="number" step="0.01" name="distance"><br>
    Notatka: <input type="text" name="notes"><br>
    <input type="submit" value="Dodaj">
</form>

<h2>Lista treningów</h2>
<table border="1">
<tr><th>Data</th><th>Typ</th><th>Czas</th><th>Dystans</th><th>Notatka</th></tr>
<?php
$result = $conn->query("SELECT * FROM Workouts ORDER BY workout_date DESC");
while ($row = $result->fetch_assoc()) {
    echo "<tr>
    <td>{$row['workout_date']}</td>
    <td>{$row['workout_type']}</td>
    <td>{$row['duration_minutes']}</td>
    <td>{$row['distance_km']}</td>
    <td>{$row['notes']}</td>
    </tr>";
}
$conn->close();
?>
</table>
</body>
</html>