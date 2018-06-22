// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable();
});

function onLoadEvent(quantityLabel){
  $('#productsQuantityLabel').text(quantityLabel);
  $('#downloadLabel').text("Descargar XLS")
}