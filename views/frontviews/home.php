<?php 
$this->setTitle('Accueil');
$title = $this->getPageTitle();
?>

<section class="container-fluid presentation">
  <div class="container">
    <div class="col-lg-6 offset-lg-3">
      <img class="portrait" src="../public/img/jeanForteroche.png" alt="">
    </div>
    <div class="col align-self-center text-center">
      <h2>Jean Forteroche</h2>
      <p class="text-muted">
        <strong>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit eveniet nemo repudiandae, libero omnis voluptatum asperiores architecto quisquam quos in ipsum aliquam ut quibusdam, facere dolor suscipit.<br>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla debitis fugiat at quo consequuntur labore nisi quod, illum reiciendis quam esse tempora. Ex exercitationem molestias, nesciunt quod quia. Dolorum, consequatur.Vel sint perspiciatis quasi, nostrum itaque est quisquam harum commodi alias tempore recusandae ex quo et ad accusamus placeat earum aliquam eius eveniet nobis, voluptas obcaecati pariatur voluptatibus aperiam.
        </strong>
      </p>
    </div>
  </div>
</section>



<section class="container">
  <h2 class="text-center">Les dérniers chapitres</h2>
  <div class="row">
    <?php foreach ($articles as $article):?>
      <div class="col-lg-4 block-resum">
        <div class="resum-article"> 
          <div class="content-resum">         
            <div class="img-resum-article">
              <img src="<?= URI_IMAGE_CHAPTER . $article->getImageName();?>" alt="<?= $article->getImageAlt();?>">
            </div>
            <h5 class="text-muted text-uppercase">Chapitre <?= str_secur($article->getChapter());?></h5>
            <h3><?= str_secur($article->getTitle());?></h3>
            <p class="text-muted"><em>Publié le <?= str_secur($article->getDateAdded());?></em></p>
            <p><?= $article->getResume();?></p>
          </div>
          <p class="text-center resum-btn"><a class="btn btn-outline-info btn-block" href="../public/index.php?route=article&amp;idArt=<?= str_secur($article->getId());?>" role="button">Lire la suite &raquo;</a></p>
        </div>
      </div>
    <?php endforeach;?>        
  </div>
</section>