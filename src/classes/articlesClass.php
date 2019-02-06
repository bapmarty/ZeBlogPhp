<?php

namespace Zeblogphp;

use Zeblogphp\DBConnect;

class Articles {
  public function addArticle($arr, $author, $file, $tmpfile) {
    $bdd = new DBConnect;
    if (!empty($arr['title']) && !empty($arr['content']) && !empty($file)) {
      $args= array(
        'title' => FILTER_DEFAULT,
        'content' => FILTER_DEFAULT,
        'video' => FILTER_DEFAULT
      );
      $inputs = filter_var_array($arr, $args);
      if (empty($inputs['video'])) {
        $inputs['video'] = NULL;
      }
      $gAuthor = $bdd->prepare("SELECT id FROM users WHERE pseudo = ?");
      $gAuthor->execute(array($author));
      $idAuth = $gAuthor->fetch();  
      $gCategorie = $bdd->prepare("SELECT id FROM categories WHERE categorie = ?");
      $gCategorie->execute(array($arr['categorieSelector']));
      $idCat = $gCategorie->fetch();
      $addArticle =  $bdd->prepare('INSERT INTO articles(titre, auteur, id_auteur, content, id_categorie, video) VALUE (?, ?, ?, ?, ?, ?)');
      $addArticle->execute(array($inputs['title'], $author, $idAuth['id'], $inputs['content'], $idCat['id'], $inputs['video']));
      $id = $bdd->lastInsertId();
      $dir = __DIR__."/../../uploads/articles/{$id}/";
      if (!(mkdir($dir, 0755, true))) 
        die();
      else {
        $scDir = scandir($dir);
        (isset($scDir[2])) ? unlink($dir. "" .$scDir[2]) : print_r("nop!");
        print_r($uploadfile = $dir.basename($file));
        print_r($tmpfile);
        move_uploaded_file($tmpfile, $uploadfile);
        $realdir = "/uploads/articles/{$id}/";
        $addArticle =  $bdd->prepare('UPDATE articles SET logo = ? WHERE id = ?');
        $addArticle->execute(array($realdir, $id));
        return ($id);
      }
    } else {
      return (0);
    }
  }

  public function editArticle($arr, $id){
    $bdd = new DBConnect;
    $args = array(
      'title' => FILTER_DEFAULT,
      'content' => FILTER_DEFAULT,
      'video' => FILTER_DEFAULT
     );
     $inputs = filter_var_array($arr, $args);
     $gArticle = $bdd->prepare("SELECT id FROM articles WHERE id = ?");
     $gArticle->execute(array($id));
     if ($gArticle->rowCount() == 1) {
       $edit = $bdd->prepare("UPDATE articles SET titre = ?, content = ?, video = ? WHERE id = ?");
       $edit->execute(array($inputs['title'], $inputs['content'], $inputs['video'], $id));
       return ($id);
     } else {
       return (0);
     }
  }

  public function deleteArticle($id) {
    $bdd = new DBConnect;
    $gArticle = $bdd->prepare("SELECT id FROM articles WHERE id = ?");
    $gArticle->execute(array($id));
    if ($gArticle->rowCount() == 1) {
      $del = $bdd->prepare("DELETE FROM articles WHERE id = ?");
      $del->execute(array($id));
      return (1);
    } else {
      return (0);
    }
  }
}