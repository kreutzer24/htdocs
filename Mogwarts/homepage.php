<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../Style/stylehomepage.css">
</head>

<body>

    <header>
        <h2 class="logo">MOGWARTS UNIVERSITY</h2>
        <nav class="navigation">
            <a href="index.php">login<span></span></a>
        </nav>
    </header>

    <!-- Hier beginnt der Abschnitt, den man scrollen kann -->
    <div class="scrollable-section">
        <img src="../img/Uni2.png" alt="Mogwarts University">
    </div>
    <!-- Ende des scrollbaren Abschnitts -->

    <!-- Text am Ende der Seite -->
    <div class="footer-text">
        <h1>Willkommen bei Mogwarts University!</h1>
        <p>
            Seit ihrer Gründung im Jahr 1887 hat die Mogwarts Universität ihre Mission unermüdlich verfolgt: Das Beste aus den Menschen herauszuholen, sie zu motivieren und ihr Selbstbewusstsein zu stärken. Inmitten einer Welt des Wandels und der Herausforderungen hat sie stets an ihren Prinzipien festgehalten, ohne dabei rassistische oder diskriminierende Ideologien zu tolerieren.

            Diese renommierte Institution ist nicht nur eine Hochburg des Wissens und der akademischen Exzellenz, sondern auch eine Quelle der Inspiration und des persönlichen Wachstums. Ihre Fakultät und Mitarbeiter sind bestrebt, nicht nur Wissen zu vermitteln, sondern auch eine Atmosphäre der Unterstützung und Ermutigung zu schaffen, in der jeder Student sein volles Potenzial entfalten kann.

            Das Curriculum der Mogwarts Universität ist so gestaltet, dass es die intellektuellen Grenzen herausfordert und gleichzeitig Raum für persönliche Interessen und Leidenschaften lässt. Von den traditionellen Disziplinen bis hin zu innovativen Forschungsfeldern bietet die Universität ein breites Spektrum an Studienprogrammen, die darauf abzielen, die Vielfalt des menschlichen Geistes und Talents zu würdigen und zu fördern.

            Darüber hinaus legt die Mogwarts Universität großen Wert auf die Entwicklung von Soft Skills und persönlichen Eigenschaften, die für ein erfolgreiches Leben und eine erfolgreiche Karriere von entscheidender Bedeutung sind. Durch ein umfassendes Angebot an Workshops, Seminaren und außerschulischen Aktivitäten werden die Studenten ermutigt, Führungsqualitäten zu entwickeln, kommunikative Fähigkeiten zu verbessern und ein tieferes Verständnis für die Welt um sie herum zu gewinnen.

            In den Gängen und auf den Höfen der Mogwarts Universität herrscht eine Atmosphäre der Offenheit, des Respekts und der Toleranz. Hier werden Ideen ausgetauscht, Debatten
        </p>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $(window).scroll(function () {
                var scroll = $(window).scrollTop();
                if (scroll > $('.scrollable-section').height()) {
                    $('.footer-text').css('opacity', '1');
                } else {
                    $('.footer-text').css('opacity', '0');
                }
            });
        });
    </script>

</body>

</html>
