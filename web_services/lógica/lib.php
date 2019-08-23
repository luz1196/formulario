<?php
include('../includes/header.php'); 
include('../includes/footer.php');
include ('../conexionDB/conexionBD.php');

error_reporting(E_ALL ^ E_NOTICE);

if (isset($_POST['actualizarUsuario'])) {

    $editarId = $_POST['editarId'];
    $actNombre = $_POST['nombre'];
    $actCorreo = $_POST['correo'];
    $actCiudad = $_POST['ciudad'];
    $actNombreUsuario = $_POST['nombreUsuario'];
    $actTelefono = $_POST['telefono'];
    $actCelular = $_POST['celular'];
    $actAutorizado = $_POST['autorizado'];

    $actualizarEditar = "UPDATE usuario SET nombre = '$actNombre',
                                            correo = '$actCorreo',
                                            ciudad = '$actCiudad', 
                                            nombreUsuario = '$actNombreUsuario', 
                                            telefono = '$actTelefono', 
                                            celular = '$actCelular', 
                                            autorizado = '$actAutorizado'
                                            WHERE id = '$editarId'";
    $ejectarAct = mysqli_query ($enlace, $actualizarEditar);

    if ($ejectarAct) {
header("Location: ../formularios/usuario.php");
        }
    }

//-------------------------------------------------------------------------------

function ncurso ($actCurso){
    include ('../conexionDB/conexionBD.php');
    $idCurso = "SELECT nombre FROM curso WHERE id=".$actCurso;
        $ejecutarSQL = mysqli_query($enlace, $idCurso);
        $regCur = mysqli_fetch_array($ejecutarSQL);
        foreach($regCur as $valueC){
            $ncurso=$valueC;
        }
        return $ncurso;
}


function nmodulo($actModulo){
    include ('../conexionDB/conexionBD.php');
    $idModulo = "SELECT nombre FROM modulo WHERE id=".$actModulo;
        $ejecutarSQL = mysqli_query($enlace, $idModulo);
        $regMod = mysqli_fetch_array($ejecutarSQL);
        foreach($regMod as $valueM){
            $nmodulo=$valueM;
        }
    return $nmodulo;
}

function nclase($actTitulo){
    include ('../conexionDB/conexionBD.php');
    $idClase = "SELECT titulo FROM clase WHERE id=".$actTitulo;
        $ejecutarSQL = mysqli_query($enlace, $idClase);
        $regClase = mysqli_fetch_array($ejecutarSQL);
        foreach($regClase as $valueCl){
            $nclase=$valueCl;
        }
        return $nclase;
}

function eliminarC($dir2)
{
    $dir= dirname(getcwd(),2).$dir2;
    $files = scandir($dir);


    array_shift($files);
    array_shift($files); 

    foreach ($files as $file) 
    {
        $file2 = $dir.'/'.$file;
        if (is_dir($file2)) 
        {
            eliminarC($dir2.$file."/");
            rmdir($file2);
        } else {
            unlink($file2);           
        }
    }
    rmdir($dir); 
}



//// EDITAR CURSO ----------------------------------------------------------------------------//


