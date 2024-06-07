@extends('layouts.app')
@section('title','Accueil')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap"
    rel="stylesheet"/>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
<style>
      #essay{
            margin-left: 250px;
    margin-top: 10px;
    width: calc(100% - 250px);

    background-color: #FEF5E7;
        }

    #nij{
        background-color: #FEF5E7;
    }
  #header {
      background-color: #38512F; /* Changer la couleur de fond en vert */
      width: calc(100% - 14.08rem); /* Calculer la largeur en soustrayant
      la largeur de la barre de menu */
      float: right;
      height: 70px;

  }
  #body {
      background-color: #FEF5E7; /* Changer la couleur de fond de l'interface en #FEF5E7 */
  }
  .page-container {
      min-height: 100vh; /* Hauteur minimum de la page pour occuper toute la fenêtre */
      display: flex;
      justify-content: center; /* Alignement horizontal au centre */
      align-items: center; /* Alignement vertical au centre */
  }
  .box {
       width: 600px;
       height: 500px;
        /* Spécifie une bordure de 2
                                 pixels de large, solide et rouge */
       position: absolute; /* Position absolue par rapport au corps */
       top: 65%; /* Place le haut de la boîte à 50% de la hauteur du corps */
       left: 60%; /* Place la gauche de la boîte à 50% de la largeur du corps */
       text-align: center;
       transform: translate(-50%, -50%); /* Centre la boîte horizontalement et verticalement */
       border-radius: 15px;
      text-decoration-color: #35512F;

       }
       #animated-text {
          margin-top:50px;
          margin-left:20px;
          font-size: 24px;
          font-family: Arial, sans-serif;
          color: #35512F;
          overflow: hidden;
          font-weight: bold; /* Met le texte en gras */
      }

</style>
 <div class="content-wrapper" id="essay">

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      </div>
    </div>
    <div id="body">

        <div class="box">

             <div>
             </div>
              <div id="animated-text">
                  <h4 >Bienvenue dans votre espace enseignant !</h4>
                  <h4  >Saisissez votre  non-disponibilité, consultez vos emplois du temps des examens.</h4>
              </div>

        </div>

        </div>
  </div>
@endsection
