<?php

$queryUrl = 'https://minsvyazcc.bitrix24.ru/rest/62/htb2x60n4uhbf2vh/crm.contact.list';
$queryData = http_build_query(array(
	'order' => array("STATUS_ID"=>"ASC"),
	'filter' => array("EMAIL"=>iconv("windows-1251", "utf-8", $_POST['email'])),
	'select' => array("ID", "EMAIL")
));

$curl = curl_init();
curl_setopt_array($curl, array(
	CURLOPT_SSL_VERIFYPEER => 0,
	CURLOPT_POST => 1,
	CURLOPT_HEADER => 0,
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_URL => $queryUrl,
	CURLOPT_POSTFIELDS => $queryData,
));

//создадим задачу
$result = curl_exec($curl);
$result = json_decode($result, 1);
print_r($result);
$ID = $result['result'][0]['ID'];
curl_close($curl);

date_default_timezone_set('Europe/Moscow');

$gotov = 0;
if($_POST['poll_ready']=='other')
	$gotov = 56;
else
	$gotov = $_POST['poll_ready'];

if($ID>0)
{
	$queryUrl = 'https://minsvyazcc.bitrix24.ru/rest/62/htb2x60n4uhbf2vh/crm.deal.add';
	$queryData = http_build_query(array(
		'fields' => array(
			"TITLE" => "Квиз от (".$_POST['email'].")", 
            "TYPE_ID" => "SALEW", 
            "STAGE_ID" => "NEW", 					
            "CONTACT_ID" => $ID,
            "OPENED" => "Y", 
            "ASSIGNED_BY_ID" => 46, 
            "BEGINDATE" => date("Y-m-d\TH:i:s"),
			"UF_CRM_1594393983" => $_POST['poll_company'],
			"UF_CRM_1594394004" => $_POST['poll_company_descr'],
			"UF_CRM_1594394017" => $_POST['poll_company_country'],
			"UF_CRM_1594394030" => $_POST['poll_company_name'],
			"UF_CRM_1594394106" => $gotov,
			"UF_CRM_1594394133" => $_POST['poll_ready_7_text'],
			"UF_CRM_1594394150" => $_POST['poll_company_founders'],
			"UF_CRM_1594394164" => $_POST['poll_company_market'],
			"UF_CRM_1594394188" => $_POST['poll_ready_7_finance'],
			"UF_CRM_1594394201" => $_POST['poll_company_sum'],
			"UF_CRM_1594394224" => $_POST['poll_company_income'],
			"UF_CRM_1594394236" => $_POST['poll_company_income_2'],
			"UF_CRM_1594394261" => $_POST['poll_company_patents'],
			"UF_CRM_1594394277" => $_POST['poll_company_accelerators'],
			"UF_CRM_1594394306" => $_POST['poll_company_link'],
			"UF_CRM_1594394336" => $_POST['poll_email'],
			"UF_CRM_1594394359" => $_POST['poll_phone']
		),
		'params' => array("REGISTER_SONET_EVENT" => "Y")
	));

	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_SSL_VERIFYPEER => 0,
		CURLOPT_POST => 1,
		CURLOPT_HEADER => 0,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $queryUrl,
		CURLOPT_POSTFIELDS => $queryData,
	));

	//создадим задачу с лидом
	$result = curl_exec($curl);
	$result = json_decode($result, 1);
	print_r($result);
	curl_close($curl);
} 
else {
	$queryUrl = 'https://minsvyazcc.bitrix24.ru/rest/62/htb2x60n4uhbf2vh/crm.contact.add';
	$queryData = http_build_query(array(
		'fields' => array(
			"NAME" => $_POST['name'],
			"SOURCE_ID" => "WEB",
			"ASSIGNED_BY_ID" => 46,
			"PHONE" => array(array("VALUE" => $_POST['phone'], "VALUE_TYPE" => "WORK" )),
			"EMAIL" => array(array("VALUE" => $_POST['email'], "VALUE_TYPE" => "WORK" )),
			"UF_CRM_1594399373" => $_POST['company'],
			"UF_CRM_1594399387" => $_POST['poll_company_country'],
			"UF_CRM_1594399396" => $_POST['name'],
		),
		'params' => array("REGISTER_SONET_EVENT" => "Y")
	));

	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_SSL_VERIFYPEER => 0,
		CURLOPT_POST => 1,
		CURLOPT_HEADER => 0,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $queryUrl,
		CURLOPT_POSTFIELDS => $queryData,
	));

	//создадим задачу с лидом
	$result = curl_exec($curl);
	$result = json_decode($result, 1);
	print_r($result);
	$ID = $result['result'];
	curl_close($curl);
	
	$queryUrl = 'https://minsvyazcc.bitrix24.ru/rest/62/htb2x60n4uhbf2vh/crm.deal.add';
	$queryData = http_build_query(array(
		'fields' => array(
			"TITLE" => "Квиз от (".$_POST['email'].")", 
            "TYPE_ID" => "SALEW", 
            "STAGE_ID" => "NEW", 					
            "CONTACT_ID" => $ID,
            "OPENED" => "Y", 
            "ASSIGNED_BY_ID" => 46, 
            "BEGINDATE" => date("Y-m-d\TH:i:s"),
			"UF_CRM_1594393983" => $_POST['poll_company'],
			"UF_CRM_1594394004" => $_POST['poll_company_descr'],
			"UF_CRM_1594394017" => $_POST['poll_company_country'],
			"UF_CRM_1594394030" => $_POST['poll_company_name'],
			"UF_CRM_1594394106" => $gotov,
			"UF_CRM_1594394133" => $_POST['poll_ready_7_text'],
			"UF_CRM_1594394150" => $_POST['poll_company_founders'],
			"UF_CRM_1594394164" => $_POST['poll_company_market'],
			"UF_CRM_1594394188" => $_POST['poll_ready_7_finance'],
			"UF_CRM_1594394201" => $_POST['poll_company_sum'],
			"UF_CRM_1594394224" => $_POST['poll_company_income'],
			"UF_CRM_1594394236" => $_POST['poll_company_income_2'],
			"UF_CRM_1594394261" => $_POST['poll_company_patents'],
			"UF_CRM_1594394277" => $_POST['poll_company_accelerators'],
			"UF_CRM_1594394306" => $_POST['poll_company_link'],
			"UF_CRM_1594394336" => $_POST['poll_email'],
			"UF_CRM_1594394359" => $_POST['poll_phone']
		),
		'params' => array("REGISTER_SONET_EVENT" => "Y")
	));

	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_SSL_VERIFYPEER => 0,
		CURLOPT_POST => 1,
		CURLOPT_HEADER => 0,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $queryUrl,
		CURLOPT_POSTFIELDS => $queryData,
	));

	//создадим задачу с лидом
	$result = curl_exec($curl);
	$result = json_decode($result, 1);
	print_r($result);
	curl_close($curl);
}




