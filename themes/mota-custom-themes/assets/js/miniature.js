document.addEventListener('DOMContentLoaded', function() {
  var thumbnails = document.querySelectorAll('.thumbnails');
  var arrowLeft = document.querySelector('.arrow-left');
  var arrowRight = document.querySelector('.arrow-right');
  var currentIndex = 1;

  // Fonction pour afficher la miniature suivante
  function showNextThumbnail() {
    if (currentIndex < thumbnails.length - 1) {
      currentIndex++;
    } else {
      currentIndex = 1;
    }
    thumbnails[currentIndex].click();
  }

  // Fonction pour afficher la miniature précédente
  function showPreviousThumbnail() {
    if (currentIndex > 0) {
      currentIndex--;
    } else {
      currentIndex = thumbnails.length - 1;
    }
    thumbnails[currentIndex].click();
  }

  // Fonction pour afficher la miniature au survol de la flèche gauche
  function showBeforeThumbnail() {
    thumbnails[0].style.opacity = 1;
  }

  // Fonction pour afficher la miniature au survol de la flèche droite
  function showAfterThumbnail() {
    thumbnails[thumbnails.length - 1].style.opacity = 1;
  }

  // Fonction pour masquer toutes les miniatures
  function hideThumbnails() {
    thumbnails.forEach(function(thumbnail) {
      thumbnail.style.opacity = 0;
    });
  }

  // Ajouter les événements de clic aux flèches
  arrowLeft.addEventListener('click', showPreviousThumbnail);
  arrowRight.addEventListener('click', showNextThumbnail);

  // Ajouter les événements de survol aux flèches
  arrowLeft.addEventListener('mouseover', showBeforeThumbnail);
  arrowRight.addEventListener('mouseover', showAfterThumbnail);

  // Masquer les miniatures lorsque la souris quitte les flèches
  arrowLeft.addEventListener('mouseout', hideThumbnails);
  arrowRight.addEventListener('mouseout', hideThumbnails);
});