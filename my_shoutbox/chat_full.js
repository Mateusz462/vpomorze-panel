/*
* Usama Ejaz
* thedeveloper24.com
* osamaejaz1[at]gmail.com
*/



/*!
 * Autolinker.js
 * 0.18.1
 *
 * Copyright(c) 2015 Gregory Jacobs <greg@greg-jacobs.com>
 * MIT Licensed. http://www.opensource.org/licenses/mit-license.php
 *
 * https://github.com/gregjacobs/Autolinker.js
 */
!function(a,b){"function"==typeof define&&define.amd?define([],function(){return a.Autolinker=b()}):"object"==typeof exports?module.exports=b():a.Autolinker=b()}(this,function(){var a=function(b){a.Util.assign(this,b);var c=this.hashtag;if(c!==!1&&"twitter"!==c&&"facebook"!==c)throw new Error("invalid `hashtag` cfg - see docs")};return a.prototype={constructor:a,urls:!0,email:!0,twitter:!0,phone:!0,hashtag:!1,newWindow:!0,stripPrefix:!0,truncate:void 0,className:"",htmlParser:void 0,matchParser:void 0,tagBuilder:void 0,link:function(a){if(!a)return"";for(var b=this.getHtmlParser(),c=b.parse(a),d=0,e=[],f=0,g=c.length;g>f;f++){var h=c[f],i=h.getType(),j=h.getText();if("element"===i)"a"===h.getTagName()&&(h.isClosing()?d=Math.max(d-1,0):d++),e.push(j);else if("entity"===i||"comment"===i)e.push(j);else if(0===d){var k=this.linkifyStr(j);e.push(k)}else e.push(j)}return e.join("")},linkifyStr:function(a){return this.getMatchParser().replace(a,this.createMatchReturnVal,this)},createMatchReturnVal:function(b){var c;if(this.replaceFn&&(c=this.replaceFn.call(this,this,b)),"string"==typeof c)return c;if(c===!1)return b.getMatchedText();if(c instanceof a.HtmlTag)return c.toAnchorString();var d=this.getTagBuilder(),e=d.build(b);return e.toAnchorString()},getHtmlParser:function(){var b=this.htmlParser;return b||(b=this.htmlParser=new a.htmlParser.HtmlParser),b},getMatchParser:function(){var b=this.matchParser;return b||(b=this.matchParser=new a.matchParser.MatchParser({urls:this.urls,email:this.email,twitter:this.twitter,phone:this.phone,hashtag:this.hashtag,stripPrefix:this.stripPrefix})),b},getTagBuilder:function(){var b=this.tagBuilder;return b||(b=this.tagBuilder=new a.AnchorTagBuilder({newWindow:this.newWindow,truncate:this.truncate,className:this.className})),b}},a.link=function(b,c){var d=new a(c);return d.link(b)},a.match={},a.htmlParser={},a.matchParser={},a.Util={abstractMethod:function(){throw"abstract"},trimRegex:/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,assign:function(a,b){for(var c in b)b.hasOwnProperty(c)&&(a[c]=b[c]);return a},extend:function(b,c){var d=b.prototype,e=function(){};e.prototype=d;var f;f=c.hasOwnProperty("constructor")?c.constructor:function(){d.constructor.apply(this,arguments)};var g=f.prototype=new e;return g.constructor=f,g.superclass=d,delete c.constructor,a.Util.assign(g,c),f},ellipsis:function(a,b,c){return a.length>b&&(c=null==c?"..":c,a=a.substring(0,b-c.length)+c),a},indexOf:function(a,b){if(Array.prototype.indexOf)return a.indexOf(b);for(var c=0,d=a.length;d>c;c++)if(a[c]===b)return c;return-1},splitAndCapture:function(a,b){if(!b.global)throw new Error("`splitRegex` must have the 'g' flag set");for(var c,d=[],e=0;c=b.exec(a);)d.push(a.substring(e,c.index)),d.push(c[0]),e=c.index+c[0].length;return d.push(a.substring(e)),d},trim:function(a){return a.replace(this.trimRegex,"")}},a.HtmlTag=a.Util.extend(Object,{whitespaceRegex:/\s+/,constructor:function(b){a.Util.assign(this,b),this.innerHtml=this.innerHtml||this.innerHTML},setTagName:function(a){return this.tagName=a,this},getTagName:function(){return this.tagName||""},setAttr:function(a,b){var c=this.getAttrs();return c[a]=b,this},getAttr:function(a){return this.getAttrs()[a]},setAttrs:function(b){var c=this.getAttrs();return a.Util.assign(c,b),this},getAttrs:function(){return this.attrs||(this.attrs={})},setClass:function(a){return this.setAttr("class",a)},addClass:function(b){for(var c,d=this.getClass(),e=this.whitespaceRegex,f=a.Util.indexOf,g=d?d.split(e):[],h=b.split(e);c=h.shift();)-1===f(g,c)&&g.push(c);return this.getAttrs()["class"]=g.join(" "),this},removeClass:function(b){for(var c,d=this.getClass(),e=this.whitespaceRegex,f=a.Util.indexOf,g=d?d.split(e):[],h=b.split(e);g.length&&(c=h.shift());){var i=f(g,c);-1!==i&&g.splice(i,1)}return this.getAttrs()["class"]=g.join(" "),this},getClass:function(){return this.getAttrs()["class"]||""},hasClass:function(a){return-1!==(" "+this.getClass()+" ").indexOf(" "+a+" ")},setInnerHtml:function(a){return this.innerHtml=a,this},getInnerHtml:function(){return this.innerHtml||""},toAnchorString:function(){var a=this.getTagName(),b=this.buildAttrsStr();return b=b?" "+b:"",["<",a,b,">",this.getInnerHtml(),"</",a,">"].join("")},buildAttrsStr:function(){if(!this.attrs)return"";var a=this.getAttrs(),b=[];for(var c in a)a.hasOwnProperty(c)&&b.push(c+'="'+a[c]+'"');return b.join(" ")}}),a.AnchorTagBuilder=a.Util.extend(Object,{constructor:function(b){a.Util.assign(this,b)},build:function(b){var c=new a.HtmlTag({tagName:"a",attrs:this.createAttrs(b.getType(),b.getAnchorHref()),innerHtml:this.processAnchorText(b.getAnchorText())});return c},createAttrs:function(a,b){var c={href:b},d=this.createCssClass(a);return d&&(c["class"]=d),this.newWindow&&(c.target="_blank"),c},createCssClass:function(a){var b=this.className;return b?b+" "+b+"-"+a:""},processAnchorText:function(a){return a=this.doTruncate(a)},doTruncate:function(b){return a.Util.ellipsis(b,this.truncate||Number.POSITIVE_INFINITY)}}),a.htmlParser.HtmlParser=a.Util.extend(Object,{htmlRegex:function(){var a=/!--([\s\S]+?)--/,b=/[0-9a-zA-Z][0-9a-zA-Z:]*/,c=/[^\s\0"'>\/=\x01-\x1F\x7F]+/,d=/(?:"[^"]*?"|'[^']*?'|[^'"=<>`\s]+)/,e=c.source+"(?:\\s*=\\s*"+d.source+")?";return new RegExp(["(?:","<(!DOCTYPE)","(?:","\\s+","(?:",e,"|",d.source+")",")*",">",")","|","(?:","<(/)?","(?:",a.source,"|","(?:","("+b.source+")","(?:","\\s+",e,")*","\\s*/?",")",")",">",")"].join(""),"gi")}(),htmlCharacterEntitiesRegex:/(&nbsp;|&#160;|&lt;|&#60;|&gt;|&#62;|&quot;|&#34;|&#39;)/gi,parse:function(a){for(var b,c,d=this.htmlRegex,e=0,f=[];null!==(b=d.exec(a));){var g=b[0],h=b[3],i=b[1]||b[4],j=!!b[2],k=a.substring(e,b.index);k&&(c=this.parseTextAndEntityNodes(k),f.push.apply(f,c)),f.push(h?this.createCommentNode(g,h):this.createElementNode(g,i,j)),e=b.index+g.length}if(e<a.length){var l=a.substring(e);l&&(c=this.parseTextAndEntityNodes(l),f.push.apply(f,c))}return f},parseTextAndEntityNodes:function(b){for(var c=[],d=a.Util.splitAndCapture(b,this.htmlCharacterEntitiesRegex),e=0,f=d.length;f>e;e+=2){var g=d[e],h=d[e+1];g&&c.push(this.createTextNode(g)),h&&c.push(this.createEntityNode(h))}return c},createCommentNode:function(b,c){return new a.htmlParser.CommentNode({text:b,comment:a.Util.trim(c)})},createElementNode:function(b,c,d){return new a.htmlParser.ElementNode({text:b,tagName:c.toLowerCase(),closing:d})},createEntityNode:function(b){return new a.htmlParser.EntityNode({text:b})},createTextNode:function(b){return new a.htmlParser.TextNode({text:b})}}),a.htmlParser.HtmlNode=a.Util.extend(Object,{text:"",constructor:function(b){a.Util.assign(this,b)},getType:a.Util.abstractMethod,getText:function(){return this.text}}),a.htmlParser.CommentNode=a.Util.extend(a.htmlParser.HtmlNode,{comment:"",getType:function(){return"comment"},getComment:function(){return this.comment}}),a.htmlParser.ElementNode=a.Util.extend(a.htmlParser.HtmlNode,{tagName:"",closing:!1,getType:function(){return"element"},getTagName:function(){return this.tagName},isClosing:function(){return this.closing}}),a.htmlParser.EntityNode=a.Util.extend(a.htmlParser.HtmlNode,{getType:function(){return"entity"}}),a.htmlParser.TextNode=a.Util.extend(a.htmlParser.HtmlNode,{getType:function(){return"text"}}),a.matchParser.MatchParser=a.Util.extend(Object,{urls:!0,email:!0,twitter:!0,phone:!0,hashtag:!1,stripPrefix:!0,matcherRegex:function(){var a=/(^|[^\w])@(\w{1,15})/,b=/(^|[^\w])#(\w{1,139})/,c=/(?:[\-;:&=\+\$,\w\.]+@)/,d=/(?:\+?\d{1,3}[-\s.])?\(?\d{3}\)?[-\s.]?\d{3}[-\s.]\d{4}/,e=/(?:[A-Za-z][-.+A-Za-z0-9]+:(?![A-Za-z][-.+A-Za-z0-9]+:\/\/)(?!\d+\/?)(?:\/\/)?)/,f=/(?:www\.)/,g=/[A-Za-z0-9\.\-]*[A-Za-z0-9\-]/,h=/\.(?:international|construction|contractors|enterprises|photography|productions|foundation|immobilien|industries|management|properties|technology|christmas|community|directory|education|equipment|institute|marketing|solutions|vacations|bargains|boutique|builders|catering|cleaning|clothing|computer|democrat|diamonds|graphics|holdings|lighting|partners|plumbing|supplies|training|ventures|academy|careers|company|cruises|domains|exposed|flights|florist|gallery|guitars|holiday|kitchen|neustar|okinawa|recipes|rentals|reviews|shiksha|singles|support|systems|agency|berlin|camera|center|coffee|condos|dating|estate|events|expert|futbol|kaufen|luxury|maison|monash|museum|nagoya|photos|repair|report|social|supply|tattoo|tienda|travel|viajes|villas|vision|voting|voyage|actor|build|cards|cheap|codes|dance|email|glass|house|mango|ninja|parts|photo|shoes|solar|today|tokyo|tools|watch|works|aero|arpa|asia|best|bike|blue|buzz|camp|club|cool|coop|farm|fish|gift|guru|info|jobs|kiwi|kred|land|limo|link|menu|mobi|moda|name|pics|pink|post|qpon|rich|ruhr|sexy|tips|vote|voto|wang|wien|wiki|zone|bar|bid|biz|cab|cat|ceo|com|edu|gov|int|kim|mil|net|onl|org|pro|pub|red|tel|uno|wed|xxx|xyz|ac|ad|ae|af|ag|ai|al|am|an|ao|aq|ar|as|at|au|aw|ax|az|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|cr|cu|cv|cw|cx|cy|cz|de|dj|dk|dm|do|dz|ec|ee|eg|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gg|gh|gi|gl|gm|gn|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|im|in|io|iq|ir|is|it|je|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nc|ne|nf|ng|ni|nl|no|np|nr|nu|nz|om|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|ps|pt|pw|py|qa|re|ro|rs|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sx|sy|sz|tc|td|tf|tg|th|tj|tk|tl|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|za|zm|zw)\b/,i=/[\-A-Za-z0-9+&@#\/%=~_()|'$*\[\]?!:,.;]*[\-A-Za-z0-9+&@#\/%=~_()|'$*\[\]]/;return new RegExp(["(",a.source,")","|","(",c.source,g.source,h.source,")","|","(","(?:","(",e.source,g.source,")","|","(?:","(.?//)?",f.source,g.source,")","|","(?:","(.?//)?",g.source,h.source,")",")","(?:"+i.source+")?",")","|","(",d.source,")","|","(",b.source,")"].join(""),"gi")}(),charBeforeProtocolRelMatchRegex:/^(.)?\/\//,constructor:function(b){a.Util.assign(this,b),this.matchValidator=new a.MatchValidator},replace:function(a,b,c){var d=this;return a.replace(this.matcherRegex,function(a,e,f,g,h,i,j,k,l,m,n,o,p){var q=d.processCandidateMatch(a,e,f,g,h,i,j,k,l,m,n,o,p);if(q){var r=b.call(c,q.match);return q.prefixStr+r+q.suffixStr}return a})},processCandidateMatch:function(b,c,d,e,f,g,h,i,j,k,l,m,n){var o,p=i||j,q="",r="";if(g&&!this.urls||f&&!this.email||k&&!this.phone||c&&!this.twitter||l&&!this.hashtag||!this.matchValidator.isValidMatch(g,h,p))return null;if(this.matchHasUnbalancedClosingParen(b))b=b.substr(0,b.length-1),r=")";else{var s=this.matchHasInvalidCharAfterTld(g,h);s>-1&&(r=b.substr(s),b=b.substr(0,s))}if(f)o=new a.match.Email({matchedText:b,email:f});else if(c)d&&(q=d,b=b.slice(1)),o=new a.match.Twitter({matchedText:b,twitterHandle:e});else if(k){var t=b.replace(/\D/g,"");o=new a.match.Phone({matchedText:b,number:t})}else if(l)m&&(q=m,b=b.slice(1)),o=new a.match.Hashtag({matchedText:b,serviceName:this.hashtag,hashtag:n});else{if(p){var u=p.match(this.charBeforeProtocolRelMatchRegex)[1]||"";u&&(q=u,b=b.slice(1))}o=new a.match.Url({matchedText:b,url:b,protocolUrlMatch:!!h,protocolRelativeMatch:!!p,stripPrefix:this.stripPrefix})}return{prefixStr:q,suffixStr:r,match:o}},matchHasUnbalancedClosingParen:function(a){var b=a.charAt(a.length-1);if(")"===b){var c=a.match(/\(/g),d=a.match(/\)/g),e=c&&c.length||0,f=d&&d.length||0;if(f>e)return!0}return!1},matchHasInvalidCharAfterTld:function(a,b){if(!a)return-1;var c=0;b&&(c=a.indexOf(":"),a=a.slice(c));var d=/^((.?\/\/)?[A-Za-z0-9\.\-]*[A-Za-z0-9\-]\.[A-Za-z]+)/,e=d.exec(a);return null===e?-1:(c+=e[1].length,a=a.slice(e[1].length),/^[^.A-Za-z:\/?#]/.test(a)?c:-1)}}),a.MatchValidator=a.Util.extend(Object,{invalidProtocolRelMatchRegex:/^[\w]\/\//,hasFullProtocolRegex:/^[A-Za-z][-.+A-Za-z0-9]+:\/\//,uriSchemeRegex:/^[A-Za-z][-.+A-Za-z0-9]+:/,hasWordCharAfterProtocolRegex:/:[^\s]*?[A-Za-z]/,isValidMatch:function(a,b,c){return b&&!this.isValidUriScheme(b)||this.urlMatchDoesNotHaveProtocolOrDot(a,b)||this.urlMatchDoesNotHaveAtLeastOneWordChar(a,b)||this.isInvalidProtocolRelativeMatch(c)?!1:!0},isValidUriScheme:function(a){var b=a.match(this.uriSchemeRegex)[0].toLowerCase();return"javascript:"!==b&&"vbscript:"!==b},urlMatchDoesNotHaveProtocolOrDot:function(a,b){return!(!a||b&&this.hasFullProtocolRegex.test(b)||-1!==a.indexOf("."))},urlMatchDoesNotHaveAtLeastOneWordChar:function(a,b){return a&&b?!this.hasWordCharAfterProtocolRegex.test(a):!1},isInvalidProtocolRelativeMatch:function(a){return!!a&&this.invalidProtocolRelMatchRegex.test(a)}}),a.match.Match=a.Util.extend(Object,{constructor:function(b){a.Util.assign(this,b)},getType:a.Util.abstractMethod,getMatchedText:function(){return this.matchedText},getAnchorHref:a.Util.abstractMethod,getAnchorText:a.Util.abstractMethod}),a.match.Email=a.Util.extend(a.match.Match,{getType:function(){return"email"},getEmail:function(){return this.email},getAnchorHref:function(){return"mailto:"+this.email},getAnchorText:function(){return this.email}}),a.match.Hashtag=a.Util.extend(a.match.Match,{getType:function(){return"hashtag"},getHashtag:function(){return this.hashtag},getAnchorHref:function(){var a=this.serviceName,b=this.hashtag;switch(a){case"twitter":return"https://twitter.com/hashtag/"+b;case"facebook":return"https://www.facebook.com/hashtag/"+b;default:throw new Error("Unknown service name to point hashtag to: ",a)}},getAnchorText:function(){return"#"+this.hashtag}}),a.match.Phone=a.Util.extend(a.match.Match,{getType:function(){return"phone"},getNumber:function(){return this.number},getAnchorHref:function(){return"tel:"+this.number},getAnchorText:function(){return this.matchedText}}),a.match.Twitter=a.Util.extend(a.match.Match,{getType:function(){return"twitter"},getTwitterHandle:function(){return this.twitterHandle},getAnchorHref:function(){return"https://twitter.com/"+this.twitterHandle},getAnchorText:function(){return"@"+this.twitterHandle}}),a.match.Url=a.Util.extend(a.match.Match,{urlPrefixRegex:/^(https?:\/\/)?(www\.)?/i,protocolRelativeRegex:/^\/\//,protocolPrepended:!1,getType:function(){return"url"},getUrl:function(){var a=this.url;return this.protocolRelativeMatch||this.protocolUrlMatch||this.protocolPrepended||(a=this.url="http://"+a,this.protocolPrepended=!0),a},getAnchorHref:function(){var a=this.getUrl();return a.replace(/&amp;/g,"&")},getAnchorText:function(){var a=this.getUrl();return this.protocolRelativeMatch&&(a=this.stripProtocolRelativePrefix(a)),this.stripPrefix&&(a=this.stripUrlPrefix(a)),a=this.removeTrailingSlash(a)},stripUrlPrefix:function(a){return a.replace(this.urlPrefixRegex,"")},stripProtocolRelativePrefix:function(a){return a.replace(this.protocolRelativeRegex,"")},removeTrailingSlash:function(a){return"/"===a.charAt(a.length-1)&&(a=a.slice(0,-1)),a}}),a});




url=document.location.href;



function trim(str){
	return str.trim();
}
function dynamicSort(property, property2) {
    var sortOrder = 1;
    if(property[0] === "-") {
        sortOrder = -1;
        property = property.substr(1);
    }
    return function (a,b) {
        var result = (a[property] < b[property]) ? -1 : (a[property] > b[property]) ? 1 : 0;
        return result * sortOrder;
    }
}


function chat_heartbeat(){ 
var time = Math.round(new Date().getTime()/1000.0); 
$.ajax({
dataType: "json",
url: base_url+"read.php",
success: function(data){
//data=data.sort(dynamicSort("time"));
data=data.sort(function(obj1, obj2) {
	return obj1.id - obj2.id;
});
var items = [];
$.each( data, function( key, val ) {
if($("#chat"+val['id']).length=="0"){

message=val['message'];
message=Autolinker.link(message, {truncate: 60});
var emoticon_folder = emoticon_folder || "http://usamaejaz-html-files.googlecode.com/git/emoticons/";
	var emotes ={
	    "heart": Array("&lt;3"),
	    "thumbsup": Array("\\(y\\)","\\(Y\\)"),
	    "happy": Array(":\\)\\)"),
	    "smile": Array(":-\\)",":\\)","=\\]","=\\)"),
	    "grin": Array(":D",":-D",":d",":-d"),
	    "sad": Array(":-\\(",":\\("),
	    "cool": Array("8\\)","8-\\)","B\\)","B\\|"),
	    "surprised": Array(":o",":-o",":O",":-O"),
	    "tongue": Array(":P",":-P",":p",":-p"),
	    "waii": Array("3\\)","3-\\)"),
	    "angry": Array("&gt;_&lt;"),
	    "crying": Array(":'\\("),
	    "wink": Array(";\\)",";-\\)")
	};
	var emoticonimgprefix = emoticonimgprefix || "emoticon_";
	    for(var emoticon in emotes){
	        for(var i = 0; i < emotes[emoticon].length; i++){
	            var re = new RegExp(emotes[emoticon][i],"g");
	            message = message.replace(re,"<img align=\"absmiddle\" src=\""+emoticon_folder+emoticonimgprefix+emoticon+".png\" alt=\""+emoticon+"\" title=\""+emoticon+"\" style=\"border:none;height:16px;width:16px;\" />");
	            }
	        }

val['message']=message;
$("#chatmessages").append( "<div class='chat-container' id='chat" + val['id'] + "'><a id='chatter_href' onclick='return false;' href='"+val['url']+"'>"+val['name']+":</a>&nbsp;" + val['message'] + "</div>" );
$('#chatmessages').scrollTop($('#chatmessages')[0].scrollHeight);
}
});
setTimeout(function(){ chat_heartbeat(); }, 100);
},
  error:function(){
	chat_heartbeat();
  }
});
}
function getChatterName(){
$.ajax({
  type: 'GET',
  url: base_url+'misc.php?action=getname',
  success:function(data){
	chatter=$("#chatform #chatter_name");
	if(data!=''){
		if(!(chatter.attr("disabled"))){
			chatter.val(data).attr("disabled","disabled");
		}
	} else {
		if((chatter.attr("disabled"))){
			chatter.removeAttr("disabled");
		}
	}
	setTimeout(function(){ getChatterName(); }, 100);
  },
  error:function(){
	getChatterName();
  }
});
}

$(function(){

$("div.chat_window").append('<div class="chat_wrapper"><div id="chat_header">'+chat_header_title+' <span style="float:right;"><a href="http://www.thedeveloper24.com">?</a></span></div><div id="chatmessages"></div><div id="chatposter"></div></div>');

chat_heartbeat();
getChatterName();

$("#chatposter").append('<form id="chatform" method="POST" action="'+base_url+'post.php"><input id="chatter_name" type="text" name="name" placeholder="Name" /><div id="post_status"></div><input id="postmsg_btn" type="submit" value="Post" /><textarea id="chat_msg" type="text" name="message" style="width:100%;" placeholder="Message"></textarea></form>');

$("#chatform").on("submit",function(e){

e.preventDefault();

value=$("#chatform #chat_msg").val();

value=$.trim(value);

$("#chatform #chat_msg").val(value);

if(($("#chatform #chatter_name").val()!="") && ($("#chatform #chat_msg").val()!="")){
$.ajax({
  type: 'POST',
  url: 'post.php',
  data: $("#chatform").serialize()+"&url="+url,
  beforeSend:function(){
	$("#post_status").empty().append('<i>Posting...</i>').show();
	msg=$("#chatform #chat_msg").val();
	$("#chatform #chat_msg").val("");
  },
  success:function(data){
	if(data=='error'){
		$("#post_status").empty().append('<strong>Try again</strong>');
	} else {
		$("#addlink").removeAttr("checked");
		$("#post_status").hide();
	}
  },
  error:function(){
	$("#post_status").empty().append('<strong>Network error</strong>').show();
	$("#chatform #chat_msg").val(msg);
  }
});
} else {
$("#post_status").empty().append('<strong>Please fill all fields</strong>').show();
}
});

$("#chatform #chat_msg").on("keydown",function(e){

var code = e.keyCode || e.which;

if (code == 13 && !e.shiftKey){
e.preventDefault();

value=$(this).val();

value=$.trim(value);

$(this).val(value);

if($(this).val()!=""){
	$(this).closest("form").submit();
} else {
	$("#post_status").empty().append('<strong>Please fill all fields</strong>').show();
}

}


});

});