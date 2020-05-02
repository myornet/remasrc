<div class="navbar-item">
    <div class="columns">
        <div class="column"><?php echo strtoupper($user['Usuario']['usuario'])?></div>
        <div class="column"> | </div>
        <div class="column">IPN: <strong><?php echo $_SERVER['REMOTE_ADDR']?></strong></div>
    </div>
</div>
<hr class="navbar-divider">
<div class="navbar-item">
    <span class="icon is-small">
        <i class="fas fa-sitemap" aria-hidden="true"></i>
    </span>
    <span> <?php echo $user['Centro']['descripcion']?></span>
</div>
<hr class="navbar-divider">
<div class="navbar-item">
    <div class="buttons">
        <a class="button is-small" href="/usuarios/password">
            <span class="icon is-small">
                <i class="fas fa-key"></i>
            </span>
            <span>Cambiar</span>
        </a>
        <a class="button is-small" href="/usuarios/logout">
            <span class="icon is-small">
                <i class="fas fa-power-off"></i>
            </span>
            <span>Salir</span>
        </a>
    </div>
</div>