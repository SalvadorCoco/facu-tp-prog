# Sistema de Fuentes Centralizado

## ¿Qué cambió?

Ahora todas las fuentes del proyecto están centralizadas en un solo archivo: **`fonts.css`**

## Ventajas

✅ **No más repetición**: Define las fuentes una sola vez
✅ **Fácil mantenimiento**: Si necesitas cambiar una fuente, solo editas un archivo
✅ **Más limpio**: Tus archivos CSS individuales ya no tienen código repetido
✅ **Consistencia**: Todas las páginas usan las mismas definiciones de fuentes

## Cómo usar

### Para páginas existentes
Todas las páginas ya están actualizadas. Solo asegúrate de incluir esta línea en el `<head>` de cualquier HTML nuevo:

```html
<link rel="stylesheet" href="../fonts.css">
```

**Nota:** Ajusta la ruta (`../`) según la ubicación de tu archivo HTML respecto a `fonts.css`

### Ejemplo para nueva página

```html
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mi Página</title>
    <!-- Primero las fuentes -->
    <link rel="stylesheet" href="../fonts.css">
    <!-- Después tu CSS -->
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <!-- Tu contenido -->
</body>
</html>
```

### En tu CSS
Simplemente usa las fuentes como siempre:

```css
.mi-titulo {
    font-family: 'mettars';
}

.mi-texto {
    font-family: 'Gotham-Medium';
}
```

## Agregar nuevas fuentes

Si necesitas agregar una nueva fuente al proyecto:

1. Coloca el archivo de fuente en `paginaprincipal/fonts/`
2. Abre `fonts.css`
3. Agrega la definición:

```css
@font-face {
    font-family: 'NombreDeTuFuente';
    src: url(/paginaprincipal/fonts/archivo-fuente.otf);
}
```

4. ¡Listo! Ahora puedes usarla en cualquier página del proyecto

## Fuentes disponibles

- **mettars**: Fuente decorativa usada en títulos superpuestos
- **Gotham-Medium**: Fuente principal del proyecto

