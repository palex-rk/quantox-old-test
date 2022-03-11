<?php

namespace App\Controller;

use App\Model\User;
use Src\View;

class UsersController
{
    public function index($x, $z, $c)
    {
        // echo 'hi there prick!';die;
        $errorMessage = '';
        if (isset($_GET['success'])) 
        {
            if ($_GET['success']) 
            {
                $errorMessage = "<div class='alert alert-success'> Last action was completed </div>"; 
            } 
            else 
            {
                $errorMessage = "<div class='alert alert-danger'> Last action was not completed </div>"; 
            }
        }
      
        $userModel = new User();
        $users = $userModel->select(['id', 'name', 'email', 'address', 'phone'])->get();

        View::render('index.php', ['users' => $users, 'errorMessage' => $errorMessage]);
    }

    public function create()
    {
        $errorMessage = [];
        // var_dump($_GET);
        if (isset($_GET['e'])) {
            $errorMessage = $_GET['e'];
        }
        View::render('users/create.php', ['errors'=> $errorMessage]);
    }

    public function store($user)
    {
        $user = [];
        $errorMessage = [];
        echo "<pre>";var_dump($this->getErrorMessage('name_empty'));die;
        foreach ($_POST as $key => $value) 
        {
            if (empty($value) || $value == '')
            {
                $errorMessage[] = $this->getErrorMessage($key.'_empty');
            }
            $user[$key] = strip_tags($value);
        }

        if (!preg_match ("/^[0-9]*$/", $_POST['phone']) && (!empty($_POST['phone'])))
        {
            $errorMessage[] = $this->getErrorMessage('not_a_number');
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && (!empty($_POST['email'])))
        {
            $errorMessage[] = $this->getErrorMessage('invalid_mail');
        }
        
        if ($errorMessage)
        {
            header('Location: /index.php?c=UsersController&m=create&success=0&e=' . (implode (',', array_keys($errorMessage))));
            exit();
        }

        $userModel = new User();

        if ($userModel->insert($user)->run()) 
        {
            header('Location: /index.php?c=UsersController&m=index&success=1');
        } 
        else 
        {
            header('Location: /index.php?c=UsersController&m=index&success=0');
        }

    }

    public function edit()
    {
        $id = $_GET['user_id'];
        $userModel = new User();

        $user = $userModel->select(['id', 'name', 'email', 'phone', 'address'], $id)->get();
        if (empty($user)) 
        {
            header('Location: /index.php?c=UsersController&m=index&success=0');
        } 
        else 
        {
            View::render('users/edit.php', ['user' => $user[0]]);
        }
    }

    public function update($user)
    {
        $user = [];

        foreach ($_POST as $key => $value) 
        {
            $user[$key] = strip_tags($value);
        }

        $userModel = new User();

        if ($userModel->update($user, $user['id'])->run()) 
        {
            header('Location: /index.php?c=UsersController&m=index&success=1');
        } 
        else 
        {
            header('Location: /index.php?c=UsersController&m=index&success=0');
        }
    }

    public function delete()
    {
        $id = $_GET['user_id'];

        $userModel = new User();
        if ($userModel->delete($id)->run()) 
        {
            header('Location: /index.php?c=UsersController&m=index&success=1');
        } 
        else 
        {
            header('Location: /index.php?c=UsersController&m=index&success=0');
        }
    }

    public function getErrorMessage($ind)
    {
        $errors = [
            'name_empty' => 'Your name must have enter your username',
            'mail_empty' => 'Your name must have enter your email',
            'phone_empty' => 'Your name must have enter your phone number',
            'address_empty' => 'Your name must have enter your address',
            'not_a_number' => 'Field phone must be a number',
            'invalid_mail' => 'Not a valid email',
        ];
        return $errors[$ind];
    }

}