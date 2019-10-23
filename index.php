<!DOCTYPE html>
<html lang="en">
<head>
	<title>OMDB Search Platform</title>
</head>
<body>
<h1>OMDB Search Platform</h1>

<h3> Please select one of the preset search options</h3>
<form action="/search.php" method="get">
	<label for="red">Red<input type="radio" id="red" name="search" value="red"></label>
	<label for="green">Green<input type="radio" id="green" name="search" value="green"></label>
	<label for="blue">Blue<input type="radio" id="blue" name="search" value="blue"></label>
	<label for="yellow">Yellow<input type="radio" id="yellow" name="search" value="yellow"></label>
	<label> <input type="submit" value="I like this one"></label>
</form>
<h3>or enter a custom search option</h3>
	
<form action="/search.php" method="get">
	<label>Custom Search: <input type="text" placeholder="My Favourite Movie" name="search"></label>
	<label><input type="submit" value="I like it my own way"></label>
</form>	

</body>
</html>