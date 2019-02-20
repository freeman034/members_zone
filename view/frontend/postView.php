<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog</title>
        <link href="public/css/style.css" rel="stylesheet" />
    </head>

    <body>
        <h1>Mon super blog !</h1>
        <p><a href="index.php">Retour à la liste des billets</a></p>

        <div class="news">
            <h3>
                <?= htmlspecialchars($post['titre']) ?>
                <em>le <?= $post['creation_date_fr'] ?></em>
            </h3>

            <p>
                <?= nl2br(htmlspecialchars($post['contenu'])) ?>
            </p>
        </div>

        <h2>Commentaires</h2>

        <?php
        while ($commentaires = $comments->fetch())
        {
        ?>
            <p><strong><?= htmlspecialchars($commentaires['auteur']) ?></strong> le <?= $commentaires['comment_date_fr'] ?></p>
            <p><?= nl2br(htmlspecialchars($commentaires['commentaire'])) ?></p>
        <?php
        }
        ?>

        <h2>Commentaires</h2>


        <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">

            <div>

                <label for="auteur">Auteur</label><br />

                <input type="text" id="auteur" name="auteur" />

            </div>

            <div>

                <label for="commentaire">Commentaire</label><br />

                <textarea id="commentaire" name="commentaire"></textarea>

            </div>

            <div>

                <input type="submit" />

            </div>

        </form>

    </body>
</html>
