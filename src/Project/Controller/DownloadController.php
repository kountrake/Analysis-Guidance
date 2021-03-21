<?php

namespace Project\Controller;

use Exception;
use Project\Middleware\PersonnaMiddleware;
use Project\Middleware\UserStoryMiddleware;
use Project\Middleware\StoryMapMiddleware;
use Project\Middleware\ProjectMiddleware;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Html2Pdf;

class DownloadController extends Controller
{
    public function index($id)
    {
        /*
        header('Content-type: text/plain');
        header('Content-Disposition: attachment; filename="projet.json"');
        //TODO Il faut créer le Middleware permettant de générer le JSON et le mettre dans le print ci dessous
        $jsonExample = '{
        "menu": {
              "id": "file",
              "value": "File",
              "popup": {
                  "menuitem": [
                      {"value": "New", "onclick": "CreateNewDoc()"},
                      {"value": "Open", "onclick": "OpenDoc()"},
                      {"value": "Close", "onclick": "CloseDoc()"}
                  ]
              }
        }
}';
        print $jsonExample;*/      
        try {
            /*
            $url = 'http://localhost:8000/personna/15';//url('personna/'.$id);
            $html = file_get_contents($url);
*/
            $html2pdf = new Html2Pdf('P', 'Legal', 'en', true, 'UTF-8', array(25.4, 20.4, 25.4, 20.4));
            $html2pdf->pdf->SetTitle('PDF PROJET N°'.$id);
            $html2pdf->WriteHTML($this->gethtmlPersonna($id) /*$this->render('personna', ['projectId' => $id])*/ /*$html*/);
            $html2pdf->Output('PDF-PROJET-N'.$id.'.pdf');
        }
        catch (HTML2PDF_exception $e) {
            echo $e;
            exit;
    }
}
    public function gethtmlPersonna($idproj)
    {
        try {
            $html2pdf = new Html2Pdf('P', 'Legal', 'en', true, 'UTF-8', array(25.4, 20.4, 25.4, 20.4));
            $html2pdf->pdf->SetTitle('PDF PROJET N°'.$idproj.' - Persona');
            $html2pdf->WriteHTML($this->getHTMLPersonnas($idproj));
            $html2pdf->Output('PDF-PROJET-N'.$idproj.'-Persona.pdf');
        } catch (Exception $e) {
            echo $e;
            exit();
        }
    }

    public function getHTMLPersonnas($idproj)
    {
        $html='';
        session_start();
        try {
            $user = $_SESSION['user'];
            $pm = new ProjectMiddleware();
            $pm->getProject($idproj, $user->getId());
            $personnaMid = new PersonnaMiddleware($idproj);
            $personnas = $personnaMid->getAllPersonnas();
        } catch (Exception $exception) {
            $this->view('error/oops', ['error' => $exception->getMessage()]);
            exit();
        }
         if (isset($personnas))
         {
            $i = 1;
            foreach ($personnas as $personna) {
                $html= $html . '<div style="border:solid";>
                <div class="flex justify-center bg-white w-full mt-10 p-4 " style="text-align:center";>
                    <u><h3 class="text-center text-2xl font-bold">Personna n° '. $i .'</h3></u>
                </div>
                <div class="w-full bg-white rounded mb-4 p-4" style="border:solid;">
                <u><h3 class="text-center underline text-xl"style="text-align:center;">Identité</h3></u>
                    <p class="p-2"style="margin-left:25px;">Nom : '.$personna->nom .'</p>
                    <p class="p-2"style="margin-left:25px;">Prénom : '.$personna->prenom .'</p>
                    <p class="p-2"style="margin-left:25px;">Age : '.$personna->age .'</p>
                    <p class="p-2"style="margin-left:25px;">Profession : '.$personna->role .'</p>
                    <br>
                </div>
                <div class="bg-white rounded mb-4 p-4" style="border:solid";>
                <u><h3 class="text-center underline text-xl"style="text-align:center;">Description</h3></u>
                    <p class="p-2" style="margin-left:25px;">'.$personna->caractéristiques .'</p>
                    <br>
                </div>
                <div class="bg-white rounded mb-4 p-4" style="border:solid";>
                <u> <h3 class="text-center underline text-xl"style="text-align:center;">Objectifs</h3></u>
                    <p class="p-2"style="margin-left:25px;">'.$personna->objectif .'</p>
                    <br>
                </div>
                <div class="bg-white rounded mb-4 p-4" style="border:solid";>
                <u> <h3 class="text-center underline text-xl"style="text-align:center;">Scénarios</h3></u>
                    <p class="p-2"style="margin-left:25px;">'. $personna->scénario .'</p><br></div></div>';
                    $i++;
            }
        }
        return $html;
    }

