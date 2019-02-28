<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function listPosts()
{
    $postManager = new freeman034\members_zone\Model\PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require('view/frontend/listPostsView.php');
}

function post()
{
    $postManager = new freeman034\members_zone\Model\PostManager();
    $commentManager = new freeman034\members_zone\Model\CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}

function addComment($postId, $auteur, $commentaire)
{
    $commentManager = new freeman034\members_zone\Model\CommentManager();

    $affectedLines = $commentManager->postComment($postId, $auteur, $commentaire);

    if ($affectedLines === false)
    {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else
    {
        header('Location: index.php?action=post&id=' . $postId);
    }
}
function editComment()
{
    $postManager = new freeman034\members_zone\Model\PostManager();
    $commentManager = new freeman034\members_zone\Model\CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comment = $commentManager->editComment($_GET['commentid']);

    require('view/frontend/editcommentView.php');
}

function modifyComment()
{
    $postManager = new freeman034\members_zone\Model\PostManager();
    $commentManager = new freeman034\members_zone\Model\CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $commentManager->modifyComment($_GET['commentid'], $_POST['auteur'], $_POST['commentaire']);
    $comment = $commentManager->editComment($_GET['commentid']);

    require('view/frontend/editcommentView.php');
}
