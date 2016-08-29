function updateinfo(obj,values)
	{
		var container = document.getElementById("infocontainer");
	    clearContainer(container);
	    if (obj.value in values ){
	    	if (values[obj.value].hasOwnProperty("options")){
	    		var label = document.createElement("label");
	    		label.innerHTML = values[obj.value]["label"];
	    		label.id = "infoLabel";
	    		container.appendChild(label);
	    		var newobj = document.createElement("select");
	    		newobj.id = "infoData";
	    		container.appendChild(newobj);
				for (var i = 0; i < values[obj.value]["options"].length; i++) {
    				var option = document.createElement("option");
    				option.value = values[obj.value]["options"][i]["value"];
    				option.text = values[obj.value]["options"][i]["label"];
    				newobj.appendChild(option);
				}
	    	}else if (values[obj.value].hasOwnProperty("text")){
	    		var newobj = document.createElement("input");
	    		newobj.id = "infoData";
	    		container.appendChild(newobj);
	    	}
	    }else{
	    	console.log("no data");
	    }
	};
	function clearContainer(containerObj){
		if (containerObj.children.length > 0){
			while (containerObj.firstChild) {
	    		containerObj.removeChild(containerObj.firstChild);
			}
	}
}
