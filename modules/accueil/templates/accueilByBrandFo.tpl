<div align="center">
	<div id="Schweppes">
		{$headerExtranet}	
    <div id="wrappMain2">
      <div class="wrappCenter">
        <div class="blockCenter">
		{$filAriane}
          
		  <h2>{$marqueTitre}</h2>
		  
          <p class="txtIntro">
		  	<strong>
			{if $marqueTexteExtranet}
		  		{$marqueTexteExtranet}
			{else}
				<!--No extranet text !-->
			{/if}
			</strong></p>
          <div class="downloadLignes">
            <div class="float-left"><span class="txt5">DOWNLOADS</span><span><img src="{$j_basepath}design/front/membre/images/schweppes/rearRightCorner.gif" class="hideRearcorner"/></span></div>
            <div class="float-right">
			{if $lastDateUpdate}
			<em>last update : 
				{$lastDateUpdate|date_format:"%Y.%m.%d"} / {$lastDateUpdate|date_format:"%H:%M"}
				<!--2008.01.12 / 12:42-->
			</em>
			{/if}
			</div>
            <div class="clear">&nbsp;</div>
          </div>
          <div class="collapsible">
           			<!-- debut liste retractable -->
			<div id="DownloadList">
			{$listeRubrique}			
			</div>
			<!-- fin liste retractable -->
			
          </div>
        </div>		
        <div class="blockRight">
		  {$logoutForm}
		  <div class="menuRight"> <strong class="txt6">This section</strong>
		    {$thisSection}			
          </div>    		  
  		  {$blocContact}		  
		  <div class="bloc_gda">	
		  	{$blocGda}
		  </div>
          
		  <div class="rightContent"> <span class="txt5_">GENERAL INFORMATION</span>
		  	{$rightContent}
          </div>
          <img src="{$j_basepath}design/front/membre/images/schweppes/img1.gif" alt="" /><br />
        </div>
        <div class="clear">&nbsp;</div>
      </div>
    </div>
  </div>
</div>
<!-- footer -->
<div id="footer_normal">&nbsp;</div>
<!-- -->