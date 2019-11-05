<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  if ( ! function_exists('validarcedula'))
  {
      function validarcedula($sRun = "", $sTipo = "", $sSerie = "") {

      $ch = curl_init();
      $timeout = 5;
      curl_setopt($ch, CURLOPT_URL, "https://portal.sidiv.registrocivil.cl/usuarios-portal/pages/DocumentRequestStatus.xhtml?RUN=" . $sRun . "&type=" . $sTipo . "&serial=" . $sSerie);
      curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
      curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
      $data = curl_exec($ch);
      curl_close($ch);
      $pos1 = strpos($data, " no corresponde en nuestros registros");
      $pos0 = strpos($data, ">No Vigente<");

      if ( $pos1 > 0 ) {
          // los datos ingresados son erroneos
          return -1;
      } else {
          // buscamos si no esta vigente
          if ( $pos0 > 0 ) {
              // el run y la seria no estan vigentes
              return -2;
          } else {
              // todo OK
              return 0;
          }
      }
  }
}
?>
