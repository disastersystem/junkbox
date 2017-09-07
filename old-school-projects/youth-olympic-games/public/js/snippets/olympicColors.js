/*---------------------------------------------------------------------------*/
/*						O L Y M P I C   C O L O R S
/*---------------------------------------------------------------------------*/
	
	var OLColor = function (standard, light, dark )
	{
		this.standard = standard;
		this.light    = light;
		this.dark     = dark;
	}
	
	
		
/*---|--COLOR-|-------------|------STANDARD-------|-------LIGHT-------|--------DARK--------|*/	
		
	var olBlue  = new OLColor("hsl(222,80%,27%)", "hsl(222,75%,50%)", "hsl(222,50%,35%)");		
		
	var olBlack = new OLColor("#333","#888","#555");	
		
	var olRed   = new OLColor("hsl(0,80%,48%)",    "hsl(0,80%,55%)",    "hsl(0,80%,40%)");	

	var olYel   = new OLColor("hsl(56,80%,52%)",  "hsl(56,80%,62%)",  "hsl(56,80%,32%)");	
		
	var olGreen = new OLColor("hsl(146,80%,26%)",  "hsl(146,80%,36%)",  "hsl(146,80%,20%)");