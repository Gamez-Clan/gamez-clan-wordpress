/*
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
Object.append(Browser.Features,{localstorage:(function(){return("localStorage" in window)&&window.localStorage!==null;
})()});var JTabs=new Class({Implements:[Options,Events],options:{display:0,useStorage:true,onActive:function(b,a){a.setStyle("display","block");b.addClass("open").removeClass("closed");
},onBackground:function(b,a){a.setStyle("display","none");b.addClass("closed").removeClass("open");},titleSelector:"dt",descriptionSelector:"dd"},initialize:function(b,c){this.setOptions(c);
this.dlist=document.id(b);this.titles=this.dlist.getChildren(this.options.titleSelector);this.descriptions=this.dlist.getChildren(this.options.descriptionSelector);
this.content=new Element("div").inject(this.dlist,"after").addClass("current");this.storageName="jpanetabs_"+this.dlist.id;if(this.options.useStorage){if(Browser.Features.localstorage){this.options.display=localStorage[this.storageName];
}else{this.options.display=Cookie.read(this.storageName);}}if(this.options.display===null||this.options.display===undefined){this.options.display=0;}this.options.display=this.options.display.toInt().limit(0,this.titles.length-1);
for(var d=0,a=this.titles.length;d<a;d++){var f=this.titles[d];var e=this.descriptions[d];f.setStyle("cursor","pointer");f.addEvent("click",this.display.bind(this,d));
e.inject(this.content);}this.display(this.options.display);if(this.options.initialize){this.options.initialize.call(this);}},hideAllBut:function(a){for(var c=0,b=this.titles.length;
c<b;c++){if(c!=a){this.fireEvent("onBackground",[this.titles[c],this.descriptions[c]]);}}},display:function(a){this.hideAllBut(a);this.fireEvent("onActive",[this.titles[a],this.descriptions[a]]);
if(this.options.useStorage){if(Browser.Features.localstorage){localStorage[this.storageName]=a;}else{Cookie.write(this.storageName,a);}}}});