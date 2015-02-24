<div id="header">
	<div class="widthConstrained">
		<div id="hamMenu">
			<div></div><div></div>
			<div id="dropDownMainMenu">
				<ul>
					<li>Barnehage<img src="/public/img/lock.png"></li>
					<li>Skolestart</li>
					<li>1-2. Klasse<img src="/public/img/lock.png"></li>
					<li>3-4. Klasse<img src="/public/img/lock.png"></li>
					<li>5-7. Klasse<img src="/public/img/lock.png"></li>
				</ul>
			</div>
		</div>

		<div class="center"> <a id="logoLink" href="/"><img id="headerLogo" src="/public/img/logo_orange.png" alt="logo"/></a></div>

		<div id="user">
			<a href="#"><img src="/public/img/profile.png"/>  <?php echo $_SESSION['user']->getUsername();?></a>
            <a href="/logout"><img src="/public/img/logout.png">   Logg ut</a>
        </div>
    </div>
</div>