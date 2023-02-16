jQuery(document).ready(function ($) {
  const mcp_events = new MCPEvents();
  $(".cf7-save-fields").on("click", mcp_events.save);
  $(document).on("click", ".cf7-remove-field", mcp_events.remove);
  $(document).on("click", ".mcp-copy-btn", mcpCopyToClipBoard);

  //   $(".cf7-mcp-tabs table").on("DOMSubtreeModified", toggle_table_remove_btn);
});
