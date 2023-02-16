class MCPUtils {
  static objHasEmptyValues(obj) {
    return Object.values(obj).some((val) => !val);
  }
}

function mcpCopyToClipBoard(e) {
  const btn = e.target;
  const label = e.target.innerText;
  var inputElement = e.target.previousElementSibling;
  inputElement.select();
  document.execCommand("Copy");
  btn.innerText = "Copied!";
  setTimeout(() => (btn.innerText = label), 500);
}
