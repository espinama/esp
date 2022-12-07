function selectville(obj) {
		 var val = obj.options[obj.selectedIndex].id;
		 document.getElementById("fr").value = val;
		// var title = obj.options[obj.selectedIndex].title;
		// var valville = obj.options[obj.selectedIndex].value;
		// document.getElementById("copytext5").value = title;
		 
		// document.getElementById("boxville").value = valville;
		 
		 
	 }


	  function selectproduit(obj) {
		var valproduit = obj.options[obj.selectedIndex].value; 
         var val = obj.options[obj.selectedIndex].id; 
		 var typ = obj.options[obj.selectedIndex].title; 
		 var qty = document.getElementById("Qty").value;
         document.getElementById("prixproduit").value = val*qty;
		 document.getElementById("prixunite").value = val;
		 document.getElementById("achat").value = typ;
		 document.getElementById("boxproduit").value = valproduit;
      }
	  	  function selectqty(val) {
         var val = document.getElementById("prixunite").value;
		 var qty = document.getElementById("Qty").value;
         document.getElementById("prixproduit").value = val*qty;
      }
	function upsel(){
		if(document.getElementById("ckeckupselbox").
		checked){
			document.getElementById("fr").value = "0";
			document.getElementById("ckeckupsel").value = "1";
		}else
			document.getElementById("ckeckupsel").value = null;
	}
