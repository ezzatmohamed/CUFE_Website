<!doctype html>
<html>


<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/css/signup.css" type="text/css" />
	
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
</head>
<header>
	<a href='login'><p style="margin-left:46%;">Log In</p></a>
</header>
<body>
  
  <div class="form2">
	
	<img class = "imag" src="/uploads/prof.jpg">

	<form action="/signup" method="POST">
		{{ csrf_field() }}
		<div class="form-input">

		@if(count($errors) > 0)
			@foreach($errors->all() as $error)
				{{$error}}
			@endforeach
		@endif
		
		  <input type="text" placeholder ="Username" name = "usr" required autocomplete="off"/>
		</div>
		<div class="form-input">
		  <input type="password" placeholder = "Password" name = "pwd" required autocomplete="off"/>
		</div>
	
		<button type ="submit" name = "submit" class="btn-login"/>Sign up</button>
		
	</form>
  
  </div>
  
  
</body>
</html>