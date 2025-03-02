#!/bin/bash

# Création des dossiers
mkdir -p public/uploads/worlds/cards
mkdir -p public/uploads/worlds/details

# Définition des permissions
chmod -R 775 public/uploads

echo "Dossiers d'images créés avec succès !" 