# TAREA UD7 DWCS

**Andrés Reino Guerra**

## 1. Requisitos de la tarea

Se han completado todos los puntos especificados en la tarea, salvo el punto 10: *Personaliza el tema asignando algunos colores distintos a botones u otros elementos con SCSS.*

Este apartado fallaba al ejecutar el comando **npm run build**

Se ha trabajado en varias ramas, desarrollando la mayor parte del trabajo en la rama denominada **pruebas3**. Se fusionará la rama **pruebas5** para la entrega de la tarea debido a una implementación de última hora no solicitada en la misma.

## 2. Implementación a mayores de lo solicitado en la tarea

- **MIDDLEWARE**

Además de **TallerMiddleware**, encargado de verificar que sólo usuario con rol *taller* accede a ciertas rutas, se añade un middleware denominado **ClienteMiddleware** que verifica si el id del usuario autenticado coincide con el id del cliente dueño de la Cita. El fin es impedir el acceso manual incluyendo el id de un Cita directamente en la URL (ej: */citas/clientes/8*). Se implementa en la ruta:

```bash
Route::get('/citas/clientes/{cita}', [CitasClienteController::class, 'show'])->middleware(ClienteMiddleware::class)->name('citas.clientes.show');
```

- **SEEDERS**

Se crean los seeder **CitaSeeder** y **UserSeeder** para poder incorporar datos de prueba a la base de datos después de realizar las migraciones.

- **IDIOMA**

Se agrega carpeta **lang** dentro de resources para añadir el archivo *es.json* y permitir que el contenido dentro de la función global de ayuda __() se traduzca al español.

- **FONDO CORPORATIVO**

En la carpeta *public* se crea el directorio **images**, el cual contendrá la imagen corporativa del taller para utilizar en las vistas. 

Se implementa como imagen en el nav (*navigation.blade.php*) utilizando un componente que brinda Laravel al efecto: *x-application-logo*.

También al hacer el login o register.

Del mismo modo, se ha empleado como imagen de fondo en el layout *app.blade.php* para toda la aplicación, dándole un carácter tenue evitando que interfiera o desvirtúe el contenido principal.
