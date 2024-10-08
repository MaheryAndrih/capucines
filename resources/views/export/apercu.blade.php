<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
        }

        .portrait-container {
            width: 21cm; /* Largeur d'une page A4 en mode portrait */
            height: 29.7cm; /* Hauteur d'une page A4 en mode portrait */
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            box-sizing: border-box;
            transform-origin: top left;
        }

        /* Ajustement de l'échelle pour que le contenu s'adapte à la fenêtre */
        @media screen {
            .portrait-container {
                transform: scale(calc(100vh / 29.7cm));
                transform-origin: top left;
            }
        }

        /* Ajustement pour les petites fenêtres */
        @media screen and (max-width: 21cm) {
            .portrait-container {
                transform: scale(calc(100vw / 21cm));
                transform-origin: top left;
            }
        }
    </style>
</head>
<body>
    <div class="portrait-container">
        <!-- Contenu de la page ici -->
        <h1>Page en mode portrait</h1>
        <p>Ceci est un exemple de mise en page en mode portrait.</p>
    </div>
</body>
</html>
