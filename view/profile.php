<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css" />
		<title>iGetIt</title>
	</head>
	<body>
		<header><h1>iGetIt</h1></header>
		<nav>
			<ul>
                        <li> <a href="">Class</a>
                        <li> <a href="">Profile</a>
                        <li> <a href="">Logout</a>
                        </ul>

		</nav>
		<main>
			<h1>Profile</h1>
			<form>
				<fieldset>
					<legend>Edit Profile</legend>
					<p> <label for="user">User</label>    <input type="text" name="user"></input> </p>
					<p> <label for="password">Password</label><input type="password" name="password"></input> </p>
					<p> <label for="firstName">First Name</label><input type="text" value="" name="firstName"></input> </p>
					<p> <label for="lastName">Last Name</label><input type="text" value="" name="lastName"></input> </p>
					<p> <label for="email">email</label><input type="text" value="" name="email"></input> </p>
					<p> <label for="type">type</label>
						<input type="radio" name="type" value="instructor">instructor</input> 
						<input type="radio" name="type" value="student" checked="checked">student</input> 
					</p>
					<p> <input type="submit" name="submit" value="Submit"/>
					<input type="submit" name="submit" value="Back"/>
				</fieldset>
			</form>
		</main>
		<footer>
		</footer>
	</body>
</html>

