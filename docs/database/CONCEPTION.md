# Questions de conception de la base de données

1) Pourquoi stocker le prix unitaire dans la table des lignes de commande plutôt que d'utiliser directement le prix du produit ? :

    Il est nécessaire de stocker le prix unitaire dans la table des lignes de commande et très dangereux d'utiliser directement le prix du produit car ce dernier est ammené à évoluer, et alors si l'utilisateur achète le produit il le paiera à un prix auquel il n'était pas prêt. 

2) j'ai préféré choisir les suppressions en cascade(ON DELETE CASCADE), en effet, elles sont, à mon avis plus simples à implémenter au sein de la base de données que les autres solutions.

3) le stock sera vérifié au niveau du php, si le client souhaite acheter un produit en rupture de stocks, le backend empêchera l'achat et renverra un message d'erreur au frontend. Le stock sera décrémenté lors du paiement, pour garantir le fait que le produit soit acheté lorsque le stock est décrémenté. 

4) Je n'ai, pour l'instant, pas mis en place d'indexs au sein de la base de données.

5) j'ai garanti l'unicité du numéro de commande par l'usage de la contrainte UNIQUE pour ce dernier(qui est la clé primaire de la table Commande)

6) Je pourrais, pour mon modèle, mettre en place , une gestion des avis client pour permettre aux clients de donner leur avis pour un produit et de se donner une idée de la qualité de ce dernier grace aux avis. Enfin, je pourrais également, mettre en place, des images multiples par produit, pour permettre aux clients de se donner une idée plus précise sur leur apparence et leurs caractéristiques.