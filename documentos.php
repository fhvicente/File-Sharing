<?php
    include_once 'header.php'
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
        <h5 class="card-title">Documentos (Word e Excel)</h5>
        <p class="card-text">
            <?php
                if(isset($_SESSION['useruid'])){
                    echo '
                    <div class="gallery-upload">
                        <form action="includes/upload_documentos.php" method="POST" enctype="multipart/form-data">
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

    </div>
</div>

<section class="galeria-flex">

    <?php
        if(isset($_SESSION['userid'])){
            $session_user = $_COOKIE['user_name'];
            include_once 'includes/dbh.inc.php';
            $sql = "SELECT * FROM files WHERE fileType='docs' AND fileUserName='$session_user' ORDER BY fileOrder DESC;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)){
                echo "SQL statament failed";
            } else {
                mysqli_stmt_execute($stmt);
                $resultado = mysqli_stmt_get_result($stmt);

                while ($row = mysqli_fetch_assoc($resultado)){
                    echo '
                    <div class="table">
                        <table>
                            <tr>
                                <td>
                                <a href="uploads/docs/'.$row["fileFullName"].'">'.$row["fileFullName"].'</a>
                                </td>
                                <td>'.$row["fileName"].'</td>
                                <td><a href="includes/delete_documentos.php?file_id=' .$row["fileFullName"]. '" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a></td>   
                            </tr>
                        </table>
                    </div>
                    ';
                }
            }

        }
    ?>

</section>

<?php
    include_once 'footer.php'
?>