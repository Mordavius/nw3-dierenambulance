<div class="admin-menu">
  <ul>
    <li class="menu-item {{ (Request::is('administratie') ? 'active' : '') }}">
      <a href="../administratie">
        <svg width="23px" height="21px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
            <path id="{{asset('images/users.svg')}}" .../><span>Gebruikers</span>
        </svg>
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
