<div class="admin-menu">
  <ul>
    <li class="menu-item {{ (Request::is('administratie') ? 'active' : '') }} {{ (Request::is('register') ? 'active' : '') }}">
        <a href="/administratie">
          <span class="icon"> Gebruikers </span>
        </a>
    </li>
    <li class="menu-item {{ (Request::is('bus') ? 'active' : '') }} {{ (Request::is('bus/*') ? 'active' : '') }}">
      <a href="/bus">
          <span class="icon"> Voertuigen </span>
      </a>
    </li>
    <li class="menu-item {{ (Request::is('bekende-adressen') ? 'active' : '') }} {{ (Request::is('bekende-adressen/*') ? 'active' : '') }}">
      <a href="/bekende-adressen">
          <span class="icon"> Bekende adressen </span>
      </a>
    </li>
    <li class="menu-item {{ (Request::is('exporteren') ? 'active' : '') }}">
      <a href="/exporteren">
          <span class="icon"> Exporteren </span>
      </a>
    </li>
  </ul>
</div>
