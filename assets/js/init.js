jQuery(document).ready(function ($) {
  $(".cf7-save-fields").on("click", mcp_save_fields);
  //   $(".cf7-mcp-tabs table").on("DOMSubtreeModified", toggle_table_remove_btn);
  $(document).on("click", ".cf7-remove-field", function (e) {
    mcp_remove_field(e, "cf7_mcp_live_events");
  });
});
