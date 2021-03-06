<?php


namespace Project\Controller;

class Controller
{
    public function view(string $path, array $params = null)
    {
        if (session_status() != 2) {
            session_start();
        }
        if (isset($_SESSION['user'])) {
            $auth = $_SESSION['user'];
        } else {
            $auth = false;
        }
        ob_start();
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        if ($params) {
            $params = extract($params);
        }
        require VIEWS . $path . '.php';
        $content = ob_get_clean();
        require VIEWS . 'layout.php';
    }

    public function viewcontrol(string $path, array $params = null)
    {
        if (session_status() != 2) {
            session_start();
        }
        if (isset($_SESSION['user'])) {
            $auth = $_SESSION['user'];
        } else {
            $auth = false;
        }
        ob_start();
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        if ($params) {
            $params = extract($params);
        }
        if (isset($_SESSION['user'])) {
            require VIEWS . $path . '.php';
        } else {
            header('Location: /login');
            exit();
        }
        $content = ob_get_clean();
        require VIEWS . 'layout.php';
    }
}
