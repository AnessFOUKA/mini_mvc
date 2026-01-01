import Alpine from "alpinejs";
import {getCategories,getProduits,getProduit} from "./functions";
(async()=>{
    window.Alpine=Alpine;
    let Categories=await getCategories();
    let Produits=await getProduits();
    if(sessionStorage.getItem("accountData")===null){
        const a=document.createElement("a");
        a.href="auth.html";
        a.click();
    }
    let pendingRequest=false;
    const data={
        produits:Produits,
        categories:Categories,
        searchCategory:"toutes catégories",
        showCategoriesMenu:false,
        wishListItems:[],
        accountData:JSON.parse(sessionStorage.getItem("accountData")),
        pendingRequest:false,
        message:"",
        name:"",
        searchCategoryDBID:0,
        updateWishListItems:async function(){
            try{
                const response=await fetch(`http://localhost:8080/client/getClientPanier?id=${this.accountData["id_client"]}`);
                if(!response.ok){
                    throw new Error("Request error");
                }
                const responseJson=await response.json();
                this.wishListItems=responseJson;
            }catch(e){
                throw new Error(e.message);
            }
        },
        createCommande:async function(){
            if(!pendingRequest){
                pendingRequest=true;
                if(this.accountData==null){
                    const aLink=document.createElement("a");
                    aLink.href=`auth.html?page=productPage.html?id=${this.produit.id_produit}`;
                    aLink.click();
                }
                const accountData=this.accountData;
                try{
                    const response=await fetch("http://localhost:8080/commandes/createCommande",{
                        method:"POST",
                        headers:{
                            "Content-Type":"application/x-www-form-urlencoded"
                        },
                        body:new URLSearchParams({
                            statut:"en cours",
                            montantTotal:this.getTotalPrice(),
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

                    for(let wishListItem of this.wishListItems){
                        const responseCommandContent=await fetch("http://localhost:8080/contenir/createContenir",{
                            method:"POST",
                            headers:{
                                "Content-Type":"application/x-www-form-urlencoded"
                            },
                            body:new URLSearchParams({
                                idProduit:wishListItem.infosProduit.id_produit,
                                idCommande:IdCommande,
                                quantite:wishListItem.panierContenu.quantite,
                                prixUnitaire:wishListItem.infosProduit.prix,
                                sousTotal:wishListItem.infosProduit.prix*wishListItem.panierContenu.quantite
                            })
                        });
                        
                        if(!responseCommandContent.ok){
                            throw new Error("Request error");
                        }
                    }
                    this.message="élements achetés avec succès";
                }catch(e){
                    this.message=e.message;
                }
                pendingRequest=true;
            }
        },
        setNewData:async function(Quantite,IdProduit,IdPanier,PrixUnitaire){
            try{
                const product=await getProduit(IdProduit);
                if(!this.pendingRequest && (Quantite>=1 && Quantite<=product.stock)){
                    this.pendingRequest=true;
                    const response=await fetch(`http://localhost:8080/panierContenu/updatePanierContenu`,{
                        method:"POST",
                        headers:{
                            "Content-Type":"application/x-www-form-urlencoded"
                        },
                        body:new URLSearchParams({
                            idProduit:IdProduit,
                            idPanier:IdPanier,
                            quantite:Quantite,
                            prixUnitaire:PrixUnitaire,
                            currentIdProduit:IdProduit,
                            currentIdPanier:IdPanier
                        })
                    });
                    if(!response.ok){
                        throw new Error("Request error");
                    }
                    await this.updateWishListItems();
                    console.log("won");
                    this.pendingRequest=false;
                }
            }catch(e){
                throw new Error(e.message);
            }
        },
        removePanierContenu:async function(IdProduit,IdPanier){
            try{
                if(!this.pendingRequest){
                    this.pendingRequest=true;
                    const response=await fetch(`http://localhost:8080/panierContenu/removePanierContenu?currentIdPanier=${IdPanier}&currentIdProduit=${IdProduit}`);
                    if(!response.ok){
                        throw new Error("Request error");
                    }
                    await this.updateWishListItems();
                    console.log("won");
                    this.pendingRequest=false;
                }
            }catch(e){
                throw new Error(e.message);
            }
        },
        getTotalPrice:function(){
            let totalPrice=0;
            for(let wishListItem of this.wishListItems){
                totalPrice+=(Number(wishListItem.panierContenu.prix_unitaire)*Number(wishListItem.panierContenu.quantite));
            }
            return totalPrice;
        },
        categoryId:Math.floor(Math.random()*((Categories.length-1)-0+1)+0)
    }
    document.addEventListener("alpine:init",()=>{
        Alpine.store("data",data);
    });
    await data.updateWishListItems();
    console.log(data.wishListItems);
    Alpine.start();
})();