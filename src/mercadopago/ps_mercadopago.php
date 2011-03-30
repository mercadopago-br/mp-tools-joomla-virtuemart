<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 

class ps_mercadopago {
    var $classname = "ps_mercadopago";
    var $payment_code = "MPAGO";
    
   function show_configuration() {
        global $VM_LANG;
        $db = new ps_DB();
        
	function show_configuration() {
    $configs = $this->configs();
    foreach($configs as $item) 
      $this->trataInput($item);
  }
		
        
        include(CLASSPATH ."payment/".$this->classname.".cfg.php");
    ?>
<SCRIPT type="text/javascript">
function Biblioteca( from, to )
{
		document.getElementsByName(to)[0].value = document.getElementsByName(from)[0].value;
}
</SCRIPT>
    <table>
        <tr>
        <td width="100"><font color="#FF0000"><strong><b>Número da Conta</strong></td>
            <td width="395">
			<input type="text" name="MPAGO_ID" class="inputbox" size ="14" value="<?php  echo MPAGO_ID ?>" /><b> -->acc_id</td>
            
            <td width="118" rowspan="5"><img src="http://www.mercadolivre.com.br/org-img/MLB/MP/BANNERS/tipo2_357X75.jpg" /></td>
			</tr>
			<td width="130"><font color="#FF0000"><strong><b>Cód. de Segurança</strong></td>
            <td width="390">
			<input type="text" name="MPAGO_ENC" size ="50" class="inputbox" value="<?php  echo MPAGO_ENC ?>" /><b>-->Enc</td>
            
	    </tr>
			<tr>
		      <td  width="100"><font color="#FF0000"><strong><b>Url de Processamento</strong></td>
            <td>
			<input type="text" name="MPAGO_URL_PROCESS" size ="50" class="inputbox" value="<?php  echo MPAGO_URL_PROCESS ?>" /></td>
			  
           
	    </tr>
			<tr>
		      <td  width="100"><font color="#FF0000"><strong><b>Url de Sucesso</strong></td>
            <td>
			<input type="text" name="MPAGO_URL_SUCCESFULL" size ="50" class="inputbox" value="<?php  echo MPAGO_URL_SUCCESFULL ?>" /></td>
            
	    </tr>
		
		<tr>
		      <td  width="100"><strong></strong></td>
            <td>
			</td>
            
	    </tr>
		
		<tr>
		      <td  width="100"><strong></strong></td>
            <td>
			</td>
            
	    </tr>
		
		<tr>
		      <td  width="100"><strong><b>Reseller (OPCIONAL)</strong></td>
            <td>
			<input type="text" name="MPAGO_RESELLER_ACC_ID" size ="14" class="inputbox" value="<?php  echo MPAGO_RESELLER_ACC_ID ?>" /></td>
            
	    </tr>
					<tr>
		      <td><strong></strong></td>
            <td colspan="2"><br>
<textarea name="MercadoPago_FORM" cols="80" rows="15" readonly="readonly" STYLE="display:none;">
<?php echo "<?php\n"; ?>
include (JPATH_COMPONENT_ADMINISTRATOR.'/classes/payment/mercadopago/biblioteca/mpago.php');
include (JPATH_COMPONENT_ADMINISTRATOR.'/classes/payment/mercadopago/biblioteca/tratadados.php');
$db1 = new ps_DB();
$db1->query("SELECT * FROM #__vm_order_item WHERE order_id = '".$db->f('order_id')."'");

// Busca a descrição do produtos e concatena
while ($db1->next_record()) {
$zb[]=$db1->f('order_item_name');
$za=implode("+",$zb);
}

//Adiciona os dados da conta do vendedor
$mpago = new mpago(array(
  
  'acc_id' => MPAGO_ID,
  'reseller_acc_id' => MPAGO_RESELLER_ACC_ID,
  'url_process' => MPAGO_URL_PROCESS,
  'url_succesfull' => MPAGO_URL_SUCCESFULL,
  'enc' => MPAGO_ENC,
  'price' => $db->f('order_total'),
  'seller_op_id' => $db->f("order_id"),
 
));

list($telefone_ddd, $telefone) = trataTelefone($user->phone_1);
list($endereco, $endereco_num) = trataEndereco("{$user->address_1} {$user->address_2}");

//Adiciona os dados do Cliente ao Carrinho do MercadoPago
$mpago->cliente(array(
  'cart_name' => $user->first_name,
  'cart_surname' => $user->middle_name." ".$user->last_name,
  'cart_cep' => $user->zip,
  'cart_street' => $user->address_1,
  'cart_number' => $endereco_num,
  'cart_complement' => $user->address_2,
  'cart_city' => $user->city,
  'cart_state' => $user->state,
  'cart_phone' => $telefone,
  'op_retira' => '',
  'shipping_cost' => '',
  'ship_cost_mode' => '',
  'cart_email' => $user->user_email,
   'name'=>$za,
));


$mpago->mostra();
$VM_LANG->_('VM_CHECKOUT_MPAGO_BUTTON_OPEN_WINDOW') ?></td><td width="100%" id="flashLoader"></td></tr></table>
<br><br><br>
<img src="http://www.mercadolivre.com.br/org-img/MLB/MP/BANNERS/tipo2_728x90.gif" border="0">

</textarea>
<BUTTON onClick="Biblioteca('MercadoPago_FORM', 'payment_extrainfo')">
<font color="#191970" size="2"><b>Incluir Biblioteca</BUTTON>            </td>
        </tr>
      </table>
    <?php
    }
    
    function has_configuration() {
    
      return true;
   }
   
   function configfile_writeable() {
      return is_writeable( CLASSPATH."payment/".$this->classname.".cfg.php" );
   }
   
   function configfile_readable() {
      return is_readable( CLASSPATH."payment/".$this->classname.".cfg.php" );
   }
  
   function write_configuration( &$d ) {
      
      $my_config_array = array(
				  "MPAGO_ID" => $d['MPAGO_ID'],
		  		  "MPAGO_ENC" => $d['MPAGO_ENC'],
				  "MPAGO_URL_PROCESS" => $d['MPAGO_URL_PROCESS'],
		  		  "MPAGO_URL_SUCCESFULL" => $d['MPAGO_URL_SUCCESFULL'],
				  "MPAGO_RESELLER_ACC_ID" => $d['MPAGO_RESELLER_ACC_ID']
				  );
      $config = "<?php\n";
      $config .= "if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); ; \n\n";
      foreach( $my_config_array as $key => $value ) {
        $config .= "define ('$key', '$value');\n";
      }
      
      $config .= "?>";
  
      if ($fp = fopen(CLASSPATH ."payment/".$this->classname.".cfg.php", "w")) {
          fputs($fp, $config, strlen($config));
          fclose ($fp);
          return true;
     }
     else
        return false;
   }
   
    function process_payment($order_number, $order_total, &$d) {
        return true;
    }
   
}
