<div class="admin-menu">
  <ul>
    <li class="menu-item {{ (Request::is('administratie') ? 'active' : '') }}">
        <a href="/administratie">
            <div class="svgwrapper icon">
            <?php echo file_get_contents("images/Users.svg"); ?> <span class="icon"> Gebruikers </span>
            </div>
        </a>
    </li>
    <li class="menu-item {{ (Request::is('bus') ? 'active' : '') }}">
      <a href="/bus">
          <div class="svgwrapper icon">
          <?php echo file_get_contents("images/Car.svg"); ?> <span class="icon"> Voertuigen </span>
          </div>      </a>
    </li>
    <li class="menu-item {{ (Request::is('bekende-adressen') ? 'active' : '') }}">
      <a href="/bekende-adressen">
          <div class="svgwrapper icon">
          <?php echo file_get_contents("images/Location.svg"); ?> <span class="icon"> Bekende adressen </span>
          </div>      </a>
    </li>
    <li class="menu-item {{ (Request::is('exporteren') ? 'active' : '') }}">
      <a href="/exporteren">
          <div class="svgwrapper icon">
          <?php echo file_get_contents("images/Export.svg"); ?> <span class="icon"> Exporteren </span>
          </div>      </a>
    </li>
  </ul>
</div>
