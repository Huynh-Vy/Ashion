<?php
include 'system/Bridge.php';

try {
    $app = new App();
} catch (Exception $er) {
    echo $er->getMessage();
}





