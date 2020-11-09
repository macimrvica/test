<?php


namespace App\Films\Domain;

final class NoResultsFound
{
    public static function asString(string $searchTerm)
    {
        return sprintf('No people found for search term "%s"', $searchTerm);
    }
}
