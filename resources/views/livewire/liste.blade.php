 <div class="row p-4' pt-5">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fas fa-users fa-2x"></i>Listes des utilisateurs</h3>

                <div class="card-tools d-flex align-items-center">
                   <a href="{{ route('users.index', ['form' => 'add']) }}" class="btn btn-primary">
                    <i class="fa fa-user-plus"></i> Nouvel utilisateur
                    </a>

                  <div class="input-group input-group-nd" style="width: 250px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th style="width:5%;"></th>
                      <th style="width:25%;">Utilisateurs</th>
                      <th style="width:20%;">Roles</th>
                      <th style="width:20%;" class="text-center">Ajouter</th>
                      <th style="width:30%;" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        @foreach ($users as $user )
                            
                      <td>
                        @if($user->sexe == "femme")
                         <img src="{{asset('image/businesswoman.png')}}" width="24">
                        @else
                         <img src="{{asset('image/boss.png')}}" width="24">
                        @endif
                      </td>
                      <td>{{ $user->nom_complet}}</td>
                      <td>{{    $user->roles->pluck('role')->implode(' | ') ?? 'Aucun rôle' }}</td>
                      <td class="text-center"><span class="tag tag-success">
                        {{ $user->created_at ? $user->created_at->diffForHumans() : 'Date inconnue' }}
                        </span></td>
                      <td class="text-center"> 
                        <button class="btn btn-link"><i class="far fa-edit"></i></button>
                        <button class="btn btn-link"><i  class="fas fa-trash-alt"class="fas fa-trash-alt"></i></button>
                      </td>
                    </tr>
                 @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                {{ $users->links('pagination::bootstrap-5') }}
               
             </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
    
     
</div>