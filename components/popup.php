<?php if (isset($_GET['message'])) {
    $message = $_GET["message"];
    $error = isset($_GET["error"]) ? true : false;
}
if (isset($message)): ?>
    <div class="popup" id="popup">
        <?php echo $message ?>
    </div>
<?php endif; ?>

<script>
    <?php if (isset($error) && $error): ?>
        document.getElementById('popup').classList.add('error');
    <?php endif; ?>
</script>