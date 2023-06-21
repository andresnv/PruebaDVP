<?php        

    $vPOST= filter_input_array(INPUT_POST);
    $busqueda="";    
    if(isset($vPOST["txtBuscar"]) && $vPOST["txtBuscar"]!=''){
        $url = "https://api.github.com/search/users?q=".$vPOST["txtBuscar"];
        $busqueda = $vPOST["txtBuscar"];
    }
    else{
        $url = "https://api.github.com/search/users?q=YOUR_NAME";
    }
    
    
    

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);        

    $headers = [
        'user-agent: php'            
    ];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    curl_close($ch);
    
    $json = json_decode(utf8_decode($result));

    $data = $json->items;
    
        

?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">    
    
    <title>.:Prueba DVP:.</title>
    
    <link href="includes/bootstrap-5.3.0-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="includes/css/notify.min.css" rel="stylesheet">
    <link href="includes/css/dashboard.css" rel="stylesheet">
    
    <link href="includes/fontawesome-free-6.4.0-web/css/all.min.css" rel="stylesheet">    
    <script src="includes/js/jquery-3.7.0.min.js"></script>
    <script src="includes/js/notify.min.js"></script>
  </head>
  <body>
  

<header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">Prueba DVP</a>

  <ul class="navbar-nav flex-row d-md-none">
    <li class="nav-item text-nowrap">
      <button class="nav-link px-3 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false" aria-label="Toggle search">        
        <i class="fa fa-solid fa-magnifying-glass text-white"></i>
      </button>
    </li>
    <li class="nav-item text-nowrap">
      <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-solid fa-list"></i>
      </button>
    </li>
  </ul>

  <div id="navbarSearch" class="navbar-search w-100 collapse show">
      <div class="container-fluid">
      <form method="post" action="#" id="formBuscar" class="m-0">
        <div class="row">          
            <div class="col-md-4 col-lg-4 p-0">
                <input class="form-control w-100 rounded-0 border-0" type="text" placeholder="Ingrese Nombre de Usuario" aria-label="Search" id="txtBuscar" name="txtBuscar" value="<?php echo $busqueda; ?>" />
            </div>
            <div class="col-md-4 col-lg-4 p-0">
                <button type="submit" class="btn btn-secondary mt-1" id="btnBuscar">Buscar</button>    
            </div>          
        </div>
      </form>
      </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
      <div class="offcanvas-lg offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="#">                
                <i class="fa fa-duotone fa-users"></i> Usuarios
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2" href="#">
                <i class="fa fa-solid fa-house"></i> Texto Ejemplo
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2" href="#">
                <i class="fa fa-sharp fa-solid fa-gears"></i> Texto Ejemplo
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2" href="#">
                <i class="fa fa-duotone fa-flag-checkered"></i> Texto Ejemplo
              </a>
            </li>
          </ul>

          <hr class="my-3">
          
        </div>
      </div>
    </div>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">            
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h2">Listado Usuarios</h2>
      </div>
      <div class="table-responsive small">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col"></th>
              <th scope="col">Id</th>
              <th scope="col">Login</th>
              <th scope="col">Url</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $dtsGrafica["labls"][] = "'test'";
            $dtsGrafica["data"][] = "10";
                $cont = 1;
                    foreach($data as $info){
                        $dtsGrafica["labls"][] = "'".$info->login."'";
                        
                        $url = "https://api.github.com/users/".$info->login."/followers";

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);        

                        $headers = [
                            'user-agent: php'            
                        ];

                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        curl_setopt($ch, CURLOPT_URL, $url);
                        $result = curl_exec($ch);
                        curl_close($ch);
                       
                        $json = json_decode(utf8_decode($result));
                        $dtsGrafica["data"][] = count($json);
                ?>
                 <tr>
                    <td><?php echo $cont ?></td>
                    <td><img src="<?php echo $info->avatar_url ?>" class="imgList" /></td>
                    <td><?php echo $info->id ?></td>
                    <td><button type="button" class="btn btn-link btnAbrirInfo p-0" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><?php echo $info->login ?></button></td>
                    <td><?php echo $info->html_url ?></td>
                  </tr>
            <?php  
                    $cont++;
                    if($cont>10){
                        break;
                    }
                }  ?>
              
            
          </tbody>
        </table>
      </div>
        
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h2 class="h2">Número Seguidores</h2>        
        </div>
        <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
    </main>
  </div>
</div>
      

      
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Información de Usuario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Cargando...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>      
      
      
<!--<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>-->
<script src="includes/bootstrap-5.3.0-dist/js/bootstrap.bundle.min.js"></script>

<script language="javascript">        
    var grafica=Array();
    grafica["lbls"]=[<?php echo implode(",", $dtsGrafica["labls"]) ?>];
    grafica["data"]=[<?php echo implode(",", $dtsGrafica["data"]) ?>];   
</script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js" integrity="sha384-gdQErvCNWvHQZj6XZM0dNsAoY4v+j5P1XDpNkcM3HJG1Yx04ecqIHk7+4VBOCHOG" crossorigin="anonymous"></script><script src="includes/js/dashboard.js"></script>
  </body>
</html>
