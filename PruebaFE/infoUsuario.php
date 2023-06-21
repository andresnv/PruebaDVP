<?php

$vGET= filter_input_array(INPUT_GET);
    
if(isset($vGET["usuario"]) && $vGET["usuario"]!=''){
    $url = "https://api.github.com/users/".$vGET["usuario"];
}
else{
    echo "Dato no recibido";
    exit();
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

$info = json_decode(utf8_encode($result));


?>

<div class="text-center">
    <img src="<?php echo $info->avatar_url ?>" class="imgUsuario" />
</div>

<p><b>ID:</b> <?php echo $info->id ?></p>
<p><b>Nombre:</b> <?php echo utf8_decode($info->name) ?></p>
<p><b>Ubicaci&oacute;n:</b> <?php echo utf8_decode($info->location) ?></p>
<p><b>Url:</b> <?php echo $info->html_url ?> </p>
<p><b>Fch.Creaci&oacute;n:</b> <?php echo $info->created_at ?></p>
<p><b>Empresa:</b> <?php echo utf8_decode($info->company) ?></p>