window.addEvent("domready",function(){$$("#provider").addEvent("change",function(){var a=this.options[this.selectedIndex].get("rel");window.location.href=a;
});$$("#search-button").addEvent("click",function(b){var c=$("search-input").value;var a=$("search-button").get("href");$("search-button").set("href",a+"&search="+c);
});$$("#toolbar-edit").addEvent("click",function(d){var b=this.getElement("a").get("href");var c=[];var a=$$("span.selectid input[type=checkbox]:checked");
a.each(function(e){c.push(e.get("value"));});if(c.length<1){alert("Please make a selection");d.stop();}else{this.getElement("a").set("href",b+"&id="+c[0]);
}});$$("span.checkall input[type=checkbox]").addEvent("click",function(){this.getParent("table.widefat").getElements("input[type=checkbox]").set("checked",this.checked);
});});