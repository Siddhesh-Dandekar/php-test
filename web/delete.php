<?php
require "config.php";

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $recipe_id = $_POST['recipe_id'];

        $stmt = $pdo->prepare('DELETE FROM recipes WHERE recipe_id = ?');
        $stmt->execute([$recipe_id]);

        echo "Recipe deleted successfully! .... REDIRECTING IN 2 SECONDS";
        header("refresh:2;url=index.php");
exit;
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
