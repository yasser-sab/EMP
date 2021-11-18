 <div class="d-flex toggled" id="wrapper" style="position: fixed;width: 100%; z-index: 222;">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper" >
      <div class="sidebar-heading" style="text-align: center;text-transform: uppercase;padding: 15px 0px;letter-spacing: 0.4em;font-size: 120%;">menu</div>
      <div class="list-group list-group-flush">
        <ul class="list-group list-group-flush">
               
                    <a href="#" data-toggle="collapse" data-target="#submenu-1" color="black" class=" btn btn-success">Formateur</a>
                    <ul id="submenu-1" class="collapse">
                    <a class="list-group-item list-group-item-action bg-light" href="{{url('Formateurs/create')}}">Nouveau formateur</a>
                    <a class="list-group-item list-group-item-action bg-light"  href="{{url('competances/create')}}">Nouveau Competance formateur</a>
                    <a class="list-group-item list-group-item-action bg-light"  href="{{url('affectfiliers/create')}}">Nouveau Affectation filiere</a>
                    <a class="list-group-item list-group-item-action bg-light"  href="{{url('affectmodules/create')}}">Nouveau Affectation module</a> 
                    <!-- <a class="list-group-item list-group-item-action bg-light"  href="#">Absence des formateurs</a> -->    
                    </ul>                            
                    <a href="#" data-toggle="collapse" data-target="#submenu-2" class="btn btn-secondary">Filiers</a>
                    <ul id="submenu-2" class="collapse">
                        <a href="{{url('filiers/create')}}" class="list-group-item list-group-item-action bg-light">Nouveau filier</a>
                        <a class="list-group-item list-group-item-action bg-light"  href="{{url('modulefiliers')}}">Nouveau modules filiers</a>
                        <!-- <a href="#"class="list-group-item list-group-item-action bg-light">Groupe par filiers</a> -->
                    </ul>        
                    <ul class="list-group list-group-flush">               
                    <a href="#" data-toggle="collapse" data-target="#submenu-3" class="btn btn-primary">Groupes</a>
                    <ul id="submenu-3" class="collapse">
                        <a href="{{url('groupes/create')}}" class="list-group-item list-group-item-action bg-light">Nouveau groupe</a>
                        <a class="list-group-item list-group-item-action bg-light"  href="{{url('niveauGroupes')}}">Nouveau niveaux groupes</a>
                        <!-- <a href="#"class="list-group-item list-group-item-action bg-light">Groupe par filliers</a> -->
                    </ul>
                    <ul class="list-group list-group-flush">               
                    <a href="#" data-toggle="collapse" data-target="#submenu-4" class="btn btn-success">Modules</a>
                    <ul id="submenu-4" class="collapse">
                        <a href="{{url('modules/create')}}" class="list-group-item list-group-item-action bg-light">Nouveau module</a>
                        <a class="list-group-item list-group-item-action bg-light"  href="{{url('modulefiliers')}}">Nouveau modules filiers</a>
                    </ul>
                    <ul class="list-group list-group-flush">               
                    <a href="#" data-toggle="collapse" data-target="#submenu-5" class="btn btn-secondary">Salles</a>
                    <ul id="submenu-5" class="collapse">
                        <a href="{{url('salles/create')}}" class="list-group-item list-group-item-action bg-light">Nouveau salle</a>
                    </ul>
                    

                    <ul class="list-group list-group-flush">               
                    <a href="#" data-toggle="collapse" data-target="#submenu-6" class="btn btn-primary">Emplois</a>
                    <ul id="submenu-6" class="collapse">
                        <a href="{{url('emploiparams/create')}}"class="list-group-item list-group-item-action bg-light">paramétrer emplois</a>
                        <a href="{{url('emplois/edit?semaine=-1&filier=-1&groupe=-1')}}"class="list-group-item list-group-item-action bg-light">Valider un emploi</a>
                        <a href="{{url('semaines/create')}}"class="list-group-item list-group-item-action bg-light">generer semaines</a>
                        <a href="{{url('emploiparams/generer')}}"class="list-group-item list-group-item-action bg-light">Generer emplois</a>
                    </ul>
               <!--<a href="#" class="list-group-item list-group-item-action bg-light">Status</a>-->
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper" style="width: 100%;">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle"><span class="navbar-toggler-icon"></span></button>
        @include('layouts.filter')

      </nav>
      <!-- <div class="container-fluid">@yield('content')</div> -->
    </div>
    <!-- /#page-content-wrapper -->
  </div>
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    }); 
  </script>
  <dir style="height: 30px;"></dir>