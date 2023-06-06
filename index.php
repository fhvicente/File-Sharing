<!--O header e footer foram separados para dar uma ideia de trabalhar com páginas tipo template, o header e o footer fixos!-->
<?php
    include_once 'header.php';
?>

<br>
<div class="card text-center">
    <div class="card-header"></div>
    <div class="card-body">
        <h5 class="card-title">Repositório de Documentos</h5>    
    </div>  
</div>


<div style="text-align: left" class="card-footer text-muted">
    <?php 
    if(isset($_SESSION['useruid'])){
        $id = $_SESSION['useruid'];
        echo "Repositório de: ".$id;
    } else {
        echo "Flávio Vicente - a79367@ualg.pt";
    }
    ?>
</div>
</div>

<section class="index-categories">
    <h4 align="center">Lista de Categorias</h4>
  <div class="index-categories-list"> 

      <a href='imagens.php'>
          <div>
              <h3>Outros</h3>
          </div>
      </a>
      
      <a href='documentos.php'>
          <div>
              <h3>Office</h3>
          </div>
      </a>
      
      <a href='pdfs.php'>
          <div>
              <h3>PDFs</h3>
          </div>
      </a>
      
      <a href='zips.php'>
          <div>
              <h3>Zip</h3>
          </div>
      </a>
</section>

<?php
  include_once 'footer.php';
?>
