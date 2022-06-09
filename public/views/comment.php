<?php

$error = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId = $_POST['id'];
    $userId = $_SESSION['loggedUser']['id'];
    $username = $_SESSION['loggedUser']['username'];
    $comment = $_POST['comment'];
    $date = date('Y-m-d H:i:s');

    if (!$comment) {
        $errors['comment'] = 'Comment is required !';
    }
    if (!$username) {
        $errors['username'] = 'Your have to login first !';
    }

    $_SESSION['post_data'] = [
        'comment' => $_POST['comment'],

    ];

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;

    } else {

        $sqlQuery = 'INSERT INTO comments(postId, userId, username, comment, date ) VALUES ( :postId, :userId, :username, :comment, :date)';
        $insertComment = $db->prepare($sqlQuery);
        $insertComment->execute([
            'postId' => $postId,
            'userId' => $userId,
            'username' => $username,
            'comment' => $comment,
            'date' => $date,
        ]);
        header("location: post.php?id=$postId");
        exit;
    }

}
