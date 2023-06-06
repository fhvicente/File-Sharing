<?php
if (isset($_POST['submit'])) {

    $newFileName = $_POST['file_name'];  
    $setfileType = "pdfs";
    
    $session_user = $_COOKIE["user_name"];
    
    $file = $_FILES['file'];
     
    /* Obter as informação do ficheiro para upload */   
    $fileName = $file['name'];
    $fileType = $file['type'];
    $fileTempName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    
    /* Capturar a extensão dos ficheiros */
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    /* Tipos de ficheiros autorizados */
    $allowed = array('pdf');
    /* Verifica se tem extensão autorizada na array */
    if (in_array($fileActualExt, $allowed)){
        /* Verifica a consistencia da imagem - atributo erro = 0 */
        if ($fileError === 0){
            /* Verifica se não tem mais de 2M de tamanho*/
            if ($fileSize < 200000000 ){
                /* Forçar que obtem nome não repetível (único)*/
                /* $imageFullName = $newFileName . "." . uniqid("", false) . "." . $fileActualExt; */
                $imageFullName = $newFileName . uniqid("", false) . "." . $fileActualExt;
                $imageFullName2 = $session_user . uniqid("", false) . "." . $fileActualExt;
                $fileDestino = "../uploads/pdf/" . $imageFullName2;
                
                /* Guardar para a base de dados */
                include_once "../includes/dbh.inc.php";
                if (empty($newFileName) ){
                    header("Location: ../pdfs.php?upload=empty");
                    exit();
                } else {
                    $sql = "SELECT * FROM files;";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo "SQL statement failed";
                    } else {
                        mysqli_stmt_execute($stmt);
                        $resultado = mysqli_stmt_get_result($stmt);
                        $rowCount = mysqli_num_rows($resultado);
                        $setImageOrder = $rowCount + 1;

                        $sql = "INSERT INTO files (fileType, fileName, fileFullName, fileOrder, fileUserName) VALUES (?, ?, ?, ?, ?);";
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            echo "SQL statement failed";
                        } else {
                            mysqli_stmt_bind_param($stmt, "sssss", $setfileType, $newFileName, $imageFullName2, $setImageOrder, $session_user);
                            mysqli_stmt_execute($stmt);

                            /* Transferir o ficheiro do local temporário para a pasta correcta */
                            move_uploaded_file($fileTempName, $fileDestino);
                        }
                    }
                }
                header("Location: ../pdfs.php?upload=Success");
            } else {
                /* Erro se tem mais de 2M de tamanho*/
                echo "O ficheiro é demasiado grande";
            }
        } else {
            /* Se o atributo erro = 1 */
            echo "Houve um erro ao carregar o ficheiro";
        }
    } else {
        /* Se não for de extensão autorizada */
        echo "Não é permitido carregar esse tipo de ficheiro ";
        exit();
    }
}

 