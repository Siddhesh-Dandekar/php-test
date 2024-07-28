<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body class="bg-slate-300">
<section class="py-1 bg-blueGray-50">
<div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4 mx-auto mt-24">
  <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
    <div class="rounded-t mb-0 px-4 py-3 border-0">
      <div class="flex flex-wrap items-center">
        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
          <h3 class="font-semibold text-base text-blueGray-700">RECIPES</h3>
        </div>
        <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
            <a href="add.php"> <button class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" >ADD(CREATE)</button></a>
        </div>
      </div>
    </div>

    <div class="block w-full overflow-x-auto">
    <?php
require 'config.php';

try {

    $stmt = $pdo->query('SELECT recipe_id, recipe_name, prep, difficulty, vegetarian FROM recipes');
    
    echo "
      <table class='items-center bg-transparent w-full border-collapse '>
        <thead>
          <tr>
            <th class='px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left'>
                          Recipe Name
                        </th>
          <th class='px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left'>
                          vegetarian
                        </th>
           <th class='px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left'>
                          difficulty
                        </th>
          <th class='px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left'>
                          Preparation Time
                        </th>
          <th class='px-6 bg-blueGray-50 text-blueGray-500 text-center align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left'>
                          Update Recipe
                        </th>
          <th class='px-6 bg-blueGray-50 text-blueGray-500 text-center align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left'>
                          Delete Recipe
                        </th>
          </tr>
        </thead>

        <tbody>";
            while ($row = $stmt->fetch()) {
        echo "
          <tr>
            <th class='border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 '>
            {$row['recipe_name']}
            </th>
            <td class='border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 '>
            " . ($row['vegetarian'] ? 'Yes' : 'No') . "
            </td>
            <td class='border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4'>
            {$row['difficulty']}
            </td>
            <td class='border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4'>
              {$row['prep']}
            </td>
            <td class='border-t-0 px-6 align-middle text-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4'>
            <form method='post' action='update.php'>
                        <input type='hidden' name='recipe_id' value='{$row['recipe_id']}'>
                        <input type='hidden' name='recipe_name' value='{$row['recipe_name']}'>
                        <input type='hidden' name='prep' value='{$row['prep']}'>
                        <input type='hidden' name='difficulty' value='{$row['difficulty']}'>
                        <input type='hidden' name='vegetarian' value='{$row['vegetarian']}'>
                        <input class='bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150' type='submit' value='Update'>
                    </form>
            </td>
            <td class='border-t-0 px-6 align-middle text-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4'>
            <form method='post' action='delete.php'>
            <input type='hidden' id='recipe_id' name='recipe_id' value='{$row['recipe_id']}' required>
            <input class='bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150' type='submit' value='Delete Recipe'>
           </form>
            </td>
          </tr>
         
        </tbody>";
    }

    echo "</table>";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
    </div>
  </div>
</div>
</section>


    
</body>
</html>

