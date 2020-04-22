/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/******************************************************************************************************************
LIBRERIA DE FUNCIONES GENERALES
*******************************************************************************************************************/

// FormatCurrency
function FormatCurrency(Expression)
{
    var iNumDecimals = 2;
    var dbInVal = Expression;
    var bNegative = false;
    var iInVal = 0;
    var strInVal
    var strWhole = "", strDec = "";
    var strTemp = "", strOut = "";
    var iLen = 0;

    if (dbInVal < 0)
    {
        bNegative = true;
        dbInVal *= -1;
    }

    dbInVal = dbInVal * Math.pow(10, iNumDecimals)
    iInVal = parseInt(dbInVal);
    if ((dbInVal - iInVal) >= 0.5)
    {
        iInVal++;
    }
    strInVal = iInVal + "";
    strWhole = strInVal.substring(0, (strInVal.length - iNumDecimals));
    strDec = strInVal.substring((strInVal.length - iNumDecimals), strInVal.length);
    while (strDec.length < iNumDecimals)
    {
        strDec = "0" + strDec;
    }
    iLen = strWhole.length;
    if (iLen >= 3)
    {
        while (iLen > 0)
        {
            strTemp = strWhole.substring(iLen - 3, iLen);
            if (strTemp.length == 3)
            {
                //strOut = "," + strTemp + strOut;
                strOut = strTemp + strOut;
                iLen -= 3;
            }
            else
            {
                strOut = strTemp + strOut;
                iLen = 0;
            }
        }
        if (strOut.substring(0, 1) == ",")
        {
            strWhole = strOut.substring(1, strOut.length);
        }
        else
        {
            strWhole = strOut;
        }
    }
    if (bNegative)
    {
        return "-" + strWhole + "." + strDec;
    }
    else
    {
        return strWhole + "." + strDec;
    }
}

//soloNumeros
function soloNumeros(e,decimal){
	 var key = (document.all) ? e.keyCode : e.which;
	 if(!decimal){
		 return (key <= 13 || (key >= 48 && key <= 57));
	 }else{
		 return (key <= 13 || (key >= 48 && key <= 57 || key == 46));
	 }
}




function Left(str, n){
	if (n <= 0)
	    return "";
	else if (n > String(str).length)
	    return str;
	else
	    return String(str).substring(0,n);
}

function Right(str, n){
    if (n <= 0)
       return "";
    else if (n > String(str).length)
       return str;
    else {
       var iLen = String(str).length;
       return String(str).substring(iLen, iLen - n);
    }
}


function rellenar(str,fill,len,dir){
	var relleno = '';
	var cadenaFormateada = '';
	str = Trim(str);
	for (j=0; j < len; j++){
		relleno = relleno + fill;
	}
	if(dir=='L'){
		cadenaFormateada = relleno + str;
		return Right(cadenaFormateada,len);
	}else if(dir=='R'){
		cadenaFormateada = str + relleno;
		return Left(cadenaFormateada,len);
	}else{
		return "";
	}
}

function Trim(strToTrim) {
  while(strToTrim.charAt(0)==' '){strToTrim = strToTrim.substring(1,strToTrim.length);}
  while(strToTrim.charAt(strToTrim.length-1)==' '){strToTrim = strToTrim.substring(0,strToTrim.length-1);}
  return strToTrim;
}



function currencyMaskFormat(fld, milSep, decSep, e,callFuncEnter) {
	  var sep = 0;
	  var key = '';
	  var i = 0;
	  var j = 0;
	  var len = 0;
	  var len2 = 0;
	  var strCheck = '0123456789';
	  var aux = '';
	  var aux2 = '';

	  var whichCode = (document.all) ? e.keyCode : e.which; // 2
	  //var whichCode = window.Event ? e.which : e.keyCode;

	  if (whichCode == 13){
	  	window.setTimeout(callFuncEnter,1);
		return true;  // Enter
	  }

	  if (whichCode == 8 || whichCode == 0) return true;  // Delete

	  key = String.fromCharCode(whichCode);  // Get key value from key code

	  if (strCheck.indexOf(key) == -1) return false;  // Not a valid key
	  len = fld.value.length;
	  for(i = 0; i < len; i++)
	  if ((fld.value.charAt(i) != '0') && (fld.value.charAt(i) != decSep)) break;
	  aux = '';
	  for(; i < len; i++)
	  if (strCheck.indexOf(fld.value.charAt(i))!=-1) aux += fld.value.charAt(i);
	  aux += key;
	  len = aux.length;
	  if (len == 0) fld.value = '';
	  if (len == 1) fld.value = '0'+ decSep + '0' + aux;
	  if (len == 2) fld.value = '0'+ decSep + aux;
	  if (len > 2) {
	    aux2 = '';
	    for (j = 0, i = len - 3; i >= 0; i--) {
	      if (j == 3) {
	        aux2 += milSep;
	        j = 0;
	      }
	      aux2 += aux.charAt(i);
	      j++;
	    }
	    fld.value = '';
	    len2 = aux2.length;
	    for (i = len2 - 1; i >= 0; i--)
	    fld.value += aux2.charAt(i);
	    fld.value += decSep + aux.substr(len - 2, len);
	  }
	  return false;
	}
