<?php
if (isset($_SESSION['error']) && $_SESSION['error'] != '') { 
    ?>
        <div class="alert alert-warning" role="alert">
            <?=$_SESSION['error']?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php
}

?>

<?php

if (isset($_SESSION['success']) && $_SESSION['success'] != '') { 
    ?>
        <div class="alert alert-success" role="alert">
            <?=$_SESSION['success']?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php
}

?>
