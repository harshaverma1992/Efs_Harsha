<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eagle Financial</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	</head>
<body>
<div class="container">
    <a href="{{ action('CustomerController@index') }}">Customers</a> |
    <a href="{{ action('StockController@index') }}">Stocks</a> |
    <a href="{{ action('InvestmentController@index') }}">Investments</a> 
		
		<ul class="nav navbar-nav navbar-right">
	
	<a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a>
	</ul>
</div>
<hr>
<div class="container">
    @yield('content')
</div>
</body>
</html>