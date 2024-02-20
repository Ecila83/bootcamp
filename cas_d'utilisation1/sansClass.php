<?php

const banane =1;
const pomme = 1.50;
const vin = 10;

$totalPrix = (banane * 6)+(pomme * 3) + (vin * 2);

echo $totalPrix;

$taxe = (((pomme *3)+ (banane*6))/100*6)+ ((vin *2)/100*21);

echo $taxe;

$prixHtva = $totalPrix - $taxe;
echo $prixHtva;