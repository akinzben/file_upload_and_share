/* jquery.form.min.js */
(function(e){"use strict";if(typeof define==="function"&&define.amd){define(["jquery"],e)}else{e(typeof jQuery!="undefined"?jQuery:window.Zepto)}})(function(e){"use strict";function r(t){var n=t.data;if(!t.isDefaultPrevented()){t.preventDefault();e(t.target).ajaxSubmit(n)}}function i(t){var n=t.target;var r=e(n);if(!r.is("[type=submit],[type=image]")){var i=r.closest("[type=submit]");if(i.length===0){return}n=i[0]}var s=this;s.clk=n;if(n.type=="image"){if(t.offsetX!==undefined){s.clk_x=t.offsetX;s.clk_y=t.offsetY}else if(typeof e.fn.offset=="function"){var o=r.offset();s.clk_x=t.pageX-o.left;s.clk_y=t.pageY-o.top}else{s.clk_x=t.pageX-n.offsetLeft;s.clk_y=t.pageY-n.offsetTop}}setTimeout(function(){s.clk=s.clk_x=s.clk_y=null},100)}function s(){if(!e.fn.ajaxSubmit.debug){return}var t="[jquery.form] "+Array.prototype.join.call(arguments,"");if(window.console&&window.console.log){window.console.log(t)}else if(window.opera&&window.opera.postError){window.opera.postError(t)}}var t={};t.fileapi=e("<input type='file'/>").get(0).files!==undefined;t.formdata=window.FormData!==undefined;var n=!!e.fn.prop;e.fn.attr2=function(){if(!n){return this.attr.apply(this,arguments)}var e=this.prop.apply(this,arguments);if(e&&e.jquery||typeof e==="string"){return e}return this.attr.apply(this,arguments)};e.fn.ajaxSubmit=function(r){function k(t){var n=e.param(t,r.traditional).split("&");var i=n.length;var s=[];var o,u;for(o=0;o<i;o++){n[o]=n[o].replace(/\+/g," ");u=n[o].split("=");s.push([decodeURIComponent(u[0]),decodeURIComponent(u[1])])}return s}function L(t){var n=new FormData;for(var s=0;s<t.length;s++){n.append(t[s].name,t[s].value)}if(r.extraData){var o=k(r.extraData);for(s=0;s<o.length;s++){if(o[s]){n.append(o[s][0],o[s][1])}}}r.data=null;var u=e.extend(true,{},e.ajaxSettings,r,{contentType:false,processData:false,cache:false,type:i||"POST"});if(r.uploadProgress){u.xhr=function(){var t=e.ajaxSettings.xhr();if(t.upload){t.upload.addEventListener("progress",function(e){var t=0;var n=e.loaded||e.position;var i=e.total;if(e.lengthComputable){t=Math.ceil(n/i*100)}r.uploadProgress(e,n,i,t)},false)}return t}}u.data=null;var a=u.beforeSend;u.beforeSend=function(e,t){if(r.formData){t.data=r.formData}else{t.data=n}if(a){a.call(this,e,t)}};return e.ajax(u)}function A(t){function T(e){var t=null;try{if(e.contentWindow){t=e.contentWindow.document}}catch(n){s("cannot get iframe.contentWindow document: "+n)}if(t){return t}try{t=e.contentDocument?e.contentDocument:e.document}catch(n){s("cannot get iframe.contentDocument: "+n);t=e.document}return t}function k(){function f(){try{var e=T(v).readyState;s("state = "+e);if(e&&e.toLowerCase()=="uninitialized"){setTimeout(f,50)}}catch(t){s("Server abort: ",t," (",t.name,")");_(x);if(w){clearTimeout(w)}w=undefined}}var t=a.attr2("target"),n=a.attr2("action"),r="multipart/form-data",u=a.attr("enctype")||a.attr("encoding")||r;o.setAttribute("target",p);if(!i||/post/i.test(i)){o.setAttribute("method","POST")}if(n!=l.url){o.setAttribute("action",l.url)}if(!l.skipEncodingOverride&&(!i||/post/i.test(i))){a.attr({encoding:"multipart/form-data",enctype:"multipart/form-data"})}if(l.timeout){w=setTimeout(function(){b=true;_(S)},l.timeout)}var c=[];try{if(l.extraData){for(var h in l.extraData){if(l.extraData.hasOwnProperty(h)){if(e.isPlainObject(l.extraData[h])&&l.extraData[h].hasOwnProperty("name")&&l.extraData[h].hasOwnProperty("value")){c.push(e('<input type="hidden" name="'+l.extraData[h].name+'">').val(l.extraData[h].value).appendTo(o)[0])}else{c.push(e('<input type="hidden" name="'+h+'">').val(l.extraData[h]).appendTo(o)[0])}}}}if(!l.iframeTarget){d.appendTo("body")}if(v.attachEvent){v.attachEvent("onload",_)}else{v.addEventListener("load",_,false)}setTimeout(f,15);try{o.submit()}catch(m){var g=document.createElement("form").submit;g.apply(o)}}finally{o.setAttribute("action",n);o.setAttribute("enctype",u);if(t){o.setAttribute("target",t)}else{a.removeAttr("target")}e(c).remove()}}function _(t){if(m.aborted||M){return}A=T(v);if(!A){s("cannot access response document");t=x}if(t===S&&m){m.abort("timeout");E.reject(m,"timeout");return}else if(t==x&&m){m.abort("server abort");E.reject(m,"error","server abort");return}if(!A||A.location.href==l.iframeSrc){if(!b){return}}if(v.detachEvent){v.detachEvent("onload",_)}else{v.removeEventListener("load",_,false)}var n="success",r;try{if(b){throw"timeout"}var i=l.dataType=="xml"||A.XMLDocument||e.isXMLDoc(A);s("isXml="+i);if(!i&&window.opera&&(A.body===null||!A.body.innerHTML)){if(--O){s("requeing onLoad callback, DOM not available");setTimeout(_,250);return}}var o=A.body?A.body:A.documentElement;m.responseText=o?o.innerHTML:null;m.responseXML=A.XMLDocument?A.XMLDocument:A;if(i){l.dataType="xml"}m.getResponseHeader=function(e){var t={"content-type":l.dataType};return t[e.toLowerCase()]};if(o){m.status=Number(o.getAttribute("status"))||m.status;m.statusText=o.getAttribute("statusText")||m.statusText}var u=(l.dataType||"").toLowerCase();var a=/(json|script|text)/.test(u);if(a||l.textarea){var f=A.getElementsByTagName("textarea")[0];if(f){m.responseText=f.value;m.status=Number(f.getAttribute("status"))||m.status;m.statusText=f.getAttribute("statusText")||m.statusText}else if(a){var c=A.getElementsByTagName("pre")[0];var p=A.getElementsByTagName("body")[0];if(c){m.responseText=c.textContent?c.textContent:c.innerText}else if(p){m.responseText=p.textContent?p.textContent:p.innerText}}}else if(u=="xml"&&!m.responseXML&&m.responseText){m.responseXML=D(m.responseText)}try{L=H(m,u,l)}catch(g){n="parsererror";m.error=r=g||n}}catch(g){s("error caught: ",g);n="error";m.error=r=g||n}if(m.aborted){s("upload aborted");n=null}if(m.status){n=m.status>=200&&m.status<300||m.status===304?"success":"error"}if(n==="success"){if(l.success){l.success.call(l.context,L,"success",m)}E.resolve(m.responseText,"success",m);if(h){e.event.trigger("ajaxSuccess",[m,l])}}else if(n){if(r===undefined){r=m.statusText}if(l.error){l.error.call(l.context,m,n,r)}E.reject(m,"error",r);if(h){e.event.trigger("ajaxError",[m,l,r])}}if(h){e.event.trigger("ajaxComplete",[m,l])}if(h&&!--e.active){e.event.trigger("ajaxStop")}if(l.complete){l.complete.call(l.context,m,n)}M=true;if(l.timeout){clearTimeout(w)}setTimeout(function(){if(!l.iframeTarget){d.remove()}else{d.attr("src",l.iframeSrc)}m.responseXML=null},100)}var o=a[0],u,f,l,h,p,d,v,m,g,y,b,w;var E=e.Deferred();E.abort=function(e){m.abort(e)};if(t){for(f=0;f<c.length;f++){u=e(c[f]);if(n){u.prop("disabled",false)}else{u.removeAttr("disabled")}}}l=e.extend(true,{},e.ajaxSettings,r);l.context=l.context||l;p="jqFormIO"+(new Date).getTime();if(l.iframeTarget){d=e(l.iframeTarget);y=d.attr2("name");if(!y){d.attr2("name",p)}else{p=y}}else{d=e('<iframe name="'+p+'" src="'+l.iframeSrc+'" />');d.css({position:"absolute",top:"-1000px",left:"-1000px"})}v=d[0];m={aborted:0,responseText:null,responseXML:null,status:0,statusText:"n/a",getAllResponseHeaders:function(){},getResponseHeader:function(){},setRequestHeader:function(){},abort:function(t){var n=t==="timeout"?"timeout":"aborted";s("aborting upload... "+n);this.aborted=1;try{if(v.contentWindow.document.execCommand){v.contentWindow.document.execCommand("Stop")}}catch(r){}d.attr("src",l.iframeSrc);m.error=n;if(l.error){l.error.call(l.context,m,n,t)}if(h){e.event.trigger("ajaxError",[m,l,n])}if(l.complete){l.complete.call(l.context,m,n)}}};h=l.global;if(h&&0===e.active++){e.event.trigger("ajaxStart")}if(h){e.event.trigger("ajaxSend",[m,l])}if(l.beforeSend&&l.beforeSend.call(l.context,m,l)===false){if(l.global){e.active--}E.reject();return E}if(m.aborted){E.reject();return E}g=o.clk;if(g){y=g.name;if(y&&!g.disabled){l.extraData=l.extraData||{};l.extraData[y]=g.value;if(g.type=="image"){l.extraData[y+".x"]=o.clk_x;l.extraData[y+".y"]=o.clk_y}}}var S=1;var x=2;var N=e("meta[name=csrf-token]").attr("content");var C=e("meta[name=csrf-param]").attr("content");if(C&&N){l.extraData=l.extraData||{};l.extraData[C]=N}if(l.forceSync){k()}else{setTimeout(k,10)}var L,A,O=50,M;var D=e.parseXML||function(e,t){if(window.ActiveXObject){t=new ActiveXObject("Microsoft.XMLDOM");t.async="false";t.loadXML(e)}else{t=(new DOMParser).parseFromString(e,"text/xml")}return t&&t.documentElement&&t.documentElement.nodeName!="parsererror"?t:null};var P=e.parseJSON||function(e){return window["eval"]("("+e+")")};var H=function(t,n,r){var i=t.getResponseHeader("content-type")||"",s=n==="xml"||!n&&i.indexOf("xml")>=0,o=s?t.responseXML:t.responseText;if(s&&o.documentElement.nodeName==="parsererror"){if(e.error){e.error("parsererror")}}if(r&&r.dataFilter){o=r.dataFilter(o,n)}if(typeof o==="string"){if(n==="json"||!n&&i.indexOf("json")>=0){o=P(o)}else if(n==="script"||!n&&i.indexOf("javascript")>=0){e.globalEval(o)}}return o};return E}if(!this.length){s("ajaxSubmit: skipping submit process - no element selected");return this}var i,o,u,a=this;if(typeof r=="function"){r={success:r}}else if(r===undefined){r={}}i=r.type||this.attr2("method");o=r.url||this.attr2("action");u=typeof o==="string"?e.trim(o):"";u=u||window.location.href||"";if(u){u=(u.match(/^([^#]+)/)||[])[1]}r=e.extend(true,{url:u,success:e.ajaxSettings.success,type:i||e.ajaxSettings.type,iframeSrc:/^https/i.test(window.location.href||"")?"javascript:false":"about:blank"},r);var f={};this.trigger("form-pre-serialize",[this,r,f]);if(f.veto){s("ajaxSubmit: submit vetoed via form-pre-serialize trigger");return this}if(r.beforeSerialize&&r.beforeSerialize(this,r)===false){s("ajaxSubmit: submit aborted via beforeSerialize callback");return this}var l=r.traditional;if(l===undefined){l=e.ajaxSettings.traditional}var c=[];var h,p=this.formToArray(r.semantic,c);if(r.data){r.extraData=r.data;h=e.param(r.data,l)}if(r.beforeSubmit&&r.beforeSubmit(p,this,r)===false){s("ajaxSubmit: submit aborted via beforeSubmit callback");return this}this.trigger("form-submit-validate",[p,this,r,f]);if(f.veto){s("ajaxSubmit: submit vetoed via form-submit-validate trigger");return this}var d=e.param(p,l);if(h){d=d?d+"&"+h:h}if(r.type.toUpperCase()=="GET"){r.url+=(r.url.indexOf("?")>=0?"&":"?")+d;r.data=null}else{r.data=d}var v=[];if(r.resetForm){v.push(function(){a.resetForm()})}if(r.clearForm){v.push(function(){a.clearForm(r.includeHidden)})}if(!r.dataType&&r.target){var m=r.success||function(){};v.push(function(t){var n=r.replaceTarget?"replaceWith":"html";e(r.target)[n](t).each(m,arguments)})}else if(r.success){v.push(r.success)}r.success=function(e,t,n){var i=r.context||this;for(var s=0,o=v.length;s<o;s++){v[s].apply(i,[e,t,n||a,a])}};if(r.error){var g=r.error;r.error=function(e,t,n){var i=r.context||this;g.apply(i,[e,t,n,a])}}if(r.complete){var y=r.complete;r.complete=function(e,t){var n=r.context||this;y.apply(n,[e,t,a])}}var b=e("input[type=file]:enabled",this).filter(function(){return e(this).val()!==""});var w=b.length>0;var E="multipart/form-data";var S=a.attr("enctype")==E||a.attr("encoding")==E;var x=t.fileapi&&t.formdata;s("fileAPI :"+x);var T=(w||S)&&!x;var N;if(r.iframe!==false&&(r.iframe||T)){if(r.closeKeepAlive){e.get(r.closeKeepAlive,function(){N=A(p)})}else{N=A(p)}}else if((w||S)&&x){N=L(p)}else{N=e.ajax(r)}a.removeData("jqxhr").data("jqxhr",N);for(var C=0;C<c.length;C++){c[C]=null}this.trigger("form-submit-notify",[this,r]);return this};e.fn.ajaxForm=function(t){t=t||{};t.delegation=t.delegation&&e.isFunction(e.fn.on);if(!t.delegation&&this.length===0){var n={s:this.selector,c:this.context};if(!e.isReady&&n.s){s("DOM not ready, queuing ajaxForm");e(function(){e(n.s,n.c).ajaxForm(t)});return this}s("terminating; zero elements found by selector"+(e.isReady?"":" (DOM not ready)"));return this}if(t.delegation){e(document).off("submit.form-plugin",this.selector,r).off("click.form-plugin",this.selector,i).on("submit.form-plugin",this.selector,t,r).on("click.form-plugin",this.selector,t,i);return this}return this.ajaxFormUnbind().bind("submit.form-plugin",t,r).bind("click.form-plugin",t,i)};e.fn.ajaxFormUnbind=function(){return this.unbind("submit.form-plugin click.form-plugin")};e.fn.formToArray=function(n,r){var i=[];if(this.length===0){return i}var s=this[0];var o=this.attr("id");var u=n?s.getElementsByTagName("*"):s.elements;var a;if(u&&!/MSIE [678]/.test(navigator.userAgent)){u=e(u).get()}if(o){a=e(':input[form="'+o+'"]').get();if(a.length){u=(u||[]).concat(a)}}if(!u||!u.length){return i}var f,l,c,h,p,d,v;for(f=0,d=u.length;f<d;f++){p=u[f];c=p.name;if(!c||p.disabled){continue}if(n&&s.clk&&p.type=="image"){if(s.clk==p){i.push({name:c,value:e(p).val(),type:p.type});i.push({name:c+".x",value:s.clk_x},{name:c+".y",value:s.clk_y})}continue}h=e.fieldValue(p,true);if(h&&h.constructor==Array){if(r){r.push(p)}for(l=0,v=h.length;l<v;l++){i.push({name:c,value:h[l]})}}else if(t.fileapi&&p.type=="file"){if(r){r.push(p)}var m=p.files;if(m.length){for(l=0;l<m.length;l++){i.push({name:c,value:m[l],type:p.type})}}else{i.push({name:c,value:"",type:p.type})}}else if(h!==null&&typeof h!="undefined"){if(r){r.push(p)}i.push({name:c,value:h,type:p.type,required:p.required})}}if(!n&&s.clk){var g=e(s.clk),y=g[0];c=y.name;if(c&&!y.disabled&&y.type=="image"){i.push({name:c,value:g.val()});i.push({name:c+".x",value:s.clk_x},{name:c+".y",value:s.clk_y})}}return i};e.fn.formSerialize=function(t){return e.param(this.formToArray(t))};e.fn.fieldSerialize=function(t){var n=[];this.each(function(){var r=this.name;if(!r){return}var i=e.fieldValue(this,t);if(i&&i.constructor==Array){for(var s=0,o=i.length;s<o;s++){n.push({name:r,value:i[s]})}}else if(i!==null&&typeof i!="undefined"){n.push({name:this.name,value:i})}});return e.param(n)};e.fn.fieldValue=function(t){for(var n=[],r=0,i=this.length;r<i;r++){var s=this[r];var o=e.fieldValue(s,t);if(o===null||typeof o=="undefined"||o.constructor==Array&&!o.length){continue}if(o.constructor==Array){e.merge(n,o)}else{n.push(o)}}return n};e.fieldValue=function(t,n){var r=t.name,i=t.type,s=t.tagName.toLowerCase();if(n===undefined){n=true}if(n&&(!r||t.disabled||i=="reset"||i=="button"||(i=="checkbox"||i=="radio")&&!t.checked||(i=="submit"||i=="image")&&t.form&&t.form.clk!=t||s=="select"&&t.selectedIndex==-1)){return null}if(s=="select"){var o=t.selectedIndex;if(o<0){return null}var u=[],a=t.options;var f=i=="select-one";var l=f?o+1:a.length;for(var c=f?o:0;c<l;c++){var h=a[c];if(h.selected){var p=h.value;if(!p){p=h.attributes&&h.attributes.value&&!h.attributes.value.specified?h.text:h.value}if(f){return p}u.push(p)}}return u}return e(t).val()};e.fn.clearForm=function(t){return this.each(function(){e("input,select,textarea",this).clearFields(t)})};e.fn.clearFields=e.fn.clearInputs=function(t){var n=/^(?:color|date|datetime|email|month|number|password|range|search|tel|text|time|url|week)$/i;return this.each(function(){var r=this.type,i=this.tagName.toLowerCase();if(n.test(r)||i=="textarea"){this.value=""}else if(r=="checkbox"||r=="radio"){this.checked=false}else if(i=="select"){this.selectedIndex=-1}else if(r=="file"){if(/MSIE/.test(navigator.userAgent)){e(this).replaceWith(e(this).clone(true))}else{e(this).val("")}}else if(t){if(t===true&&/hidden/.test(r)||typeof t=="string"&&e(this).is(t)){this.value=""}}})};e.fn.resetForm=function(){return this.each(function(){if(typeof this.reset=="function"||typeof this.reset=="object"&&!this.reset.nodeType){this.reset()}})};e.fn.enable=function(e){if(e===undefined){e=true}return this.each(function(){this.disabled=!e})};e.fn.selected=function(t){if(t===undefined){t=true}return this.each(function(){var n=this.type;if(n=="checkbox"||n=="radio"){this.checked=t}else if(this.tagName.toLowerCase()=="option"){var r=e(this).parent("select");if(t&&r[0]&&r[0].type=="select-one"){r.find("option").selected(false)}this.selected=t}})};e.fn.ajaxSubmit.debug=false})





uploadarea.onchange = evt => {
  const [file] = uploadarea.files
  if (file) {
    blah.innerHTML = "<img src='"+URL.createObjectURL(file)+"'>";
    previewfile();
  }

}

function previewfile() {
    fileName = document.getElementById('uploadarea').value;
    document.getElementById("previewfilelink").innerHTML = fileName.replace("fakepath","...");
    extension = fileName.split('.').pop();

    var image_exts = ['jpg','png','gif','jpeg','svg','psd','bmp','ai','tif','tiff'];
    var video_exts = ['mp4','mov','wmv','mpeg','flv','avi','webm','avchd'];
    var audio_exts = ['mp3','aif','cda','mid','mpa','ogg','wav','wma'];
    var coding_exts = ['html','htm','js','css','php','py','cs','cpp','class','c'];
    var docs_exts = ['doc','docx','txt','ppt','pptx','pps','xls','xlsx','csv'];

    if(image_exts.indexOf(extension) > -1){
        var nothing = 0;
    }else if(video_exts.indexOf(extension) > -1){
        $("#blah").html('<i class="icofont-file-avi-mp4"></i>');
    }else if(audio_exts.indexOf(extension) > -1){
        $("#blah").html('<i class="icofont-file-mp3"></i>');
    }else if(coding_exts.indexOf(extension) > -1){
        $("#blah").html('<i class="icofont-file-code"></i>');
    }else if(docs_exts.indexOf(extension) > -1){
        $("#blah").html('<i class="icofont-file-document"></i>');
    }else if("pdf".indexOf(extension) > -1){
        $("#blah").html('<i class="icofont-file-pdf"></i>');
    }else if("zip".indexOf(extension) > -1){
        $("#blah").html('<i class="icofont-file-zip"></i>');
    }else{
        $("#blah").html('<i class="icofont-file-file"></i>');
    }
}

function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";

  window.scrollTo(0, 0);
  check_login();
}


function myFunction() {
   
    var copyText = document.getElementById("dataydetails");

    /* Copy the text inside the text field */
    navigator.clipboard.writeText(copyText.innerText);
  
  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copied: Data Details";
}

function outFunc() {
  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copy to clipboard";
}

function gettextbox() {
    var range = document.createRange();
    range.selectNode(document.getElementById("viewtextbox"));
    window.getSelection().removeAllRanges(); // clear current selection
    window.getSelection().addRange(range); // to select text
    document.execCommand("copy");
    window.getSelection().removeAllRanges();// to deselect
  
  var tooltip = document.getElementById("viewTooltip");
  tooltip.innerHTML = "Copied Text Data";
}

function viewoutFunc() {
  var tooltip = document.getElementById("viewTooltip");
  tooltip.innerHTML = "Copy to clipboard";
}

function deletedata() {
		
		var datacode = document.getElementById("datacode").innerHTML;
        var datapin = document.getElementById("datapin").innerHTML;
		
		if(datacode==''){
			document.getElementById("inputperror").style.display = "inline";
		}else{
			$.ajax({
				url:"delete_data.php",
			method:"POST",
			data:{
				datacode: datacode,
                datapin: datapin,
				},
					
				dataType:"JSON",
				success:function(data){  
						//if the result is 10  
						if(data.status == 10){    
							document.getElementById("greenalertdiv").innerHTML = "&#128465; Data Deleted";
                            document.getElementById("greenalertdiv").style.display = "inline";
                            document.getElementById("filearea").style.display = "none";
                            setTimeout(closealerts, 3000);
						}else if(data.status == 11){    
							document.getElementById("redalertdiv").innerHTML = "&#128683; Data doesnt exist!";
                            document.getElementById("redalertdiv").style.display = "inline";
							setTimeout(closealerts, 3000);
						}else{    
							document.getElementById("redalertdiv").innerHTML = "&#128683; Error !!";
                            document.getElementById("redalertdiv").style.display = "inline";
							setTimeout(closealerts, 3000);
						}
				}				
			}); 
		}
			
}
function closealerts(){
    document.getElementById("greenalertdiv").style.display = "none";
    document.getElementById("redalertdiv").style.display = "none";
    
    document.getElementById("progress-div").style.display = "none";
}



function addtext() {
		
        var textdata = $('#textbox').val();
        var maxviews = $('#textmaxviews').val();
        document.getElementById("submitbtn").innerHTML='Uploading...';
        
        document.getElementById("filearea").style.display = "none";
        document.getElementById("dataviewarea").style.display = "none";
        document.getElementById("textdataviewarea").style.display = "none";
		
		if(textdata==''){
			document.getElementById("redalertdiv").innerHTML = "&#128683; Empty Data";
            document.getElementById("redalertdiv").style.display = "inline";
			setTimeout(closealerts, 3000);
            document.getElementById("submitbtn").innerHTML='UPLOAD';
		}else{
			$.ajax({
				url:"add_text_data.php",
			method:"POST",
			data:{
				textdata: textdata,
                maxviews: maxviews,
				},
					
				dataType:"JSON",
				success:function(data){  
						//if the result is 10  
						if(data.status == 10){ 
                            document.getElementById("fileimg").innerHTML = '<i class="icofont-file-alt"></i>';
                            document.getElementById("datacode").innerHTML = data.code;
                            document.getElementById("datapin").innerHTML = data.pin;
                            document.getElementById("dataurl").innerHTML = data.url;
                            document.getElementById("dataexp").innerHTML = data.exp;
                            document.getElementById("filearea").style.display = "block";
							document.getElementById("greenalertdiv").innerHTML = "&#9989; Data Uploaded";
                            document.getElementById("submitbtn").innerHTML='<i class="icofont-upload"></i> ENCRYPT & UPLOAD';
                            document.getElementById("greenalertdiv").style.display = "inline";
                            setTimeout(closealerts, 3000);
						}else{   
							document.getElementById("redalertdiv").innerHTML = "&#128683; Error !!";
                            document.getElementById("redalertdiv").style.display = "inline";
							setTimeout(closealerts, 3000);
                            document.getElementById("submitbtn").innerHTML='<i class="icofont-upload"></i> ENCRYPT & UPLOAD';
						}
				}				
			}); 
		}
			
}


function accessdata() {
		
        var datainputcode = $('#datainputcode').val();
        var datainputpin = $('#datainputpin').val();
        var maxviews = $('#maxviews').val();
        
        document.getElementById("dataviewarea").style.display = "none";
        document.getElementById("textdataviewarea").style.display = "none";
        document.getElementById("filearea").style.display = "none";
		
		if(datainputpin==''){
			document.getElementById("redalertdiv").innerHTML = "&#128683; Error !!";
            document.getElementById("redalertdiv").style.display = "inline";
			setTimeout(closealerts, 3000);
		}else{
			$.ajax({
				url:"access_data.php",
			method:"POST",
			data:{
				datainputcode: datainputcode,
                datainputpin: datainputpin,
				},
					
				dataType:"JSON",
				success:function(data){  
						//if the result is 10  
						if(data.status == 10){
                            if(data.type == '1'){
                                document.getElementById("viewfileimg").innerHTML = data.fileimg;   
                                document.getElementById("viewservercode").innerHTML = data.code;
                                document.getElementById("viewfileurl").innerHTML = data.url;
                                document.getElementById("viewfilename").innerHTML = data.filename;
                                document.getElementById("textdataviewarea").style.display = "none";
                                document.getElementById("dataviewarea").style.display = "block";
                                $("#secretIFrame").attr("src","download_file.php");
                            }else{  
                                document.getElementById("viewtextservercode").innerHTML = data.code;
                                document.getElementById("viewtextbox").value = data.texts;
                                document.getElementById("dataviewarea").style.display = "none";
                                document.getElementById("textdataviewarea").style.display = "block";
                            }

                            document.getElementById("datainputcode").value="";
                            document.getElementById("datainputpin").value="";
						}else if(data.status == 11){
                            document.getElementById("redalertdiv").innerHTML = "&#128683; Invalid Credentials";
                            document.getElementById("redalertdiv").style.display = "inline";
                            setTimeout(closealerts, 3000);
                            return false;
                        }else{
							document.getElementById("redalertdiv").innerHTML = "&#128683; Trouble Reaching Server";
                            document.getElementById("redalertdiv").style.display = "inline";
							setTimeout(closealerts, 3000);
                            return false;
						}
				}				
			}); 
		}
			
}


function downloadfile(datapin, datacode) {
		
    var datacode = datacode;
    var datapin = datapin;
    
    if(datacode==''){
        document.getElementById("redalertdiv").innerHTML = "&#128683; Error !!";
        document.getElementById("redalertdiv").style.display = "inline";
        setTimeout(closealerts, 3000);
    }else{
        $.ajax({
            url:"check_file.php",
        method:"POST",
        data:{
            datacode: datacode,
            datapin: datapin,
            },
                
            dataType:"JSON",
            success:function(data){  
                    //if the result is 10  
                    if(data.status == 10){    
                        document.getElementById("greenalertdiv").innerHTML = "&#9989; Download will start soon";
                        document.getElementById("greenalertdiv").style.display = "inline";
                        
                        $("#secretIFrame").attr("src","download_file.php?datacode="+datacode+"&datapin="+datapin+"");

                        setTimeout(closealerts, 3000);

                    }else{    
                        document.getElementById("redalertdiv").innerHTML = "&#128683; File doesnt exist!";
                        document.getElementById("redalertdiv").style.display = "inline";
                        setTimeout(closealerts, 3000);
                        document.getElementById("dataviewarea").style.display = "none";
                    }
            }				
        });

        

    }
        
}


$(document).ready(function(){

$("#but_upload").click(function(){
    document.getElementById("but_upload").innerHTML='Uploading...';
    var maxviews = $('#maxviews').val();
    var fd = new FormData();
    var files = $('.file')[0].files;
    document.getElementById("filearea").style.display = "none";
    document.getElementById("dataviewarea").style.display = "none";
    document.getElementById("textdataviewarea").style.display = "none";
    // Check file selected or not
    if(files.length > 0 ){
        
    document.getElementById("progress-div").style.display = "block";
       fd.append('file',files[0]);
       fd.append('maxviews',maxviews);

       $.ajax({
          url: 'upload_file.php',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          dataType:"JSON",
          success: function(data){
             if(data.status == 10){
                document.getElementById("uploadarea").value="";
                document.getElementById("blah").innerHTML = '<i class="icofont-cloud-upload"></i>';
                document.getElementById("previewfilelink").innerHTML = "Browse your device";
                document.getElementById("fileimg").innerHTML = data.iconlink;   
                document.getElementById("datacode").innerHTML = data.code;
                document.getElementById("datapin").innerHTML = data.pin;
                document.getElementById("dataurl").innerHTML = data.url;
                document.getElementById("dataexp").innerHTML = data.exp;
                document.getElementById("filearea").style.display = "block";
				document.getElementById("greenalertdiv").innerHTML = "&#9989; Data Uploaded";
                document.getElementById("greenalertdiv").style.display = "inline";
                document.getElementById("but_upload").innerHTML='<i class="icofont-upload"></i> ENCRYPT & UPLOAD';
                setTimeout(closealerts, 3000);
             }else{
                document.getElementById("redalertdiv").innerHTML = "&#128683; Trouble reaching server!!";
                document.getElementById("redalertdiv").style.display = "inline";
                document.getElementById("but_upload").innerHTML='<i class="icofont-upload"></i> ENCRYPT & UPLOAD';
				setTimeout(closealerts, 3000);
             }
          },
       });
    }else{
        document.getElementById("but_upload").innerHTML='<i class="icofont-upload"></i> ENCRYPT & UPLOAD';
        document.getElementById("redalertdiv").innerHTML = "&#128683; Please select a File!";
        document.getElementById("redalertdiv").style.display = "inline";
        setTimeout(closealerts, 3000);

        return false;

    }
});
});



$(document).ready(function() { 
    $('#myform').submit(function(e) {	
       if($('#uploadarea').val()) {
           e.preventDefault();
           $('#loader-icon').show();
           $(this).ajaxSubmit({ 
               beforeSubmit: function() {
                 $("#progress-bar").width('0%');
               },
               uploadProgress: function (event, position, total, percentComplete){	
                   $("#progress-bar").width(percentComplete + '%');
                   $("#progress-bar").html('<div id="progress-status">' + percentComplete +' %</div>')
               },
               success:function (){
                    $("#progress-bar").html('<div id="progress-status">' + percentComplete +' %</div>')
               },
               resetForm: true 
           }); 
           return false; 
       }
   });
}); 


function signup(){
    hideerror();
    $('#passwordbox').css("color", "#848282");
    var firstname = $('#firstname').val();
    var lastname = $('#lastname').val();
    var email = $('#email').val();
    var userpassword = $('#userpassword').val();
    var retypepass = $('#retypepass').val();

    var els = document.getElementsByClassName("checkit");
        var errorcheck = 0;
        for(var i = 0; i < els.length; i++)
        {
            if(els[i].value==''){
                els[i].style.borderBottom="2px solid #cc0000";
                var errorcheck = errorcheck+1;
            }else{
                els[i].style.borderBottom="1px solid #ccc";
            }
        }

    var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    
    if (email.match(validRegex)) {
        hideerror();
    }else{
        showerror('Invalid Email Address!');
        return 'no';
    }

    if(userpassword != retypepass){
        showerror('Passwords does not match!');
        var errorcheck = errorcheck+1;
    }else{
        var errorcheck = 0;
        hideerror();
    }

    if(errorcheck > 0){
        var goterror = "yes";
    }else{
        var regbtn = document.getElementById("regbtn");
        regbtn.innerHTML = "Registering...";
        regbtn.setAttribute('disabled', '');
        $.ajax({
            url:"registration_exec.php",
            method:"POST",
            data:{
                firstname: firstname,
                lastname: lastname,
                email: email,
                password: userpassword,
            },
            dataType:"JSON",
            success:function(data){
                    //if the result is 10  
                    if(data.status == 10){
                        openusermenu();
                        window.location.href="./";
                        closemodal();
                    }else if(data.status == 11){
                        showerror('Email already exists!');
                    }else if(data.status == 12){
                        $('#passwordbox').css("color", "#cc0000");
                        var regbtn = document.getElementById("regbtn");
                        regbtn.innerHTML = "PROCEED";
                        regbtn.removeAttribute('disabled', '');
                    }
            }

        });
    }
}

function showerror(errormsg){
    $('#signuperror').text(errormsg);
    $('#signuperror').css("display", "block");
    var regbtn = document.getElementById("regbtn");
    regbtn.removeAttribute('disabled', '');
    regbtn.innerHTML = "PROCEED";
}
function hideerror(){
    $('#signuperror').css("display", "none");
}

function openwindow(winID){
    $('#modalload').css("display", "block");
    var allwin = document.getElementsByClassName("popwindow");
    for(var i = 0; i < allwin.length; i++)
    {
       allwin[i].style.display="none";
    }
    $('#pop-modal').css("display", "block");
    
    var winID=winID;
    setTimeout(function(){realopen(winID)}, 0500);
}
function realopen(winID){
    $('#modalload').css("display", "none");
    $('.modal-box').css("display", "block");
    $('.'+winID).css("display", "block");
}

function closemodal(){
    $('#pop-modal').css("display", "none");
    $('.modal-box').css("display", "none");
}


function signinuser(){
    document.getElementById('loginerror').style.display='none';
    var email = document.getElementById('loginemail').value;
    var userpassword = document.getElementById('loginpassword').value;

        // Get relevant element
    rememberme = document.getElementById('rememberme');
    // Check if the element is selected/checked
    if(rememberme.checked) {
        // Respond to the result
        var rememberme="yes";
    }else{
        var rememberme="no";
    }

    var els = document.getElementsByClassName("checklogins");
    var errorcheck = 0;
    for(var i = 0; i < els.length; i++)
    {
        if(els[i].value==''){
            els[i].style.borderBottom="2px solid #cc0000";
            var errorcheck = errorcheck+1;
        }else{
            els[i].style.borderBottom="1px solid #ccc";
        }
    }

    if(errorcheck > 0){
        var goterror = "yes";
    }else{
        document.getElementById("sendbtn").innerHTML = "Checking...";
        $.ajax({
            url:"signin_exec.php",
            method:"POST",
            data:{
                email: email,
                userpassword: userpassword,
                rememberme: rememberme,
            },
            dataType:"JSON",
            success:function(data){  
                    //if the result is 10  
                    if(data.status == 10){
                        openusermenu();
                        document.getElementById("userfirstname").innerHTML = ""+data.firstname+"";
                        closemodal();
                        window.location.href="./";
                    }else if(data.status == 11){
                        document.getElementById('loginerror').style.display='block';
                        document.getElementById('loginerror').innerHTML='Invalid Login Credentials';
                        document.getElementById("sendbtn").innerHTML = "Sign in";
                    }else{
                        document.getElementById('loginerror').style.display='block';
                        document.getElementById('loginerror').innerHTML='Trouble connecting to server';
                        document.getElementById("sendbtn").innerHTML = "Sign in";
                    }
            }				
        }); 
    }

}

function openusermenu(){
    var els = document.getElementsByClassName("usermenu");
        var errorcheck = 0;
        for(var i = 0; i < els.length; i++)
        {
            els[i].style.display="block";
        }

        var els = document.getElementsByClassName("guestmenu");
        var errorcheck = 0;
        for(var i = 0; i < els.length; i++)
        {
            els[i].style.display="none";
        }
}

function openguestmenu(){
    var els = document.getElementsByClassName("guestmenu");
        var errorcheck = 0;
        for(var i = 0; i < els.length; i++)
        {
            els[i].style.display="block";
        }

        var els = document.getElementsByClassName("usermenu");
        var errorcheck = 0;
        for(var i = 0; i < els.length; i++)
        {
            els[i].style.display="block";
        }
}


function share(dataid){
    openwindow('sharebox');
    var dataid = dataid;
    $('#sharecode').text("Fetching data...");
                        $('#sharepin').text("Fetching data...");
                        $('#shareurl').text("Fetching data...");
                        $('#shareexp').text("Fetching data...");
        
        $.ajax({
            url:"access_details.php",
            method:"POST",
            data:{
                dataid: dataid,
            },
            dataType:"JSON",
            success:function(data){  
                    //if the result is 10  
                    if(data.status == 10){
                        $('#sharecode').text(data.code);
                        $('#sharepin').text(data.pin);
                        $('#shareurl').text(data.url);
                        $('#shareexp').text(data.exp);
                    }else if(data.status == 11){
                        document.getElementById("redalertdiv").innerHTML = "&#128683; User not Logged In!";
                        document.getElementById("redalertdiv").style.display = "inline";
                        setTimeout(closealerts, 3000);
                    }else if(data.status == 12){
                        $('#sharecode').text("N/A");
                        $('#sharepin').text("N/A");
                        $('#shareurl').text("N/A");
                        $('#shareexp').text('Data doesnt exist!');
                    }else{
                        document.getElementById("redalertdiv").innerHTML = "&#128683; Server Error!";
                        document.getElementById("redalertdiv").style.display = "inline";
                        setTimeout(closealerts, 3000);
                    }
            }				
        }); 
    

}

function copyshare() {
   
    var copyText = document.getElementById("sharedetails");

    /* Copy the text inside the text field */
    navigator.clipboard.writeText(copyText.innerText);
  
  var tooltip = document.getElementById("shareTooltip");
  tooltip.innerHTML = "Copied: Data Details";
}

function shareoutFunc() {
  var tooltip = document.getElementById("shareTooltip");
  tooltip.innerHTML = "Copy to clipboard";
}


function deleteuploaded(dataid) {
		
    var dataid = dataid;
    
    
        $.ajax({
            url:"delete_data.php",
        method:"POST",
        data:{
            uploaded: "YES",
            dataid: dataid,
            },
                
            dataType:"JSON",
            success:function(data){  
                    //if the result is 10  
                    if(data.status == 10){    
                        document.getElementById("greenalertdiv").innerHTML = "&#128465; Data Deleted";
                        document.getElementById("greenalertdiv").style.display = "inline";
                        document.getElementById("filearea").style.display = "none";
                        fetchuploads();
                        setTimeout(closealerts, 3000);
                    }else if(data.status == 11){
                        document.getElementById("redalertdiv").innerHTML = "&#128683; User not Logged In!";
                        document.getElementById("redalertdiv").style.display = "inline";
                        setTimeout(closealerts, 3000);
                    }else if(data.status == 12){
                        document.getElementById("redalertdiv").innerHTML = "&#128683; Data doesnt exist!";
                        document.getElementById("redalertdiv").style.display = "inline";
                        setTimeout(closealerts, 3000);
                    }else{    
                        document.getElementById("redalertdiv").innerHTML = "&#128683; Error !!";
                        document.getElementById("redalertdiv").style.display = "inline";
                        setTimeout(closealerts, 3000);
                    }
            }				
        }); 
    
}

function fetchuploads() {
    
        $.ajax({
            url:"fetch_uploaded.php",
        method:"POST",
        data:{
            uploaded: "YES",
            },
                
            dataType:"JSON",
            success:function(data){  
                    //if the result is 10  
                    if(data.status == 10){    
                        document.getElementById("alluploads").innerHTML = ''+data.uploads;
                    }else if(data.status == 11){
                        document.getElementById("alluploads").innerHTML = ' <div class="box-error"><i class="icofont-learn"></i> <br> <span>No uploads yet!</span></div>';
                    }else if(data.status == 12){
                        window.location.href="./";
                    }else{    
                        document.getElementById("redalertdiv").innerHTML = "&#128683; Error !!";
                        document.getElementById("redalertdiv").style.display = "inline";
                        setTimeout(closealerts, 3000);
                    }
            }				
        }); 
    
}

function logoutuser() {
    
    $.ajax({
        url:"logout.php",
    method:"POST",
    data:{
        user: "YES",
        },
            
        dataType:"JSON",
        success:function(data){  
                //if the result is 10  
                if(data.status == 10){ 
                    window.location.href="./";
                }else{    
                    closemodal();
                }
        }				
    }); 

}



function changepass(){
    hidechangepasserror();
    $('#passwordbox').css("color", "#848282");
    var oldpass = $('#oldpass').val();
    var newpass = $('#newpass').val();
    var retypenewpass = $('#retypenewpass').val();

    var els = document.getElementsByClassName("passcheckit");
        var errorcheck = 0;
        for(var i = 0; i < els.length; i++)
        {
            if(els[i].value==''){
                els[i].style.borderBottom="2px solid #cc0000";
                var errorcheck = errorcheck+1;
            }else{
                els[i].style.borderBottom="1px solid #ccc";
            }
        }

        var regbtn = document.getElementById("changepassbtn");
    if(newpass != retypenewpass){
        showchangepasserror('Passwords does not match!');
        var errorcheck = errorcheck+1;
    }else{
        var errorcheck = 0;
        hidechangepasserror();
    }

    if(errorcheck > 0){
        var goterror = "yes";
    }else{
        regbtn.innerHTML = "Processing...";
        regbtn.setAttribute('disabled', '');
        $.ajax({
            url:"changepass_exec.php",
            method:"POST",
            data:{
                oldpass: oldpass,
                newpass: newpass,
            },
            dataType:"JSON",
            success:function(data){
                    //if the result is 10  
                    if(data.status == 10){
                        for(var i = 0; i < els.length; i++)
                        {
                            els[i].value="";
                        }
                        regbtn.innerHTML = "PROCEED";
                        regbtn.removeAttribute('disabled', '');
                        closemodal();
                        document.getElementById("greenalertdiv").innerHTML = "&#9989; Password Changed";
                        document.getElementById("greenalertdiv").style.display = "inline";
                        setTimeout(closealerts, 3000);
                    }else if(data.status == 11){
                        showchangepasserror('User not Found! Login Again');
                        regbtn.removeAttribute('disabled', '');
                    }else if(data.status == 12){
                        showchangepasserror('Old Password is wrong!');
                        regbtn.removeAttribute('disabled', '');
                    }else if(data.status == 13){
                        $('#changepasswordbox').css("color", "#cc0000");
                        regbtn.innerHTML = "PROCEED";
                        regbtn.removeAttribute('disabled', '');
                    }
            }

        });
    }
}

function hidechangepasserror(){
    $('#changepasserror').css("display", "none");
}

function showchangepasserror(errormsg){
    $('#changepasserror').text(errormsg);
    $('#changepasserror').css("display", "block");
    var regbtn = document.getElementById("changepassbtn");
    regbtn.removeAttribute('disabled', '');
    regbtn.innerHTML = "PROCEED";
}


function editprofile(){
    hidepersonalerror();
    var editfirstname = $('#editfirstname').val();
    var editlastname = $('#editlastname').val();
    var editemail = $('#editemail').val();

    var els = document.getElementsByClassName("perscheckit");
        var errorcheck = 0;
        for(var i = 0; i < els.length; i++)
        {
            if(els[i].value==''){
                els[i].style.borderBottom="2px solid #cc0000";
                var errorcheck = errorcheck+1;
            }else{
                els[i].style.borderBottom="1px solid #ccc";
            }
        }

        var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    
    if (editemail.match(validRegex)) {
        hidepersonalerror();
    }else{
        showpersonalerror('Invalid Email Address!');
        return 'no';
    }

        var regbtn = document.getElementById("changepersbtn");

    if(errorcheck > 0){
        var goterror = "yes";
    }else{
        regbtn.innerHTML = "Processing...";
        regbtn.setAttribute('disabled', '');
        $.ajax({
            url:"edit_profile.php",
            method:"POST",
            data:{
                newfirstname: editfirstname,
                newlastname: editlastname,
                newemail: editemail,
            },
            dataType:"JSON",
            success:function(data){
                    //if the result is 10  
                    if(data.status == 10){
                        $('#profile-name').text(''+editfirstname+' '+editlastname+'');
                        $('#account-email').text(''+editemail+'');
                        $('#userfirstname').text(''+editfirstname+'');
                        
                        regbtn.innerHTML = "PROCEED";
                        regbtn.removeAttribute('disabled', '');
                        closemodal();
                        document.getElementById("greenalertdiv").innerHTML = "&#9989; Profile Updated";
                        document.getElementById("greenalertdiv").style.display = "inline";
                        setTimeout(closealerts, 3000);

                    }else if(data.status == 11){
                        showpersonalerror('User not Found! Login Again');
                        regbtn.removeAttribute('disabled', '');
                    }else if(data.status == 12){
                        showpersonalerror('Email already exist!');
                        regbtn.removeAttribute('disabled', '');
                    }else{
                        document.getElementById("redalertdiv").innerHTML = "&#128683; Server/Network Error!";
                        document.getElementById("redalertdiv").style.display = "inline";
                        regbtn.removeAttribute('disabled', '');
                        setTimeout(closealerts, 3000);
                    }
            }

        });
    }
}

function hidepersonalerror(){
    $('#personalerror').css("display", "none");
}

function showpersonalerror(errormsg){
    $('#personalerror').text(errormsg);
    $('#personalerror').css("display", "block");
    var regbtn = document.getElementById("changepersbtn");
    regbtn.removeAttribute('disabled', '');
    regbtn.innerHTML = "PROCEED";
}


function check_login() {
    
    $.ajax({
        url:"check_login.php",
    method:"POST",
    data:{
        user: "YES",
        },
            
        dataType:"JSON",
        success:function(data){  
                //if the result is 10  
                if(data.status == 10){ 
                    window.location.href="./";
                    alert("Security: You are Logged Out");  
                }else{  
                    var userexist="yes";
                }
        }				
    }); 

}



