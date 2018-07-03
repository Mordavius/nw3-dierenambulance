<div class="admin-menu">
  <ul>
    <li class="menu-item {{ (Request::is('administratie') ? 'active' : '') }}">
        <a href="/administratie">
            <?php echo file_get_contents("images/Users.svg"); ?> <span class="icon"> Gebruikers </span>
        </a>
    </li>
    <li class="menu-item {{ (Request::is('bus') ? 'active' : '') }}">
      <a href="/bus">
          <?php echo file_get_contents("images/Car.svg"); ?> <span class="icon"> Voertuigen </span>
      </a>
    </li>
    <li class="menu-item {{ (Request::is('bekende-adressen') ? 'active' : '') }}">
      <a href="/bekende-adressen">
          <?php echo file_get_contents("images/Location.svg"); ?> <span class="icon"> Bekende adressen </span>
      </a>
    </li>
    <li class="menu-item {{ (Request::is('exporteren') ? 'active' : '') }}">
      <a href="/exporteren">
          <?php echo file_get_contents("images/Export.svg"); ?> <span class="icon"> Exporteren </span>
      </a>
    </li>
  </ul>
</div>