if (isset($_POST['actualizarCurso'])){

    $editarId = $_POST['editarId'];
    $actNombre = $_POST['nombre'];
    $actNumeroModulos = $_POST['numeroModulos'];
    $actHoras = $_POST['horas'];
    $actFechaAct = $_POST['fechaActualizacion'];
    $actDescripcion= $_POST['descripcion'];
    $actProfesor = $_POST['profesor'];
    $actDisponible = $_POST['disponible'];
    $actCalificacion = $_POST['calificacion'];
    $actDestacado = $_POST['destacado'];
    $actCursosSugeridos = $_POST['cursosSugeridos'];
    $actTotalClases = $_POST['totalClases'];
    $actTipoCategoria = $_POST['idTipoCategoria'];

    $previmgC = $_POST['previmgC']; 
    $previmgM = $_POST['previmgM'];

    $actImagenC="content/".$actNombre."/".$_FILES['urlImagen']['name'];
    $actImagenM="content/".$actNombre."/".$_FILES['urlImagenMini']['name'];


        $ruta = "../../content/".$actNombre."/".$_FILES['urlImagen']['name'];    
        $tipo_archivo = $_FILES['urlImagen']['type'];
        $tamano_archivo = $_FILES['urlImagen']['size'];


        $ruta1 = "../../content/".$actNombre."/".$_FILES['urlImagenMini']['name'];       
        $tipo_archivoM = $_FILES['urlImagenMini']['type'];
        $tamano_archivoM = $_FILES['urlImagenMini']['size'];



       if($_FILES['urlImagen']['name']== null){   
            $actImagenCurso = $previmgC;            
           }else{
                $actImagenCurso = $actImagenC;
                if($tipo_archivo !="image/jpeg" && $tipo_archivo != "image/png" && $tipo_archivo != "image/gif")
                    { Echo "Formato de imagen no permitido";}
                    else if($tamano_archivo > 50000000)
                        {Echo "Tamaño de imagen no permitido";}
                        else {
                            unlink("../../".$_POST['previmgC']);                           
                            $guardarimg =@move_uploaded_file($_FILES["urlImagen"]["tmp_name"], $ruta);
                            }
                }


        if($_FILES['urlImagenMini']['name']== null){        
                 $actImagenMini = $previmgM;                  
            }else{
                 $actImagenMini = $actImagenM;
                    if($tipo_archivo !="image/jpeg" && $tipo_archivo != "image/png" && $tipo_archivo != "image/gif")
                        { Echo "Formato de imagen no permitido";}
                        else if($tamano_archivo > 50000000) 
                            {Echo "Tamaño de imagen no permitido";}
                            else { 
                             unlink("../../".$_POST['previmgM']);                                    
                               $guardarimgM = @move_uploaded_file($_FILES["urlImagenMini"]["tmp_name"], $ruta1);
                            }
             }

                
                 $actualizarEditar = "UPDATE curso SET nombre = '$actNombre',
                                            numeroModulos = '$actNumeroModulos',
                                            horas = '$actHoras', 
                                            fechaActualizacion = '$actFechaAct', 
                                            descripcion = '$actDescripcion', 
                                            profesor = '$actProfesor',
                                            disponible = '$actDisponible',
                                            urlImagen = '$actImagenCurso',
                                            calificacion = '$actCalificacion',
                                            destacado = '$actDestacado',
                                            cursosSugeridos = '$actCursosSugeridos',
                                            totalClases = '$actTotalClases',
                                            urlImagenMini = '$actImagenMini',
                                            idTipoCategoria = '$actTipoCategoria'

                                            WHERE id = '$editarId'";
                $ejectarAct = mysqli_query ($enlace, $actualizarEditar);


    if ($ejectarAct) {
header("Location: ../formularios/curso.php");
        }
}

//// EDITAR MODULO //

if (isset($_POST['actualizarModulo'])) {

    $editarId = $_POST['editarId'];
    $actNombre = $_POST['nombre'];
    $actNumeroClases = $_POST['numeroClases'];
    $actIdCurso = $_POST['idCurso'];


    $actualizarEditar = "UPDATE modulo SET nombre = '$actNombre',
                                            numeroClases = '$actNumeroClases',
                                            idCurso = '$actIdCurso'                                                                 
                                            WHERE id = '$editarId'";
    $ejectarAct = mysqli_query ($enlace, $actualizarEditar);

    if ($ejectarAct) {
header("Location: ../formularios/modulo.php");
        }
    }

   
// EDITAR CLASE----------------------------------------------------------------------------------- //