$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= 'From: office@minsvyazcc.ru' . "\r\n";


$body = '

<meta charset="utf-8">
<table cellpadding="0" cellspacing="0" border="0" width="100%" style="width:100%;">
  <tr>
    <td style="padding:20px;background:#f3f3f3;font-family: Arial,sans-serif;">

      <table cellpadding="0" cellspacing="0" border="0" align="center" background="#ffffff"
             style="max-width:700px;background: #fff; box-shadow: 0 10px 30px 0 rgba(0,0,0,.3);">

        <tr>

          <td style="background:#000;padding:0 10px;">

            <table cellpadding="0" cellspacing="0" border="0" width="100%" style="width:100%;">
              <tr>
                <td style="padding:20px 20px 20px 20px;text-align:center;">
                  <img src="http://test.fglukhov.tmweb.ru/mincom/images/logo.png" alt="Цифровой акселератор" width="100">
                </td>
                <td style="padding:20px 20px 20px 0;">
                  <img src="http://test.fglukhov.tmweb.ru/mincom/images/logo-ttl.png" alt="Цифровой акселератор" width="106">
								</td>
              </tr>
            </table>

          </td>

        </tr>

        <tr>

          <td
            style="color: #273057;	background: #fff;	padding: 30px 30px 0 30px;	text-align: center;	font-size: 24px;	line-height: 30px;	font-weight: bold;">

            Новая заявка.

          </td>

        </tr>

        <tr>

          <td
            style="background: #fff;padding: 20px 30px 0 30px;text-align: center;font-size: 15px;line-height: 22px;color: #273057;">

            Поступила заявка с сайта.

          </td>

        </tr>

        <tr>

          <td style="background: #fff;padding:30px;">

            <table cellpadding="0" cellspacing="0" border="0" width="100%">
              <tr>
                <td style="padding:20px;border:1px solid #273057;">
                  <table cellpadding="0" cellspacing="0" border="0" width="100%">
