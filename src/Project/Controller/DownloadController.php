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
        try {
            $html2pdf = new Html2Pdf('P', 'Legal', 'en', true, 'UTF-8', array(25.4, 20.4, 25.4, 20.4));
            $html2pdf->pdf->SetTitle('PDF PROJET N°'.$id);
            $html2pdf->WriteHTML($this->gethtmlPersonna($id));
            $html2pdf->Output('PDF-PROJET-N'.$id.'.pdf');
        } catch (HTML2PDF_exception $e) {
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
        if (session_status() != 2) {
            session_start();
        }
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
        if (isset($personnas)) {
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
        return $html.'<br>';
    }

    public function gethtmlUserStory($idproj)
    {
        try {
            $html2pdf = new Html2Pdf('P', 'Legal', 'en', true, 'UTF-8', array(25.4, 20.4, 25.4, 20.4));
            $html2pdf->pdf->SetTitle('PDF PROJET N°'.$idproj.' - US');
            $html2pdf->WriteHTML($this->getHTMLUserStorys($idproj));
            $html2pdf->Output('PDF-PROJET-N'.$idproj.'-US.pdf');
        } catch (HTML2PDF_exception $e) {
            echo $e;
            exit;
        }
    }
    public function getHTMLUserStorys($idproj)
    {
        $html='';
        if (session_status() != 2) {
            session_start();
        }
        try {
            $user = $_SESSION['user'];
            $pm = new ProjectMiddleware();
            $pm->getProject($idproj, $user->getId());
            $usMid = new UserStoryMiddleware($idproj);
            $userstories = $usMid->getAllUserStories();
        } catch (Exception $exception) {
            $this->view('oops', ['error' => $exception->getMessage()]);
        }
        if (isset($userstories)) {
            $nbUs = 1;
            $html = '';
            for ($i = 0; $i < count($userstories); $i+=3) {
                $html= $html . '<div class="mt-10 bg-white rounded" style="border:solid;">
                <u><h3 class="text-center underline text-xl" style="text-align: center;">Us - '.$nbUs.'</h3></u>
                <p class="p-2" style="margin-left:25px;">
                    En tant que :'.$userstories[$i]->entantque .'
                </p>
                <p class="p-2"style="margin-left:25px;">
                    Je veux : '.$userstories[$i]->jeveux .'
                </p>
                <p class="p-2"style="margin-left:25px;">
                    De sorte que : '.$userstories[$i]->desorte.' 
                </p>
                <p class="p-2"style="margin-left:25px;">
                    Je suis satisfait si :
                </p>
                <ul>
                    <li>'. $userstories[$i]->description .'</li>
                    <li>'. $userstories[$i+1]->description .'</li>
                    <li>'.  $userstories[$i+2]->description .'</li>
                </ul>
            </div><br>';
                        $nbUs++;
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
        } catch (HTML2PDF_exception $e) {
            echo $e;
            exit;
        }
    }

    public function getHTMLStoryMaps($idproj)
    {
        $html='';
        if (session_status() != 2) {
            session_start();
        }
        try {
            $user = $_SESSION['user'];
            $pm = new ProjectMiddleware();
            $pm->getProject($idproj, $user->getId());
            $storymapMid = new StoryMapMiddleware($idproj);
            $roles = $storymapMid->getAllRoles();
            $activites = $storymapMid->activitiesFromRoles($roles);
            $stories = $storymapMid->storiesFromActivities($activites);
            $columns = $storymapMid->createColumns($roles, $activites, $stories);
        } catch (Exception $exception) {
            $this->view('oops', ['error' => $exception->getMessage()]);
        }
            $html = '
            <div class="">
                <u><h1 class="text-center text-4xl font-bold underline" style="text-align:center;">Story Map</h1></u>
            </div>
            <br>
            <div class="Tout">';
                    for ($i = 0; $i < count($columns); $i++)
                    {
                        $html=$html.'<br>
                        <div class="Colonne" style="width:92%;">
                            <div class="1erligne" style="border:solid">
                            <u><h3 style="text-align:center;">Thème</h3></u>'.'<div style="margin-left:15px;">'.
                                $columns[$i]->role->role .'</div><br>
                            </div>
                            <div class="2emeligne" style="border:solid">
                            <u><h3 style="text-align:center;">Epics</h3></u>';
                            foreach ($columns[$i]->activites as $activite)
                            {
                                $html=$html.'<div style="margin-left:15px;">'. $activite->activite. '</div><br>' ;
                            }
                            $html=$html.'
                            </div>
                            <div class="3emeligne" style="border:solid">
                            <u><h3 style="text-align:center;">V1</h3></u>';
                            foreach ($columns[$i]->stories as $story)
                            {
                                $html=$html.'<div style="margin-left:15px;">'.$story->description. '</div><br>';
            }
                                    $html=$html.'
                            </div>
                        </div>';
        }
                    $html=$html.'</div>';
        return $html;
    }

    public function gethtmlProject($idproj)
    {
        try {
            $html2pdf = new Html2Pdf('P', 'Legal', 'en', true, 'UTF-8', array(25.4, 20.4, 25.4, 20.4));
            $html2pdf->pdf->SetTitle('PDF PROJET N°'.$idproj.' - Persona');
            $html=($this->getHTMLPersonnas($idproj));
            $html=$html.($this->getHTMLUserStorys($idproj));
            $html=$html.($this->getHTMLStoryMaps($idproj));
            $html2pdf->WriteHTML($html);
            $html2pdf->Output('PDF-PROJET-N'.$idproj.'-Persona.pdf');
        } catch (Exception $e) {
            echo $e;
            exit();
        }
    }

}