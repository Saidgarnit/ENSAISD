// Cette fonction s'exécute lorsque la page est chargée
document.addEventListener("DOMContentLoaded", function() {
    // Récupère tous les boutons "View Details"
    const viewDetailsButtons = document.querySelectorAll('.btn-view-details');

    // Boucle à travers chaque bouton
    viewDetailsButtons.forEach(button => {
        // Ajoute un écouteur d'événements pour chaque bouton
        button.addEventListener('click', function() {
            // Récupère l'ID de l'événement à partir de l'attribut "data-event-id"
            const eventId = button.getAttribute('data-event-id');

            // Redirige vers eventDetail.php avec l'ID de l'événement comme paramètre d'URL
            window.location.href = `eventDetail.php?id=${eventId}`;
        });
    });
});
