<script>
    function expandMenu(obj){
        if ( $(obj).height() != 38)
            $(obj).animate({ height: 38 }, 250 );
        else
            $(obj).animate({ height: 308 }, 250 );
    }
</script>
<div id="header">
	<div class="widthConstrained">
		<div id="hamMenu" onclick="return true">
			<div></div><div></div>
            <h4 id="classRangeLabel"><?php echo $this->classLevel;?>. Klasse</h4>
			<div id="dropDownMainMenu">
				<ul>
					<li><a href="/">Forsiden</a></li>
                    <li><a href="/forside/fag/2-klasse/">Barnehage</a></li>
                    <li><a href="/forside/fag/0-klasse/">Skolestart</a></li>
                    <li onclick="expandMenu(this)">
                        <span>Klassetrinn</span>
                        <ul>
                            <li><a href="/forside/fag/1-klasse/">1. Klasse</a></li>
                            <li> <a href="/forside/fag/2-klasse/">2. Klasse</a></li>
                            <li> <a href="/forside/fag/3-klasse/">3. Klasse</a></li>
                            <li> <a href="/forside/fag/4-klasse/">4. Klasse</a></li>
                            <li> <a href="/forside/fag/5-klasse/">5. Klasse</a></li>
                            <li><a href="/forside/fag/6-klasse/">6. Klasse</a></li>
                            <li><a href="/forside/fag/7-klasse/">7. Klasse</a></li>
                        </ul>
                    </li>
				</ul>
			</div>
		</div>

		<div class="center"> <a id="logoLink" href="/"><img id="headerLogo" src="/public/img/SALABY_Logo_Blue.png" alt="logo"/></a></div>

		<div id="user">
			<a href="/mypage"><img id="profilePic" src="/public/img/profile.png"/> <span class="topMenuUser"><?php echo $_SESSION['user']->getFullName();?></span></a>
            <a href="/logout"><img src="/public/img/logout.png"> <span class="topMenuUser"> Logg ut</span></a>
        </div>
    </div>
</div>