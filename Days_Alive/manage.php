<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="description" 	content="Job Hunting Website"/>
	<meta name="keywords"		content="Job, Jobbie"/>
	<meta name="author"			content="Matt Hannah"/>
	<title>Jobbie - A Job Hunting Website</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css"/>
	<script src="jobs.js"></script>
</head>
<body>
	<div id="container">
		<?php
			include 'header.php';
			include 'nav.php';
		?>
		<article>
		<h1 class="mainheadings">MANAGE</h1>
			<section>
				<form id="manage" method="post" action="">
					<p><label for="jobref">Job Reference Number:</label><br />
					<input type="text" name="jobref" id="jobref" /></p>	
					<p><label for="jobref">First Name:</label><br />
					<input type="text" name="firstname" id="firstname" /></p>	
					<p><label for="jobref">Last Name:</label><br />
					<input type="text" name="lastname" id="lastname" /></p>	
					<p><input id="all" type="submit" name="all" value="List all EOI"/></p>
					<p><input id="listjobref" type="submit" name="listjobref" value="List EOIs for Job Reference Number"/></p>
					<p><input id="listnames" type="submit" name="listnames" value="List EOIs for given names"/></p>
					<p><input id="delete" type="submit" name="delete" value="Delete EOIs for Job Reference Number"/></p>
				</form>
				<?php
					require_once ("settings.php"); //connection info
					if (isset($_POST['all'])) {
						$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
						// Checks if connection is successful
						if (!$conn) {
							// Displays an error message
							echo "<p>Database connection failure</p>";
						} 
						else {
							// Upon successful connection
							
							//create table if doesn't exist
						$query = "SHOW TABLES LIKE 'EOI'";
						if (mysqli_num_rows(mysqli_query($conn, $query))== NULL) {
							echo "Table does not exist";
							$sqlString = "CREATE TABLE EOI (
								EOInumber	INT,
								jobref		VARCHAR(7),
								firstname	VARCHAR(15),
								lastname	VARCHAR(25),									
								street		VARCHAR(50),
								town		VARCHAR(25),
								state		VARCHAR(3),
								postcode	INT,
								email		VARCHAR(40),
								phone		VARCHAR(10),
								skills		VARCHAR(100)
								)";
							$queryResult = mysqli_query($dbConnect, $sqlString);
						}
							
							$query = "SELECT * FROM EOI";
							$result = mysqli_query($conn, $query);
							echo "<div id=manage>";
							echo "<table border='1'>";
							echo "<tr><th>EOInumber</th><th>jobref</th><th>firstname</th><th>lastname</th><th>street</th><th>town</th><th>state</th><th>postcode</th><th>email</th><th>phone</th><th>skills</th></tr>";
							while ($row = mysqli_fetch_assoc($result)) {
								echo "<tr><td>{$row['EOInumber']}</td>";
								echo "<td>{$row['jobref']}</td>";
								echo "<td>{$row['firstname']}</td>";
								echo "<td>{$row['lastname']}</td>";
								echo "<td>{$row['street']}</td>";
								echo "<td>{$row['town']}</td>";
								echo "<td>{$row['state']}</td>";
								echo "<td>{$row['postcode']}</td>";
								echo "<td>{$row['email']}</td>";
								echo "<td>{$row['phone']}</td>";
								echo "<td>{$row['skills']}</td></tr>";
							}
							echo "</table>";
							echo "</div>";
							// close the database connection
							mysqli_close($conn);
						}
					}
					if (isset($_POST['listjobref'])) {
						$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
						// Checks if connection is successful
						if (!$conn) {
							// Displays an error message
							echo "<p>Database connection failure</p>";
						} 
						else {
							// Upon successful connection
							
							//create table if doesn't exist
						$query = "SHOW TABLES LIKE 'EOI'";
						if (mysqli_num_rows(mysqli_query($conn, $query))== NULL) {
							echo "Table does not exist";
							$sqlString = "CREATE TABLE EOI (
								EOInumber	INT,
								jobref		VARCHAR(7),
								firstname	VARCHAR(15),
								lastname	VARCHAR(25),									
								street		VARCHAR(50),
								town		VARCHAR(25),
								state		VARCHAR(3),
								postcode	INT,
								email		VARCHAR(40),
								phone		VARCHAR(10),
								skills		VARCHAR(100)
								)";
							$queryResult = mysqli_query($dbConnect, $sqlString);
						}
							
							$jobref = $_POST['jobref'];
							$query = "SELECT * FROM EOI WHERE jobref = '$jobref'";
							$result = mysqli_query($conn, $query);
							echo "<div id=manage>";
							echo "<table border='1'>";
							echo "<tr><th>EOInumber</th><th>jobref</th><th>firstname</th><th>lastname</th><th>street</th><th>town</th><th>state</th><th>postcode</th><th>email</th><th>phone</th><th>skills</th></tr>";
							while ($row = mysqli_fetch_assoc($result)) {
								echo "<tr><td>{$row['EOInumber']}</td>";
								echo "<td>{$row['jobref']}</td>";
								echo "<td>{$row['firstname']}</td>";
								echo "<td>{$row['lastname']}</td>";
								echo "<td>{$row['street']}</td>";
								echo "<td>{$row['town']}</td>";
								echo "<td>{$row['state']}</td>";
								echo "<td>{$row['postcode']}</td>";
								echo "<td>{$row['email']}</td>";
								echo "<td>{$row['phone']}</td>";
								echo "<td>{$row['skills']}</td></tr>";
							}
							echo "</table>";
							echo "</div>";
							// close the database connection
							mysqli_close($conn);
						}
					}
					if (isset($_POST['listnames'])) {
						$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
						// Checks if connection is successful
						if (!$conn) {
							// Displays an error message
							echo "<p>Database connection failure</p>";
						} 
						else {
							// Upon successful connection
							
							//create table if doesn't exist
						$query = "SHOW TABLES LIKE 'EOI'";
						if (mysqli_num_rows(mysqli_query($conn, $query))== NULL) {
							echo "Table does not exist";
							$sqlString = "CREATE TABLE EOI (
								EOInumber	INT,
								jobref		VARCHAR(7),
								firstname	VARCHAR(15),
								lastname	VARCHAR(25),									
								street		VARCHAR(50),
								town		VARCHAR(25),
								state		VARCHAR(3),
								postcode	INT,
								email		VARCHAR(40),
								phone		VARCHAR(10),
								skills		VARCHAR(100)
								)";
							$queryResult = mysqli_query($dbConnect, $sqlString);
						}
							
							if (!empty($_POST['firstname']) || !empty($_POST['lastname'])) {
								$firstname = $_POST['firstname'];
								$lastname = $_POST['lastname'];
								if (!empty($_POST['firstname']) && !empty($_POST['lastname'])) {
									$query = "SELECT * FROM EOI WHERE firstname = '$firstname' AND lastname = '$lastname'";
								}
								elseif (!empty($_POST['firstname'])) {
									$query = "SELECT * FROM EOI WHERE firstname = '$firstname'";
								}
								elseif (!empty($_POST['lastname'])) {
									$query = "SELECT * FROM EOI WHERE lastname = '$lastname'";
								}
								$result = mysqli_query($conn, $query);
								echo "<div id=manage>";
								echo "<table border='1'>";
								echo "<tr><th>EOInumber</th><th>jobref</th><th>firstname</th><th>lastname</th><th>street</th><th>town</th><th>state</th><th>postcode</th><th>email</th><th>phone</th><th>skills</th></tr>";
								while ($row = mysqli_fetch_assoc($result)) {
									echo "<tr><td>{$row['EOInumber']}</td>";
									echo "<td>{$row['jobref']}</td>";
									echo "<td>{$row['firstname']}</td>";
									echo "<td>{$row['lastname']}</td>";
									echo "<td>{$row['street']}</td>";
									echo "<td>{$row['town']}</td>";
									echo "<td>{$row['state']}</td>";
									echo "<td>{$row['postcode']}</td>";
									echo "<td>{$row['email']}</td>";
									echo "<td>{$row['phone']}</td>";
									echo "<td>{$row['skills']}</td></tr>";
								}
								echo "</table>";
								echo "</div>";
								// close the database connection
								mysqli_close($conn);
							}
						}
					}
					if (isset($_POST['delete'])) {
						$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
						// Checks if connection is successful
						if (!$conn) {
							// Displays an error message
							echo "<p>Database connection failure</p>";
						} 
						else {
							// Upon successful connection
							
							//create table if doesn't exist
						$query = "SHOW TABLES LIKE 'EOI'";
						if (mysqli_num_rows(mysqli_query($conn, $query))== NULL) {
							echo "Table does not exist";
							$sqlString = "CREATE TABLE EOI (
								EOInumber	INT,
								jobref		VARCHAR(7),
								firstname	VARCHAR(15),
								lastname	VARCHAR(25),									
								street		VARCHAR(50),
								town		VARCHAR(25),
								state		VARCHAR(3),
								postcode	INT,
								email		VARCHAR(40),
								phone		VARCHAR(10),
								skills		VARCHAR(100)
								)";
							$queryResult = mysqli_query($dbConnect, $sqlString);
						}
							
							$jobref = $_POST['jobref'];
							$query = "SELECT * FROM EOI WHERE jobref = '$jobref'";
							$result = mysqli_query($conn, $query);
							$row = mysqli_fetch_assoc($result);
							$num_rows = mysqli_num_rows($result);
							$query = "DELETE FROM EOI WHERE jobref = '$jobref'";
							$result = mysqli_query($conn, $query);
							echo "<p>" . $num_rows . " records deleted.</p>";
							// close the database connection
							mysqli_close($conn);
						}
					}
				?>
			</section>
		</article>		
		<aside>		
		</aside>	
		<?php
			include 'footer.php';
		?>
	</div>
</body>
</html>