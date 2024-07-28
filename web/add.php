<?php
require "config.php";

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $recipe_name = $_POST['recipe_name'];
        $prep = $_POST['prep'];
        $difficulty = $_POST['difficulty'];
        $vegetarian = isset($_POST['vegetarian']) ? 'true' : 'false';

        $stmt = $pdo->prepare('INSERT INTO recipes (recipe_name, prep, difficulty, vegetarian) VALUES ( ?, ?, ?, ?)');
        $stmt->execute([$recipe_name, $prep, $difficulty, $vegetarian]);

        echo "Recipe added successfully!";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Add Recipe</title>
</head>
<body>
<header>
     <nav class="px-20 py-4 flex flex-col gap-2">
        <ul>
            <li><a href="index.php"><button class="border-2 border-indigo-600 bg-indigo-600 rounded-md">HOME</button></a></li>
        </ul>
     </nav>
    </header>
    <section class="px-20 py-20 flex flex-col gap-2">
    <h1>Add a New Recipe</h1>
    <form method="post" action="">
        <label for="recipe_name">Recipe Name:</label><br>
        <input class="border-2 border-indigo-600" type="text" id="recipe_name" name="recipe_name" required><br><br>
        
        <label for="prep">Preparation Time:</label><br>
        <input class="border-2 border-indigo-600" type="text" id="prep" name="prep" required><br><br>
        
        <label for="difficulty">Difficulty:</label><br>
        <input class="border-2 border-indigo-600" type="text" id="difficulty" name="difficulty" required><br><br>
        
        <label for="vegetarian">Vegetarian:</label><br>
        <input class="border-2 border-indigo-600" type="checkbox" id="vegetarian" name="vegetarian"><br><br>
        
        <input class="border-2 border-indigo-600 bg-indigo-600 rounded-md" type="submit" value="Add Recipe">
    </form>
    </section>
</body>
</html>
