#!/bin/bash

{
    read utilisateur 
    read serveur 
    read motdepasse 
    read basededonnees 
} < ids.txt

utilisateur=${utilisateur##* }
serveur=${serveur##* }
motdepasse=${motdepasse##* }
basededonnees=${basededonnees##* }

#echo $utilisateur
#echo $serveur
#echo $motdepasse
#echo $basededonnees

for i in *.php; do
	grep '\$utilisateur = ' $i > /dev/null
	if [ $? == 0 ] ; then
		#echo "1ère phase"
		vi $i << ! 2> /dev/null
:1,$ s/\(\$utilisateur = "\).*\(".*\)/\1$utilisateur\2/
:1,$ s/\(\$serveur = "\).*\(".*\)/\1$serveur\2/
:1,$ s/\(\$motdepasse = "\).*\(".*\)/\1$motdepasse\2/
:1,$ s/\(\$basededonnees = "\).*\(".*\)/\1$basededonnees\2/
:x
!
		echo "$i (modifié)"
	fi
	grep '\$user = ' $i > /dev/null
	if [ $? == 0 ] ; then
		#echo "2ème phase"
		vi $i << ! 2> /dev/null
:1,$ s/\(\$user = '\).*\('.*\)/\1$utilisateur\2/
:1,$ s/\(\$host = '\).*\('.*\)/\1$serveur\2/
:1,$ s/\(\$password = '\).*\('.*\)/\1$motdepasse\2/
:1,$ s/\(\$dbname = '\).*\('.*\)/\1$basededonnees\2/
:x
!
		echo "$i (modifié)"
	fi
done

