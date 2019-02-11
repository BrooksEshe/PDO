<?php

//Connect to DB
require '/home/beshegre/config.php';
try{
    //instantiate a database object
    $dbh = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
    echo 'Connected to database!';
}
catch(PDOException $e){
    echo $e->getMessage();
}

//Connect to the DB...
//Define the query
$sql= "INSERT INTO pets(type,name, color)VALUES(:type,:name, :color)";
//Prepare the statement
$statement = $dbh->prepare($sql);

//Bind the parameters
$type = 'kangaroo';
$name = 'Joey';
$color = 'purple';
$statement->bindParam(':type', $type, PDO::PARAM_STR);
$statement->bindParam(':name', $name, PDO::PARAM_STR);
$statement->bindParam(':color', $color, PDO::PARAM_STR);

//Execute
//$statement->execute();
$id = $dbh->lastInsertId();
echo "<p>Pet $id inserted successfully.</p>";

//bind the parameters
$type = 'snake';
$name = 'Slitherin';
$color = 'green';
$statement->bindParam(':type',$type, PDO::PARAM_STR);
$statement->bindParam(':name',$name, PDO::PARAM_STR);
$statement->bindParam(':color',$color, PDO::PARAM_STR);

//Execute
//$statement->execute();
$id = $dbh->lastInsertId();
echo "<p>Pet $id inserted successfully.</p>";

$type = 'dog';
$name = 'Cuda';
$color = 'black';
$statement->bindParam(':type',$type, PDO::PARAM_STR);
$statement->bindParam(':name',$name, PDO::PARAM_STR);
$statement->bindParam(':color',$color, PDO::PARAM_STR);

//Execute
//$statement->execute();
$id = $dbh->lastInsertId();
echo "<p>Pet $id inserted successfully.</p>";




//Define the query
$sql = "UPDATE pets SET name = :new WHERE name = :old";

//prepare the statement
$statement = $dbh->prepare($sql);

//Bind the parameters
$old = 'Joey';
$new = 'Troy';
$statement->bindParam(':old',$old,PDO::PARAM_STR);
$statement->bindParam(':new',$new,PDO::PARAM_STR);

//execute
$statement->execute();




//TRY IT
//Define the query
$sql = "UPDATE pets SET color = :new WHERE color = :old";

//prepare the statement
$statement = $dbh->prepare($sql);

//Bind the parameters
$old = 'black';
$new = 'pink';
$statement->bindParam(':old',$old,PDO::PARAM_STR);
$statement->bindParam(':new',$new,PDO::PARAM_STR);

//execute
$statement->execute();




//Define the query
$sql = "DELETE FROM pets WHERE id= :id";

//prepare
$statement = $dbh->prepare($sql);

//Bind
$id = 1;
$statement->bindParam(':id', $id, PDO::PARAM_INT);

//execute
$statement->execute();




//Define the query
$sql = "SELECT * FROM pets WHERE id = :id";

//prepare
$statement = $dbh->prepare($sql);

//Bind the parameters
$id=3;
$statement->bindParam(":id",$id,PDO::PARAM_INT);

//execute the statement
$statement->execute();

//Process the result
$row = $statement->fetch(PDO::FETCH_ASSOC);
echo $row['name'].", ".$row['type'].", ".$row['color'];


//TRY IT
//Define the query
$sql="SELECT petOwners.first,petOwners.last, pets.name FROM petOwners 
INNER JOIN pets ON petOwners.petID=pets.id";
//Prepare the statement
$statement = $dbh->prepare($sql);
//Execute the statement
$statement->execute();
//Process the result
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
echo "<table>";
foreach($result as $row) {
    echo "<br>";
    echo '<tr>'.'<td>'.$row['first']."</td><td>".$row['last'].'</td><td>'.
            $row['name'].'</td></tr>';
}
echo "</table>";