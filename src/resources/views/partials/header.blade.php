<ul class="nav justify-content-center bg-dark border-bottom border-body" data-bs-theme="dark">
  <!-- Menú para usuarios no autenticados -->
  <!-- guest: directiva de Blade para usuario no autenticado -->
  @guest
    <li class="nav-item">
      <a class="nav-link active text-white" aria-current="page" href="{{ route('login') }}">Iniciar sesión</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="{{ route('register') }}">Registrarse</a>
    </li>
  @endguest
  
  <!-- Menú para usuarios autenticados -->
  <!-- auth: directiva de Blade que comprueba si hay usuario autenticado -->
  @auth
    <!-- Si el usuario tiene el rol 'cliente' -->
    @if(auth()->user()->role === 'cliente')
      <li class="nav-item">
        <a class="nav-link active text-white" aria-current="page" href="{{ route('cliente_create') }}">Crear cita</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('cliente_show') }}">Consultar citas</a>
      </li>
      <!-- Si el usuario tiene el rol 'taller' -->
      @elseif(auth()->user()->role === 'taller')
      <li class="nav-item">
        <a class="nav-link active text-white" aria-current="page" href="{{ route('taller_show') }}">Consultar citas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('taller_show') }}">Citas pendientes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('taller_edit') }}">Modificar citas</a>
      </li>
      @endif
      <!-- Añadimos opción cerrar sesión para usuario autenticado. Breeze ya tiene todo configurado. -->
      <!-- Solo añadir botón o enlace que apunte a ruta de logout y envíe formulario POST (Laravel requiere que logout sea por POST por seguridad). -->
      <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
      <!-- Directiva @csrf es obligatoria para proteger contra ataques CSRF-->
          @csrf
          <button type="submit" class="nav-link btn btn-link text-white" style="text-decoration: none;">
            Cerrar sesión
          </button>
        </form>
      </li>
  @endauth

</ul>