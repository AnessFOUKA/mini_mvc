import Alpine from "alpinejs";
(async()=>{
    window.Alpine=Alpine;
    const page=(new URLSearchParams(window.location.search)).get("page");
    document.addEventListener("alpine:init",()=>{
        Alpine.store("data",{
            fields:{
                "Connexion":["mail","mot de passe"],
                "Inscription":["nom utilisateur","mail","mot de passe","adresse","ville","code postal"]
            },
            fieldsValues:{
                "nom utilisateur":"",
                "mail":"",
                "mot de passe":"",
                "adresse":"",
                "ville":"",
                "code postal":""
            },
            fieldIndex:"Connexion",
            loading:false,
            error:"",
            signIn:async function(){
                try{
                    const response=await fetch("http://localhost:8080/client");
                    if(!response.ok){
                        throw new Error("client to server request failure");
                    }
                    const jsonResponse=await response.json();
                    let error=true;
                    for(let i of jsonResponse){
                        if(this.fieldsValues["mail"].length===0 || this.fieldsValues["mot de passe"].length===0){
                            throw new Error("please fill all blanks");
                        }
                        if(i["email"]===this.fieldsValues["mail"]&&i.mot_de_passe===this.fieldsValues["mot de passe"]){
                            sessionStorage.setItem("accountData",JSON.stringify(i));
                            const aLink=document.createElement("a");
                            aLink.href=page!==null?page:"index.html";
                            aLink.click();
                            error=false;
                        }
                    }
                    if(error){
                        throw new Error("user or password is false");
                    }
                }catch(e){
                    this.error = e.message;
                }
            },
            signUp:async function(){
                const Username=this.fieldsValues["nom utilisateur"];
                const Adresse=this.fieldsValues["adresse"];
                const Mail=this.fieldsValues["mail"];
                const MotDePasse=this.fieldsValues["mot de passe"];
                const Ville=this.fieldsValues["ville"];
                const CodePostal=this.fieldsValues["code postal"];
                let stop=false;
                Object.values(this.fieldsValues).forEach(element => {
                    if(element.length===0){
                        this.error="please fill all fields";
                        stop=true;
                    }
                });
                if(!stop){
                    this.loading=true;
                    try{
                        const response=await fetch("http://localhost:8080/client/createClient",{
                            method:"POST",
                            headers:{
                                "Content-Type":"application/x-www-form-urlencoded"
                            },
                            body:new URLSearchParams({
                                username:Username,
                                adresse:Adresse,
                                email:Mail,
                                motDePasse:MotDePasse,
                                ville:Ville,
                                codePostal:CodePostal
                            })
                        });
                        if(!response.ok){
                            throw new Error("client to server request failure");
                        }
                        this.loading=false;
                        this.fieldIndex="Connexion";
                        this.fieldsValues={
                            "nom utilisateur":"",
                            "mail":"",
                            "mot de passe":"",
                            "adresse":"",
                            "ville":"",
                            "code postal":""
                        }
                    }catch(e){
                        throw new Error(e);
                    }
                }
            }
        });
    });
    Alpine.start();
})();