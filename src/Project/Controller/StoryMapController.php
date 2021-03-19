<?php


namespace Project\Controller;

class StoryMapController extends Controller
{
    public function index(string $projectId)
    {
        session_start();
        $pm = new ProjectMiddleware();
        $storymapMid = new StoryMapMiddleware($projectId);
        $storymap = $storymapMid->getStorymap();
        if (!$storymap) {
            $this->viewcontrol('storymap', ['projectId' => $projectId]);
        } else {
            $this->viewcontrol('storymap', ['projectId' => $projectId, 'storymap' => $storymap]);
        }
    }

    public function create()
    {

        session_start();
        try {
            $theme1 = $_POST['theme1'];
            $theme2 = $_POST['theme2'];
            $theme3 = $_POST['theme3'];
            $theme4 = $_POST['theme4'];
            $theme5 = $_POST['theme5'];
            $theme6 = $_POST['theme6'];
            $epic1 = $_POST['epic1'];
            $epic2 = $_POST['epic2'];
            $epic3 = $_POST['epic3'];
            $epic4 = $_POST['epic4'];
            $epic5 = $_POST['epic5'];
            $epic6 = $_POST['epic6'];
            $story1 = $_POST['story1'];
            $story2 = $_POST['story2'];
            $story3 = $_POST['story3'];
            $story4 = $_POST['story4'];
            $story5 = $_POST['story5'];
            $story6 = $_POST['story6'];
            $story7 = $_POST['story7'];
            $story8 = $_POST['story8'];
            $story9 = $_POST['story9'];
            $story10 = $_POST['story10'];
            $story11 = $_POST['story11'];
            $story12 = $_POST['story12'];
            $storymapMid = new StoryMapMiddleware($_POST['projectId']);
            $storymapMid->create_role($theme1);
            $storymapMid->create_role($theme2);
            $storymapMid->create_role($theme3);
            $storymapMid->create_role($theme4);
            $storymapMid->create_role($theme5);
            $storymapMid->create_role($theme6);
            $storymapMid->create_activite($epic1);
            $storymapMid->create_activite($epic2);
            $storymapMid->create_activite($epic3);
            $storymapMid->create_activite($epic4);
            $storymapMid->create_activite($epic5);
            $storymapMid->create_activite($epic6);
            $storymapMid->create_story($story1,1);
            $storymapMid->create_story($story2,1);
            $storymapMid->create_story($story3,1);
            $storymapMid->create_story($story4,1);
            $storymapMid->create_story($story5,1);
            $storymapMid->create_story($story6,1);
            $storymapMid->create_story($story7,1);
            $storymapMid->create_story($story8,1);
            $storymapMid->create_story($story9,1);
            $storymapMid->create_story($story10,1);
            $storymapMid->create_story($story11,1);
            $storymapMid->create_story($story12,1);
            header('Location: /storymap/' . $_POST['projectId']);
            exit();
        }
        catch (Exception $exception) {
            $this->view('oops', ['error' => $exception->getMessage()]);
        }
    }


    public function update()
    {

        session_start();
        try {
            $theme1 = $_POST['theme1'];
            $theme2 = $_POST['theme2'];
            $theme3 = $_POST['theme3'];
            $theme4 = $_POST['theme4'];
            $theme5 = $_POST['theme5'];
            $theme6 = $_POST['theme6'];
            $epic1 = $_POST['epic1'];
            $epic2 = $_POST['epic2'];
            $epic3 = $_POST['epic3'];
            $epic4 = $_POST['epic4'];
            $epic5 = $_POST['epic5'];
            $epic6 = $_POST['epic6'];
            $story1 = $_POST['story1'];
            $story2 = $_POST['story2'];
            $story3 = $_POST['story3'];
            $story4 = $_POST['story4'];
            $story5 = $_POST['story5'];
            $story6 = $_POST['story6'];
            $story7 = $_POST['story7'];
            $story8 = $_POST['story8'];
            $story9 = $_POST['story9'];
            $story10 = $_POST['story10'];
            $story11 = $_POST['story11'];
            $story12 = $_POST['story12'];
            $storymapMid = new StoryMapMiddleware($_POST['projectId']);
            $storymapMid->update_role($theme1);
            $storymapMid->update_role($theme2);
            $storymapMid->update_role($theme3);
            $storymapMid->update_role($theme4);
            $storymapMid->update_role($theme5);
            $storymapMid->update_role($theme6);
            $storymapMid->update_activite($epic1);
            $storymapMid->update_activite($epic2);
            $storymapMid->update_activite($epic3);
            $storymapMid->update_activite($epic4);
            $storymapMid->update_activite($epic5);
            $storymapMid->update_activite($epic6);
            $storymapMid->update_story($story1,1);
            $storymapMid->update_story($story2,1);
            $storymapMid->update_story($story3,1);
            $storymapMid->update_story($story4,1);
            $storymapMid->update_story($story5,1);
            $storymapMid->update_story($story6,1);
            $storymapMid->update_story($story7,1);
            $storymapMid->update_story($story8,1);
            $storymapMid->update_story($story9,1);
            $storymapMid->update_story($story10,1);
            $storymapMid->update_story($story11,1);
            $storymapMid->update_story($story12,1);
            header('Location: /storymap/' . $_POST['projectId']);
            exit();
        }
        catch (Exception $exception) {
            $this->view('oops', ['error' => $exception->getMessage()]);
        }
    }

}
