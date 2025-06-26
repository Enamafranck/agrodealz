 <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="bg-dark">
              <div class="card-body bg-dark box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="{{asset ('image/user.png')}}" alt="User profile picture">
                </div>
                

                <h3 class="profile-username text-center ellipsis">{{ auth()->user()->nom_complet}}</h3>

                <center><p class="text-muted text-center" style=" color: #ffffff !important;
                   font-weight: bold;
                  text-shadow: 1px 1px 2px rgba(241, 234, 234, 0.5);
                  opacity: 1 !important;
                  visibility: visible !important;
                  display: inline-block !important;">{{getroleName()}}</p></center>
                    
                

                <ul class="list-group bg-dark mb-3">
                  
                  <li class="list-group-item">
                  <a href="#" class="d-flex align-items-center "><i class="fa fa-lock pr-2"></i><b >Mot de passe</b></a>
                  </li>
                  <li class="list-group-item">
                    <a href="#" class="d-flex align-items-center "><i class="fa fa-user pr-2"></i><b >Mon profile</b></a>
                  </li>
                </ul>

                 <a class="btn btn-primary btn-block" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                    Déconnexion
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                   </form>
     
              </div>
              <!-- /.card-body -->
            </div>
  </aside>