	<table id="medaljer" class="table" style = "margin-top: 30px;" >
		<thead>
			<tr id="tablehead">
				<th>#</th>
				<th>Country</th>
				<th id="gold"><img src="img/medal_gold_3.png"> <span>Gold</span></th>
				<th id="silver"><img src="img/medal_silver_3.png"> <span>Silver</span></th>
				<th id="bronze"><img src="img/medal_bronze_3.png"> <span>Bronze</span></th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>1</td>
				<td><img src="img/flags/no.gif"> Norway</td>
				<td>12</td>
				<td>7</td>
				<td>6</td>
				<td>25</td>
			</tr>
			<tr>
				<td>2</td>
				<td><img src="img/flags/ru.gif"> Russia</td>
				<td>10</td>
				<td>5</td>
				<td>6</td>
				<td>21</td>
			</tr>
			<tr>
				<td>3</td>
				<td><img src="img/flags/us.gif"> USA</td>
				<td>9</td>
				<td>4</td>
				<td>6</td>
				<td>19</td>
			</tr>
			<tr>
				<td>4</td>
				<td><img src="img/flags/it.gif"> Italy</td>
				<td>8</td>
				<td>3</td>
				<td>6</td>
				<td>17</td>
			</tr>
			<tr>
				<td>5</td>
				<td><img src="img/flags/ca.gif"> Canada</td>
				<td>7</td>
				<td>7</td>
				<td>1</td>
				<td>15</td>
			</tr>
			<tr>
				<td>6</td>
				<td><img src="img/flags/se.gif"> Sweden</td>
				<td>6</td>
				<td>5</td>
				<td>3</td>
				<td>14</td>
			</tr>
			<tr>
				<td>7</td>
				<td><img src="img/flags/fr.gif"> France</td>
				<td>5</td>
				<td>4</td>
				<td>2</td>
				<td>11</td>
			</tr>
			<tr>
				<td>8</td>
				<td><img src="img/flags/fi.gif"> Finland</td>
				<td>4</td>
				<td>5</td>
				<td>1</td>
				<td>10</td>
			<tr>
				<td>9</td>
				<td> <img src="img/flags/de.gif"> Germany</td>
				<td>4</td>
				<td>4</td>
				<td>1</td>
				<td>9</td>
			</tr>
			<tr>
				<td>10</td>
				<td><img src="img/flags/jp.gif"> Japan</td>
				<td>4</td>
				<td>3</td>
				<td>1</td>
				<td>8</td>
			</tr>
			<tr>
				<td>11</td>
				<td><img src="img/flags/es.gif"> Spain</td>
				<td>4</td>
				<td>2</td>
				<td>1</td>
				<td>7</td>
			</tr>
			<tr>
				<td>12</td>
				<td><img src="img/flags/si.gif"> Serbia</td>
				<td>4</td>
				<td>1</td>
				<td>1</td>
				<td>6</td>
			</tr>
			<tr>
				<td>13</td>
				<td><img src="img/flags/sk.gif"> Slovakia</td>
				<td>3</td>
				<td>1</td>
				<td>1</td>
				<td>5</td>
			</tr>
			<tr>
				<td>14</td>
				<td><img src="img/flags/pl.gif"> Poland</td>
				<td>3</td>
				<td>1</td>
				<td>0</td>
				<td>4</td>
			</tr>
			<tr>
				<td>15</td>
				<td><img src="img/flags/gb.gif"> Great Britain</td>
				<td>3</td>
				<td>0</td>
				<td>1</td>
				<td>4</td>
			</tr>
			<tr>
				<td>16</td>
				<td><img src="img/flags/ua.gif"> Ukraine</td>
				<td>3</td>
				<td>0</td>
				<td>0</td>
				<td>3</td>
			</tr>
			<tr>
				<td>17</td>
				<td><img src="img/flags/at.gif"> Austria</td>
				<td>2</td>
				<td>1</td>
				<td>0</td>
				<td>3</td>
			</tr>
			<tr>
				<td>18</td>
				<td><img src="img/flags/bg.gif"> Bulgaria</td>
				<td>2</td>
				<td>0</td>
				<td>1</td>
				<td>3</td>
			</tr>
			<tr>
				<td>19</td>
				<td><img src="img/flags/be.gif"> Belgia</td>
				<td>2</td>
				<td>0</td>
				<td>0</td>
				<td>2</td>
			</tr>
			<tr>
				<td>20</td>
				<td><img src="img/flags/is.gif"> Iceland</td>
				<td>1</td>
				<td>1</td>
				<td>0</td>
				<td>2</td>
			</tr>
		</tbody>
	</table>

<!--
<script type="text/javascript">
	// fixed tablehead when scrolling
    ;(function($) {
        $.fn.fixMe = function() {
            return this.each(function() {
                var $this = $(this),
                $t_fixed;

                function init() {
                    $this.wrap('<div class="stats_container col-xs-12 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1" style="overflow: scroll;" />');
                    $t_fixed = $this.clone();
                    $t_fixed.find("tbody").remove().end().addClass("fixed").insertBefore($this);
                    resizeFixed();
                }

                function resizeFixed() {
                    $t_fixed.find("th").each(function(index) {
                    $(this).css("width",$this.find("th").eq(index).outerWidth()+"px");
                    });
                }

                function scrollFixed() {
                    var offset = $(this).scrollTop(),
                    tableOffsetTop = $this.offset().top,
                    tableOffsetBottom = tableOffsetTop + $this.height() - $this.find("thead").height();
                    if(offset < tableOffsetTop || offset > tableOffsetBottom)
                    	$t_fixed.hide();
                    else if(offset >= tableOffsetTop && offset <= tableOffsetBottom && $t_fixed.is(":hidden"))
                    	$t_fixed.show();
                }

                $(window).resize(resizeFixed);
                $(window).scroll(scrollFixed);
                init();
            });
        };
    })(jQuery);

    $(document).ready(function() {
        $("table").fixMe();
    });
</script>
-->
