<?php include("top.html"); ?>
<!--
Nadia Kazi
The purpose of this file is to print a list of movies depending on the user input.
If the user input for an actor's name then it will produce a complete list that consist 
of all movies that the given actor has performed. Else if the user specfy an actor who
did movies with Kevin Bacon then it will print a list of movies that the given actor have 
performed with Kevin Bacon.        
-->

<?php 
$firstname = $_GET["firstname"];
$lastname = $_GET["lastname"];
$caption = "All Films";  # stores the caption of the page in a variable
$actor_dont_exist = "Actor $firstname $lastname not found."; 
$db = new PDO("mysql:dbname=imdb;host=localhost", "nadiak3", "BLcLH282tbQ6E");

#finds the id for a given actor's name:
$id_list = $db->query("SELECT id
					  FROM actors a 
				      WHERE first_name Like '$firstname%' AND a.last_name = '$lastname'
				      ORDER BY film_count DESC;");

# takes the first id from the result      					
$actor_id = $id_list->fetchColumn(0);  

#takes actor_dont_exist as a parameter and prints a massage that the actor not found
function print_actor_not_found($actor_dont_exist) { ?>
	<p><?= $actor_dont_exist; ?></p>	
<?php } 

# takes caption and rows as parameter and prints a table that consists of 
# a count that numbers each line of the list, the name and the year.   
function print_results($caption, $rows, $firstname, $lastname) { 
	$count = 1; 
	?>	
	<h1>Results for <?= $firstname; ?> <?= $lastname; ?></h1>
	
	<table>
		<caption><?= $caption; ?></caption>
		<tr>
			<th>#</th>
			<th>Title</th>
			<th>Year</th>
		</tr>

		<?php foreach($rows as $row) { ?>	
			<tr>		
				<td><?= $count++; ?></td>
				<td><?= $row["name"]; ?></td>
				<td><?= $row["year"]; ?></td>			
			</tr>
		<?php } ?>
		
	</table>
<?php } ?> 
