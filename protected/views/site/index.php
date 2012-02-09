<!DOCTYPE HTML>
<html>
  <head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=no">
	
    <title>DragED</title>
	
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" title="no title" charset="utf-8">
	<link rel="stylesheet" type="text/css" href="addTouch.css">
	<script type="text/javascript" charset="utf-8" src="kinetic-v3.6.4.js"></script>
	<script type="text/javascript" charset="utf-8" src="main.js"></script>
	<!-- For Debug -->
	<script type="text/javascript" charset="utf-8" src="addTouch.js"></script>

	<script type="text/javascript">
		// holds the grid: {0,1}
		var matrixItems = MultiDimensionalZeroArray(6, 3);
		// holds all the items for export
		var codeItems = MultiDimensionalNullArray(6, 3);
		// holds all var names
		/**********************
		0 = null/nothing
		1 = var
		2 = if
		3 = else
		4 = while
		5 = echo(string)
		6 = echo(var)
		**********************/
		var varArr = new Array();
		var varArrTypes = new Array("null", "var", "if", "else", "while", "echoS", "echoV");
		
		var menuItemCount = 5;
		var menuItemsTxt = new Array("var", "if", "else", "while", "echo");
		var canvasItems = new Array();
		var canvasItemsColor = new Array("#00b2d8", "#64808c", "#ff9600", "#ddae6b", "#ff6600", "#d6834c", "#00d9e1", "#78d6d9", "#b200d8", "#d45fed");
		
		window.onload = function(){
			var stageWidth = 308;
			var stageHeight = 370;
		
			var stage = new Kinetic.Stage("container", stageWidth, stageHeight);
			var backLayer = new Kinetic.Layer();
			var shapesLayer = new Kinetic.Layer();
			var messageLayer = new Kinetic.Layer();

			var message = "Drag and drop the box...";
			
			var rectWidth = 100;
			var rectHeight = 50;
			var draggingRectOffsetX = rectWidth / 2;
			var draggingRectOffsetY = rectHeight / 2;
			var staticRectWidth = 57;
			var staticRectHeight = 57;
			
			//grid width and height
			var bw = stageWidth;
			var bh = 313;
			//gridsquare size
			var sw = rectWidth + 2;
			var sh = rectHeight + 2;
			//padding around grid
			var p = 0;
			//size of canvas
			var cw = bw + (p*2) + 1;
			var ch = bh + (p*2) + 1;
			var snapGrid = new Kinetic.Shape(function()
			{
				var c = this.getContext();
				for (var x = 0; x <= bw; x += sw) {
					c.moveTo(0.5 + x + p, p);
					c.lineTo(0.5 + x + p, bh + p);
				}
				for (var x = 0; x <= bh; x += sh) {
					c.moveTo(p, 0.5 + x + p);
					c.lineTo(bw + p, 0.5 + x + p);
				}
				
				c.lineWidth = 1;
				c.strokeStyle = "#ccc";
				c.stroke();
			});
			snapGrid.draggable(false);
			backLayer.add(snapGrid);
			
			for (var n = 0; n < menuItemCount; n++)
			{
				//anonymous function to induce scope
                (function()
				{
					var i = n;
					var staticBox = new Kinetic.Shape(function()
					{
						var c = this.getContext();
						c.beginPath();
						c.fillStyle = "#444";
						c.fillRect(60 * i, 315, staticRectWidth, staticRectHeight);
						c.font = "12pt Calibri";
						c.fillStyle = "white";
						c.textBaseline = "top";
						c.fillText(this.text, (60 * i) + 15, 340);
						c.closePath();
					});
					var dragBox;
					staticBox.text = menuItemsTxt[i];
					staticBox.on("click touchstart", function()
					{
						dragBox = new Kinetic.Shape(function()
						{
							var c = this.getContext();
							c.beginPath();
							c.rect(190, 260, rectWidth, rectHeight);
							c.lineWidth = 2;
							c.strokeStyle = "black";
							c.fillStyle = this.color;
							c.fill();
							c.stroke();
							c.font = "12pt Calibri";
							c.fillStyle = "white";
							c.textBaseline = "top";
							c.fillText(this.text, 200, 270);
							c.closePath();
						});
						dragBox.canvasObjType = menuItemsTxt[i];
						dragBox.objType = 0;
						dragBox.sitsOn = new Array(-3, -3);	// negative number to be sure to prevent any errors
						dragBox.text = menuItemsTxt[i];
						dragBox.draggable(true);
						dragBox.color = canvasItemsColor[2 * i];
						dragBox.val = "";
						// Event: start drag
						dragBox.on("dragstart", function()
						{
							var pos = this.getPosition();
							var x = Math.floor(pos.x / 102) * 102;
							var y = Math.floor(pos.y / 52) * 52;
							
							var row = Math.abs(getRow(x));
							var col = Math.abs(getCol(y));
							if ((matrixItems[row][col] == 1) && (this.sitsOn[0] == row) && (this.sitsOn[1] == col))
							{
								matrixItems[row][col] = 0;
								//console.log(this.sitsOn);
								if ((this.sitsOn[0] > -1) && (this.sitsOn[1] > -1)) codeItems[this.sitsOn[0]][this.sitsOn[1]] = null;
								this.sitsOn = new Array(-1, -1);
							}
							this.color = canvasItemsColor[2 * i];
							this.moveToTop();
							shapesLayer.draw();
						});
						// Event: mouse and drag release
						dragBox.on("touchend mouseup", function()
						{
							var pos = this.getPosition();
							var x = Math.floor(pos.x / 102) * 102;
							var y = Math.floor(pos.y / 52) * 52;
							
							var row = Math.abs(getRow(x));
							var col = Math.abs(getCol(y));
							if (((matrixItems[row][col] == 0) || (matrixItems[row][col] == undefined)))
							{
								x += 15;
								y += 2;
								this.setPosition(x, y);
								matrixItems[row][col] = 1;
								codeItems[row][col] = this;
								this.sitsOn = new Array(row, col);
								this.color = canvasItemsColor[(2 * i) + 1];
								this.objType = this.canvasObjType == "echo" ? 6 : getObjType(this);
							}
							
							// Put var names and/or echo strings into the box
							var txtInput = document.getElementById("varTxt").value;
							if (((this.canvasObjType == "var") || (this.canvasObjType == "echo")) && (txtInput != ""))
							{
								var strAdd = "" + this.canvasObjType + " ";
								var strPost = "";
								
								this.val = txtInput;
								if (this.canvasObjType == "var")
								{
									if (txtInput.match("\x3D"))
										strAdd = "";
									else
										if (!varArr.contains(txtInput))
										{
											varArr.push(txtInput);	// add var name to the global array
										}
								}
								if ((this.canvasObjType == "echo") && (!varArr.contains(txtInput)))
								{
									strAdd += "\""; strPost = "\"";
									this.objType = 5;
								}
								
								this.text = strAdd + txtInput + strPost;
								//writeMessage(messageLayer, canvasItems.length + "|" + varArr);
							}
							shapesLayer.draw();
						});
						// Event: double tap/click
						dragBox.on("dbltap dblclick", function()
						{
							var pos = this.getPosition();
							var x = Math.floor(pos.x / 102) * 102;
							var y = Math.floor(pos.y / 52) * 52;
							
							var row = Math.abs(getRow(x));
							var col = Math.abs(getCol(y));
							if (this.canvasObjType == "var") removeFromArray(this.val, varArr);
							if ((matrixItems[row][col] == 1) && (this.sitsOn[0] == row) && (this.sitsOn[1] == col))
							{
								//this.sitsOn = new Array(-1, -1);
								matrixItems[row][col] = 0;
								codeItems[row][col] = null;
								//writeMessage(messageLayer, canvasItems.length + "|" + varArr);
							}
							removeFromArray(this, canvasItems);
							shapesLayer.remove(this);
							shapesLayer.draw();
						});
						shapesLayer.add(dragBox);
						dragBox.moveToTop();
						shapesLayer.draw();
						
						canvasItems.push(dragBox);
						//writeMessage(messageLayer, canvasItems.length + "|" + varArr);
					});
					shapesLayer.add(staticBox);
				})();
			}
			stage.add(backLayer);
			stage.add(shapesLayer);
			stage.add(messageLayer);
		};
    </script>
	
  </head>
  <body>
	<div id="container">
	</div>
	<div id="menu">
		<input id="varTxt" type="text" style="width:120px; margin-top:380px;" />
		<form method="post" action="index.php?r=skript/create" style="width:250px; display:inline;" name="saver"> <!-- hier den Link ändern -->
			<input id="jsonout" type="hidden" name="jsonout" />
			<input type="button" value="Save All" onclick="javascript:sendToBackEnd();" />
		</form>
	</div>
  </body>
</html>
