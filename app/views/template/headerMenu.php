<script>
    function expandMenu(obj){
        if (obj.className === 'expandDropDownHeight')
            obj.className = '';
        else
            obj.className = 'expandDropDownHeight';
    }
    function showMenu(obj){
        if (obj.parentNode.className === 'showMenuOnClick')
            obj.parentNode.className = '';
        else
            obj.parentNode.className = 'showMenuOnClick';
    }

</script>
<div id="header">
	<div class="widthConstrained">
		<div id="hamMenu">
            <a href="#" onclick="showMenu(this)">
                <div id="hamMenuIconWrapper">
                    <!--<div></div><div></div>-->
                </div>
                <span id="classRangeLabel"><?php echo $this->classLevel;?>. Klasse</span>
            </a>
			<div id="dropDownMainMenu">
				<ul>
					<li><a href="/">Forsiden</a></li>
                    <li><a href="/forside/fag/2-klasse/">Barnehage</a></li>
                    <li><a href="/forside/fag/0-klasse/">Skolestart</a></li>
                    <li onclick="expandMenu(this)">
                        <a href="#">Klassetrinn</a>
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
            <?php if(isset($this->homeworkCount['homeworkCount'])) {
                echo '<div id="homeworkCount">' . $this->homeworkCount['homeworkCount'] . '</div>';
            }?>
            <a href="/logout"><img src="/public/img/logout.png"> <span class="topMenuUser"> Logg ut</span></a>
        </div>
    </div>
</div>