if (isset($_POST['actualizarClase'])) {
    
    $editarId = $_POST['editarId'];
    $actTitulo = $_POST['titulo'];
    $actDescripcion = $_POST['descripcion'];
    $actTipo = $_POST['idTipoClase'];
    $actCurso = $_POST['idCurso'];
    $actModulo= $_POST['idModulo'];
    $actPregunta = $_POST['idPregunta'];

    $ncurso = ncurso($actCurso);
    $nmodulo = nmodulo($actModulo);

    $previmg = $_POST['previmg'];
    $prevcont = $_POST['prevcont'];
   
    $actImagenCl = "content/".$ncurso."/".$nmodulo."/".$actTitulo."/".$_FILES['urlImagenPrev']['name'];//muestra

    $actContenidoCl="content/".$ncurso."/".$nmodulo."/".$actTitulo."/".$_FILES['contenidoClase']['name'];//muestra

/////////////////////////


$cont3 = "content/".$ncurso."/".$nmodulo."/".$actTitulo."/".$_FILES['contenidoClase']['name'];
$cont4 = $actPregunta;

$ruta3 = "../../content/".$ncurso."/".$nmodulo."/".$actTitulo."/".$_FILES['contenidoClase']['name'];

$tipo_archivoC = $_FILES['contenidoClase']['type'];
$ext = pathinfo($_FILES['contenidoClase']['name'], PATHINFO_EXTENSION);
$next = true;

if($_FILES['contenidoClase']['name']== null){
    $actContenido = $prevcont;
}else{$actContenido = $actContenidoCl;}
            if($actTipo=="1"){
                    if($ext != "mp3" && $ext != "mp4"){
                        $next= false;
                        Echo "Formato de archivo no permitido";
                    }else{
                        $resultadoC = @move_uploaded_file($_FILES["contenidoClase"]["tmp_name"], $ruta1);
                        unlink("../../".$_POST['prevcont']);
                        $contenidoC = $cont1;
                    }
                }            
                else if($actTipo=="2"){
                    if($ext != "mp3" && $ext != "mp4"){
                        $next= false;
                        Echo "Formato de archivo no permitido";
                        $contenidoC = $cont1;
                    }else{
                        $resultadoC = @move_uploaded_file($_FILES["contenidoClase"]["tmp_name"], $ruta2);
                        unlink("../../".$_POST['prevcont']);
                        $contenidoC = $cont2;
                    }
                }
                else if($actTipo=="3"){
                    if($ext != "pdf"){
                        $next= false;
                        Echo "Formato de archivo no permitido";
                    }else{
                        $resultadoC = @move_uploaded_file($_FILES["contenidoClase"]["tmp_name"], $ruta3);
                        unlink("../../".$_POST['prevcont']);
                        $contenidoC = $cont3;
                    }
                
                }else if($actTipo=="4"){
                    if(empty($_POST['idPregunta'])){        
                        $next= false;
                        echo"seleccione el cuestionario";               
                    }       
                }

    $ruta = "../../content/".$ncurso."/".$nmodulo."/".$actTitulo."/".$_FILES['urlImagenPrev']['name'];      
    $tipo_img = $_FILES['urlImagenPrev']['type'];
    $tamano_archivo = $_FILES['urlImagenPrev']['size'];

      //valida la imagen
    if($_FILES['urlImagenPrev']['name']== null)
        {$actImagen = $previmg;}
        else{$actImagen = $actImagenCl;}
            if($tipo_img != "image/png" && $tipo_archivo != "image/jpeg" && $tipo_archivo != "image/gif")
                {Echo "Formato de imagen no permitido";}      
                    else if($tamano_archivo > 50000000 ){Echo "Tamaño de imagen no permitido";}       
                       else {
                               $resultado = @move_uploaded_file($_FILES["urlImagenPrev"]["tmp_name"], $ruta);
                               unlink("../../".$_POST['previmg']);
                            }

            $actualizarEditar = "UPDATE clase SET titulo = '$actTitulo',
                                            descripcion = '$actDescripcion',
                                            urlImagenPrev = '$actImagen',                                       
                                            idTipoClase = '$actTipo',
                                            contenidoClase = '$actContenido',
                                            idModulo = '$actModulo', 
                                            idCurso = '$actCurso'                                           
                                            WHERE id = '$editarId'";

            $ejectarAct = mysqli_query ($enlace, $actualizarEditar);

    if ($ejectarAct) {
        header("Location: ../formularios/clase.php");

        }
   
}   

//// EDITAR CURSO USUARIO //

