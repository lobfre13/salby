<div id="header">
	<div class="widthConstrained">
		<div id="hamMenu">
			<div></div><div></div>
			<div id="dropDownMainMenu">
				<ul>
					<li>Barnehage<img src="/public/img/lock.png"></li></a>
                    <a href="/main/"><li>Skolestart</li></a>
                    <li>1-2. Klasse<img src="/public/img/lock.png"></li></a>
                    <li>3-4. Klasse<img src="/public/img/lock.png"></li></a>
                    <li>5-7. Klasse<img src="/public/img/lock.png"></li></a>
				</ul>
			</div>
            <h4 id="classRangeLabel">1-2. Klasse</h4>
		</div>

		<div class="center"> <a id="logoLink" href="/"><img id="headerLogo" src="/public/img/SALABY_Logo_Blue.png" alt="logo"/></a></div>

		<div id="user">
			<a href="/mypage"><img id="profilePic" src="/public/img/profile.png"/> <span class="topMenuUser"><?php echo $_SESSION['user']->getFullName();?></span></a>
            <a href="/logout"><img src="/public/img/logout.png"> <span class="topMenuUser"> Logg ut</span></a>
        </div>
    </div>
</div>