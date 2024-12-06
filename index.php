<?php include 'db.php'; ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kamus Bahasa Bangka</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif; 
        }
    </style>
</head>
<body class="bg-gray-100">
    <header class="bg-blue-500 text-white py-4 text-center">
        <h1 class="text-3xl font-bold">Kamus Bahasa Bangka</h1>
    </header>

    <main class="container mx-auto p-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <input 
                type="text" 
                id="wordInput" 
                placeholder="Masukkan kata dalam Bahasa Bangka"
                class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button 
                onclick="searchWord()"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                Cari
            </button>
        </div>

        <div id="result" class="mt-8">
            
        </div>
    </main>

    <script>
        async function searchWord() {
            const word = document.getElementById('wordInput').value;
            const resultDiv = document.getElementById('result');

            if (!word) {
                resultDiv.innerHTML = `
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">Please enter a word.</span>
                    </div>
                `;
                return;
            }

            try {
                const response = await fetch(`getTranslation.php?word=${word}`);
                const data = await response.json();

                if (data.error) {
                    resultDiv.innerHTML = `
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">${data.error}</span>
                        </div>
                    `;
                } else {
                    resultDiv.innerHTML = `
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <h2 class="text-xl font-bold">${data.word}</h2>
                            <p class="mt-2">
                                <strong>Arti:</strong> ${data.translation}<br>
                                ${data.example ? `<strong>Contoh:</strong> ${data.example}` : ''} 
                            </p> 
                        </div>
                    `;
                }
            } catch (error) {
                console.error("Error fetching data:", error);
                resultDiv.innerHTML = `
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">Failed to fetch data.</span>
                    </div>
                `;
            }
        }
    </script>
</body>
</html>