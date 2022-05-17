<?php

require '../models/Model.class.php';
require '../models/Register.class.php';

class UserController
{

    //register function create one new user
    public function registerController($POST)
    {
        $registerModel = new RegisterModel();
        $registerModel->getData($POST);
        if ($registerModel->validateData() && $registerModel->register()) {
            return 'success';
        }

        if (!empty($registerModel->errors)) {
            $_SESSION['post_errors'] = $registerModel->errors;

        }
    }

    //login function
    /*  public function login($POST)
{
$user = new User;
$data = [
'email' => $POST['email'],
];
$userData = $user->getUser($data);
$_SESSION['post_data'] = [

'email' => $POST['email'],
'password' => $POST['password'],

];

foreach ($userData as $user) {
if ($_SESSION['post_data']['email'] !== $user['email'] || !password_verify($_SESSION['post_data']['password'], $user['password'])) {
$this->errors['loginError'] = self::ERROR_LOGIN_NOT_VALID;

} else {
$_SESSION['loggedUser'] = [
'id' => $user['id'],
'username' => $user['username'],
'email' => $user['email'],

];

header('location: index.php');
exit;
}
}

if (!empty($this->errors)) {
$_SESSION['post_errors'] = $this->errors;

}
return $this->errors;

} */

}