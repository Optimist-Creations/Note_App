<?php
session_start();

// Initialize the notes array if it doesn't exist
if (!isset($_SESSION['notes'])) {
    $_SESSION['notes'] = [];
}

// Add a new note
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['note'])) {
    $_SESSION['notes'][] = $_POST['note'];
}

// Delete a note
if (isset($_GET['delete'])) {
    $index = $_GET['delete'];
    if (isset($_SESSION['notes'][$index])) {
        unset($_SESSION['notes'][$index]);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes App</title>
</head>
<body>
    <h1>SALAUDEEN MUBARAQ OLANSILE <br> Notes App</h1>
    <form method="POST" action="">
        <textarea name="note" placeholder="Enter your note here..." required></textarea>
        <button type="submit">Add Note</button>
    </form>

    <h2>Your Notes</h2>
    <ul>
        <?php foreach ($_SESSION['notes'] as $index => $note): ?>
            <li>
                <?php echo htmlspecialchars($note); ?>
                <a href="?delete=<?php echo $index; ?>">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>