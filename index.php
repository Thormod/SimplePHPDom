<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Bootstrap core CSS-->
      <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <!-- Custom fonts for this template-->
      <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <!-- Page level plugin CSS-->
      <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
      <!-- Custom styles for this template-->
      <link href="css/sb-admin.css" rel="stylesheet">
   </head>
   <body class="fixed-nav sticky-footer bg-dark" id="page-top">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
         <a class="navbar-brand" href="index.html">Plan de compra (Prueba técnica)</a>
         <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
               <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                  <a class="nav-link" href="index.html">
                  <i class="fa fa-shopping-cart"></i>
                  <span class="nav-link-text">Jumbo Supermercados</span>
                  </a>
               </li>
            </ul>
         </div>
      </nav>
      <div class="content-wrapper">
         <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Jumo Supermercados</a>
                </li>
            </ol>
  
            <div class="card mb-3">
               <div class="card-header">
                  <i class="fa fa-table"></i> Resultados
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                           <tr>
                              <th>Nombre</th>
                              <th>Precio Regular</th>
                              <th>Precio Descuento</th>
                              <th>Marca</th>
                           </tr>
                        </thead>
                        <tfoot>
                            <tr>
                              <th>Nombre</th>
                              <th>Precio Regular</th>
                              <th>Precio Descuento</th>
                              <th>Marca</th>
                           </tr>
                        </tfoot>
                        <tbody>
                        
                        <?php
                            // Al ser una página de carga dinámica por medio del scroll, es necesario aumentar el tiempo de ejecución de las funciones
                            ini_set('max_execution_time', 300);
                            // Llamado a la librería usada para realizar el web-scraping
                            require 'simple_html_dom.php';
                            // Variable que determina la página en la cuál se encuentra la URL
                            $page = 1;
                            // URL base
                            $baseUrl = 'https://www.tiendasjumbo.co/buscapagina?sl=49a31962-b0e8-431b-a189-2473c95aeeeb&PS=18&cc=18&sm=0&PageNumber=';
                            // Atributos adicionales de la URL
                            $orderByAttribute = '&&fq=C%3a%2f2000001%2f&O=OrderByBestDiscountDESC';
                            // Función para realizar el llamado a la URL para poder realizar llamados al DOM
                            $html = file_get_html($baseUrl.$page.$orderByAttribute);
                            // Nos indica si carga una página, si no carga (o es vacía) esta retornará FALSE 
                            while($html){
                                // LLamado a los productos por medio de su clase específica dentro del DOM
                                $products = $html->find('div[class="product-item"]');
                                // Para cada producto buscamos la información necesaria y la agregamos a la tabla si este posee descuento
                                foreach ($products as $prod) {
                                    if($prod->find('div[class=discount-percent]', 0)->plaintext != 0) {
                                        $productInfo = $prod->find('div[class="product-item__info"]', 0);
                                        $productPrices = $prod->find('div[class="product-prices__wrapper"]', 0);
                                        echo '<tr>';
                                        echo '<td>';
                                        echo $name = $productInfo->find('a[class="product-item__name"]', 0)->title;
                                        echo '</td>';
                                        echo '<td>';
                                        echo $formerPrice = $productPrices->find('span[class="product-prices__value"]', 0);
                                        echo '</td>';
                                        echo '<td>';
                                        echo $betterPrice = $productPrices->find('span[class="product-prices__value--best-price"]', 0);
                                        echo '</td>';
                                        echo '<td>';
                                        echo $betterPrice = $productInfo->find('p[class="brand"]', 0);
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                }
                                // Cambio de página
                                $page++;
                                $html = file_get_html($baseUrl.$page.$orderByAttribute);
                            }
                        ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         <!-- /.container-fluid-->
         <!-- /.content-wrapper-->
         <footer class="sticky-footer">
            <div class="container">
               <div class="text-center">
                  <small>Juan Sebastián Zapata</small>
               </div>
            </div>
         </footer>
         <!-- Scroll to Top Button-->
         <a class="scroll-to-top rounded" href="#page-top">
         <i class="fa fa-angle-up"></i>
         </a>
         <!-- Bootstrap core JavaScript-->
         <script src="vendor/jquery/jquery.min.js"></script>
         <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
         <!-- Core plugin JavaScript-->
         <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
         <!-- Page level plugin JavaScript-->
         <script src="vendor/chart.js/Chart.min.js"></script>
         <script src="vendor/datatables/jquery.dataTables.js"></script>
         <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
         <!-- Custom scripts for all pages-->
         <script src="js/sb-admin.min.js"></script>
         <!-- Custom scripts for this page-->
         <script src="js/sb-admin-datatables.min.js"></script>
         <script src="js/sb-admin-charts.min.js"></script>
      </div>
   </body>
</html>