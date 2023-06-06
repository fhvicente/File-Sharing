<?php
    include_once 'header.php';
?>


<style>
/* Galeria Upload */
.gallery-upload {
    display: flex;
    flex-wrap: wrap;
    max-width: 800px;
    margin: 0 auto;
    justify-content: center;
}

.gallery-upload form {
    width: 80%;
}

.gallery-upload form input {
    width: calc(100% - 16px);
    padding: 6px;
    margin-bottom: 4px;
}

.gallery-upload form button {
    display: block;
    padding: 10px 20px;
    margin: 10px auto;
    cursor: pointer;
}

/* Galeria */

.galeria-flex {
    display: flex;
    flex-wrap: wrap;
    max-width: 800px;
    margin: 0 auto;
}

.galeria-flex div {
    flex: 1 1 200px;
    margin: 10px;
}
.galeria-flex img {
    width: 80%;
    height: 80%;    
}

/* POP UP WINDOW*/

.img-window {
    width: 98vw;
    height: 80vh;
    background-color: rgba(0, 0, 0, 0.8);
    position: fixed;
    top: 0;
    left: 0;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 100;
}

.img-window img {
    max-height: 60vh;
    max-width: 60vw;
}

/* BUTÕES */
.img-btn-next {
    display: block;
    padding: 6px 10 px;
    border-radius: 4px;
    background-color: #111111;
    position: fixed;
    top: 48vh;
    z-index: 500;
    font-family: Arial, Helvetica, sans-serif;
    color: white;
    cursor: pointer;
    text-transform: uppercase;
}

.img-btn-next:hover {
    opacity: 0.8;
}

.img-btn-prev {
    display: block;
    padding: 6px 10 px;
    border-radius: 4px;
    background-color: #111111;
    position: fixed;
    top: 48vh;
    z-index: 500;
    font-family: Arial, Helvetica, sans-serif;
    color: white;
    cursor: pointer;
    text-transform: uppercase;
}

.img-btn-prev:hover {
    opacity: 0.8;
}    
</style>

<br>
<div class="card text-center">
    <div class="card-header" align="left">
        <h4>Repositório de 
            <?php     
                if(isset($_SESSION['useruid'])){
                    $session_user = $_COOKIE['user_name'];
                    echo $session_user;
                } else {
                    echo "#";
                }
            ?>
        </h4>
    </div>

    <div class="card-body">
        <h5 class="card-title">Documentos (Zip)</h5>
        <p class="card-text">
            <?php
                if(isset($_SESSION['useruid'])){
                    echo '
                    <div class="gallery-upload">
                        <form action="includes/upload_zips.php" method="POST" enctype="multipart/form-data">
                            <input type="file" name="file">
                            <input type="text" name="file_name" placeholder="File name...">
                            <button type="submit" class="btn btn-primary" name="submit">UPLOAD</button>
                        </form>
                    </div>
                    ';
                } else {
                    echo '
                    <h2>Não se encontra Credenciado<h2>';
                }    
            ?>   
        </p>
    </div>
    <div style="text-align: left" class="card-footer text-muted">
    <!-- Search - vai aqui -->
    </div>
</div>


<section class="galeria-flex">

    <?php
        if(isset($_SESSION['useruid'])){
            $session_user = $_COOKIE['user_name'];
            include_once 'includes/dbh.inc.php';
            $sql = "SELECT * FROM files WHERE fileType='zips' AND fileUserName='$session_user' ORDER BY fileOrder DESC;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)){
                echo "SQL statement failed";
            } else {
                mysqli_stmt_execute($stmt);
                $resultado = mysqli_stmt_get_result($stmt);

                while ($row = mysqli_fetch_assoc($resultado)){
                    echo '
                    <div class="table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Ficheiro</th>
                                    <th>Nome</th>
                                    <th>Ação</th>
                                </th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                    <a href="uploads/zip/'.$row["fileFullName"].'">'.$row["fileFullName"].'</a>
                                    </td>
                                    <td>'.$row["fileName"].'</td>
                                    <td><a href="includes/delete_zips.php?file_id=' .$row["fileFullName"]. '" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a></td>   
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    ';
                }
            }
        }
    ?>

</section>


<?php
    include_once 'footer.php';
?>
