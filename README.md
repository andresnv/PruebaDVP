<h2>Para probar el Backend local</h2>

<p>**La estructura de la bd y la tabla están en el archivo bd.sql</p>

<p>- <b>Listar los tickets</b><br>
http://localhost/PruebaBE/?listarTickets<br>
Variables Esperadas:<br>
num_registros<br>
num_pagina<br>
id_ticket<br></p>


<p>- <b>Crear Tickets</b><br>
http://localhost/PruebaBE/?crearTicket<br>
Variables Esperadas:<br>
asunto<br>
descripcion<br>
prioridad<br>
usuario<br>
estatus<br></p>


<p>- <b>Editar Tickets</b><br>
http://localhost/PruebaBE/?editarTicket<br>
asunto<br>
descripcion<br>
prioridad<br>
usuario<br>
estatus<br>
id_ticket<br></p>

<p>- <b>Eliminar Ticktets</b><br>
http://localhost/PruebaBE/?eliminarTicket<br>
Variables Esperadas:<br>
id_ticket<br></p>
