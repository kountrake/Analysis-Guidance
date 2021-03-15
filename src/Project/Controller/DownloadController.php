<?php


namespace Project\Controller;

class DownloadController extends Controller
{
    public function index()
    {
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
        print $jsonExample;
    }
}
