<?php require_once 'backend/User.php';
$user = new User();
?>
<style>
    .dropdown {
        position: relative;
        display: inline-block;
        padding-inline: .5rem;
        cursor: pointer;
    }

    .dropdown-menu {
        position: absolute;
        background-color: whitesmoke;
        right: 0;
        top: 1.5rem;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
        z-index: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        box-shadow: 0 0 8px rgba(16, 201, 32, .8);
        border-radius: 10px;
    }

    .dropdown-menu.show {
        opacity: 1;
        visibility: visible;
    }

    .dropdown-item {
        all: initial;
    }

    .dropdown-item:after {
        all: initial;
    }

    .dropdown-item {
        font-size: 16pt;
        padding: .4rem .6rem;
        cursor: pointer;
        transition: background-color .3s ease;
    }

    .dropdown-item:hover {
        background-color: rgba(16, 201, 32, .8);
        color: whitesmoke;
    }

    .dropdown-item:first-child {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .dropdown-item:last-child {
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }
</style>
<script src="JS/dropdown.js" defer></script>
<?php if ($user->AuthCheck()): ?>
    <div class="dropdown" onmouseover="OpenMenu()" onmouseout="CloseMenu()">
        <p>
            <span>&#9660;</span>
        </p>
        <div class="dropdown-menu" id="dropdown-menu">
            <a href="/upload.php" class="dropdown-item">Upload</a>
            <a href="/upload.php" class="dropdown-item">Upload</a>
            <a href="/upload.php" class="dropdown-item">Upload</a>
        </div>
    </div>
<?php endif; ?>