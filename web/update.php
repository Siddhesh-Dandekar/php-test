<?php
require 'config.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $recipe_id = $_POST['recipe_id'];
        $recipe_name = $_POST['recipe_name'];
        $prep = $_POST['prep'];
        $difficulty = $_POST['difficulty'];
        $vegetarian = $_POST['vegetarian'] === '1' ? 'true' : 'false';

        if (isset($_POST['update'])) {
            $stmt = $pdo->prepare('UPDATE recipes SET recipe_name = ?, prep = ?, difficulty = ?, vegetarian = ? WHERE recipe_id = ?');
            $stmt->execute([$recipe_name, $prep, $difficulty, $vegetarian, $recipe_id]);

            echo "Recipe updated successfully!";
        }
    } else {
        $recipe_id = $_POST['recipe_id'];
        $recipe_name = $_POST['recipe_name'];
        $prep = $_POST['prep'];
        $difficulty = $_POST['difficulty'];
        $vegetarian = $_POST['vegetarian'];
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
    <title>Update Recipe</title>
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
    <h1>Update Recipe</h1>
    <form method="post" action="update.php">
        <input class="border-2 border-indigo-600" type="hidden" name="recipe_id" value="<?php echo $recipe_id; ?>">

        <label for="recipe_name">Recipe Name:</label><br>
        <input class="border-2 border-indigo-600" type="text" id="recipe_name" name="recipe_name" value="<?php echo $recipe_name; ?>" required><br><br>

        <label for="prep">Preparation Time:</label><br>
        <input class="border-2 border-indigo-600" type="text" id="prep" name="prep" value="<?php echo $prep; ?>" required><br><br>

        <label for="difficulty">Difficulty:</label><br>
        <input class="border-2 border-indigo-600" type="text" id="difficulty" name="difficulty" value="<?php echo $difficulty; ?>" required><br><br>

        <label for="vegetarian">Vegetarian:</label><br>
        <input class="border-2 border-indigo-600" type="checkbox" id="vegetarian" name="vegetarian" <?php echo $vegetarian ? 'checked' : ''; ?>><br><br>

        <input class="border-2 border-indigo-600 bg-indigo-600 rounded-md" type="submit" name="update" value="Update Recipe">
    </form>
    </section>
</body>

</html>