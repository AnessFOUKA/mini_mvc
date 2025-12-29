import Alpine from "alpinejs";
import {getCategories,getProduits,getProduit} from "./functions";
(async()=>{
    window.Alpine=Alpine;
    const produit_id=(new URLSearchParams(window.location.search)).get("id");
    let Categories=await getCategories();
    const Produit=await getProduit(produit_id);
    const Produits=await getProduits();
    let ProductCategory="";
    for(let i of Categories){
        if(i.id_categorie===Produit.id_categorie){
            ProductCategory=i.nom;
        }
    }
    document.addEventListener("alpine:init",()=>{
        Alpine.store("data",{
            categories:Categories,
            produit:Produit,
            produits:Produits,
            searchCategory:"toutes catégories",
            categoryId:Math.floor(Math.random()*((Categories.length-1)-0+1)+0),
            showCategoriesMenu:false,
            productCategory:ProductCategory,
            quantity:1
        });
    });
    Alpine.start();
})();