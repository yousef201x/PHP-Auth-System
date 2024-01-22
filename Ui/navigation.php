<?php
require_once 'configs/session_start.php';
require_once 'configs/checkAuth.php';
require_once 'configs/User.php';

if (basename($_SERVER['PHP_SELF']) === 'index.php') $index = "active";

$userName =  User::getUserName();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Xmedia</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php echo $active = !empty($index) ? $index : ''; ?>" aria-current="page" href="index.php">Home</a>
                </li>
            </ul>
            <div class=" dropdown">
                <a class="dropdown-toggle col-2" id="userName" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none;color:black;">
                    <?php echo $userName ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                    <li><a class="dropdown-item" href="authenticationAction.php?action=logout">SignOut</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>