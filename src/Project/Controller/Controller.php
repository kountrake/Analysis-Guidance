<?php


namespace Project\Controller;

class Controller
{
    public function view(string $path, array $params = null)
    {
        session_start();
        if (isset($_SESSION['user'])) {
            $auth = $_SESSION['user'];
        } else {
            $auth = false;
        }
        ob_start();
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        require VIEWS . $path . '.php';
        if ($params) {
            $params = extract($params);
        }
        $content = ob_get_clean();
        require VIEWS . 'layout.php';
    }
}
