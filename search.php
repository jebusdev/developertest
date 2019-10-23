<?php
//API_KEY defined here
require_once('config.php');

if($_GET["search"]) {
    $search = $_GET["search"];
}else{
    //no search term, return to index for user to enter new term
    header("Location: index.php");
}

//Call the API using the defined key and the get request search term
//to do, correctly escape get inputs
$response = file_get_contents('https://www.omdbapi.com/?apikey=' . API_KEY . '&type=movie&r=json&s=' . $search);
$response = json_decode($response);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <title>OMDB Movie Search Results</title>
</head>
<body>
	<h1>
		OMDB Movie Search Results
	</h1>
	<?php
		 if(!$response->totalResults){
			echo("<h3> No Results found :( </h3>");
			}
	?>
	<div class="container">
		<div class="row">
		<?php
		    $searcharray = $response->Search;
			$rowcount = -1;
			foreach ($searcharray as $Movie){
				//collect runtime
				$runtime = file_get_contents('https://www.omdbapi.com/?apikey=' . API_KEY . '&type=movie&i=' . $Movie->imdbID);
				$runtime = json_decode($runtime);
				$runtime = $runtime->Runtime;
				$rowcount++;
				//echo ("row count = " . $rowcount);
				if($rowcount == 3){
					echo("</div>\n<div class='row'>");
					$rowcount = 0;					
				}
				echo ("<div class='col-lg-4'>\r\n");
				$fancyTitle = str_ireplace($search,"<span class='highlight' >" . $search . "</span>",$Movie->Title);
				//$fancyTitle = str_ireplace("blue","asdfasdfasdf",$Movie->Title);
				//echo $fancyTitle;
				//echo ("<h3>" . $Movie->Title. " (" . $Movie->Year . ")</h3>\n");
				echo ("<h3>" . $fancyTitle . " (" . $Movie->Year . ")</h3>\n");
				echo ("<p> Runtime: " . $runtime . "</p>\n");
				echo ("<a href='https://imdb.com/title/" . $Movie->imdbID. "'><img class='poster' src='" . $Movie->Poster . "' title= '" . $Movie->Title . "'/></a>\n</div>\n");
			}?>
		</div>
	</div>
</body>
</html>