
<head>

<style type="text/css">

#lcd-display {
	border : 1px solid #444;
	border-radius : 3px;
	-web-border-radius : 3px;
	-moz-border-radius : 3px;
	height : 25px;
	width : 100%;
	background : #cfe;
	padding : 3px;
	padding-top : 10px;
	overflow : hidden;
}

.button-grid {
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}

.alt-btn {
	font-size: 11px;
	font-weight: bolder;
	color:#555;
    margin-left: auto;
    margin-right: auto;
    display:block;
    text-align: center; 
}

.btn-shift,
.btn {
	font-size: 11px;
	font-weight: bolder;
	color:#555;
	height:25px;
	width:60px;
	background:#ccc;
	border-radius: 3px;
	-web-border-radius: 3px;
	-moz-border-radius: 3px;
}

.btn-shift {
	background :#fc6;
}

.light {
	background:#eee;
}

.shifted {
	color: #C00;
}

.bigger {
	font-size: 13px;
}

.nodisplay {
	visibility:hidden;
}

span.calculator-button-shift,
span.calculator-button {
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	border: 1px solid #777;
	-webkit-border-radius: 2px;
	-moz-border-radius: 2px;
	border-radius: 3px;
	padding: 3px;
	margin-right: 3px;
	font-weight: bolder;
	font-size: 15px;
	background: #fff;
	margin-top: 3px;
}

span.calculator-button-shift {
	border: 1px dashed #777;
}

</style>

