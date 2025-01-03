<?php
// Charger la bibliothèque Symfony/Yaml
require 'yaml/vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

// Charger les données YAML
$skills = [];
try {
    $skills = Yaml::parseFile('competences.yaml')['dev'];
} catch (Exception $e) {
    echo "Erreur de lecture du fichier YAML : " . $e->getMessage();
}

$contactForm = [];
try {
    $contactForm = Yaml::parseFile('contact.yaml')['contact_form'];
} catch (Exception $e) {
    echo "Erreur de lecture du fichier YAML : " . $e->getMessage();
}

// Chargement des données YAML pour mes réalisations

$projects = [];
$formations = [];
try {
    $projects = Yaml::parseFile('realisations.yaml')['projects'];
    $formations = Yaml::parseFile('formations.yaml')['formations'];
} catch (Exception $e) {
    echo "Erreur de lecture du fichier YAML : " . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Max .T - PORTFOLIO</title>
    <link href="css/base.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Racing+Sans+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400..700;1,400..700&family=Changa+One:ital@0;1&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Racing+Sans+One&family=Squada+One&display=swap" rel="stylesheet">

</head>
<body>
    <div class="network">
<a href='https://linkedin.com/in/max-tribouillard-831b71279' target='_blank'><button class='socials'><strong>LinkedIn</strong></button></button></a>
</div>
<?php

require_once("yaml/yaml.php");
$homeData = yaml_parse_file("accueil.yaml");

// Illustration première page
echo "<img id='home' class='background' src='".$homeData['illustration']."'>"

?>

<!-- BARRE DE NAVIGATION -->

<!-- Seconde illustration -->
<img class='nameimg' src='css/img/MAX-TRIBOUILLARD.png'>
<div class="navbar">
        <ul class="menu">
            <li class='home'><a href="#home">HOME</a></li>
            <li><a href="#mainTitle">MAX</a></li>
            <li><a href="#skillsTitle">SKILLS</a></li>
            <li><a href="#realisations">WORK</a></li>
            <li><a href="#formations">FORMATIONS</a></li>
            <li class='contact'><a href="#contact">CONTACT</a></li>
        </ul>
    </div>

<!-- PRESENTATION -->

<h1 id='mainTitle' class='mainTitle'>Hey ! &#128516;</h1>
<hr>
<div class='mainContent'>
<?php

// Accroche et présentation
echo "<h2 id='max' class='max'> Salut, moi c'est ".$homeData['prenom']." - Apprenti développeur. &#128187;</h2>";
echo "<div class='presentation'><h3 id='presentation'>Je me présente ".$homeData['presentation']." <br> ".$homeData['accroche']."</h3></div>";

?>
</div>


<!-- SKILLS/COMPETENCES -->

<h1 id='skillsTitle' class='skillsTitle'>Skills</h1>
<hr>
<div class="skillbars">
        <?php foreach ($skills as $skill): ?>
            <div class="skillbar-container">
                <div class="skillbar">
                    <span class="skillbar-name"><?= htmlspecialchars($skill['name']) ?></span>
                    <div class="skillbar-bar" style="--skill-level: <?= htmlspecialchars($skill['level']) ?>%;">
                        <div class="skillbar-fill"></div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<!-- REALISATIONS -->

    <h1 id='realisations' class='realisations'>Realisations</h1>
    <hr>
    <div class="portfolio-container">
        <?php foreach ($projects as $project): ?>
            <div class="card">
                <img src="<?= htmlspecialchars($project['image']) ?>" alt="<?= htmlspecialchars($project['title']) ?>">
                <div class="card-body">
                    <h2 class="card-title"><?= htmlspecialchars($project['title']) ?></h2>
                    <p class="card-description"><?= htmlspecialchars($project['description']) ?></p>
                    <a href="<?= htmlspecialchars($project['link']) ?>" target="_blank">Voir le projet</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<!-- FORMATIONS -->

    <h1 id='formations' class='formations'>Formations</h1>
    <hr>
    <div class="formations-container">
        <?php foreach ($formations as $formation): ?>
            <div class="formation-card">
                <h2 class="formation-title"><?= htmlspecialchars($formation['title']) ?></h2>
                <p class="formation-institution"><?= htmlspecialchars($formation['institution']) ?> - <?= htmlspecialchars($formation['year']) ?></p>
                <p class="formation-description"><?= htmlspecialchars($formation['description']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <div class='cvButton'>
    <a href='https://drive.google.com/file/d/1l1ZfWwHy3NoqhzWzqJwCATqVKz59CMAb/view?usp=sharing' target='_blank'><button class='cv'>Télécharger mon CV</button></a>
    </div>
    <h1 id='contact' class='formations'>Contact</h1>
    <hr>

    <div class="contact-container">
        <form action="contact-handler.php" method="POST" class="contact-form">
            <?php foreach ($contactForm['fields'] as $field): ?>
                <label for="<?= htmlspecialchars($field['name']) ?>">
                    <?= htmlspecialchars($field['label']) ?>
                </label>
                <?php if ($field['type'] === 'textarea'): ?>
                    <textarea
                        id="<?= htmlspecialchars($field['name']) ?>"
                        name="<?= htmlspecialchars($field['name']) ?>"
                        placeholder="<?= htmlspecialchars($field['placeholder']) ?>"
                        <?= $field['required'] ? 'required' : '' ?>
                    ></textarea>
                <?php else: ?>
                    <input
                        type="<?= htmlspecialchars($field['type']) ?>"
                        id="<?= htmlspecialchars($field['name']) ?>"
                        name="<?= htmlspecialchars($field['name']) ?>"
                        placeholder="<?= htmlspecialchars($field['placeholder']) ?>"
                        <?= $field['required'] ? 'required' : '' ?>
                    />
                <?php endif; ?>
            <?php endforeach; ?>
            <button type="submit"><?= htmlspecialchars($contactForm['submit_button']) ?></button>
        </form>
    </div>


</body>
</html>

