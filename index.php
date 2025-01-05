<?php
session_start();
require_once "components/header.php";
require_once "backend/database.php";
$query = "SELECT * FROM products";
$result = $db->fetch($query);
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    // Perform search query here
    $searchQuery = "SELECT * FROM products 
    WHERE name LIKE '%$search%' 
    OR category LIKE '%$search%' 
    OR description LIKE '%$search%'";
    $searchresult = $db->fetch($searchQuery);
}
?>

<body>
    <?php
    require_once "components/nav.php";
    ?>
    <div class="content">
        <div class="container">
            <?php if (isset($_GET['search'])) {
                if ($searchresult) {
                    foreach ($searchresult as $product) {
                        ?>
                        <div class="item-container">
                            <img src="<?php echo $product['picture'] ?>" width="200px" alt="<?php echo $product['name'] ?>">
                            <h1><?php echo $product['name'] ?></h1>
                            <a href="/product.php?id=<?php echo $product['id'] ?>">View</a>
                        </div>
                        <?php
                    }
                }
            } else {
                if ($result) {
                    foreach ($result as $product) {
                        ?>
                        <div class="item-container">
                            <img src="<?php echo $product['picture'] ?>" width="200px" alt="<?php echo $product['name'] ?>">
                            <h1><?php echo $product['name'] ?></h1>
                            <a href="/product.php?id=<?php echo $product['id'] ?>">View</a>
                        </div>
                        <?php
                    }
                }
            } ?>
        </div>
    </div>
    <?php
    require_once "components/popup.php";
    ?>
</body>

</html>