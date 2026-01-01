import Alpine from "alpinejs";
import {getCategories,getProduits} from "./functions";
(async()=>{
    window.Alpine=Alpine;
    let Categories=await getCategories();
    let Produits=await getProduits();
    document.addEventListener("alpine:init",()=>{
        Alpine.store("data",{
            categories:Categories,
            produits:Produits,
            searchCategory:"toutes catégories",
            searchCategoryDBID:0,
            name:"",
            categoryId:Math.floor(Math.random()*((Categories.length-1)-0+1)+0),
            showCategoriesMenu:false,
            indexes:[]
        });
    });
    Alpine.start();
})();