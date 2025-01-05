<?php
session_start();
require_once "backend/database.php";
require_once "components/header.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM products WHERE id = :id";
    $result = $db->fetch($query, ['id' => $id]);
    $product = $result[0];
}
?>

<body>
    <?php require_once "components/nav.php"; ?>
    <div class="content">
        <div class="product-container">
            <img src="<?php echo $product['picture']; ?>" alt="<?php echo $product['name']; ?>">
            <div class="product-details">
                <h2 id="name"><?php echo $product['name']; ?></h2>
                <p id="category"><?php echo $product['category']; ?>
                </p>
                <p id="description"><?php echo $product['description']; ?></p>
            </div>
            <div class="cart">
                <h3>Quantity</h3>
                <select name="quantity" id="quantity">
                    <?php for ($i = 1; $i <= $product['quantity']; $i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
                <br>
                <?php
                echo "<script>
                let quantity = 1;
    document.getElementById('quantity').addEventListener('change', function() {
        quantity = this.value;
        let price = quantity * " . $product['price'] . ";
        document.getElementById('total-price').textContent = price.toFixed(2);
    });
</script>";
                ?>
                <p>Total Price: $<span id="total-price"><?php echo $product['price'] ?></span></p>

                <a href="#" class="add-to-cart" data-id="<?php echo $product['id']; ?>">Add to Cart</a>
            </div>
        </div>
    </div>
    <?php require_once "components/popup.php"; ?>
</body>

</html>