<?php include("common.php"); ?>

<!--
Nadia Kazi, CSE 190M,
May 02, 2012, Section: MJ
The purpose of this file is to create a page that prints the results as a list,
a list of movies that the given actor performed with keven beacon. A multiple 
massages gets printed depending on if the given actor is not found on the databases
or if the given actor did not do any movies with Kevin Bacon.  
-->

<?php   
# the query produces the list of movies that the given actor performed with Kevin Bacon
#produces a list of movies name and the year
$rows = $db->query("SELECT distinct m.year, m.name
					FROM actors a1 
					JOIN roles r1 on a1.id = r1.actor_id 
					JOIN movies m on m.id = r1.movie_id
					JOIN roles r2 on m.id = r2.movie_id
					JOIN actors a2 on a2.id = r2.actor_id  
					WHERE a2.id = $actor_id AND a1.first_name = 'Kevin' AND a1.last_name = 'Bacon' 
					ORDER BY m.year DESC, m.name ASC;");

# it checks if the actor exist in the databaese and prints the results.
# prints multiple massages, for instance if the the given actor did zero
# movies then it prints not found else if the actor did movies but not with 
# kevin bacon then it prints that someother massage.
if($rows != null and $rows->rowCount() > 0) { 
	
	print_results($caption, $rows, $firstname, $lastname); 
	
} elseif($id_list->rowCount() == 0) { 
	
	# prints a massage if the actor is not found 	
	print_actor_not_found($actor_dont_exist);	
		
} else { ?>	
	
	<p><?= $firstname; ?> <?= $lastname; ?> wasn't in any films with Kevin Bacon.</p>
	
<?php } ?>

<?php include("bottom.html"); ?>