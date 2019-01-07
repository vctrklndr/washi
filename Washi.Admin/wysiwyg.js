(function() {
  let wysiwyg = document.getElementById("wysiwyg");
  wysiwyg.innerHTML = `<div id="toolbar"> <div class="toolbar__tool toolbar__tool--bold" onclick="format('bold')"> <img src="https://png.icons8.com/android/48/000000/bold.png" width="16"> </div><div class="toolbar__tool " onclick="format('italic')"> <img src="https://png.icons8.com/metro/48/000000/italic.png" width="16"> </div><div class="toolbar__tool toolbar__tool--underline" onclick="format('underline')"> <img src="https://png.icons8.com/android/48/000000/underline.png" width="16"> </div><div class="toolbar__tool toolbar__tool--h1" onclick="formatParam('formatBlock','H1')">H1</div><div class="toolbar__tool toolbar__tool--h1" onclick="formatParam('formatBlock','H2')">H2</div><div class="toolbar__tool toolbar__tool--h1" onclick="formatParam('formatBlock','H3')">H3</div><div class="toolbar__tool toolbar__tool--h1" onclick="formatParam('formatBlock','P')">P</div><div class="toolbar__tool" onclick="format('insertUnorderedList')"> <img src="https://png.icons8.com/ios/100/000000/bulleted-list.png" width="20"> </div><div class="toolbar__tool" onclick="format('insertOrderedList')"> <img src="https://png.icons8.com/ios/100/000000/numbered-list.png" width="22"> </div><div class="toolbar__tool" onclick="format('justifyLeft')"> <img src="https://png.icons8.com/ios/40/000000/align-left-filled.png" width="22"> </div><div class="toolbar__tool" onclick="format('justifyCenter')"> <img src="https://png.icons8.com/ios/40/000000/align-justify-filled.png" width="22"> </div><div class="toolbar__tool right-flex" onclick="format('justifyRight')"> <img src="https://png.icons8.com/ios/40/000000/align-right-filled.png" width="22"> </div></div><iframe id="editor"></iframe>`;
  let toolbar = document.getElementById("toolbar");
  let editor = document.getElementById("editor");
  let width = wysiwyg.dataset.width;
  let height = wysiwyg.dataset.height;
  toolbar.style.width = width;
  editor.style.width = width;
  editor.style.height = height;
  editor.contentDocument.designMode = "on";
  this.format = function(cmd) {
    editor.contentDocument.execCommand(cmd, !1, null);
  };
  this.formatParam = function(cmd, param) {
    editor.contentDocument.execCommand(cmd, !1, param);
  };

  this.getHtml = function() {
    let code = editor.contentDocument.getElementsByTagName("body")[0].innerHTML;
    return code;
  };
})();
