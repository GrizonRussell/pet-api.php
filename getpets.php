<?php
include "connection.php";
include "headers.php";

// Prepare the SQL statement to get pet records
$sql = "SELECT 
            Pets.PetID, 
            Pets.Name AS PetName, 
            Species.SpeciesName, 
            Breeds.BreedName, 
            Pets.DateOfBirth, 
            Owners.Name AS OwnerName 
        FROM Pets 
        JOIN Species ON Pets.SpeciesID = Species.SpeciesID 
        JOIN Breeds ON Pets.BreedID = Breeds.BreedID 
        JOIN Owners ON Pets.OwnerID = Owners.OwnerID";

$stmt = $conn->prepare($sql);
$stmt->execute();

// Fetch and return results
echo $stmt->rowCount() > 0 ? json_encode($stmt->fetchAll(PDO::FETCH_ASSOC)) : 0;
?>
