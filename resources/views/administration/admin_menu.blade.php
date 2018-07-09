<div class="admin-menu">
  <ul>
    <li class="menu-item {{ (Request::is('administratie') ? 'active' : '') }} {{ (Request::is('register') ? 'active' : '') }}">
        <a href="/administratie">

        </a>
    </li>
    <li class="menu-item {{ (Request::is('bus') ? 'active' : '') }} {{ (Request::is('bus/*') ? 'active' : '') }}">
      <a href="/bus">

      </a>
    </li>
    <li class="menu-item {{ (Request::is('bekende-adressen') ? 'active' : '') }} {{ (Request::is('bekende-adressen/*') ? 'active' : '') }}">
      <a href="/bekende-adressen">

      </a>
    </li>
    <li class="menu-item {{ (Request::is('exporteren') ? 'active' : '') }}">
      <a href="/exporteren">
      </a>
    </li>
  </ul>
</div>
