<?php include("common.php"); ?>

<!--
Nadia Kazi
The purpose of this file is to crate a page that shows a list of all the movies
that a given actor has appeared. And if the actor is not on the databases then
the page will show a massage that the actor is not found. 
-->

<?php
# perfoms a SQL select query on the database and finds a complete list of movies
# in which the given actor has performed.
$rows = $db->query("SELECT name, year
					FROM roles r 
					JOIN movies m on r.movie_id = m.id 
					JOIN actors a on r.actor_id = a.id
					WHERE a.id = $actor_id
					ORDER BY year DESC, name ASC;");

# checks if the row returned by the query is greater then one and not null
if($rows != null and $rows->rowCount() > 0) { 
	
	# calls the print_table function and prints the table consis of the given actors 
	# movies name, the year and a counter that counter.    
	print_results($caption, $rows, $firstname, $lastname);
		
} else { # prints a massage if the actor is not found 	
	print_actor_not_found($actor_dont_exist);	
} ?>

<?php include("bottom.html"); ?>
