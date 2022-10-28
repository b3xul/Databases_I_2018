<html>
<head>
<title>Corsi</title>
</head>

<body>
	<h3>Ricerca lezioni corso</h3>
	<form method="get" action="cerca_lezioni_corso.php">

		Codice corso: <select name="codice_corso">
		<?php
		/* CONNESSIONE AL DB */
		$con = @mysqli_connect ( 'localhost', 'root', '', 'PALESTRA' );
		
		if (mysqli_connect_errno ()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error ();
		}
		
		/* ESECUZIONE QUERY */
		$sql = "SELECT CodC FROM corsi order by CodC";
		
		$result = mysqli_query ( $con, $sql );
		
		if (! $result)
			die ( 'Query error: ' . mysqli_error ( $con ) );
		
		/* USO DEL RISULTATO DELLA QUERY COME INPUT PER IL MENU A TENDINA */
		if (mysqli_num_rows ( $result ) > 0) {
			
			while ( $row = mysqli_fetch_row ( $result ) ) {
				echo "<option value=$row[0]>$row[0]</option>";
			}
		}
		
		?>
		</select>
		
		<input type="submit" value="Cerca">
	
	</form>
</body>
</html>


