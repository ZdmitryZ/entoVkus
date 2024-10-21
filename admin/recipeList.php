<?php
include 'database.php'; // подключаем базу данных

// Получаем все рецепты
$result = $mysqli->query("SELECT r.id, r.title, r.description, c.name AS country_name
                           FROM recipes r
                           LEFT JOIN countries c ON r.country_id = c.id");
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список рецептов</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/cover.css" rel="stylesheet">
</head>
<body>
<div class="d-flex h-100 text-center text-bg-dark">
        <div class="wrapper cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
            <?php include "../header.php"; ?>
        </div>
    </div>
<div class="container mt-5">
    <h1>Список рецептов</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название рецепта</th>
                <th>Описание</th>
                <th>Страна</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td>
                        <a href="full_recipe.php?id=<?php echo $row['id']; ?>">
                            <?php echo htmlspecialchars($row['title']); ?>
                        </a>
                    </td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td><?php echo htmlspecialchars($row['country_name']); ?></td>
                    <td>
                        <form action="delete_recipe.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
