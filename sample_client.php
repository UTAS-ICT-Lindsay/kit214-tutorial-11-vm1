<?php//display php errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
?>

<h2>String Reverser Web Service</h2>
<form action='sample_client.php' method='GET'/>
    <div><input name='input' value=''/></div>
    <div><input type='Submit' name='submit' value='GO'/></div>
</form>

<?php
if(isset($_GET['input']))
{
    $input = $_GET['input'];
    
    //make soap work with our Azure self-signed SSL certs
    $context = stream_context_create([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ]);
   

    $client = new SoapClient(null, array(
        'location' => "YOUR_VM_URL_HERE/tute11/sample_server.php", 
        'uri'    => "urn://utas/kit214", 
        'stream_context' => $context
    ));
    $result = $client->__soapCall("reverseString", array($input));
    echo $result;
}
?>