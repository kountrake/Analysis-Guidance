<?php

namespace Project\Controller;

use Exception;
use Project\Middleware\PersonnaMiddleware;
use Project\Middleware\UserStoryMiddleware;
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
                $html= $html . '<div class="flex justify-center bg-white w-full mt-10 p-4 ">
                    <h3 class="text-center text-2xl font-bold">Personna n° '. $i .'</h3>
                </div>
                <div class="w-full bg-white rounded mb-4 p-4">
                    <h3 class="text-center underline text-xl">Identité</h3>
                    <p class="p-2">Nom : '.$personna->nom .'</p>
                    <p class="p-2">Prénom : '.$personna->prenom .'</p>
                    <p class="p-2">Age : '.$personna->age .'</p>
                    <p class="p-2">Profession : '.$personna->role .'</p>
                </div>
                <div class="bg-white rounded mb-4 p-4">
                    <h3 class="text-center underline text-xl">Description</h3>
                    <p class="p-2">'.$personna->caractéristiques .'</p>
                </div>
                <div class="bg-white rounded mb-4 p-4">
                    <h3 class="text-center underline text-xl">Objectifs</h3>
                    <p class="p-2">'.$personna->objectif .'</p>
                </div>
                <div class="bg-white rounded mb-4 p-4">
                    <h3 class="text-center underline text-xl">Scénarios</h3>
                    <p class="p-2">'. $personna->scénario .'</p></div>';
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
            /*
        session_start();
        try {
            $user = $_SESSION['user'];
            $pm = new ProjectMiddleware();
            $pm->getProject($idproj, $user->getId());
            $UserMid = new UserStoryMiddleware($idproj);
            $Users= $UserMid->getAllUserStory();
        } catch (Exception $exception) {
            $this->view('oops', ['error' => $exception->getMessage()]);
        }*/
         if (isset($us))
         {
            $i = 1;
            foreach ($us as $User) {
                $html= $html . '<div class="mt-10 bg-white rounded">
                <h3 class="text-center underline text-xl">Us - '.$i.'</h3>
                <p class="p-2">
                    En tant que :'.$User->entantque .'
                </p>
                <p class="p-2">
                    Je veux : '.$User->jeveux .'
                </p>
                <p class="p-2">
                    De sorte que : '.$User->desorte.' 
                </p>
                <p class="p-2">
                    Je suis satisfait si :
                </p>
                <ul>
                    <li>'. $User->critere1 .'</li>
                    <li>'. $User->critere2 .'</li>
                    <li>'.  $User->critere3 .'</li>
                </ul>
            </div>';
                    $i++;
            }
        }
        return $html;
    }
}