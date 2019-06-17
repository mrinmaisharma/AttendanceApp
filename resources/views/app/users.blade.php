@extends('admin.layout.base')
@section('title', 'Users')


@section('content')

            <div id="main">
                <div class="inner">

                    <!--Header -->
                    <header id="header">
                        <a href="/admin" class="logo"><strong>{{getenv('APP_NAME')}}</strong> Admin Panel</a>
                        <ul class="icons">
                            <li><a href="#"><i class="icon fab fa-linkedin-in fa-lg"><span class="label">Medium</span></i></a></li>
                            <li><a href="#"><i class="icon fab fa-facebook fa-lg"><span class="label">Facebook</span></i></a></li>
                            <li><a href="#"><i class="icon fab fa-instagram fa-lg"><span class="label">Instagram</span></i></a></li>
                            <li><a href="#"><i class="icon fab fa-twitter fa-lg"><span class="label">Twitter</span></i></a></li>
                        </ul>
                    </header>

                    <section>
                        <h2>Users</h2>

                        @include('includes.form_alert')
                        
                    </section>

                    <section>
                        <div class="row gtr-uniform">
                            <div class="col-md-12">
                                @if(count($users))
                                    <h3>Records <a href="/admin/testimonials"><span data-toggle="tooltip" data-placement="top" title="Refresh Data"><i class="fas fa-sync-alt"></i></span></a></h3>
                                    <table id="category-table" class="table table-hover" data-form="deleteForm">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Username</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Verified</th>
                                                <th>Added</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $user)
                                             <tr>
                                                 <td>{{$user['id']}}</td>
                                                 <td>{{$user['username']}}</td>
                                                 <td>{{$user['fullname']}}</td>
                                                 <td>{{$user['email']}}</td>
                                                 <td>{{$user['role']}}</td>
                                                 <td>{{($user['verified']==1) ? 'Yes' : 'No'}}</td>
                                                 <td>{{$user['added']}}</td>
                                                 <td>
                                                     <span data-toggle="modal" style="color:#f78f20;cursor:pointer" data-target="#editModal{{$user['id']}}">
                                                        <span data-toggle="tooltip" data-placement="top" title="Edit Account">
                                                            <i class="fas fa-edit"></i>
                                                        </span>
                                                     </span>
                                                     <span>&nbsp;&nbsp;</span>    
                                                     <span data-toggle="modal" data-target="#deleteModal{{$user['id']}}">
                                                        <span data-toggle="tooltip" data-placement="top" title="Delete Account">
                                                            <i class="fas fa-times" style="color:#aa0000;cursor:pointer"></i>
                                                        </span>
                                                     </span>
                                                     <span>&nbsp;&nbsp;</span>                                                      
                                                     @if($user['verified']==1)
                                                         <a href="#" style="color:#aa0000;" data-toggle="modal" data-target="#deactivateModal{{$user['id']}}"><span data-toggle="tooltip" data-placement="top" title="Deactivate">Deactivate</span></a>
                                                     @else
                                                         <a href="#" style="color:#00a199;" data-toggle="modal" data-target="#activateModal{{$user['id']}}"><span data-toggle="tooltip" data-placement="top" title="Activate">Activate</span></a>
                                                     @endif
                                                 </td>

                                                <!-- Edit Modal -->
                                                <div id="editModal{{$user['id']}}" class="modal fade" role="dialog">
                                                  <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <form action="/admin/user/{{$user['id']}}/edit" method="post">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <span type="button" class="close" data-dismiss="modal" style="font-size:2rem;">&times;</span>
                                                            <h4 class="modal-title">Edit User</h4>
                                                          </div>
                                                          
                                                          <!--Notification-->
                                                          <div class="notification alert alert-success" role="alert">
                                                              
                                                          </div>
                                                          
                                                          <div class="modal-body row gtr-uniform">
                                                            
                                                            <div class="col-md-6">
                                                                <label>
                                                                    Username:
                                                                    <input type="text" name="username" placeholder="Username" value="{{$user['username']}}" required>
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>
                                                                    Full Name:
                                                                    <input type="text" name="fullname" placeholder="Full Name" value="{{$user['fullname']}}" required>
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>
                                                                    Email:
                                                                    <input type="email" name="email" placeholder="User Email" value="{{$user['email']}}" required>
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <br/>
                                                                <label>
                                                                    Role:
                                                                    <input type="disabled" class="disabled" name="role" placeholder="User Role" value="{{$user['role']}}" disabled>
                                                                </label>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label>
                                                                    Address:
                                                                    <textarea name="address" rows="4" placeholder="Address">{{$user['address']}}</textarea>
                                                                </label>
                                                            </div>                                                            
                                                          </div>
                                                          
                                                          <input type="hidden" name="token" value="{{App\Classes\CSRFToken::_token()}}">
                                                          <div class="modal-footer">
                                                            <button type="submit" class="button primary small"><i class="fas fa-check"></i> Save</button>
                                                            <button type="button" class="button small" data-dismiss="modal">Cancel</button>
                                                          </div>
                                                        </div>
                                                    </form>

                                                  </div>
                                                </div>

                                                <!-- Delete Modal -->
                                                <div id="deleteModal{{$user['id']}}" class="modal fade" role="dialog">
                                                  <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <form action="/admin/user/{{$user['id']}}/delete" method="post">

                                                        <input type="hidden" name="token" value="{{App\Classes\CSRFToken::_token()}}">

                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <span type="button" class="close" data-dismiss="modal" style="font-size:2rem;">&times;</span>
                                                            <h4 class="modal-title">Delete</h4>
                                                          </div>
                                                          <div class="modal-body">
                                                            <p>Are you sure you want to delete this user?</p>
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="submit" class="button primary small">Yes</button>
                                                            <button type="button" class="button small" data-dismiss="modal">No</button>
                                                          </div>
                                                        </div>

                                                    </form>

                                                  </div>
                                                </div>
                                                
                                                <!-- activate Modal -->
                                                <div id="activateModal{{$user['id']}}" class="modal fade" role="dialog">
                                                  <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <form action="/admin/user/{{$user['id']}}/activate" method="post">

                                                        <input type="hidden" name="token" value="{{App\Classes\CSRFToken::_token()}}">

                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <span type="button" class="close" data-dismiss="modal" style="font-size:2rem;">&times;</span>
                                                            <h4 class="modal-title">Activate</h4>
                                                          </div>
                                                          <div class="modal-body">
                                                            <p>Are you sure you want to delete this user?</p>
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="submit" class="button primary small">Yes</button>
                                                            <button type="button" class="button small" data-dismiss="modal">No</button>
                                                          </div>
                                                        </div>

                                                    </form>

                                                  </div>
                                                </div>
                                                
                                                <!-- deactivate Modal -->
                                                <div id="deactivateModal{{$user['id']}}" class="modal fade" role="dialog">
                                                  <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <form action="/admin/user/{{$user['id']}}/deactivate" method="post">

                                                        <input type="hidden" name="token" value="{{App\Classes\CSRFToken::_token()}}">

                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <span type="button" class="close" data-dismiss="modal" style="font-size:2rem;">&times;</span>
                                                            <h4 class="modal-title">Deactivate</h4>
                                                          </div>
                                                          <div class="modal-body">
                                                            <p>Are you sure you want to deactivate this user?</p>
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="submit" class="button primary small">Yes</button>
                                                            <button type="button" class="button small" data-dismiss="modal">No</button>
                                                          </div>
                                                        </div>

                                                    </form>

                                                  </div>
                                                </div>

                                             </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h3>No records found</h3>
                                @endif
                            </div>
                        </div>
                    </section>


                </div>
            </div>

@endsection