<?php
    require_once('db_connect.php'); //connect to database

    $name = $_GET['name'];
    $query = "select * from users where name='" . $name . "'";
    $result = mysqli_query($link,$query);
    $row = mysqli_fetch_array($result);
    
    $query = "select name from users where name<>'" . $row['name'] . "'";
    $result = mysqli_query($link,$query);

    if(isset($_POST['transfer'])) {
        if($_POST['credits_tr'] > $row['credit']) {
            			
			echo  "<div class='alert alert-danger'>
    <strong>Credits transferred cannot be more than</strong>" . $row['credit'] . "</div>";

	}

        else {
            $query = "update users set credit=credit-" . $_POST['credits_tr'] . " where name='" . $row['name'] . "'";
            mysqli_query($link,$query);

            $query = "update users set credit=credit+" . $_POST['credits_tr'] . " where name='" . $_POST['to_user'] . "'";
            mysqli_query($link,$query);

            $query = "insert into transfers values('" . $row['name'] . "','" . $_POST['to_user'] . "'," . $_POST['credits_tr'] . ")";
            mysqli_query($link,$query);

            header("Location: index.php");
        }
    }
?>

<html>
	<head>
        <title>Transfer Credits</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    </head>

    <body>
	
	
    <body>
	<div >
	<h1 class="text-primary bg-dark" align="center" style="padding:20px">Credit Management System</h1>
	
	</div>
	

	
	
	
	
        <a href="index.php">&lt; Back</a>
        <br><br>
        Hello  <?php echo $row['name'] ?>,
        <br>
        Your credits are: <?php echo $row['credit'] ?>
        <br><br>

        <form action="#" method="post" align="center">
    
                <div class="text-primary">Transfer details</div>
                Credits: <input type="number" name="credits_tr" min =0 value=1 required>
                <br><br>
                Transfer to: <select name="to_user" required>
                    <option value =""></option>

                <?php
                        while($tname = mysqli_fetch_array($result)) {
                            echo "<option value='" . $tname['name'] . "'>" . $tname['name'] . "</option>";
                        }
                ?>

                </select>
                <br>
            <br>
            <input type="submit" name="transfer" value="Transfer">
        </form>
    </body>
</html>