import Alpine from "alpinejs";
import {getCategories} from "./functions";

async function getCommandes(id){
    try{
        const response=await fetch(`http://localhost:8080/client/getClientCommands?id=${id}`);
        if(!response.ok){
            throw new Error("Request error");
        }
        const commands=await response.json();
        return commands;
    }catch(e){
        console.log(e);
    }
}

(async()=>{
    window.Alpine=Alpine;
    let Categories=await getCategories();
    const data={
        categories:Categories,
        commandes:[],
        message:"",
        loading:false,
        setCommandAsCanceled:async function(Command){
            if(!this.loading){
                this.loading=true;
                try{
                    const response=await fetch("http://localhost:8080/commandes/updateCommande",{
                        method:"POST",
                        headers:{
                            "Content-Type":"application/x-www-form-urlencoded"
                        },
                        body:new URLSearchParams({
                            id:Command.id_commande,
                            statut:"annulee",
                            montantTotal:Command.montant_total,
                            adresse:Command.adresse,
                            ville:Command.ville,
                            codePostal:Command.code_postal,
                            idClient:Command.id_client
                        })
                    });
                    if(!response.ok){
                        throw new Error("Request error");
                    }
                    this.commandes=await getCommandes(data.accountData.id_client);
                }catch(e){
                    this.error=e.message;
                }
                this.loading=false;
            }
        },
        searchCategory:"toutes catégories",
        name:"",
        searchCategoryDBID:0,
        showCategoriesMenu:false,
        accountData:sessionStorage.getItem("accountData")
    }
    if(data.accountData===null){
        const aLink=document.createElement("a");
        aLink.href="auth.html?page=myAccount.html";
        aLink.click();
    }
    data.accountData=JSON.parse(data.accountData);
    data.commandes=await getCommandes(data.accountData.id_client);
    document.addEventListener("alpine:init",()=>{
        Alpine.store("data",data);
    });
    Alpine.start();
})();