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
    const data={
        produits:Produits,
        categories:Categories,
        searchCategory:"toutes catégories",
        showCategoriesMenu:false,
        wishListItems:[],
        accountData:JSON.parse(sessionStorage.getItem("accountData")),
        pendingRequest:false,
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