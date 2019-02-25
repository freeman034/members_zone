<?php

namespace freeman034\members_zone\Model; // La classe sera dans ce namespace

require_once("model/Manager.php"); // Vous n'alliez pas oublier cette ligne ? ;o)

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM commentaires WHERE id_billet = ? ORDER BY date_commentaire DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function postComment($postId, $auteur, $commentaire)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO commentaires(id_billet, auteur, commentaire, date_commentaire) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $auteur, $commentaire));

        return $affectedLines;
    }

    public function editComment($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT auteur, commentaire FROM commentaires WHERE id_billet = ?');
        $req->execute(array($postId));
        $comment = $req->fetch();

        return $comment;
    }
}
