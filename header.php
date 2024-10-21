<header class="mb-auto">
    <div>
        <h3 class="float-md-start mb-0 text-white">
            <a href="/index.php" class="text-white text-decoration-none">
                <strong> этноВкус</strong>
            </a>
        </h3>
        <nav class="nav nav-masthead justify-content-center float-md-end">
            <a class="nav-link fw-bold py-1 px-0 <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" aria-current="page" href="/index.php">Главная</a>
            <a class="nav-link fw-bold py-1 px-0 <?php echo basename($_SERVER['PHP_SELF']) == 'recipe.php' ? 'active' : ''; ?>" href="/recipe.php">Рецепты</a>
            <a class="nav-link fw-bold py-1 px-0 <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>" href="/about.php">О нас</a>
        </nav>
    </div>
</header>
