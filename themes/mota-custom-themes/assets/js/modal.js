document.addEventListener("DOMContentLoaded", function() {
    var modal = document.getElementById("myModal");
    var menuLinks = document.querySelectorAll(".menu-item-118");
    var referenceField = document.querySelector("#wpcf7-f130-o1 form p:nth-child(4) label span input");
  
    window.onclick = function(event) {
      if (event.target === modal) {
        modal.style.display = "none";
        referenceField.value = ""; // Réinitialiser la valeur du champ de référence à une chaîne vide
      }
    };
  
    // Ouvrir le modal lorsque le lien est cliqué
    menuLinks.forEach(function(link) {
      link.addEventListener('click', function(event) {
        event.preventDefault();
        modal.style.display = "block";
        var reference = link.dataset.reference;
        if (reference) {
          referenceField.value = reference;
        } else {
          referenceField.value = "";
        }
      });
    });
  });