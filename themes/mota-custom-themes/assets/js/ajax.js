document.addEventListener("DOMContentLoaded", function () {
    var lightboxContainer = document.querySelector(".lightbox");
    var lightboxImage = lightboxContainer.querySelector(".lightbox-image");
    var lightboxReference = lightboxContainer.querySelector(".reference");
    var lightboxCategorie = lightboxContainer.querySelector(".categorie");
    var lightboxClose = lightboxContainer.querySelector(".lightbox-close");
    var prevButton = lightboxContainer.querySelector(".previous");
    var nextButton = lightboxContainer.querySelector(".next");
    var allPostContainers = [];
    var currentImageIndex;

    // Fonction pour ouvrir la lightbox
    function openLightbox(element) {
        lightboxContainer.classList.add("open");

        var reference = element.querySelector(".icon").getAttribute("data-reference");
        var categorie = element.querySelector(".icon").getAttribute("data-categorie");
        var imageUrl = element.querySelector(".icon").getAttribute("data-thumbnail-url");

        lightboxImage.src = imageUrl;
        lightboxReference.textContent = reference;
        lightboxCategorie.textContent = categorie;

        // Récupérer l'index de l'image actuellement affichée
        currentImageIndex = allPostContainers.indexOf(element);
    }

    function addOpenLightboxEvent(postContainers) {
        postContainers.forEach(function(postContainer) {
            postContainer.addEventListener("click", function(event) {
                if (event.target.closest(".icon")) {
                    event.preventDefault();
                    openLightbox(postContainer);
                }
                console.log("ouverture lightbox");
            });
        });
    }

    // Gestionnaire d'événement pour fermer la lightbox au clic sur le bouton de fermeture
    lightboxClose.addEventListener("click", function () {
        lightboxContainer.classList.remove("open");
    });

    // Gestionnaires d'événements pour les boutons "Précédent" et "Suivant" de navigation
    prevButton.addEventListener("click", function() {
        currentImageIndex--;
        if (currentImageIndex < 0) {
            currentImageIndex = allPostContainers.length - 1;
        }
        openLightbox(allPostContainers[currentImageIndex]);
    });

    nextButton.addEventListener("click", function() {
        currentImageIndex++;
        if (currentImageIndex >= allPostContainers.length) {
            currentImageIndex = 0;
        }
        openLightbox(allPostContainers[currentImageIndex]);
    });

    // Fonction pour gérer les changements de filtres
    function handleFilterChange() {
        var categorie = $("#categories").val();
        var format = $("#formats").val();
        var annee = $("#annee").val();
        var url = $(".btn-load").data('ajaxurl');

        $.ajax({
            url: url,
            type: "POST",
            data: {
                action: "load_more_photos",
                categorie: categorie,
                format: format,
                annee: annee,
                orderby: 'date',
                order: 'DESC',
            },
            success: function (response) {
                $(".photos .post-container").remove();
                $(".photos").append(response);
                $(".photos").data("page", 1);
                $(".btn-load").show().text("Charger plus");

                var postContainers = document.querySelectorAll(".post-container");
                allPostContainers = Array.from(postContainers);
                addOpenLightboxEvent(postContainers);
            },
        });
    }

    // Fonction pour charger plus de photos
    function loadMorePosts() {
        var catalogue = $(".photos");
        var currentPage = parseInt(catalogue.data("page"));
        var url = $(".btn-load").data('ajaxurl');
        var categorie = $("#categories").val();
        var format = $("#formats").val();
        var annee = $("#annee").val();

        $.ajax({
            url: url,
            type: "POST",
            dataType: "html",
            data: {
                action: "load_more_photos",
                page: currentPage,
                categorie: categorie,
                format: format,
                annee: annee,
                orderby: 'date',
                order: 'DESC',
            },
            success: function (response) {
                if (response) {
                    catalogue.append(response);
                    catalogue.data("page", currentPage + 1);
                    $(".btn-load").text("Charger plus");

                    var newPostContainers = document.querySelectorAll(".post-container");
                    allPostContainers = Array.from(newPostContainers);
                    addOpenLightboxEvent(newPostContainers);
                } else {
                    $(".btn-load").hide();
                }
            },
            error: function () {
                $(".btn-load").text("Erreur lors du chargement");
            }
        });
    }
        // Ajouter les événements pour les filtres
        $("#categories, #formats, #annee").change(handleFilterChange);

        // Ajouter l'événement pour le bouton "Charger plus"
        $(".btn-load").click(loadMorePosts);
    
        // Initialiser la première liste des post containers
        var initialPostContainers = document.querySelectorAll(".post-container");
        allPostContainers = Array.from(initialPostContainers);
        addOpenLightboxEvent(initialPostContainers);
    });


$("#formats").select2()
$("#categories").select2()
$("#annee").select2()