    public function gethtmlUserStory($idproj)
    {
        try {
            $html2pdf = new Html2Pdf('P', 'Legal', 'en', true, 'UTF-8', array(25.4, 20.4, 25.4, 20.4));
            $html2pdf->pdf->SetTitle('PDF PROJET N°'.$idproj.' - US');
            $html2pdf->WriteHTML($this->getHTMLUserStorys($idproj));
            $html2pdf->Output('PDF-PROJET-N'.$idproj.'-US.pdf');
        }
        catch (HTML2PDF_exception $e) {
            echo $e;
            exit;
    }
}
    public function getHTMLUserStorys($idproj)
    {
        $html='';
        session_start();
        try{
            $user = $_SESSION['user'];
            $pm = new ProjectMiddleware();
            $pm->getProject($idproj, $user->getId());
            $usMid = new UserStoryMiddleware($idproj);
            $us = $usMid->getAllUserStories();
        }
        catch(Exception $exception) {
            $this->view('oops', ['error' => $exception->getMessage()]);
        }
         if (isset($us))
         {
            $i = 1;
            $html = '';
            foreach ($us as $User) {
                $html= $html . '<div class="mt-10 bg-white rounded" style="border:solid;">
                <u><h3 class="text-center underline text-xl" style="text-align: center;">Us - '.$i.'</h3></u>
                <p class="p-2" style="margin-left:25px;">
                    En tant que :'.$User->entantque .'
                </p>
                <p class="p-2"style="margin-left:25px;">
                    Je veux : '.$User->jeveux .'
                </p>
                <p class="p-2"style="margin-left:25px;">
                    De sorte que : '.$User->desorte.' 
                </p>
                <p class="p-2"style="margin-left:25px;">
                    Je suis satisfait si :
                </p>
                <ul>
                    <li>'. $User->critere1 .'</li>
                    <li>'. $User->critere2 .'</li>
                    <li>'.  $User->critere3 .'</li>
                </ul>
            </div><br>';
                        $i++;
                    }
                }
        return $html;
    }

    public function gethtmlStoryMap($idproj)
    {
        try {
            $html2pdf = new Html2Pdf('P', 'Legal', 'en', true, 'UTF-8', array(25.4, 20.4, 25.4, 20.4));
            $html2pdf->pdf->SetTitle('PDF PROJET N°'.$idproj.' - STORY MAP');
            $html2pdf->WriteHTML($this->getHTMLStoryMaps($idproj));
            $html2pdf->Output('PDF-PROJET-N'.$idproj.'-STORYMAP.pdf');
        }
        catch (HTML2PDF_exception $e) {
            echo $e;
            exit;
    }
}

    public function getHTMLStoryMaps($idproj)
    {
        $html='';
        session_start();
        try{
            $user = $_SESSION['user'];
            $pm = new ProjectMiddleware();
            $pm->getProject($idproj, $user->getId());
            $storymapMid = new StoryMapMiddleware($idproj);
            $roles = $storymapMid->getAllRoles();
            $activites = $storymapMid->activitiesFromRoles($roles);
            $stories = $storymapMid->storiesFromActivities($activites);
            $columns = $storymapMid->createColumns($roles, $activites, $stories);
        }
        catch(Exception $exception) {
            $this->view('oops', ['error' => $exception->getMessage()]);
        }
            $html = '
            <div class="flex justify-center bg-white w-full mt-10 p-4 mb-12" style="text-align:center;">
                <u><h1 class="text-center text-4xl font-bold underline">Story Map</h1></u>
            </div>
            <br>
            <div class="flex flex-col w-full px-8 pr-40 bg-white">
                <div class="flex flex-row m-4">
                    <div class="flex flex-col border border-black border-r-0 justify-items-center">
                        <div class="border-b border-black p-4 text-center">'.
                            $columns[0]->role->role.'
                        </div>
                        <div class="p-4 border-b border-black">';
                           foreach ($columns[0]->activites as $activite)
                           {
                                $html=$html. $activite->activite. '<br>';
                           }
                           $html=$html.'
                        </div>
                        <div class="p-4">';
                            foreach ($columns[0]->stories as $story)
                            {
                                $html=$html. $story->description. '<br>';
                            }
                            $html=$html.'
                        </div>
                    </div>';
                    for ($i = 1; $i < count($columns); $i++)
                    {
                        $html=$html.'
                        <div class="flex flex-col border-t border-b border-black justify-items-start">
                            <div class="border-b border-black p-4">'.
                                $columns[$i]->role->role .'
                            </div>
                            <div class="p-4 border-b border-black">';
                            foreach ($columns[$i]->activites as $activite)
                            {
                                $html=$html. $activite->activite. '<br>' ;
                            }
                            $html=$html.'
                            </div>
                            <div class="p-4">';
                            foreach ($columns[$i]->stories as $story)
                            {
                                $html=$html.$story->description. '<br>';
                            }
                            $html=$html.'
                            </div>
                        </div>';
                    }
                    $html=$html.'
                    <div class="flex flex-col items-stretch content-between border border-black border-l-0 item-center">
                        <div class="border-b border-black p-4">
                            Thèmes
                        </div>
                        <div class="p-4 border-b border-black">
                            Epics
                        </div>
                        <div class="p-4">
                            V1
                        </div>
                    </div>
                </div></div>';
        return $html;
    }

}