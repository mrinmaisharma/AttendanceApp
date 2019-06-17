@extends('admin.layout.base')
@section('title', 'Testimonials')


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
                        <h2>Testimonials</h2>

                        @include('includes.form_alert')
                        
                    </section>

                    <section>
                        <div class="row gtr-uniform">
                            <div class="col-md-12">
                                @if(count($testimonials))
                                    <h3>Records <a href="/admin/testimonials"><span data-toggle="tooltip" data-placement="top" title="Refresh Data"><i class="fas fa-sync-alt"></i></span></a></h3>
                                    <table id="category-table" class="table table-hover" data-form="deleteForm">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Date Created</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($testimonials as $testimony)
                                             <tr>
                                                 <td>{{$testimony['id']}}</td>
                                                 <td>{{$testimony['fullname']}}</td>
                                                 <td>{{$testimony['email']}}</td>
                                                 <td>{{$testimony['created_at']}}</td>
                                                 <td>
                                                     <span data-toggle="modal" data-target="#editModal{{$testimony['id']}}">
                                                        <span data-toggle="tooltip" data-placement="top" title="Edit Testimony">
                                                            <i class="fas fa-edit" style="color:#f78f20;cursor:pointer"></i>
                                                        </span>
                                                     </span>
                                                     <span>&nbsp;&nbsp;</span>    
                                                     <span data-toggle="modal" data-target="#deleteModal{{$testimony['id']}}">
                                                        <span data-toggle="tooltip" data-placement="top" title="Delete Testimony">
                                                            <i class="fas fa-times" style="color:#aa0000;cursor:pointer"></i>
                                                        </span>
                                                     </span>
                                                     <span>&nbsp;&nbsp;</span>                                                      
                                                     @if($testimony['publish']==1)
                                                         <a href="/admin/testimonial/{{$testimony['id']}}/unpublish" style="color:#00a199;"><span data-toggle="tooltip" data-placement="top" title="Unpublish">Unpublish</span></a>
                                                     @else
                                                         <a href="/admin/testimonial/{{$testimony['id']}}/publish" style="color:#00a199;"><span data-toggle="tooltip" data-placement="top" title="Publish">Publish</span></a>
                                                     @endif
                                                 </td>

                                                <!-- Edit Modal -->
                                                <div id="editModal{{$testimony['id']}}" class="modal fade" role="dialog">
                                                  <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <form action="/admin/testimonial/{{$testimony['id']}}/edit" method="post" enctype="multipart/form-data">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <span type="button" class="close" data-dismiss="modal" style="font-size:2rem;">&times;</span>
                                                            <h4 class="modal-title">Edit Testimonial</h4>
                                                          </div>
                                                          
                                                          <!--Notification-->
                                                          <div class="notification alert alert-success" role="alert">
                                                              
                                                          </div>
                                                          
                                                          <div class="modal-body row gtr-uniform">
                                                            
                                                            <div class="col-md-6">
                                                                <label>
                                                                    Full Name:
                                                                    <input type="text" name="fullname" value="{{$testimony['fullname']}}" required>
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>
                                                                    Email:
                                                                    <input type="email" name="email" value="{{$testimony['email']}}" required>
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>
                                                                    Company:
                                                                    <input type="text" name="company" value="{{$testimony['company']}}" required>
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>
                                                                    Role:
                                                                    <input type="text" name="role" value="{{$testimony['role']}}" required>
                                                                </label>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label>
                                                                    Testimony:
                                                                    <textarea name="testimony" rows="4" required>{{$testimony['testimony']}}</textarea>
                                                                </label>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label>
                                                                    Profile Picture:
                                                                    <input class="imgInp" data-id="{{$testimony['id']}}" type="file" name="profilePic">
                                                                </label>
                                                                <img style="width:100px;resize:auto;" id="selected_image{{$testimony['id']}}" src="/{{$testimony['image_path']}}" alt="Profile Picture">
                                                                <a href="/{{$testimony['image_path']}}" download><span data-toggle="tooltip" data-placement="top" title="Download Image"><i class="fas fa-download fa-lg" style="color:#00a199;"></i> Download Image</span></a>
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
                                                <div id="deleteModal{{$testimony['id']}}" class="modal fade" role="dialog">
                                                  <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <form action="/admin/testimonial/{{$testimony['id']}}/delete" method="post">

                                                        <input type="hidden" name="token" value="{{App\Classes\CSRFToken::_token()}}">

                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <span type="button" class="close" data-dismiss="modal" style="font-size:2rem;">&times;</span>
                                                            <h4 class="modal-title">Delete</h4>
                                                          </div>
                                                          <div class="modal-body">
                                                            <p>Are you sure you want to delete this testimony?</p>
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