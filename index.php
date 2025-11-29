<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    
</body>
</html>
<style>
    /* 1. Configuración base del cuerpo */
    body {
        min-height: 100vh; /* Asegura que ocupe toda la altura */
        position: relative; /* Necesario para que el fondo se ubique bien */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* 2. LA MAGIA: Creamos una capa "fantasma" detrás del contenido */
    body::before {
        content: "";
        position: fixed; /* Se queda quieto al hacer scroll */
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1; /* Se va al fondo, detrás de todo */

        /* A. LA IMAGEN DE FONDO */
        /* Cambia la URL por la foto de tu institución */
        background-image: url('https://images.unsplash.com/photo-1562774053-701939374585?q=80&w=1986&auto=format&fit=crop'); 
        background-size: cover;      /* Cubre toda la pantalla */
        background-position: center; /* Centra la foto */
        background-repeat: no-repeat;

        /* B. EL EFECTO DE "HUMEDAD" (Blur) */
        /* Esto desenfoca la foto levemente, como si hubiera vapor en un vidrio */
        filter: blur(4px); 
    }

    /* 3. EL DEGRADADO (El toque de color) */
    body::after {
        content: "";
        position: fixed;
        top: 0; 
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1; /* También detrás del texto, pero ENCIMA de la foto */
        
        /* C. DEGRADADO DE 2 PARTES */
        /* Arriba: Azul institucional (con transparencia 0.8) */
        /* Abajo: Negro/Gris oscuro (con transparencia 0.8) */
        background: linear-gradient(
            to bottom, 
            rgba(13, 110, 253, 0.65) 0%,   /* Color Arriba (Azul Bootstrap) */
            rgba(255, 255, 255, 0.1) 50%,  /* Centro (Casi transparente para ver foto) */
            rgba(33, 37, 41, 0.85) 100%    /* Color Abajo (Oscuro) */
        );
    }

    /* 4. Pequeño ajuste a tu tarjeta para que resalte sobre el fondo */
    .card {
        /* Hacemos la tarjeta un poquito transparente para que se integre */
        background-color: rgba(255, 255, 255, 0.92) !important; 
        backdrop-filter: blur(5px); /* Efecto vidrio en la propia tarjeta */
    }
</style>
