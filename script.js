const progressBar = document.getElementsByClassName('progress-bar')[0];

// Funktion, um die Seite zu öffnen
function redirectToHomePage() {
  window.location.href = 'http://localhost/homepage.php';
}

// Intervall für die Aktualisierung der Breite des Fortschrittsbalkens
const interval = setInterval(() => {
  const computedStyle = getComputedStyle(progressBar);
  let width = parseFloat(computedStyle.getPropertyValue('--width')) || 0;

  // Überprüfen, ob die Breite 100 erreicht hat
  if (width >= 100) {
    clearInterval(interval); // Intervall stoppen
    redirectToHomePage(); // Seite öffnen
  } else {
    // Fortschrittsbalken weiter erhöhen
    width += 0.1;
    progressBar.style.setProperty('--width', width);
  }
}, 5);
