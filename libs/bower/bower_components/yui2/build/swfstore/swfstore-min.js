YAHOO.util.SWFStore=function(a,c,d){var b;var e;c=c.toString();d=d.toString();if(YAHOO.env.ua.ie){b="ie";}else{if(YAHOO.env.ua.gecko){b="gecko";}else{if(YAHOO.env.ua.webkit){b="webkit";}else{if(YAHOO.env.ua.caja){b="caja";}else{if(YAHOO.env.ua.opera){b="opera";}else{b="other";}}}}}if(YAHOO.util.Cookie.get("swfstore")==null||YAHOO.util.Cookie.get("swfstore")=="null"||YAHOO.util.Cookie.get("swfstore")==""){e=Math.round(Math.random()*Math.PI*100000);YAHOO.util.Cookie.set("swfstore",e);}else{e=YAHOO.util.Cookie.get("swfstore");}var f={version:9.115,useExpressInstall:false,fixedAttributes:{allowScriptAccess:"always",allowNetworking:"all",scale:"noScale"},flashVars:{allowedDomain:document.location.hostname,shareData:c,browser:e,useCompression:d}};this.embeddedSWF=new YAHOO.widget.SWF(a,YAHOO.util.SWFStore.SWFURL,f);this.createEvent("error");this.createEvent("quotaExceededError");this.createEvent("securityError");this.createEvent("save");this.createEvent("clear");this.createEvent("pending");this.createEvent("openingDialog");this.createEvent("inadequateDimensions");};YAHOO.extend(YAHOO.util.SWFStore,YAHOO.util.AttributeProvider,{on:function(a,b){this.embeddedSWF.addListener(a,b);},addListener:function(a,b){this.embeddedSWF.addListener(a,b);},toString:function(){return"SWFStore "+this._id;},getShareData:function(){return this.embeddedSWF.callSWF("getShareData");},setShareData:function(a){this.embeddedSWF.callSWF("setShareData",[a]);},hasAdequateDimensions:function(){return this.embeddedSWF.callSWF("hasAdequateDimensions");},getUseCompression:function(){return this.embeddedSWF.callSWF("getUseCompression");},setUseCompression:function(a){this.embeddedSWF.callSWF("setUseCompression",[a]);},setItem:function(a,b){if(typeof b=="string"){b=b.replace(/\\/g,"\\\\");}return this.embeddedSWF.callSWF("setItem",[a,b]);},getValueAt:function(a){return this.embeddedSWF.callSWF("getValueAt",[a]);},getNameAt:function(a){return this.embeddedSWF.callSWF("getNameAt",[a]);},getValueOf:function(a){return this.embeddedSWF.callSWF("getValueOf",[a]);},getTypeOf:function(a){return this.embeddedSWF.callSWF("getTypeOf",[a]);},getTypeAt:function(a){return this.embeddedSWF.callSWF("getTypeAt",[a]);},getItems:function(){return this.embeddedSWF.callSWF("getItems",[]);},removeItem:function(a){return this.embeddedSWF.callSWF("removeItem",[a]);},removeItemAt:function(a){return this.embeddedSWF.callSWF("removeItemAt",[a]);},getLength:function(){return this.embeddedSWF.callSWF("getLength",[]);},clear:function(){return this.embeddedSWF.callSWF("clear",[]);},calculateCurrentSize:function(){return this.embeddedSWF.callSWF("calculateCurrentSize",[]);},getModificationDate:function(){return this.embeddedSWF.callSWF("getModificationDate",[]);},setSize:function(b){var a=this.embeddedSWF.callSWF("setSize",[b]);return a;},displaySettings:function(){this.embeddedSWF.callSWF("displaySettings",[]);}});YAHOO.util.SWFStore.SWFURL="swfstore.swf";YAHOO.register("swfstore",YAHOO.util.SWFStore,{version:"@VERSION@",build:"@BUILD@"});