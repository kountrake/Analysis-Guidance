<?php


namespace Project\Controller;

use \Exception;
use Project\Middleware\ProjectMiddleware;
use Project\Middleware\ProjectMiddlewareException;
use Project\Middleware\StoryMapMiddleware;
use Project\Middleware\UserStoryMiddleware;

class StoryMapController extends Controller
{
    public function index(string $projectId)
    {
        session_start();
        try {
            $pm = new ProjectMiddleware();
            $pm->getProject($projectId, $_SESSION['user']->getId());
            $storymapMid = new StoryMapMiddleware($projectId);
            $roles = $storymapMid->getAllRoles();
            $activites = $storymapMid->activitiesFromRoles($roles);
            $stories = $storymapMid->storiesFromActivities($activites);
            $columns = $storymapMid->createColumns($roles, $activites, $stories);
            $this->viewcontrol('storymap', ['projectId' => $projectId, 'columns' => $columns]);
            $Score_StoryMap = $storymapMid->getNumberStories($projectId);
            if(($Score_StoryMap->cou)<5){$pm->update_score_sm($Score_StoryMap->cou,$projectId);}
            else{$pm->update_score_sm(5,$projectId);}
        } catch (ProjectMiddlewareException $e) {
        }
    }

    public function role($projectId)
    {
        session_start();
        try {
            $pm = new ProjectMiddleware();
            $pm->getProject($projectId, $_SESSION['user']->getId());
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
        session_start();
        try {
            $pm = new ProjectMiddleware();
            $pm->getProject($projectId, $_SESSION['user']->getId());
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
                        $_POST[$role->idbut . '_' . $activite->idactivite . '_1'],
                        intval($_POST[$role->idbut . '_' . $activite->idactivite . 'priorite_1']),
                        $activite->idactivite
                    );
                    $smMid->createStory(
                        $_POST[$role->idbut . '_' . $activite->idactivite . '_2'],
                        intval($_POST[$role->idbut . '_' . $activite->idactivite . 'priorite_2']),
                        $activite->idactivite
                    );
                    $smMid->createStory(
                        $_POST[$role->idbut . '_' . $activite->idactivite . '_3'],
                        intval($_POST[$role->idbut . '_' . $activite->idactivite . 'priorite_3']),
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

    public function delete()
    {
        session_start();
        try {
            $projectId = $_POST['projectId'];
            $pm = new ProjectMiddleware();
            $pm->getProject($projectId, $_SESSION['user']->getId());
            $storymapMid = new StoryMapMiddleware($projectId);
            $storymapMid->delete();
            header('Location: /myprojects/'.$projectId);
            exit();
        } catch (Exception $exception) {
            $this->view('error/oops', ['error' => $exception->getMessage()]);
        }
    }
}
