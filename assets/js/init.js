jQuery(document).ready(function ($) {
  $(".cf7-save-fields").on("click", mcp_save_events);
  $(document).on("click", ".cf7-remove-field", mcp_remove_event);
  $(document).on("click", ".mcp-copy-btn", mcpCopyToClipBoard);

  //   $(".cf7-mcp-tabs table").on("DOMSubtreeModified", toggle_table_remove_btn);
});
