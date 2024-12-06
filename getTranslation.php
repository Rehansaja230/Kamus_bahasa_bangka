<?php
include 'db.php'; 

if (isset($_GET['word'])) {
    $word = $_GET['word'];

    $stmt = $conn->prepare("SELECT arti_indonesia, contoh_kalimat FROM kosakata WHERE kata_bangka = ?");
    $stmt->bind_param("s", $word);
    $stmt->execute();
    $stmt->bind_result($translation, $example);
    $stmt->fetch();

    if ($translation) {
        $response = [
            'word' => $word,
            'translation' => $translation,
            'example' => $example 
        ];

        echo json_encode($response);
    } else {
        echo json_encode(['error' => 'Kata tidak ditemukan']);
    }
    $stmt->close();
} else {
    echo json_encode(['error' => 'Parameter kata tidak diberikan']);
}

$conn->close();
?>