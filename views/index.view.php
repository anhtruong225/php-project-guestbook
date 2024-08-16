<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="./styles/lib/montserrat/webfonts/Montserrat.css" />
    <link rel="stylesheet" type="text/css" href="./styles/main.css" />
    <title>Gästebuch</title>
</head>

<body>
    <div class="container">
        <h1 class="guestbook-heading">Gästebuch</h1>
        <form method="POST" action="submit.php">
            <?php if (isset($errorMessage)):?>
            <p><?php e($errorMessage)?></p>
            <?php endif; ?>
            <label class="guestbook-entry-label" for="name">Dein Name:</label>
            <input class="guestbook-entry-input" type="text" id="name" name="name" required="required" />

            <label class="guestbook-entry-label" for="title">Titel des Eintrags:</label>
            <input class="guestbook-entry-input" type="text" id="title" name="title" required="required" />

            <label class="guestbook-entry-label" for="content">Inhalt des Eintrags:</label>
            <textarea rows="4" class="guestbook-entry-input" type="text" id="content" name="content"
                required="required"></textarea>

            <div class="guestbook-form-buttons">
                <input class="button" type="reset" value="Zurücksetzen">
                <input class="button" type="submit" value="Absenden">
            </div>
        </form>

        <hr class="guestbook-separator" />

        <?php foreach($entries AS $entry): ?>
        <div class="guestbook-entry">
            <div class="guestbook-entry-header">
                <h3 class="guestbook-entry-title">
                    <?php echo e($entry['title']); ?>
                </h3>
                <span class="guestbook-entry-author">
                    <?php echo e($entry['name']); ?>
                </span>
            </div>
            <div class="guestbook-entry-content">

                <pre>
      <?php 
                    $paragraphs = explode("/n", $entry['content']);
                    $filteredPara = [];
                    foreach ($paragraphs AS $paragraph) {
                        $paragraph = trim($paragraph);
                        if (strlen($entry['content']) >0) {
                            $filteredPara[] = $paragraph;
                        }

                    }
    
                    ?>
      </pre>

                <?php echo e($entry['content']); ?>

                <?php foreach($filteredPara AS $p):?>
                <p><?php echo e($p)?></p>
                <?php endforeach; ?>

            </div>
        </div>
        <?php endforeach; ?>
        <pre>
        <?php $numPage = ceil($countTotal / $perPage)?>
        </pre>

        <ul class="guestbook-pagination">
            <?php for($x=1; $x <= $numPage; $x++):?>
            <li class="guestbook-pagination-li">
                <a class="guestbook-pagination-a guestbook-pagination-active"
                    href="index.php?<?php echo http_build_query(['page' => $x])?>"><?php echo e($x)?></a>
            </li>
            <?php endfor; ?>

        </ul>

        <hr class="guestbook-separator" />

        <footer class="guestbook-footer">
            <p>Implementiert im PHP-Kurs</p>
        </footer>

    </div>
</body>

</html>