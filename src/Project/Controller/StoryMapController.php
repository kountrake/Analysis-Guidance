<?php


namespace Project\Controller;

use \Exception;
use Project\Middleware\StoryMapMiddleware;
use Project\Middleware\UserStoryMiddleware;

class StoryMapController extends Controller
{
    public function index(string $projectId)
    {
        session_start();
        $storymapMid = new StoryMapMiddleware($projectId);
        $storymap = $storymapMid->getStorymap(123);
        if (!$storymap) {
            $this->viewcontrol('storymap', ['projectId' => $projectId]);
        } else {
            $this->viewcontrol('storymap', ['projectId' => $projectId, 'storymap' => $storymap]);
        }
    }

    public function role($projectId)
    {
        try {
            $usMid = new UserStoryMiddleware($projectId);
            $roles = $usMid->getAllRoles();
            $jeveux = $usMid->getAllJeVeux();
            $this->viewcontrol('storymap/role', ['projectId' => $projectId, 'roles' => $roles, 'jeveux' => $jeveux]);
        } catch (Exception $exception) {
            $this->view('error/oops', ['error' => $exception->getMessage()]);
        }
    }

    public function createRole()
    {
        var_dump($_POST);
        try {
            $projectId = $_POST['projectId'];
            $usMid = new UserStoryMiddleware($projectId);
            $storymapMid = new StoryMapMiddleware($projectId);
            $roles = $usMid->getAllRoles();
            foreach ($roles as $role) {
                $storymapMid->createRole($role->entantque);
                $idRole = $storymapMid->getLastRoleId();
                foreach ($_POST[$role->entantque] as $jv) {
                    $storymapMid->createActivite($jv, $idRole->max);
                }
            }
            header('Location: /storymap/activite/'.$projectId);
            exit();
        } catch (Exception $exception) {
            $this->view('error/oops', ['error' => $exception->getMessage()]);
        }
    }

    public function activite($projectId)
    {
        try {
            $smMid = new StoryMapMiddleware($projectId);
            $roles = $smMid->getAllRoles();
            $activites = [];
            foreach ($roles as $role) {
                $activites[] = $smMid->getAllActivites($role->idbut);
            }
            $this->viewcontrol(
                'storymap/activite',
                ['projectId' => $projectId, 'roles' => $roles, 'activites' => $activites]
            );
        } catch (Exception $exception) {
            $this->view('error/oops', ['error' => $exception->getMessage()]);
        }
    }

    public function createActivite()
    {
        try {
            $projectId = $_POST['projectId'];
            $smMid = new StoryMapMiddleware($projectId);
            $roles = $smMid->getAllRoles();
            $activites = [];
            foreach ($roles as $role) {
                $activites[] = $smMid->getAllActivites($role->idbut);
            }
            $i = 0;
            foreach ($roles as $role) {
                foreach ($activites[$i] as $activite) {
                    $smMid->createStory(
                        $_POST[$role->role . '_' . $activite->activite . '_1'],
                        intval($_POST[$role->role . '_' . $activite->activite . 'priorite_1']),
                        $activite->idactivite
                    );
                    $smMid->createStory(
                        $_POST[$role->role . '_' . $activite->activite . '_2'],
                        intval($_POST[$role->role . '_' . $activite->activite . 'priorite_2']),
                        $activite->idactivite
                    );
                    $smMid->createStory(
                        $_POST[$role->role . '_' . $activite->activite . '_3'],
                        intval($_POST[$role->role . '_' . $activite->activite . 'priorite_3']),
                        $activite->idactivite
                    );
                }
                $i++;
            }
            header('Location: /storymap/'.$projectId);
            exit();
        } catch (Exception $exception) {
            $this->view('error/oops', ['error' => $exception->getMessage()]);
        }
    }
}
