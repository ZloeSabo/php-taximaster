<?php
	/**
	 * ВНИМАНИЕ
	 * Для работы с API на сервере должны быть установлены расширения Curl и JSON 
	 */
    $errorMessage = '';

	if(count($_POST) > 0)
    {
		if(!isset($_POST['Number']) || empty($_POST['Number'])) {
			$errorMessage = "<p>Не заполнен «Номер телефона»!</p>";
		} else if(!isset($_POST['OrderSourceAddress']) || empty($_POST['OrderSourceAddress'])) {
			$errorMessage = "<p>Не заполнен «Адрес подачи»!</p>";
		} else {

			$ip = '127.0.0.1';		//Ваш ip адрес
			$port = 8089;			//Ваш порт
			$secret = 'secret';		//Ваш секретный ключ
			$crew_group_id = 59;	//Группа экипажей

			function autoloader($classname) {
			    $dir = dirname(__FILE__);
			    if(strpos($classname, 'Request') !== false) {
					include $dir . '/../Request/' . $classname . '.php'; //Указать правильную папку!
			    } else if (strpos($classname, 'Response') !== false) {
					include $dir . '/../Response/' . $classname . '.php'; //Указать правильную папку!
			    }
			}

			spl_autoload_register('autoloader');


			$request = new CreateOrderRequest($ip, $port, $secret);

			$request
			    ->setPhone($_POST["Number"])
			    ->setCustomer($_POST["OrderClientName"])
			    ->setSource($_POST["OrderSourceAddress"])
			    ->setComment($_POST["OrderComment"])
			    ->setCrewGroupId($crew_group_id)
			    ;

			$request->send();

			$errorMessage = false;

			if($request->isSucessful()) {
			    $response = $request->getResponse();

			    if(!$response->isSuccessful()) {
					$errorMessage = $response->getStatusMessage();
			    }
			    
			} else {
			    $errorMessage = $request->getStatusMessage();
			}
			
			if(empty($errorMessage)) {
				unset($_POST["Number"], $_POST["OrderClientName"], $_POST["OrderSourceAddress"], $_POST["OrderComment"]);
			}
            $errorMessage = empty($errorMessage) ? '<p>Спасибо за заказ, ожидайте подачи автомобиля.</p>' : '<p>При создании заказа возникла ошибка: <span style="hidden">' . $errorMessage . '</span></p>';

		}
    }

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
    <title>Такси</title>
    <style>
    	tr > td {
    		vertical-align: top
    	}
    </style>
</head>
<body>
<div class="work">

    <div class="redbold">
        <?php echo $errorMessage ?>
    </div>

    <form action="" method="post">
    <table>
        <tr>
            <td width="175" align="right" valign="middle" class="bold">
                *Номер телефона:
            </td>
            <td>
                <input type="text" name="Number" class="inp" maxlength="11" size="10"
                       value="<?php echo isset($_POST['Number']) ? $_POST['Number'] : '' ?>"/><br/>
                Пример: <strong>555111</strong> или <strong>89331515153</strong>
            </td>
        </tr>

        <tr>
            <td width="175" align="right" valign="middle">Ваше имя и отчество:</td>
            <td><input type="text" name="OrderClientName" class="inp" maxlength="50"
                       size="35"
                       value="<?php echo isset($_POST['OrderClientName']) ? $_POST['OrderClientName'] : '' ?>"/><br/>
                Пример: <strong>Василий Анатольевич</strong>
            </td>
        </tr>

        <tr>
            <td width="175" align="right" valign="middle" class="bold">
                *Адрес подачи:
            </td>
            <td>
                <input type="text" name="OrderSourceAddress" class="inp"
                       maxlength="50" size="35"
                       value="<?php echo isset($_POST['OrderSourceAddress']) ? $_POST['OrderSourceAddress'] : '' ?>"/><br/>
                       Пример: <strong>Пушкинская 155</strong>
            </td>
        </tr>

        <tr>
            <td width="175" align="right" valign="middle">Примечание:</td>
            <td>
            	<textarea name="OrderComment" class="inp" maxlength="100" cols="35"></textarea><br/>
            	Заполнять не обязательно
            </td>
        </tr>
        <tr>
        	<td colspan="2">
            	<strong>* - Поля обязательные к заполнению.</strong>
            </td>
        </tr>
        <tr>
        	<td>&nbsp;</td>
        	<td>
        		<input type="submit" name="submit" value="Заказать"/>
        	</td>
        </tr>
    </table>
    </form>

</div>

</body>
</html>
