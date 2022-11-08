<!DOCTYPE html>

<html>
   <head>
      <meta charset = "utf-8">
      <title>Password Reset Email</title>
   </head>

   <body>
      <div class="card" style="text-align:center;">
         <div class="card-body">
            <h2 style="font-weight: bold;color:green;">{{ config('app.name') }}</h2>
            <h4 class="card-title">Password Reset Request </h4>
            <p class="card-textt"> We received a passord request mail thats why we send you a password request link.</p>

            <a href="{{ route('admin.updatePassword',$token) }}" style=" background:black; color:white;padding:5px; border-radius:5px; text-decoration:none;">Reset Password</a>
         </div>
      </div>
   </body>

</html>
