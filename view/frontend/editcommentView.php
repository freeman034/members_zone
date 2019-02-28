<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog</title>
        <link href="public/css/style.css" rel="stylesheet" />
    </head>

    <body>
        <h1>Mon super blog !</h1>
        <p><a href="index.php?action=post&id=<?= $_GET['id'] ?>">Retour au billet</a></p>

        <div class="news">
            <h3>
                <?= htmlspecialchars($post['titre']) ?>
                <em>le <?= $post['creation_date_fr'] ?></em>
            </h3>

            <p>
                <?= nl2br(htmlspecialchars($post['contenu'])) ?>
            </p>
        </div>

        <h2>Commentaire à modifier</h2>


        <form action="index.php?action=modifyComment&amp;id=<?= $_GET['id'] ?>&amp;commentid=<?= $_GET['commentid'] ?>" method="post">

            <div>

                <label for="auteur">Auteur</label><br />

                <input type="text" id="auteur" name="auteur" value="<?= $comment['auteur'] ?>" />

            </div>

            <div>

                <label for="commentaire">Commentaire</label><br />

                <textarea id="commentaire" name="commentaire" /><?= $comment['commentaire'] ?></textarea>

            </div>

            <div>

                <input type="submit" />
                <?php if (isset($_POST['auteur']) && isset($_POST['commentaire']))  { echo '<br><b>Commentaire modifié !</b>'; } ?>
            </div>

        </form>

    </body>
</html>
