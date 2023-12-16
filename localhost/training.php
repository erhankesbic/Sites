<?php
include 'header.php';

$user_id = $_SESSION['user_id'];

// Fetch user's training plan
$query = $db->prepare("SELECT * FROM trainingsplan WHERE user_id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();

$training_plan = [];
while ($row = $result->fetch_assoc()) {
    $training_plan[] = $row;
}

$query->close();
$db->close();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Training Plan</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your CSS file -->
</head>
<body>
    <h1>Your Training Plan</h1>
    <?php if (count($training_plan) > 0): ?>
        <ul>
            <?php foreach ($training_plan as $exercise): ?>
                <li><?php echo htmlspecialchars($exercise['name']); ?></li>
                <!-- Add more exercise details as needed -->
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>You have no exercises in your plan. Add some!</p>
    <?php endif; ?>
</body>
</html>
