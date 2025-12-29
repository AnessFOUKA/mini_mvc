export async function getCategories(){
    try{
        const response=await fetch("http://localhost:8080/categories");
        if(!response.ok){
            throw new Error("Request error");
        }
        const produits=await response.json();
        return produits;
    }catch(e){
        console.log(e);
    }
}

export async function getCategorie(id_categorie){
    try{
        const response=await fetch(`http://localhost:8080/categorie/getCategorieFilteredById?id=${id_categorie}`);
        if(!response.ok){
            throw new Error("Request error");
        }
        const responseJson=await response.json();
        return responseJson;
    }catch(e){
        throw new Error(e.message);
    }
}

export async function getProduits(){
    try{
        const response=await fetch("http://localhost:8080/produit");
        if(!response.ok){
            throw new Error("Request error");
        }
        const produits=await response.json();
        return produits;
    }catch(e){
        console.log(e);
    }
}

export async function getProduit(id_produit){
    try{
        const response=await fetch(`http://localhost:8080/produit/getProduitFilteredById?id=${id_produit}`);
        if(!response.ok){
            throw new Error("Request error");
        }
        const responseJson=await response.json();
        return responseJson;
    }catch(e){
        throw new Error(e.message);
    }
}