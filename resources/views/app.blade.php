<!DOCTYPE html>
<html>
<head>
    <title>Repit Sports-CMS</title>
    <link rel='shortcut icon' href='/img/favicon.ico'/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />

</head>
<body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#"><img src="/img/repit_h.png"</a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="/auth/register"><span class="glyphicon glyphicon-user"></span> Register</a></li>
        <li><a href="/auth/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </nav>
    @yield('content')
</body>
</html>
