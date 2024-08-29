<?php
include "connection.php";
include "headers.php";

// Get the JSON data from POST request
$json = isset($_POST["json"]) ? $_POST["json"] : "0";
$data = json_decode($json, true);

if (!$data) {
    echo json_encode(['error' => 'Invalid JSON data']);
    exit;
}

// Prepare the SQL statement
$sql = "INSERT INTO Pets (Name, SpeciesID, BreedID, DateOfBirth, OwnerID) 
        VALUES (:name, :species_id, :breed_id, :dob, :owner_id)";

try {
    // Prepare and execute the statement
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":name", $data["name"]);
    $stmt->bindParam(":species_id", $data["species_id"]);
    $stmt->bindParam(":breed_id", $data["breed_id"]);
    $stmt->bindParam(":dob", $data["dob"]);
    $stmt->bindParam(":owner_id", $data["owner_id"]);

    $stmt->execute();

    // Return success or failure
    echo $stmt->rowCount() > 0 ? json_encode(['success' => true]) : json_encode(['error' => 'Failed to insert record']);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
