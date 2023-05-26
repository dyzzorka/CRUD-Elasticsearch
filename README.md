# Installation et mise en place d'une base Elasticsearch

En quelques mots, Elasticsearch aide les utilisateurs à trouver plus rapidement ce qu'ils recherchent, qu'il s'agisse de collaborateurs ayant besoin de documents sur votre intranet ou de clients sur internet en quête de la paire de chaussures idéale. Pour aller un peu plus loin sur le plan technique, voici ce qu'on pourrait dire :

Elasticsearch est un moteur de recherche et d'analyse distribué gratuit et ouvert pour toutes les données (textuelles, numériques, géospatiales, structurées et non structurées). Elasticsearch a été conçu à partir d'Apache Lucene et a été lancé en 2010 par Elasticsearch N. V. (maintenant appelé Elastic).
#
## Pour commencer

Nous aurons besoin de cloner ce référentiel, donc rendez-vous sur le site de [Git](https://git-scm.com/downloads), téléchargez la version Windows de Git, puis procédez à son installation.

Une fois l'installation de Git effectuée, nous devrons cloner le projet. Pour ce faire, ouvrez un terminal à l'emplacement où vous souhaitez cloner le référentiel, puis exécutez la commande suivante :
```bash
git clone https://github.com/dyzzorka/CRUD-Elasticsearch.git
```

Passons à l'étape suivante pour pouvoir utiliser le projet correctement. Vous aurez besoin de PHP 8.1.* et de Composer. PHP est un langage informatique et Composer est un gestionnaire de paquets.

Commençons par PHP. Pour cela, nous allons installer XAMPP, qui inclut PHP. Pour ce faire, rendez-vous sur [le site de XAMPP](https://www.apachefriends.org/fr/download.html), téléchargez la version 8.1.* de XAMPP correspondant à votre système d'exploitation, puis installez-le sur votre machine.

Une fois cela fait, nous devons installer Composer. Vous pouvez le télécharger en suivant [ce lien](https://getcomposer.org/Composer-Setup.exe).

Pour finir, nous devons télécharger l'outil principal de documentation d'Elasticsearch. Pour ce faire, cliquez [ici](https://artifacts.elastic.co/downloads/elasticsearch/elasticsearch-7.17.10-windows-x86_64.zip)
#
## Mise en marche

Une fois que vous avez téléchargé et installé tous les outils nécessaires, vous devrez copier la ligne suivante à la toute fin du fichier config/elasticsearch.yml se trouvant dans votre dossier Elasticsearch précédemment téléchargé.
```yaml
xpack.security.enabled: false
```
Pour démarrer votre base de données, ouvrez un terminal, déplacez-vous à l'aide de la commande cd dans le répertoire bin situé dans le dossier Elasticsearch précédemment téléchargé, puis lancez la commande suivante : 
```bash
elasticsearch
```
ou 
```bash
./elasticsearch
```

#
## Démarrage

Pour remplir la base de données avec les données présentes dans le fichier .csv, vous devez vous rendre dans le répertoire du projet, puis exécuter la commande suivante :
```bash
php generateIndex.php
```
Pour tester que tout fonctionne correctement, vous pouvez exécuter la commande suivante pour vérifier le bon fonctionnement du CRUD lié à la base de données :
```bash
php crud.php
```
Si tout fonctionne correctement, vous devriez obtenir l'affichage suivant :

Si vous souhaitez aller plus loin, vous pouvez utiliser cette [URL](http://localhost:9200/) pour tester votre base de données Elasticsearch. Vous pouvez vous aider de la documentation officielle pour mieux comprendre son fonctionnement([documentation officiel](http://localhost:9200/)).

Si vous voulez allez plus loin vous pouvez utiliser cette [url](http://localhost:9200/) pour tester votre base de donnée elasticsearch, aidez vous de la documentation officiel pour mieux comprendre le fonctionement ([documentation officiel](http://localhost:9200/))

#
## Versions

Ce projet est la version 1.0.0.
#
## Auteurs

* **VOLLAIRE Yohan** _alias_ [@dyzzorka](https://github.com/dyzzorka)