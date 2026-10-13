<?php
$service_url = 'https://integracao.dli.minhabiblioteca.com.br/DigitalLibraryIntegrationService/AuthenticatedUrl';
$curl = curl_init($service_url);
// dados do aluno
$firstName = $_POST['lis_person_name_given'];
$lastName = $_POST['lis_person_name_family'];
$email = $_POST['lis_person_contact_email_primary'];
$curl_post_data = "<?xml version=\"1.0\" encoding=\"utf-8\"?>
<CreateAuthenticatedUrlRequest
xmlns=\"http://dli.zbra.com.br\"
xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\"
xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">
<FirstName>$firstName</FirstName>
<LastName>$lastName</LastName>
<Email>$email</Email>
<CourseId xsi:nil=\"true\"/>
<Tag xsi:nil=\"true\"/>
<Isbn xsi:nil=\"true\"/>
</CreateAuthenticatedUrlRequest>
";
$content_size = strlen($curl_post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
"Content-Type: application/xml; charset=utf-8",
"Host: integracao.dli.minhabiblioteca.com.br",
"Content-Length: $content_size",
"Expect: 100-continue",
"Accept-Encoding: gzip, deflate",
"Connection: Keep-Alive",
"X-DigitalLibraryIntegration-API-Key: 73ed8ac9-2add-4144-a444-12209d949f19")
);
curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
$curl_response = curl_exec($curl);
if ($curl_response === false) {
echo curl_error($curl);
curl_close($curl);
die();
}
curl_close($curl);
$xml = new SimpleXMLElement($curl_response);
if ($xml->Success != 'true') {
echo htmlspecialchars($result);
die();
}
// user code below to redirect browser to the authenticated URL
//echo header('Location: ' . $xml->AuthenticatedUrl);
//echo $xml->AuthenticatedUrl;
header('Location: ' . $xml->AuthenticatedUrl);
///die();
?>