## Web Project : Carpool

Projet Web pour les unités d'enseignement HLIN510 et HLIN511.

### Spécifications du projet

#### Spécifications fonctionnelles :
En italique, sont indiquées les fonctionnalités facultatives (vous pouvez bien sûr en ajouter d’autres).

Un utilisateur pourra avoir trois profils (rôles) :
* Un profil d’administrateur ;
* Un profil de membre obtenu après création d’un compte ;
* Un profil d’invité avec lequel il ne pourra que consulter les trajets disponibles.

La création d’un compte implique que l’identifiant de l’utilisateur membre soit son adresse email
Outre les informations habituelles (nom, prénom, âge, adresse...), le membre doit obligatoirement
indiquer un numéro de téléphone. Si l’utilisateur membre veut proposer des covoiturages en tant que
conducteur, il doit aussi renseigner les caractéristiques d’au moins un véhicule.

Le profil d’administrateur permet :
* De créer des trajets types : ville de départ, ville d’arrivée, distance, temps moyen ;
* De fermer temporairement ou définitivement un compte membre (en étant averti
automatiquement des membres stigmatisés par des avis trop faibles) ;
* _D’accéder à des statistiques (trajets classés par ordre de fréquentation, prix moyen pour un
trajet...)._

Le profil de membre permet :
* De proposer en tant que conducteur un trajet en précisant au minimum les renseignements
suivants : ville de départ, date, adresse de rendez-vous, ville d’arrivée, adresse de dépose,
type de voiture, nombre de places, prix du trajet (\*) ;
(\*) si le trajet est déjà référencé par l’application, le prix du trajet ne doit pas dépasser un
plafond préfixé (par exemple 10 centimes par kilomètre) ;

    Le trajet doit disparaître de l’affichage des trajets disponibles une fois la date dépassée.
A l’issue du trajet, le conducteur doit pouvoir donner un avis (au minimum un nombre
d’ « étoiles ») sur ses covoitureurs.

    _Le conducteur pourrait alerter ses passagers de l’annulation du trajet.
Des villes étapes (avec prise de passagers / dépose) pourraient être signalées._
* De lister les trajets proposés entre deux villes à une date (=jour) donnée et en accédant aux
informations concernant les conducteurs.
_Les trajets pourraient être triés chronologiquement ou par prix ascendant._
* De s’inscrire à (et de se désinscrire d’) un trajet.
A l’issue de celui-ci, le membre passager doit pouvoir donner un avis (au minimum un
nombre d’« étoiles ») sur le conducteur.

Le profil d’invité permet :
* De lister les trajets proposés entre deux villes à une date donnée sans pouvoir accéder aux
informations concernant les conducteurs (hormis leurs prénoms).
_Les trajets pourraient être triés chronologiquement ou par prix ascendant._
L’évaluation de ce projet pour l’UE HLIN511 se focalisera sur les points suivants (il est donc possible de
ne rendre un projet allégé au niveau fonctionnel et des interfaces que pour cette UE) :
* Tout ou une partie des traitements métiers devra être implémenté au travers de la surcouche
procédurale de MySQL et donc en interne au système de gestion de bases de données. Il est
attendu de définir au moins trois procédures et deux déclencheurs (triggers) à l'aide de cette
surcouche. Pour exemple, un déclencheur pourrait être défini sur la fermeture temporaire ou
définitive d'un compte membre. De même les procédures pourraient porter sur des
traitements associés aux trajets : distance kilométrique, choix de l'itinéraire, etc.
Les développements réalisés à l'aide de la surcouche procédurale seront évalués pour le
compte du module HLIN511 et en particulier pour la note de TP.

#### Spécifications organisationnelles et techniques :
Le projet doit être réalisé :
* En monôme (déconseillé) ou en binôme ;
* avec PHP/MySQL _et optionnellement JavaScript (par exemple pour afficher sur une Google
Map le trajet, pour améliorer les interfaces, pour faire du web responsive...) ;_
* Des frameworks PHP ou JavaScript peuvent être utilisés ;
* Le projet doit être hébergé sur un serveur GIT (de la FDS ou externe).
Le rendu de projet consistera :
* A l’envoi par courriel aux enseignants responsables des UE concernées, une semaine avant la
date de rendu (qui sera fixée ultérieurement mais sans doute planifiée en toute fin de
semestre) :
    * La liste des fonctionnalités implémentées ;
    * Le schéma de la base de données ;
    * Le lien sur le serveur GIT.
* En une démonstration sur machine (poste de travail d’une salle de TP ou portable personnel)
de l’application. Lors de cette démonstration, tous les membres du groupe devront être
présents et pouvoir répondre à un maximum de questions sur le projet (et ne pas dire « Ah ça
je ne sais pas, ce n’est pas moi qui l’ai fait » ;) ).