';

if ($_POST['name']) {
  $body.='
  
      <tr>
        <td style="font-family:Verdana,Helvetica,sans-serif;font-size:13px;line-height:22px;color:#000;vertical-align:top;padding:0 60px 1px 0;white-space:nowrap;">Имя:</td>
        <td style="font-family:Verdana,Helvetica,sans-serif;color:#000;font-size:15px;line-height:22px;vertical-align:top;padding:0 0 4px 0;">'.$_POST['name'].'</td>
      </tr>  
  
  ';
}


if ($_POST['company']) {
  $body.='
  
      <tr>
        <td style="font-family:Verdana,Helvetica,sans-serif;font-size:13px;line-height:22px;color:#000;vertical-align:top;padding:0 60px 1px 0;white-space:nowrap;">Организация:</td>
        <td style="font-family:Verdana,Helvetica,sans-serif;color:#000;font-size:15px;line-height:22px;vertical-align:top;padding:0 0 4px 0;">'.$_POST['company'].'</td>
      </tr>  
  
  ';
}

if ($_POST['phone']) {
  $body.='
  
      <tr>
        <td style="font-family:Verdana,Helvetica,sans-serif;font-size:13px;line-height:22px;color:#000;vertical-align:top;padding:0 60px 1px 0;white-space:nowrap;">Телефон:</td>
        <td style="font-family:Verdana,Helvetica,sans-serif;color:#000;font-size:15px;line-height:22px;vertical-align:top;padding:0 0 4px 0;">'.$_POST['phone'].'</td>
      </tr>  
  
  ';
}

if ($_POST['email']) {
  $body.='
  
      <tr>
        <td style="font-family:Verdana,Helvetica,sans-serif;font-size:13px;line-height:22px;color:#000;vertical-align:top;padding:0 60px 1px 0;white-space:nowrap;">Почта:</td>
        <td style="font-family:Verdana,Helvetica,sans-serif;color:#000;font-size:15px;line-height:22px;vertical-align:top;padding:0 0 4px 0;">'.$_POST['email'].'</td>
      </tr>  
	  
  ';
}

if ($_POST['quizresult']) {
	$body.='

		<tr>
			<td style="font-family:Verdana,Helvetica,sans-serif;font-size:13px;line-height:22px;color:#000;vertical-align:top;padding:0 60px 1px 0;white-space:nowrap;">Результат квиза:</td>
			<td style="font-family:Verdana,Helvetica,sans-serif;color:#000;font-size:15px;line-height:22px;vertical-align:top;padding:0 0 4px 0;">'.$_POST['quizresult'].'</td>
		</tr>

	';
}

$body.='

                  </table>

                </td>

              </tr>

              <tr>
                <td style="text-align: center;font-size: 12px;line-height: 16px;color:#ccc;padding: 20px 0 27px 0;">
                  &copy; Цифровой акселератор, 2020. Все права защищены.
                </td>
              </tr>

            </table>

          </td>
        </tr>
      </table>

    </td>
  </tr>
</table>

';

// Отправка письма пользователю, если указан email
/*
if ($_POST['email']) {
  mail($_POST['email'], $_POST['subject'], $body, $headers);
}
*/
// Отправка письма администратору

mail('minsvyazcc.ru', $_POST['subject'], $body, $headers);

//echo $body;


?>