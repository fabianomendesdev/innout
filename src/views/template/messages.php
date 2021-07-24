<?php

$errors = []; 
if(isset($exception)){
    $message = [
        'type' => 'error',
        'message' => $exception->getMessage()
    ];

    if(get_class($exception) === 'ValidationException') {
        $errors = $exception->getErrors();
    }
}

$alertType = '';

if(isset($message)){
    if($message['type'] === 'error') {
        $alertType = 'danger';
    } else {
        $alertType = 'success';
    }
}

?>

<?php if(isset($message)): ?>
    <div rule="alert" class="my-3 alert alert-<?= $alertType ?>">  
        <?= $message['message'] ?>
    </div>
<?php endif ?>