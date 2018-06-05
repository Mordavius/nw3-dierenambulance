<div class="admin-menu">
  <ul>
    <li class="menu-item {{ (Request::is('administratie') ? 'active' : '') }}">
      <a href="../administratie">
        <img class="icon" src="{{asset('images/users.svg')}}" alt="Gebruikers"> <span>Gebruikers</span>
      </a>
    </li>
    <li class="menu-item {{ (Request::is('bus') ? 'active' : '') }}">
      <a href="/bus">
        <img class="icon" src="{{asset('images/car.svg')}}" alt="Voertuigen"> <span>Voertuigen</span>
      </a>
    </li>
    <li class="menu-item {{ (Request::is('bekende-adressen') ? 'active' : '') }}">
      <a href="/bekende-adressen">
        <img class="icon" src="{{asset('images/location.svg')}}" alt="Bekende adressen"> <span>Bekende adressen</span>
      </a>
    </li>
    <li class="menu-item {{ (Request::is('exporteren') ? 'active' : '') }}">
      <a href="/exporteren">
        <img class="icon" src="{{asset('images/export.svg')}}" alt="Export"> <span>Export</span>
      </a>
    </li>
  </ul>
</div>