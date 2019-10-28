
 @extends ('layouts.app')
 
 @section ('content')

<h1 href="javascript:void(0)" style="margin-left:50%" id="create-new-user"> New User </h1>

<form method="POST" action="/users"> 

        {{ csrf_field() }}

     <div class="form-group row">
         <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
         <div class="col-md-6">
            <input type="text" name="name" class="form-control" placeholder="Name">  
         </div>
      </div>

     <div class="form-group row">
         <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
         <div class="col-md-6">
            <input type="text" name="email" class="form-control" placeholder="Email">  
         </div>
      </div>

    <div class="form-group row">
       <label for="photo" class="col-md-4 col-form-label text-md-right">Profile Image</label>
            <div class="col-md-6">
            <input id="photo" type="file" class="form-control" name="photo">
                @if (auth()->user()->image)
                
                @else (user->photo = '/uploads/images/default.png')
                     
                @endif
             </div>
   </div>

     <div class="form-group row">
         <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
         <div class="col-md-6">
            <input type="password" name="password" class="form-control" placeholder="Password">  
         </div>
      </div>

     <div class="form-group row">
         <label for="role" class="col-md-4 col-form-label text-md-right">Role</label>
         <div class="col-md-6">
            <input type="integer" name="role" class="form-control" placeholder="Role">  
         </div>
      </div>

      <div class="form-group row">
         <label for="integer" class="col-md-4 col-form-label text-md-right">ID Department</label>
         <div class="col-md-6">
            <input type="integer" name="id_dep" class="form-control" placeholder="ID Department">  
         </div>
      </div>

   <div class="form-group row" > 
   <div class="col-sm-12">

   <button style="margin-left:50%" type="submit" class="btn btn-success"> Create new user </button> 
   </div>

   </div>
    

@endsection 