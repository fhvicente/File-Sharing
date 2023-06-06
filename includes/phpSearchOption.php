<?php

$search = $_POST['search'];
$column = $_POST['column'];

$servername = "localhost";
$username = "root";
$password = "";
$db = "repositorio";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error){
	die("Connection failed: ". $conn->connect_error);
}

$sql = "select * from files where $column like '%$search%'";

$result = $conn->query($sql);

if ($result->num_rows > 0){
    while($row = $result->fetch_assoc() ){
        echo $row["fileUserName"].", ".$row["fileType"].", ".$row["fileName"].", ".$row["fileFullName"]."<br>";
            /* Get the file location */    
            if ($row["fileType"] === "img"){
                echo '<a href="../uploads/imagens/'.$row["fileFullName"].'"><p id="caminhoImagem">'.$row["fileFullName"].'</p></a>';
            } else if ($row["fileType"] === "docs"){
                echo '<a href="../uploads/docs/'.$row["fileFullName"].'"><p id="caminhoImagem">'.$row["fileFullName"].'</p></a>';
            } else if ($row["fileType"] === "pdfs"){
                echo '<a href="../uploads/pdf/'.$row["fileFullName"].'"><p id="caminhoImagem">'.$row["fileFullName"].'</p></a>';
            } else if ($row["fileType"] === "zip"){
                echo '<a href="../uploads/zip/'.$row["fileFullName"].'"><p id="caminhoImagem">'.$row["fileFullName"].'</p></a>';
            }
    }
    } else {
        echo "0 resultados";
    }

$conn->close();

?>