<?php
function get_email_config()
{
    $data = file_exists('configs/mail_configs.json') ? file_get_contents('configs/mail_configs.json') :  false;
    if ($data !== false)
        return json_decode($data);
    $r = [
        "from_name" => "Jake Dummett",
        "from_mail" => "info@helixsafety.com.au",
    ];
    $r = json_encode($r);
    file_put_contents('configs/mail_configs.json', $r);
    return json_decode($r);
}

function get_email_recepients()
{
    global $BASE_URL;
    $data = file_exists($_SERVER['DOCUMENT_ROOT'].$BASE_URL .'configs/mail_receipients.json') ? file_get_contents($_SERVER['DOCUMENT_ROOT'].$BASE_URL .'configs/mail_receipients.json') : false;
    if ($data !== false && $data != null) {
        return json_decode($data);
    }
    $r = [
        [ 'id' => 1, 'name' => 'Fitness for word', 'email' => 'navaro@yhoo.com'],
        [ 'id' => 2, 'name' => 'Hazardous Chemicals', 'email' => 'navaro@yhoo.com'],
        [ 'id' => 3, 'name' => 'Working at height', 'email' => 'navaro@yhoo.com'],
        [ 'id' => 4, 'name' => 'Demolition and asbbestous', 'email' => 'navaro@yhoo.com'],
        [ 'id' => 5, 'name' => 'Temporary work', 'email' => 'navaro@yhoo.com'],
        [ 'id' => 6, 'name' => 'confidense space', 'email' => 'navaro@yhoo.com'],
        [ 'id' => 7, 'name' => 'excavation', 'email' => 'navaro@yhoo.com'],
        [ 'id' => 8, 'name' => 'Electrical', 'email' => 'navaro@yhoo.com'],
        [ 'id' => 9, 'name' => 'traffic', 'email' => 'navaro@yhoo.com'],
        [ 'id' => 10, 'name' => 'Mobile plamt', 'email' => 'navaro@yhoo.com'],
        [ 'id' => 11, 'name' => 'Creoewoer', 'email' => 'navaro@yhoo.com'],
        [ 'id' => 12, 'name' => 'Work Water', 'email' => 'navaro@yhoo.com'],
        [ 'id' => 13, 'name' => 'Tunnelin', 'email' => 'navaro@yhoo.com']
    ];
    $r = json_encode($r);
    file_put_contents($_SERVER['DOCUMENT_ROOT'].$BASE_URL .'configs/mail_receipients.json', $r);
    return json_decode($r);
}

function send_document($recepient, $html, $file_name, $subject)
{
    $config = get_email_config();
    //var_dump($config);
    date_default_timezone_set("Australia/Adelaide");

    // Attachment file 
    $file = $file_name; 
    // Email body content 
    $htmlContent = $html; 
    // Header for sender info 
    $headers = "From: ".($config->from_name)." <".($config->from_mail).">\n"; 
    if (isset($recepient->cc))
        $headers .= 'Cc: '.$recepient->cc . "\n";
    // Boundary  
    $semi_rand = md5(time());  
    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  
    
    // Headers for attachment  
    $headers .= "MIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
    
    // Multipart boundary  
    $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
    "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";  
    
    // Preparing attachment 
    if(!empty($file) > 0){ 
        if(is_file($file)){ 
            $message .= "--{$mime_boundary}\n"; 
            $fp =    @fopen($file,"rb"); 
            $data =  @fread($fp,filesize($file)); 
    
            @fclose($fp); 
            $data = chunk_split(base64_encode($data)); 
            $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" .  
            "Content-Description: ".basename($file)."\n" . 
            "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" .  
            "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
        } 
    } 
    $message .= "--{$mime_boundary}--"; 
    $returnpath = "-f" . $config->from_mail; 
    
    // Send email 
    return mail($recepient, $subject, $message, $headers, $returnpath);  
}