if (isset($_POST['actualizarCursoUsuario'])) {

    $editarId = $_POST['editarId'];
    $actAvance = $_POST['avance'];
    $actTerminado = $_POST['terminado'];
    $actIniciado = $_POST['iniciado'];
    $actFavorito = $_POST['favorito'];
    $actUsuario= $_POST['idUsuario'];
    $actCurso = $_POST['idCurso'];
    
    $actualizarEditar = "UPDATE curso_usuario SET avance = '$actAvance',
                                            terminado = '$actTerminado',
                                            iniciado = '$actIniciado', 
                                            favorito = '$actFavorito', 
                                            idUsuario = '$actUsuario', 
                                            idCurso = '$actCurso'                                       

                                            WHERE id = '$editarId'";
    $ejectarAct = mysqli_query ($enlace, $actualizarEditar);

    if ($ejectarAct) {
header("Location: ../formularios/curso_usuario.php");
        }
    }


// EDITAR CLASEUSUARIO //

if (isset($_POST['actualizarClaseUsuario'])) {

    $editarId = $_POST['editarId'];
    $actAvance = $_POST['avance'];
    $actAvanceVideo = $_POST['avanceVideo'];
    $actUsuario = $_POST['usuario'];
    $actCurso = $_POST['idCurso'];
    $actModulo= $_POST['idModulo'];
    $actClase = $_POST['idClase'];

    $actualizarEditar = "UPDATE clase_usuario SET avance = '$actAvance',
                                            avanceVideo = '$actAvanceVideo',
                                            idUsuario = '$actUsuario', 
                                            idCurso = '$actCurso', 
                                            idModulo = '$actModulo', 
                                            idClase = '$actClase'
                                            WHERE id = '$editarId'";
    $ejectarAct = mysqli_query ($enlace, $actualizarEditar);

    if ($ejectarAct) {
header("Location: ../formularios/clase_usuario.php");
        }
    }

//////EDITAR PREGUNTA //

if (isset($_POST['actualizarPregunta'])){

    $editarId = $_POST['editarId'];
    $actPregunta = $_POST['pregunta'];
    $actPrimRespuesta = $_POST['primeraRespuesta'];
    $actSegRespuesta = $_POST['segundaRespuesta'];
    $actTercRespuesta = $_POST['terceraRespuesta'];
    $actCuarRespuesta = $_POST['cuartaRespuesta'];
    $actRespuestaCorrec = $_POST['respuestaCorrecta']; 
    $actIdContPregunta = $_POST['idContenidoPregunta'];

    $actContAux = "content/Contenido_Auxiliar/".$_FILES['contenidoAuxiliar']['name'];
    $prevcontAux = $_POST['prevcontAux'];

    $rutaP = "../../content/Contenido_Auxiliar/" . $_FILES['contenidoAuxiliar']['name'];                        
    $tamano_archivo = $_FILES['contenidoAuxiliar']['size'];
    $ext = pathinfo($_FILES['contenidoAuxiliar']['name'], PATHINFO_EXTENSION);//obtiene extension

      
    if($_FILES['contenidoAuxiliar']['name']== null)
        { $actContAuxiliar = $prevcontAux; 
}
        else{ $actContAuxiliar = $actContAux; } 
              if($ext != "pdf" && $ext != "mp3" && $ext != "mp4")
                { Echo "Formato de archivo no permitido"; }
                    else if($tamano_archivo > 50000000 )
                    { Echo "Tamaño de archivo no permitido"; }             
                        else{ $guardar = @move_uploaded_file($_FILES["contenidoAuxiliar"]["tmp_name"], $rutaP); 
                           //  unlink("../../".$_POST['prevcontAux']);
                   }
          
            
                $actualizarEditar = "UPDATE pregunta SET pregunta = '$actPregunta',
                                                        primeraRespuesta = '$actPrimRespuesta',
                                                        segundaRespuesta = '$actSegRespuesta',  
                                                        terceraRespuesta = '$actTercRespuesta', 
                                                        cuartaRespuesta = '$actCuarRespuesta',  
                                                        respuestaCorrecta = '$actRespuestaCorrec',  
                                                        contenidoAuxiliar = '$actContAuxiliar', 
                                                        idContenidoPregunta = '$actIdContPregunta'
            
                                                        WHERE id = '$editarId'";
                                                        
                $ejectarAct = mysqli_query ($enlace, $actualizarEditar);

                if ($ejectarAct) {
            header("Location: ../formularios/pregunta.php");
            
        }
    }


