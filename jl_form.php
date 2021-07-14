<?php
/**
* Plugin Name: Plugin de formulario JL
* Description: Formulario para encuestas
* Version: 1.0
*/


// Cuando el plugin se active se crea la tabla para recoger los datos si no existe
register_activation_hook(__FILE__, 'jl_form_init');
 
/**
 * Crea la tabla para recoger los datos del formulario
 *
 * @return void
 */
function jl_form_init() 
{
    global $wpdb; // Este objeto global permite acceder a la base de datos de WP
    // Crea la tabla sólo si no existe
    // Utiliza el mismo prefijo del resto de tablas
    $tabla_jl = $wpdb->prefix . 'form_jl';
    // Utiliza el mismo tipo de orden de la base de datos
    $charset_collate = $wpdb->get_charset_collate();
    // Prepara la consultaform_jl
    $query = "CREATE TABLE IF NOT EXISTS $tabla_jl (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        nombre varchar(40) NOT NULL,
        cedula varchar(40) NOT NULL,
        correo varchar(100) NOT NULL,
        ciudad varchar(100) NOT NULL,        
        aceptacion smallint(4) NOT NULL,
        voto varchar(40) NOT NULL,
        created_at TIMESTAMP NOT NULL,
        UNIQUE (id)
        ) $charset_collate;";
    // La función dbDelta permite crear tablas de manera segura se
    // define en el archivo upgrade.php que se incluye a continuación
    include_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($query); // Lanza la consulta para crear la tabla de manera segura
}



