function writeMessage(messageLayer, message)
{
	var context = messageLayer.getContext();
	messageLayer.clear();
	context.font = "18pt Calibri";
	context.fillStyle = "black";
	context.fillText(message, 10, 25);
}

Array.prototype.contains = function(obj)
{
	var i = this.length;
	while (i--)
	{
		if (this[i] === obj)
		{
			return true;
		}
	}
	return false;
}

function removeFromArray(item, array)
{
	var idx = array.indexOf(item); 		//Find the index
	if(idx!=-1) array.splice(idx, 1); 	//Remove it if really found!
}

function MultiDimensionalZeroArray(iRows, iCols) 
{ 
	var i; 
	var j; 
	var a = new Array(iRows); 
	for (i = 0; i < iRows; i++) 
	{ 
		a[i] = new Array(iCols); 
		for (j = 0; j < iCols; j++) 
		{ 
		   a[i][j] = 0; 
		} 
	} 
	return(a); 
}

function MultiDimensionalNullArray(iRows, iCols) 
{ 
	var i; 
	var j; 
	var a = new Array(iRows); 
	for (i = 0; i < iRows; i++) 
	{ 
		a[i] = new Array(iCols); 
		for (j = 0; j < iCols; j++) 
		{ 
		   a[i][j] = null; 
		} 
	} 
	return(a); 
}

function getRow(x)
{
	return (x / 102);
}

function getCol(y)
{
	return (y / 52);
}

function getObjType(obj)
{
	switch(obj.canvasObjType)
	{
		case "var":
			return 1;
			break;
		case "if":
			return 2;
			break;
		case "else":
			return 3;
			break;
		case "while":
			return 4;
			break;
		default:
			return 0;
	}
}

// sends the items on the grid matrix to the backend
function sendToBackEnd()
{
	var jsonResult = new Array();
	for (i = codeItems.length - 1; i >= 0; i--)
	{
		for (j = codeItems[i].length - 1; j >= 0; j--)
		{
			//console.log("Row: " + i + " Col: " + j);
			var obj = recuGetJsonResultObj(i, j);
			if (obj) jsonResult.push(obj);
		}
	}
	var strJson = JSON.stringify(jsonResult);
	document.getElementById("jsonout").value = strJson;
    document.saver.submit();
}

function recuGetJsonResultObj(row, col)
{
	var currObj = codeItems[row][col];
	//console.log(currObj);
	if ((!currObj) || (currObj == null)) return false;
	var obj = new Object();
	obj.value = currObj.val;
	obj.type = varArrTypes[currObj.objType];
	if ((currObj.objType == "if") || (currObj.objType == "else") ||(currObj.objType == "while"))
	{
		if (row > 0) obj.child = recuGetJsonResultObj(row--, col);
	}
	console.log("New obj: " + obj.value + "->" + obj.type);
	return obj;
}




