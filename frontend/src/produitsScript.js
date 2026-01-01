import Alpine from "alpinejs";
import {getCategories,getProduits,getProduit} from "./functions";
(async()=>{
    window.Alpine=Alpine;
    let Categories=await getCategories();
    const Produits=await getProduits();
    let pendingRequest=false;
    let ProductCategory="";
    const data={
        categories:Categories,
        produits:Produits,
        filter_name:(new URLSearchParams(window.location.search)).get("name"),
        filter_categoryID:(new URLSearchParams(window.location.search)).get("id"),
        searchCategory:"toutes catégories",
        categoryId:Math.floor(Math.random()*((Categories.length-1)-0+1)+0),
        showCategoriesMenu:false,
        productCategory:ProductCategory,
        accountData:sessionStorage.getItem("accountData"),
        quantity:1,
        message:"",
        name:"",
        searchCategoryDBID:0,
        createCommande:async function(){
            if(!pendingRequest){
                pendingRequest=true;
                if(this.accountData==null){
                    const aLink=document.createElement("a");
                    aLink.href=`auth.html?page=productPage.html?id=${this.produit.id_produit}`;
                    aLink.click();
                }
                const accountData=JSON.parse(this.accountData);
                try{
                    const response=await fetch("http://localhost:8080/commandes/createCommande",{
                        method:"POST",
                        headers:{
                            "Content-Type":"application/x-www-form-urlencoded"
                        },
                        body:new URLSearchParams({
                            statut:"en cours",
                            montantTotal:this.produit.prix*this.quantity,
                            adresse:accountData.adresse,
                            ville:accountData.ville,
                            codePostal:accountData.code_postal,
                            idClient:accountData.id_client
                        })
                    });
                    if(!response.ok){
                        throw new Error("Request error");
                    }
                    const IdCommande=await response.json();

                    const responseCommandContent=await fetch("http://localhost:8080/contenir/createContenir",{
                        method:"POST",
                        headers:{
                            "Content-Type":"application/x-www-form-urlencoded"
                        },
                        body:new URLSearchParams({
                            idProduit:this.produit.id_produit,
                            idCommande:IdCommande,
                            quantite:this.quantity,
                            prixUnitaire:this.produit.prix,
                            sousTotal:this.produit.prix*this.quantity
                        })
                    });
                    
                    if(!responseCommandContent.ok){
                        throw new Error("Request error");
                    }
                    this.message="élement acheté avec succès";
                }catch(e){
                    this.message=e.message;
                }
                pendingRequest=true;
            }
        },
        addToWishList:async function(){
            try{
                if(!pendingRequest){
                    pendingRequest=true;
                    if(this.accountData==null){
                        const aLink=document.createElement("a");
                        aLink.href=`auth.html?page=productPage.html?id=${this.produit.id_produit}`;
                        aLink.click();
                    }
                    const accountDataArray=JSON.parse(this.accountData);
                    const response=await fetch(`http://localhost:8080/client/addToClientPanier`,{
                        method:"POST",
                        headers:{
                            "Content-Type":"application/x-www-form-urlencoded"
                        },
                        body:new URLSearchParams({
                            idClient:accountDataArray.id_client,
                            idProduit:this.produit.id_produit,
                            quantite:this.quantity,
                            prixUnitaire:this.produit.prix
                        })
                    });
                    if(!response.ok){
                        throw new Error("Request error");
                    }
                    const responseJson=await response.json();
                    if(responseJson.error.length>0){
                        throw new Error(responseJson.error);
                    }
                    console.log(this.error);
                    pendingRequest=false;
                    this.message="objet ajouté au panier !"
                }
            }catch(e){
                this.message=e.message;
                pendingRequest=false;
            }
        }
    }
    console.log(data.filter_name);
    document.addEventListener("alpine:init",()=>{
        Alpine.store("data",data);
    });
    Alpine.start();
})();

//ajoute le  message d'erreur