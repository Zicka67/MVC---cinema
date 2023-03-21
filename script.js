function filterGridItems(category) {    //DOMContentLoaded pour afficher au chargement de page ?
    // Sélectionne tous les éléments de la grille
    const gridItems = document.querySelectorAll('.grid-item');
    
    let count = 0; // Initialise le compteur à 0
    
    // Parcours chaque élément de la grille
    gridItems.forEach(item => {
      // Si l'élément a la catégorie correspondante
      if (item.dataset.category === category || category === "all") {  
        // Affiche l'élément
        item.style.display = 'block';
        count++; // Incrémente le compteur
      } else {
        // Sinon masque l'élément
        item.style.display = 'none';
      }
    });
  }
