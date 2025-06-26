<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            

            <li class="nav-item ">
                <a href="#" class="nav-link active">
                  <i class="nav-icon fas fa-home"></i>
                  <p>
                    Acceuil
                  </p>
                </a>
            </li>
            
          <li class="nav-item ">
            <a href="#" class="nav-link active ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
               Tableau de bord
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="nav-icon fas fa-chart-line"></i>
                  <p>Vue globale</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-swatchbooks"></i>
                  <p>Locations</p>
                </a>
              </li>
              </ul>
              </li>
              
              <li class="nav-item ">
                <a href="#" class="nav-link active">
                  <i class="nav-icon fas fa-user-shield"></i>
                  <p>Habilitations
                    <i class="nav-icon fas fa-angle-left"></i>
                  </p>
                </a>
             <ul class="nav nav-treeview">
          <li class="nav-item active">
           <a href="{{ route('Utilisateurs')}}" class="nav-link active">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
               Utilisateurs
              </p>
            </a>
            </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-fingerprint"></i>
                  <p>roles et permissions</p>
                </a>
              </li>
              </ul>
            </li>
  
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="nav-icon fas fa-cogs"></i>
                  <p>gestions matériels
                    <i class="nav-icon fas fa-angle-left"></i>
                  </p>
                </a>
              <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-circle"></i>
              <p>
               Materiels
              </p>
            </a>
            </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-sliders-h"></i>
                  <p>tarifications</p>
                </a>
              </li>
              </ul>
            </li>
            
            
            <li class="nav-header ">Location</li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    gestions des clients
                  </p>
                </a>
            </li>
          <li class="nav-item">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-exchange-alt"></i>
              <p>
               gestions des locations
              </p>
            </a>
            </li>
           
             <li class="nav-header ">Caisse</li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-coins"></i>
                  <p>
                    gestions des paiements
                  </p>
                </a>
            </li>
          
        </ul>
          
         
      </nav>