<div id= "window" class="w-full">
  <div class="flex justify-center bg-white w-full mt-10 p-4 ">
    <h1 class="text-center text-4xl font-bold underline">Matrice</h1>
  </div>

  <div class="flex flex-col w-full px-8">
    <div class="my-4 mx-2">

      <div class="flex flex-row justify-between">
        <table id="table_matrice">
          <tbody>
            <tr>
              <td>"dessin de croix"</td>
              <td>UC1</td>
              <td>UC2</td>
            </tr>
            <tr>
              <td>Fonctionnalité 1</td>
              <td> </td>
              <td> </td>
            </tr>
            <tr>
              <td>Fonctionnalité 2</td>
              <td> </td>
              <td> </td>
            </tr>
          </tbody>
        </table>

      </div>
      <div class="flex justify-center">
        <button class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">
          Générer
        </button>
      </div>
    </div>

    <div class="flex flex-row justify-end">
      <form method="post" action="/matrice/change">
        <input type="hidden" name="idProjet" value="<?= $projectId ?>">
        <input type="hidden" name="idMatrice" value="<?= $matrice->idpersonna ?>">
        <button class="bg-yellow-700 rounded border-2 border-yellow-800 py-2 px-5 mr-4 text-white text-semi-bold hover:underline hover:bg-yellow-600">
          Modifier
        </button>
      </form>
      <form method="post" action="/delete/matrice">
        <input type="hidden" name="idProjet" value="<?= $projectId ?>">
        <input type="hidden" name="id" value="<?= $personna->idpersonna ?>">
        <button class="bg-red-700 rounded border-2 border-red-800 py-2 px-5  text-white text-semi-bold hover:underline hover:bg-red-600">
          Supprimer le projet
        </button>
      </form>
    </div>

    <div class="flex flew-row justify-around mb-4">
      <a href="/download" class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">
        Télécharger
      </a>
      <a href="/userstory" class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">
        Suivant
      </a>
    </div>
  </div>
</div>