<?php

$class = "success";
$msg = $msgSuccess;

if (!empty($msgError)) {

    $class = "danger";
    $msg = $msgError;
}

if (!empty($msgInfo)) {

    $class = "info";
    $msg = $msgInfo;
}


if (!empty($msg)){
?>

<div style="text-align: center" class="alert alert-<?= $class ?>" role="alert">
    <?= $msg ?>
</div>

<?php }

