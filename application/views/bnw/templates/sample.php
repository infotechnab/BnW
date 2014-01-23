<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
 <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
//<![CDATA[
bkLib.onDomLoaded(function() {
new nicEditor().panelInstance('area1');
new nicEditor({fullPanel : true}).panelInstance('area2');
new nicEditor({iconsPath : '../nicEditorIcons.gif'}).panelInstance('area3');
new nicEditor({buttonList : ['fontSize','bold','italic','underline','strikeThrough','subscript','superscript','html','image']}).panelInstance('area4');
new nicEditor({maxHeight : 100}).panelInstance('area5');
});
//]]>
</script>
  
<textarea cols="50" id="area1">hi this is text area </textarea>
<p>sdljflksd sjdf sdfsd sddddddddddddddddddddddddddddddddddddddddddddddfffffffffffffddddddddddddd</p>