</head>
<body>
	<input type="hidden" id='store'/>
	<div id="lcd-display">
		
	</div>
	<table class="button-grid">
		<tr>
			<td>
				<span class="alt-btn">QUIT</span>	
				<button type="button" class='btn'>CPT</button>
			</td>
			<td>
				<span class="alt-btn">SET</span>	
				<button type="button" class='btn'>ENTER</button>
			</td>
			<td>
				<span class="alt-btn">DEL</span>	
				<button type="button" class='btn bigger'>&uparrow;</button>
			</td>
			<td>
				<span class="alt-btn">INS</span>	
				<button type="button" class='btn bigger'>&downarrow;</button>
			</td>
			<td>
				<span class="alt-btn nodisplay">ON/OFF</span>
				<button type="button" class='btn'>ON/OFF</button>
			</td>
		</tr>
		<tr>
			<td>
				<span class="alt-btn nodisplay">2ND</span>
				<button type="button" class='btn-shift'>2ND</button>
			</td>
			<td>
				<span class="alt-btn nodisplay">CF</span>
				<button type="button" class='btn'>CF</button>
			</td>
			<td>
				<span class="alt-btn nodisplay">NPV</span>
				<button type="button" class='btn'>NPV</button>
			</td>
			<td>
				<span class="alt-btn nodisplay">IRR</span>
				<button type="button" class='btn'>IRR</button>
			</td>
			<td>
				<span class="alt-btn nodisplay">&rightarrow;</span>
				<button type="button bigger" class='btn'>&rightarrow;</button>
			</td>
		</tr>
		<tr>
			<td>
				<span class="alt-btn">xP/Y</span>
				<button type="button" class='btn light'>N</button>
			</td>
			<td>
				<span class="alt-btn">P/Y</span>
				<button type="button" class='btn light'>I/Y</button>
			</td>
			<td>
				<span class="alt-btn">AMORT</span>
				<button type="button" class='btn light'>PV</button>
			</td>
			<td>
				<span class="alt-btn">BGN</span>
				<button type="button" class='btn light'>PMT</button>
			</td>
			<td>
				<span class="alt-btn">CLR TVM</span>
				<button type="button" class='btn light'>FV</button>
			</td>
		</tr>		
		<tr>
			<td>
				<span class="alt-btn">K</span>
				<button type="button" class='btn'>%</button>
			</td>
			<td>
				<span class="alt-btn nodisplay">&radic;X</span>
				<button type="button" class='btn'>&radic;X</button>
			</td>
			<td>
				<span class="alt-btn nodisplay">X<sup>2</sup></span>
				<button type="button" class='btn'>X<sup>2</sup></button>
			</td>
			<td>
				<span class="alt-btn nodisplay">1/X</span>
				<button type="button" class='btn'>1/X</button>
			</td>
			<td>
				<span class="alt-btn">RAND</span>
				<button type="button" class='btn'>&divide;</button>
			</td>
		</tr>		<tr>
			<td>
				<span class="alt-btn">HYP</span>
				<button type="button" class='btn' >INV</button>
			</td>
			<td>
				<span class="alt-btn">SIN</span>
				<button type="button" class='btn'>(</button>
			</td>
			<td>
				<span class="alt-btn">COS</span>
				<button type="button" class='btn'>)</button>
			</td>
			<td>
				<span class="alt-btn">TAN</span>
				<button type="button" class='btn'>Y<sup>X</sup></button>
			</td>
			<td>
				<span class="alt-btn">X!</span>
				<button type="button" class='btn'>&times;</button>
			</td>
		</tr>		
		<tr>
			<td>
				<span class="alt-btn">e<sup>X</sup></span>
				<button type="button" class='btn' >LN</button>
			</td>
			<td>
				<span class="alt-btn">DATA</span>
				<button type="button" class='btn light'>7</button>
			</td>
			<td>
				<span class="alt-btn">STAT</span>
				<button type="button" class='btn light'>8</button>
			</td>
			<td>
				<span class="alt-btn">BOND</span>
				<button type="button" class='btn light'>9</button>
			</td>
			<td>
				<span class="alt-btn">nPr</span>
				<button type="button" class='btn'>-</button>
			</td>
		</tr>		
		<tr>
			<td>
				<span class="alt-btn">ROUND</span>
				<button type="button" class='btn'>STO</button>
			</td>
			<td>
				<span class="alt-btn">DEPR</span>
				<button type="button" class='btn light'>4</button>
			</td>
			<td>
				<span class="alt-btn">&Delta;%</span>
				<button type="button" class='btn light'>5</button>
			</td>
			<td>
				<span class="alt-btn">BRKEVN</span>
				<button type="button" class='btn light'>6</button>
			</td>
			<td>
				<span class="alt-btn">nCr</span>
				<button type="button" class='btn'>+</button>
			</td>
		</tr>		
		<tr>
			<td>
				<span class="alt-btn nodisplay">RCL</span>
				<button type="button" class='btn'>RCL</button>
			</td>
			<td>
				<span class="alt-btn">DATE</span>
				<button type="button" class='btn light'>1</button>
			</td>
			<td>
				<span class="alt-btn">ICONV</span>
				<button type="button" class='btn light'>2</button>
			</td>
			<td>
				<span class="alt-btn">PROFIT</span>
				<button type="button" class='btn light'>3</button>
			</td>
			<td>
				<span class="alt-btn">ANS</span>
				<button type="button" class='btn'>=</button>
			</td>
		</tr>		
		<tr>
			<td>
				<span class="alt-btn">CLR WRK</span>
				<button type="button" class='btn'>CE|C</button>
			</td>
			<td>
				<span class="alt-btn">MEM</span>
				<button type="button" class='btn light'>0</button>
			</td>
			<td>
				<span class="alt-btn">FORMAT</span>
				<button type="button" class='btn light'>.</button>
			</td>
			<td>
				<span class="alt-btn">RESET</span>
				<button type="button" class='btn light'>+|-</button>
			</td>
			<td>
				&nbsp;
			</td>
		</tr>
	</table>
	
	<script src="/question-tool/web/js/jquery/jquery-1.7.1.js"></script>
	<script language="javascript">
		$(document).ready(function() {
			var shifted = false;
			
			$(document).on("click", "button.btn", function() {
				if (shifted) {
					$('div#lcd-display').append('<span class=\'calculator-button-shift\'>'+$(this).html()+ '</span>');
					unshift();
				} else {
					$('div#lcd-display').append('<span class=\'calculator-button\'>'+$(this).html()+ '</span>');
				}
			});

			$(document).on("click", 'button.btn-shift', function(){
				if (shifted) {
					unshift();
				} else {
					shift();
				}
			});

			function shift() {
				shifted = true;
				$('.btn').each(function(){
					var a = $(this).html();
					$(this).text($(this).parent().children('.alt-btn').html()) ;
					$(this).parent().children('.alt-btn').html(a);
					$(this).addClass('shifted');
				});
			}

			function unshift() {
				shifted = false;
				$('.btn').each(function(){
					var a = $(this).html();
					$(this).text($(this).parent().children('.alt-btn').html()) ;
					$(this).parent().children('.alt-btn').html(a);
					$(this).removeClass('shifted');
				});				
			}
		});

		
		var CKEDITOR = window.parent.CKEDITOR;
		var okListener = function(event){
			this._.editor.insertHtml($('#lcd-display').html());
	    	CKEDITOR.dialog.getCurrent().removeListener("ok", okListener);
		};
		CKEDITOR.dialog.getCurrent().on("ok", okListener);
	</script>

</body>
</html>	


