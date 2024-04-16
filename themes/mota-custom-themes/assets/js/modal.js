document.addEventListener("DOMContentLoaded", function() {
    var modal = document.getElementById("myModal");

    var menuLink = document.querySelector(".menu-item-118");

    window.onclick = function(event) {
      if (event.target === modal) {
        modal.style.display = "none";
      }
    };
  
    // Ouvrir le modal lorsque le lien est cliqué
    menuLink.addEventListener("click", function(event) {
      event.preventDefault(); // Empêche le comportement par défaut du lien (redirection)
      modal.style.display = "block";
    });
  });