#!/bin/bash

nomeSchema=$1

for entidadeNomeErrado in *;
    do
        entidadeNomeCerto=`echo "$entidadeNomeErrado" | sed -e "s/$nomeSchema\.//"  | sed -e 's/^./\U&/'`;
        classeAntiga=$(basename "$entidadeNomeErrado" .php)
        classeNova=$(basename "$entidadeNomeCerto" .php)
        sed -i "s,$classeAntiga,$classeNova,g" *
        mv "$entidadeNomeErrado" "$entidadeNomeCerto";
done;
