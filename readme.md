# Application de consultation et de modification de séries TV
#### par Robin Simonneau *(simo0156)* et Gaspard Lalouette *(lalo0014)* 

### Sommaire :
1. [Description](#description-)
2. [Structure du projet ](#structure-du-projet-)
3. [Mis en route](#mise-en-route-)
4. [Style de codage](#style-de-codage-)
5. [Configuration de la base de donnée](#configuration-de-la-base-de-donne-)

### Description :

---
Le but du projet est de créer une application web permettant de consulter et de modifier des séries TV présentes dans une base de donnée.

### Structure du projet :

---
📂public :   
┃ ┣ 📂admin  
┃ ┃ ┗ 📜index.php  
┃ ┗ 📜index.php  
📂src  
┃ ┣ 📂Entity  
┃ ┣ 📂Database  
┃ ┃ ┗ 📜MyPdo.php  
┃ ┗ 📂HTML  
┃   ┣ 📜AppWebPage.php 
┃   ┗ 📜webpage.php    
📂vendor  
┣ 📜README.md  
┣ 📜composer.json  
┗ 📜composer.lock  

- public : Contient les fichiers accesible depuis le navigateur
- src : Contients les class qui s'occupe de récupèrer et traiter les donnée
- vendor : fichiers de composer qui gère les dépendances
- Entity : Contient toutes les classes qui représente les entitées de la base de donnée

### Mise en route :

---
L'instalation des dépendances de composer est nécessaire pour lancer le serveur local installer les dépendance avec : ```composer install``` ou ```php composer.phar install ```

Pour lancer le serveur local : 	```composer run-server```  
Accéder au serveur local : http://localhost:8000/

### Style de codage :

---
Ce projet utilise le style de codage *PSR-12*.

### Configuration de la base de donnée :

---
Les informations de connexion à la base de données doivent être renseigné dans le fichier : *.mypdo.ini*
