<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css" />
		<title>iGetIt</title>
	</head>
	<body>
		<header><h1>iGetIt (student)</h1></header>
		<nav>
			<ul>
                        <li> <a href="">Class</a>
                        <li> <a href="">Profile</a>
                        <li> <a href="">Logout</a>
                        </ul>
		</nav>
		<main>
			<h1>Class</h1>
			<form>
				<fieldset>
					<legend>Current Classes</legend>
					<select>
					<?php	
						//enter database credentials
						$dbconn=pg_connect();
						$queryhelp="select * from currentclass natural join regclasses join appuser on regclasses.instructor = appuser.username;";
                                		$result=pg_prepare($dbconn, "uniq_user", $queryhelp);
                                		$result=pg_execute($dbconn, "uniq_user",array());
					while ($row = pg_fetch_array($result)) {
							
						echo "<option type='class' value=$row[class]> $row[class] $row[firstname] $row[lastname] </option>";						
						}
					?>
					
					<!--	<option>CSC258 Larry Zhang</option>
						<option>CSC309 Arnold Rosenbloom</option>
						<option>CSC363 Arnold Rosenbloom</option>
					!-->
					</select>
   					<p> <label for="code">code</label><input type="text" name="code"></input> </p>
                                        <p> <input type="submit" name="submit" value="Submit"/>
				</fieldset>
			</form>
		</main>
		<footer>
		</footer>
	</body>
</html>

