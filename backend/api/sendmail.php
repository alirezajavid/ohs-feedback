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