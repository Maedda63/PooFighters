<?php


namespace App\Repository;


interface IRepository
{
    function insert($request);

    function delete($request);

    function update($request);

    function getResults(string $request): array;

    function getResult(string $request);
}