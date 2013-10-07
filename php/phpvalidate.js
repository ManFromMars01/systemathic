<!--
 function fieldEnter(caller) {
    if (caller) {
      caller.style.background="#ffffff";    
    }
 }

 function fieldExit(caller) {
    if (caller) {
      caller.style.background="#ffffff";
    }
 }

 function setMessage(caller) {      
    pointer = caller;       
    clearMessage();
    if(pointer.Message) {
    window.status = pointer.Message;
    }
 }
 
 function clearMessage() {      
    window.status = "";
 }

 function validate(caller) {
    pointer = caller;       
    if (pointer.Required == true && !pointer.value) {
        alert(pointer.Label + ": Required field");  
        }
    else if (pointer.SavedValue != pointer.value) { 
        switch(pointer.DataType) {
            case "STRING" :
            // check the Caps statement
                if(pointer.Caps == "WORD") {
                    //var pattern = /(\w)(\w*)/;
                    var pattern = /([A-Za-z0-9_ëêâäîïôöûüÿËÊÂÄÎÏÔÖÛÜ])([A-Za-z0-9_ëêâäîïôöûüÿËÊÂÄÎÏÔÖÛÜ]*)/;
                    var a = pointer.value.split(/\s+/g);
                    for (i = 0 ; i < a.length ; i ++ ) {
                        var parts = a[i].match(pattern);
                        var firstLetter = parts[1].toUpperCase();
                        var restOfWord = parts[2].toLowerCase();
                        a[i] = firstLetter + restOfWord;
                    }
                    pointer.value = a.join(' ');                    
                }
                if(pointer.Caps == "ALL") {
                    var a = pointer.value;                  
                    pointer.value = a.toUpperCase();
                }
                return(0);
            case "NUMERIC" :
                // test for numeric entry
                if (isNaN(pointer.value)) {
                    alert(pointer.Label + ": Numeric field");
                    // set to minimum if required
                    if (pointer.Minimum) {
                        pointer.value = pointer.Minimum;
                        }
                    // otherwise zero/zed
                    else {
                        pointer.value = 0;
                    }                   
                    pointer.select();                                       
                }
                // minimum value
                if (pointer.Minimum && pointer.value < pointer.Minimum) {
                    alert("Minimum value " + pointer.Label + ": " + pointer.Minimum);
                    pointer.value = pointer.Minimum + "";
                    pointer.select();                   
                }
                // maximum value
                if (pointer.Maximum && pointer.value > pointer.Maximum) {
                    alert("Maximum value " + pointer.Label + ": " + pointer.Maximum);
                    pointer.value = pointer.Maximum + "";
                    pointer.select();                   
                }               
                // set precision to decimal places
                if (pointer.Places) {
                    var i;
                    var val;
                    val = pointer.value + '';
                    var decPos = val.indexOf('.');
                    if (decPos == -1) {             
                        val += '.';
                        for (i=0; i < pointer.Places; i++) {                        
                            val += '0';
                        }
                    }
                    else    {       
                        var actualDec = (val.length - 1) - decPos;
                        var diff = pointer.Places - actualDec;
                        if(diff > 0) {
                            for (i=0; i < diff; i++) {  
                                val += '0';
                            }
                        }
                        if(diff < 0) {
                            val = val.substr(0,(decPos + pointer.Places + 1));
                        }                   
                    }
                pointer.value = val;
                }
                return(0);              
            case "DATE" :
                    var dVal;
                    var iD,iM,iY;
                    dVal = pointer.value + '';                              
                    //     0123456789
                    // 1 - dd mm yyyy
                    // 2 - mm dd yyyy
                    // 3 - yyyy mm dd                      
                switch(datestyle){
                    case 1:
                        iY = dVal.substr(6,4);
                        iM = dVal.substr(3,2);
                        iD = dVal.substr(0,2);
                        break;
                    case 2:
                        iY = dVal.substr(6,4);
                        iM = dVal.substr(0,2);
                        iD = dVal.substr(3,2);
                        break;
                    case 3:
                        iY = dVal.substr(0,4);
                        iM = dVal.substr(5,2);
                        iD = dVal.substr(8,2);
                        break;
                }               
                if(pointer.value) {
                    strDate = iM + "-" + iD + "-" + iY;
                    var d = new Date(iY, iM, iD);
                    if(!d.getFullYear() || !d.getMonth() || !d.getDate() ) {
                        alert(pointer.Label + " " + strDate +  " : Invalid date");                   
                        pointer.select();                   
                    }
                }
                clearMessage();
                return(0)
            case "TIME" :
                if(pointer.value) {
                var d = new Date();
                var t = Date.parse("July 21, 1983 " + pointer.value);
                if(isNaN(t)) {
                    alert(pointer.Label + ": Invalid time");                   
                    pointer.select();                   
                    }
                else {                  
                }
                }
                return(0)
        }
    }
 }


// -->
