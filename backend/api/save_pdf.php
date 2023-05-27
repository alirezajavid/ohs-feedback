<?php
require_once 'libs/dompdf/autoload.inc.php';
include "template.php";

use Dompdf\Dompdf;

function save_pdf($data)
{
    $html = render("feedback.blade.php", $data);
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrate');
    $dompdf->render();
    return [$html, $dompdf->output()];
}

function send_feedback()
{
    global $BASE_URL;
    http_response_code(201);
    $data = file_get_contents('php://input');
    $data2 = json_decode($data);
    $file_name = date("YmdHis").$data2->type[0].uniqid();
    @mkdir("repository/{$file_name}");
    file_put_contents("repository/{$file_name}/data.json", $data);
    
    $a = save_pdf($data2);
    file_put_contents("repository/{$file_name}/report.pdf", $a[1]);
    file_put_contents("repository/{$file_name}/report.html", $a[0]);
    $recepients = get_email_recepients();
    $emails = [];
    send_document(
        $recepients[$data2->id],
        $a[0], 
        "repository/{$file_name}/report.pdf", 
        "Feedback"
    );

    header('Content-Type: application/json; charset=utf-8');
    print (
        json_encode([
            'mail' => $recepients[$data2->id],
            'pdf' => $BASE_URL ."repository/{$file_name}/report.pdf",
            'html' => $BASE_URL ."repository/{$file_name}/report.html"
        ])
    );

}