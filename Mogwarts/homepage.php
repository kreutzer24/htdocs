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
            
        </p>
    </div>

    <script>
        window.addEventListener('scroll', function () {
            const footerText = document.querySelector('.footer-text');
            const scrollableSection = document.querySelector('.scrollable-section');
            const scrollableSectionBottom = scrollableSection.getBoundingClientRect().bottom;

            if (scrollableSectionBottom <= window.innerHeight) {
                footerText.classList.add('visible');
            } else {
                footerText.classList.remove('visible');
            }
        });
    </script>

</body>

</html>
