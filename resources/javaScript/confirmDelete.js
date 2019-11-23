/**
 * Affiche une pop-up pour confirmer la suppression d'un article
 * @param idProduct, id de l'article à supprimer
 */
function ConfirmDelete(idProduct, quantity, proQuantity) {
    if(quantity - 1 > 0) {
        window.location = "index.php?controller=cart&action=subQuantity&idProduct=" + idProduct;
    }
    else {
        if(confirm("Etes-vous sûr de vouloir supprimer l'article ?")) { 
            // Redirige vers la page de suppression
            window.location = "index.php?controller=cart&action=subQuantity&idProduct=" + idProduct;
        }
    }
}
