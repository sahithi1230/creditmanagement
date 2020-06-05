<?php
    require_once('db_connect.php'); //connect to database

    $query = "select * from users";
    $result = mysqli_query($link,$query);

?>

<html>
	<head>
        <title>Credit Management</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    </head>

    <body>
	<div >
	<h1 class="text-primary bg-dark" align="center" style="padding:20px">Credit Management System</h1>
	
	</div>
	
	
	
        <table class='table table-hover'>
			<thead>
				<tr class="text-danger">
                    <th>S No.</th>
    				<th>Name</th>
    				<th>Email</th>
    				<th>Credits</th>
					<th></th>
				</tr>
			</thead>

            <?php
                $i=1;

                while($row = mysqli_fetch_array($result)) {
                    echo "<tr class='table-striped'>";
                    echo "<td>" . $i . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["credit"] . "</td>";
                    echo "<td><a href=transfer.php?name=" . $row['name'] . ">Select</a><td>";
                    echo "</tr>";
                    ++$i;
                }
            ?>

        </table>
    </body>
</html>