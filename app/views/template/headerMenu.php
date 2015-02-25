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
			<a href="#"><img src="/public/img/profile.png"/> <span class="topMenuUser"><?php echo $_SESSION['user']->getUsername();?></span></a>
            <a href="/logout"><img src="/public/img/logout.png"> <span class="topMenuUser"> Logg ut</span></a>
        </div>
    </div>
</div>