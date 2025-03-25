<?php
session_start();
require_once "config/database.php";  // Include the database configuration
require_once "models/Post.php";  // Include the Post model to fix the error

// Establish a database connection
$db = (new Database())->getConnection();

// Create a Post object
$post = new Post($db);

// Get all posts from the database
$posts = $post->getAllPosts();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="public/css/styles.css">
    <script src="public/js/scripts.js" defer></script>
</head>
<body>
    <h1>Bienvenue sur le Blog</h1>

    <?php if (isset($_SESSION["user_id"])): ?>
        <p>Connecté en tant que <strong><?= htmlspecialchars($_SESSION["username"]) ?></strong></p>
        <a href="views/create_post.php">Créer un article</a>
        <a href="views/logout.php" class="logout-btn">Se déconnecter</a>


    <?php else: ?>
        <a href="views/register.php">S'inscrire</a>
        <a href="views/login.php">Se connecter</a>
    <?php endif; ?>

    <h2>Articles</h2>

    <?php foreach ($posts as $post): ?>
        <div>
            <h3><a href="views/post.php?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a></h3>
            <p>Par <strong><?= htmlspecialchars($post['username']) ?></strong> le <?= $post['created_at'] ?></p>
        </div>
    <?php endforeach; ?>
</body>
</html>