// Define el shortcode y lo asocia a una función
wp_register_style('prefix_bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
wp_enqueue_style('prefix_bootstrap');

// https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js

wp_register_script('jq', '//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js');
wp_enqueue_script('jq');



wp_register_script('validate', '//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js');
wp_enqueue_script('validate');

wp_register_script('fon', '///kit.fontawesome.com/fa9b9824b0.js');
wp_enqueue_script('fon');

wp_register_script('sweetalert', '//cdn.jsdelivr.net/npm/sweetalert2@11');
wp_enqueue_script('sweetalert');


add_shortcode('jl_form_form', 'jl_form_form');
wp_enqueue_style('styleform', plugins_url('css/styleform.css', __FILE__));
// wp_enqueue_script( 'jquery', plugins_url('', __FILE__));

wp_enqueue_script( 'script', plugins_url('js/jquery.formtowizard.js', __FILE__));
wp_enqueue_script( 'scriptform', plugins_url('js/scriptform.js', __FILE__));





/** 
 * Define la función que ejecutará el shortcode
 * De momento sólo pinta un formulario que no hace nada
 * 
 * @return string
 */
function jl_form_form() 
{

    global $wpdb; // Este objeto global permite acceder a la base de datos de WP
    // Si viene del formulario  graba en la base de datos
    // Cuidado con el último igual de la condición del if que es doble
    // var_dump( $aceptacion);
    // die();
    if ($_POST['nombre'] != ''
        AND $_POST['email']!= ''
        AND $_POST['cedula'] != ''
        AND $_POST['ciudad'] != ''      
        AND $_POST['aceptacion'] == '1'
    ) {
        $tabla_jl = $wpdb->prefix . 'form_jl'; 

        $data = [
            "nombre" => $_POST['nombre'],
            "cedula" => $_POST['cedula'], 
            "correo" => $_POST['email'],       
            "ciudad" => $_POST['ciudad'],         
            "aceptacion" => $_POST['aceptacion'],
            "voto" => $_POST['voto'],

        
        ]; 
    
       $wpdb->insert($tabla_jl,$data);
      
     
        echo "<p class='exito'><b>Tus datos han sido registrados</b>. Gracias 
            por tu interés. En breve contactaré contigo.<p>";
    }


  
    // Esta función de PHP activa el almacenamiento en búfer de salida (output buffer)
    // Cuando termine el formulario lo imprime con la función ob_get_clean
    ob_start();
    ?>
    <div class="row wrap"><div class="col-lg-12">

<div id='progress'><div id='progress-complete'></div></div>

<form id="SignupForm" action="" method="post">
    <fieldset>
        <legend>Registra tus datos</legend>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
        <div class="form-group">
        <label for="nombre">Nombre completo</label>
        <input id="nombre" name="nombre" type="text" class="form-control" required />
        </div>
        <div class="form-group">
        <label for="Name">Numero de cedula</label>
        <input id="cedula" name="cedula" type="number" class="form-control" required />
        </div>
        <div class="form-group">
        <label for="Email">Correo electrónico</label>
        <input id="Email" name="email" type="email" class="form-control" required />
        </div>
        <div class="form-group">
            <label for="Email">Ciudad residencial</label>
            <select id="ciudad" name="ciudad" class="form-control" required>
            <option disabled selected></option>
            <option value="CA">Canada</option>
            <option value="US">United States of America</option>
            <option value="GB">United Kingdom (Great Britain)</option>
            <option value="AU">Australia</option>
            <option value="JP">Japan</option>
            <option value="AF">Afghanistan</option>
          
            
        </select>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="aceptacion" value="1" id="flexCheckDefault" required>
          <label class="form-check-label" for="flexCheckDefault">
            Acepta <a href="#" > términos, condiciones y politicas de privacidad </a>
          </label>
        </div>
    </fieldset>

    <fieldset>
        <legend>Registra tu voto</legend>
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="card">
                  <div class="card-body">
                    <p>Propuesta</p>
                    <h4>Nombre de la empresa</h4>
                    <div>Video</div>
                    <iframe width="200" height="200" src="https://www.youtube.com/embed/HyHNuVaZJ-k" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <input type="checkbox" id="voto" name="voto" class="btn btn-primary votar" value="voto" onclick="votar()">Registra tu voto</input>
                    <p>lorem ipsu</p>                    
                  </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card">
                  <div class="card-body">
                    <p>Propuesta</p>
                    <h4>Nombre de la empresa</h4>
                    <div>Video</div>
                    <iframe width="200" height="200" src="https://www.youtube.com/embed/HyHNuVaZJ-k" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <input type="checkbox" id="voto2" name="voto" class="btn btn-primary votar" value="voto 2" onclick="votar()">Registra tu voto</input>
                    <p>lorem ipsu</p>
                    
                  </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card">
                  <div class="card-body">
                    <p>Propuesta</p>
                    <h4>Nombre de la empresa</h4>
                    <div>Video</div>
                    <iframe width="200" height="200" src="https://www.youtube.com/embed/HyHNuVaZJ-k" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <input type="checkbox" id="voto3" name="voto" class="btn btn-primary votar" value="voto 3" onclick="votar()">Registra tu voto</input>
                    <p>lorem ipsu</p>
                    
                  </div>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class="form-horizontal" role="form">
        <legend>Comparte con los demas</legend>
        
 <div class='share-post'>
<ul>
 <li>Compartir en:</li>
 <li class='facebook_share'>
 <a expr:href='&quot;http://www.facebook.com/sharer.php?u=&quot; + data:post.url + &quot;&amp;title=&quot;+ data:post.title' onclick='window.open(this.href, &apos;windowName&apos;, &apos;width=550, height=600, left=24, top=24, scrollbars, resizable&apos;); return false;' rel='nofollow' target='_blank' title="Compartir en Facebook">
   <i class='fa fa-facebook'> </i></a></li>
<li class='twitter_share'>
<a expr:href='&quot;http://twitter.com/share?url=&quot; + data:post.url + &quot;&amp;title=&quot; + data:post.title' onclick='window.open(this.href, &apos;windowName&apos;, &apos;width=550, height=600, left=24, top=24, scrollbars, resizable&apos;); return false;' rel='nofollow' target='_blank' title="Compartir en Twitter">
<i class='fa fa-twitter'></i></a> </li>
  <li class='blogger_share'><a expr:href='appendParams(data:post.shareUrl, { target: &quot;blog&quot; } )' expr:onclick='&quot;window.open(this.href, \&quot;_blank\&quot;, \&quot;height=270,width=475\&quot;); return false;&quot;' expr:title='data:top.blogThisMsg' target='_blank' title="Compartir en tu Blog"><i class='fab fa-blogger-b'></i></a></li>
  <li class='whatsapp_share'><a expr:href='"whatsapp://send?text=" + data:post.title + "-" + data:post.url' title='Compartir en WhatsApp'><i class='fab fa-whatsapp'></i></a></li>
<li class='linkedin_share'>
 <a expr:href='&quot;http://pinterest.com/pin/create/button/?url=&quot; + data:post.url + &quot;&amp;media=&quot; + data:post.thumbnailUrl + &quot;&amp;description=&quot; + data:post.snippet' onclick='window.open(this.href, &apos;windowName&apos;, &apos;width=550, height=600, left=24, top=24, scrollbars, resizable&apos;); return false;' rel='nofollow' title="Compartir en Pinterest">
<i class='fa fa-pinterest'></i></a>
</li>
  <li><a expr:href='appendParams(data:post.shareUrl, { target: &quot;email&quot; } )' expr:title='data:messages.emailPost' onclick='window.open(this.href, &apos;windowName&apos;, &apos;width=550, height=600, left=24, top=24, scrollbars, resizable&apos;); return false;'><i class='far fa-envelope'><data:top.emailThisMsg/></i></a></li>
</ul>
</div>
    </fieldset>

    <button id="SaveAccount" type="submit" class="btn btn-primary submit">Submit form</button>

</form>

</div></div>
    
    <?php
     
    // Devuelve el contenido del buffer de salida
    return ob_get_clean();
}



// El hook "admin_menu" permite agregar un nuevo item al menú de administración
add_action("admin_menu", "jl_form_menu");

/**
 * Agrega el menú del plugin al escritorio de WordPress
 *
 * @return void
 */
function jl_form_menu() 
{
    add_menu_page(
        'Formulario votantes', 'votantes', 'manage_options', 
        'jl_form_menu', 'jl_form_admin', 'dashicons-feedback', 75
    );
}


/**
 * Crea el contenido del panel de administración para el plugin
 *
 * @return void
 */
function jl_form_admin()
{

    
// obtiene el path actual

$pathexport = WP_PLUGIN_DIR . '/jl_form/includes/exportadata.inc';
// var_dump($my_plugin);
// die();

    global $wpdb;
    $form_jl = $wpdb->prefix . 'form_jl';
    
    echo '<div class="wrap"><b><h1>LISTA VOTANTES</b></h1>';
    echo '<div class="wrap"><a href="admin.php?page=jl_form_menu&export=csv"><b><h3>Descargar datos</b></a></h3>';
    echo '<table class="wp-list-table widefat fixed striped">';
    echo '<thead><tr><th width="30%">Nombre</th><th width="20%">Cedula</th>
        <th>Correo</th><th>Ciudad</th><th>Aceptacion de terminos</th> <th>Voto</th> <th>Hora de votacion</th>
       </tr></thead>';
    echo '<tbody id="the-list">';
    $votantes = $wpdb->get_results("SELECT * FROM $form_jl");
    foreach ( $votantes as $votante ) {
        $nombre = $votante->nombre;
        $cedula = $votante->cedula;
        $correo = $votante->correo;  
        
        $ciudad = $votante->ciudad;
        $aceptacion = (int)$votante->aceptacion;
        $voto = $votante->voto;
        $hora = $votante->created_at;
    
    
        echo "<tr><td>$nombre</td>
            <td>$cedula</td><td>$correo</td><td>$ciudad</td>
            <td>$aceptacion</td><td>$voto</td> <td>$hora</td>";
    }
    echo '</tbody></table></div>';
}




    if ( isset($_GET['export'] )  )
{
	// Query
	$statement = $wpdb->get_results("SELECT * FROM wp_form_jl ");

	// file creation
	$wp_filename = "filename_".date("d-m-y").".csv";
	
	// Clean object
	ob_end_clean ();
	
	// Open file
	$wp_file = fopen($wp_filename,"w");
	
	// loop for insert data into CSV file
	foreach ($statement as $statementFet)
	{
		$wp_array = array(
			"name"=>$statementFet->nombre,
			"cedula"=>$statementFet->cedula,
			"correo"=>$statementFet->correo,
			"ciudad"=>$statementFet->ciudad,
			"aceptacion"=>$statementFet->aceptacion,
			"voto"=>$statementFet->voto,
			"hora"=>$statementFet->created_at,
		);
		fputcsv($wp_file,$wp_array);
	}
	
	// Close file
	fclose($wp_file);
	
	// download csv file
	header("Content-Description: File Transfer");
	header("Content-Disposition: attachment; filename=".$wp_filename);
	header("Content-Type: application/csv;");
	readfile($wp_filename);
	exit;
    header('location:/admin.php?page=jl_form_menu');
    
}
   




