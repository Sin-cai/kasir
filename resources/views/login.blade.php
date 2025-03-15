<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>Form Login</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/logon.css') }}">
    <!--Stylesheet-->
    
</head>
<body>
   <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="" method="post">
        @csrf
        <h3>Login Here</h3>
        @if($errors->any())
    <div div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $item)
            <li>{{ $item}}</li</li>
            @endforeach
        </ul>
    </div>
    @endif

        <label for="email">email</label>
        <input type="email" value="{{ old('email') }}"  name="email" placeholder="name@example.com" id="email" autofocus required>

        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" id="password" required>

            <a href="index.html">
                <button>LOGIN</button>
            </a>
        <div class="social">
          <div class="go"><i class="fab fa-google"></i> <a href="">Login with </a></div>
          <div class="fb"><i class="fab fa-facebook"></i>  Facebook</div>
        </div>
    </form>
</body>
</html>


