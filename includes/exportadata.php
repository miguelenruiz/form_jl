<?php

              global $wpdb;
              $file = 'lista_votantes'; // ?? not defined in original code
              $results = $wpdb->get_results("SELECT * FROM 'wp_form_jl';");
  
              if (empty($results)) {
                return;
              }
  
              $csv_output = '"'.implode('";"',array_keys($results[0])).'";'."\n";;
  
              foreach ($results as $row) {
                $csv_output .= '"'.implode('";"',$row).'";'."\n";
              }
              $csv_output .= "\n";
              $dir = "http://localhost/form/wp-content/plugins/jl_form/includes/exportadata.php";
              $filename = $file."_".date("Y-m-d_H-i",time()).".csv";
  
              header("Content-type: application/vnd.ms-excel");
              header("Content-disposition: csv" . date("Y-m-d") . ".csv");
              header( "Content-disposition: filename=".$filename.".csv");
              print $csv_output;
              exit;
            //  echo "<div class='alert alert-info'>Data Written to CSV File. <a href='".$geturl."' download>Click Here to Download</a></div>";
   
