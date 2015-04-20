<script>
    function expandMenu(obj){
        if ( $(obj).height() != 20)
            $(obj).animate({ height: 20 }, 250 );
        else
            $(obj).animate({ height: 300 }, 250 );
    }
</script>
<div id="header">
	<div class="widthConstrained">
		<div id="hamMenu">
			<div></div><div></div>
			<div id="dropDownMainMenu">
				<ul>
					<a href="/"><li>Forsiden</li></a>
                    <a href="/forside/fag/2-klasse/"><li>Barnehage</li></a>
                    <a href="/forside/fag/0-klasse/"><li>Skolestart</li></a>
                    <li onclick="expandMenu(this)">
                        <span>Klassetrinn</span>
                        <ul>
                            <a href="/forside/fag/1-klasse/"><li>1. Klasse</li></a>
                            <a href="/forside/fag/2-klasse/"><li>2. Klasse</li></a>
                            <a href="/forside/fag/3-klasse/"><li>3. Klasse</li></a>
                            <a href="/forside/fag/4-klasse/"><li>4. Klasse</li></a>
                            <a href="/forside/fag/5-klasse/"><li>5. Klasse</li></a>
                            <a href="/forside/fag/6-klasse/"><li>6. Klasse</li></a>
                            <a href="/forside/fag/7-klasse/"><li>7. Klasse</li></a>
                        </ul>
                    </li>
				</ul>
			</div>
            <h4 id="classRangeLabel"><?php echo $this->classLevel;?>. Klasse</h4>
		</div>

		<div class="center"> <a id="logoLink" href="/"><img id="headerLogo" src="/public/img/SALABY_Logo_Blue.png" alt="logo"/></a></div>

		<div id="user">
			<a href="/mypage"><img id="profilePic" src="/public/img/profile.png"/> <span class="topMenuUser"><?php echo $_SESSION['user']->getFullName();?></span></a>
            <a href="/logout"><img src="/public/img/logout.png"> <span class="topMenuUser"> Logg ut</span></a>
        </div>
    </div>
</div>