//////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////

// ELIMINAR
// ELIMINAR USUARIO

    if (isset($_GET['eliminarUsuario'])) {

        $eliminarId = $_GET['eliminarUsuario'];

        $consultaElim ="DELETE FROM usuario WHERE id = $eliminarId";

        $ejecutarElim = mysqli_query ($enlace, $consultaElim);


        if (!$ejecutarElim) {
            die("Error al eliminar.");
        }


        header("Location: ../formularios/usuario.php");
    }

// ELIMINAR CURSO

if (isset($_GET['eliminarCurso'])) {


        $eliminarId = $_GET['eliminarCurso'];

        $ncurso = ncurso($eliminarId);


        $dir= "/content/".$ncurso."/";

        eliminarC($dir);

        $consultaElim ="DELETE FROM curso WHERE id = $eliminarId";

        $ejecutarElim = mysqli_query ($enlace, $consultaElim);

        if (!$ejecutarElim) {
            die("Error al eliminar.");
        }

        header("Location: ../formularios/curso.php");
    }


// ELIMINAR MODULO

    if (isset($_GET['eliminarModulo'])) {

        $eliminarId = $_GET['eliminarModulo'];
        $idcurso = $_GET['curso'];//trae de modulo funcion borrar
        
        $ncurso = ncurso($idcurso);

        $nmodulo = nmodulo($eliminarId);

        $dir= "/content/".$ncurso."/".$nmodulo."/";

        eliminarC($dir);
        

        $consultaElim ="DELETE FROM modulo WHERE id = $eliminarId";

        $ejecutarElim = mysqli_query ($enlace, $consultaElim);

        if (!$ejecutarElim) {
            die("Error al eliminar.");
        }


        header("Location: ../formularios/modulo.php");
    }


// ELIMINAR CLASE

if (isset($_GET['eliminarClase'])) {

            $eliminarId = $_GET['eliminarClase'];
            $idmodulo = $_GET['modulo'];
            $idcurso = $_GET['curso'];

            $ncurso = ncurso($idcurso);

            $nmodulo = nmodulo($idmodulo);

            $actTitulo = nclase($eliminarId);

            $dir= "/content/".$ncurso."/".$nmodulo."/".$actTitulo."/";

            eliminarC($dir);

            $consultaElim ="DELETE FROM clase WHERE id = $eliminarId";

            $ejecutarElim = mysqli_query ($enlace, $consultaElim);

            

if (!$ejecutarElim) {
                die("Error al eliminar.");
            }

            header("Location: ../formularios/clase.php");
        
    }

// ELIMINAR CURSOUSUARIO

    if (isset($_GET['eliminarCursoUsuario'])) {

        $eliminarId = $_GET['eliminarCursoUsuario'];

        $consultaElim ="DELETE FROM curso_usuario WHERE id = $eliminarId";

        $ejecutarElim = mysqli_query ($enlace, $consultaElim);

        if (!$ejecutarElim) {
            die("Error al eliminar.");
        }


        header("Location: ../formularios/curso_usuario.php");
    }

// ELIMINAR CLASEUSUARIO


    if (isset($_GET['eliminarClaseUsuario'])) {

        $eliminarId = $_GET['eliminarClaseUsuario'];

        $consultaElim ="DELETE FROM clase_usuario WHERE id = $eliminarId";

        $ejecutarElim = mysqli_query ($enlace, $consultaElim);

        if (!$ejecutarElim) {
            die("Error al eliminar.");
        }


        header("Location: ../formularios/clase_usuario.php");
    }

// ELIMINAR PREGUNTA

    if (isset($_GET['eliminarPregunta'])) {


        $eliminarId = $_GET['eliminarPregunta'];

        $consultaElim ="DELETE FROM pregunta WHERE id = $eliminarId";

        $ejecutarElim = mysqli_query ($enlace, $consultaElim);

        if (!$ejecutarElim) {
            die("Error al eliminar.");
        }


        header("Location: ../formularios/pregunta.php");
    }


 ?>

