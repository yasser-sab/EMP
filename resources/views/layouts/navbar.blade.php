      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle"  href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Formateur</a>
        <div class="dropdown-menu"  aria-labelledby="navbarDropdown">
          <a class="dropdown-item"  href="{{url('Formateurs')}}">Lister les formateurs</a>
          <a class="dropdown-item"  href="{{url('module_formateur')}}">Competance des formateurs</a>
          <a class="dropdown-item"  href="{{url('filier_formateur')}}">Affectation des filieres</a>
          <a class="dropdown-item"  href="{{url('formateur_groupe_module')}}">Affectation des modules</a>
          <!-- <a class="dropdown-item"  href="{{url('affectformateurs')}}">Affectation des formateurs</a> -->
        </div>
      </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle"  href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Seance</a>
        <div class="dropdown-menu"  aria-labelledby="navbarDropdown">
          <a class="dropdown-item"  href="{{url('seances')}}">Lister les seances</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle"  href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Filiers
        </a>
        <div class="dropdown-menu"  aria-labelledby="navbarDropdown">
          <a class="dropdown-item"  href="{{url('filiers')}}">Liste des filiers</a>
          <a class="dropdown-item"  href="{{url('module_filier')}}">liste des filiers par modules</a>
          
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle"  href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Groupes
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item"  href="{{url('groupes')}}">liste des groupes</a>
          <a class="dropdown-item"  href="{{url('niveaux')}}">liste des niveaux</a>
          <!-- <a class="dropdown-item"  href="#">Groupe par filiers</a> -->
          
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle"  href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Modules
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item"  href="{{url('modules')}}">Liste des modules</a>
          <a class="dropdown-item"  href="{{url('module_filier')}}">liste des modules par filiers</a>
          
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle"  href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Salles
        </a>
        <div class="dropdown-menu"  aria-labelledby="navbarDropdown">
          <a class="dropdown-item"  href="{{url('salles')}}">Liste des salles</a>
          
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle"  href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Stages
        </a>
        <div class="dropdown-menu"  aria-labelledby="navbarDropdown">
          <a class="dropdown-item"  href="{{url('stage_groupe')}}">affectation des stages</a>
          
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle"  href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Emplois
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <!-- <a class="dropdown-item"  href="{{url('emplois/filter/createFilter')}}">Ajouter un emploi</a> -->
          <a class="dropdown-item"  href="{{url('emplois/edit?semaine=-1&filier=-1&groupe=-1')}}">Valider un emploi</a>
          <!-- <a class="dropdown-item"  href="{{url('emplois/filter/consultFilter')}}">Consulter les emplois</a> -->
          <a class="dropdown-item"  href="{{url('semaines')}}" >Liste des semaines</a>
          <a class="dropdown-item"  href="{{url('emploiparams')}}">Parametrer emploi</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle"  href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Consultation
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item"  href="{{url('emplois/filter/consultFilterFormateur')}}">par Formateur</a>
          <a class="dropdown-item"  href="{{url('emplois/filter/consultFilterSalle')}}">par salle</a>
          <a class="dropdown-item"  href="{{url('emplois/filter/consultFilterGroupe')}}">par groupe</a>
        </div>
      </li>
    <!--<form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>-->