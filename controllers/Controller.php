<?php

abstract class Contoller
{
    protected $defaultAction = 'all';

    public function run($action)
    {
        if (empty($action)) {
            $action = $this->defaultAction;
        }
        $method = $action . 'Action';
        if (method_exists($this, $method)) {
            return $this->{$method}();
        }
        return header('Location: index.php');
    }
  /*   public function allAction()
    {
        $users = (new Users())->getAll();
        return $this->render('users', ['users' => $users]);
    }
    public function oneAction()
    {
        $user = (new Users())->getOne($_GET['id']);
        return $this->render('user', ['user' => $user]);
    }
    public function render($name, $data = [])
    {
        $content = $this->renderTmpl($name, $data);
        return $this->renderTmpl('layout', ['content' => $content]);
    } */
}
