<?php

// Convertir une date au format MM/AAAA en nombre total de mois
function convertTotalMonths(string $monthString): ?int {
    $parts = explode('/', $monthString);
    if (count($parts) !== 2) {
        return null; // Format invalide
    }

    [$month, $year] = $parts;

    $monthInt = (int)$month;
    $yearInt = (int)$year;

    if ($monthInt < 1 || $monthInt > 12 || $yearInt < 0) {
        return null; // Valeurs invalides
    }

    return $yearInt * 12 + $monthInt;
}


// Calcule le nombre de mois entre deux dates au format MM/AAAA
function calculerNombreMois(string $start, string $end, bool $inclusive = true): ?int {
    $startTotal = convertTotalMonths($start);
    $endTotal = convertTotalMonths($end);

    if ($startTotal === null || $endTotal === null) {
        return null; // Format de date invalide
    }

    $diff = $endTotal - $startTotal;

    if ($diff < 0) {
        return null; // La date de fin est antérieure à la date de début
    }

    return $inclusive ? $diff + 1 : $diff;
}
?>