<?php header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set('Asia/Novosibirsk');?>
<!DOCTYPE html>
<html>
    <head>
        <title>Калькулятор W&T Program</title>
        <meta charset="utf-8">
		<link rel='StyleSheet' type='text/css' href='look.css'> 
    </head>
	
<?php
$dbParams=require('db.php');
	$db= new PDO(
		$dbParams['connection'],
		$dbParams['username'],
		$dbParams['password']
	);

$Agency = '1';





//для поля с Программой
$programQuery =$db
	->prepare('
		SELECT * FROM `program` WHERE `agency_id` = '.$Agency.'
	');
$programQuery
	->execute();
$programs=$programQuery
	->fetchAll(PDO::FETCH_ASSOC);
	










var_dump($programs);

?>













<div class="half-width">
	<label for="id">Агентство</label>
	</div>
	<div class="half-width">
		<select name='agencySelector'>
			<?php foreach ($agencies as $agency) { ?>
			<option value='
			<?=htmlspecialchars($agency['agency_id']);
			if(isset($_GET['agencySelector'])) {
				$Agency = ($_GET['agencySelector']);
			}
			?>'><?=htmlspecialchars ($agency['sponsor'])?></option>
			<?php } ?>
		</select>
	</div>
	
	<div class="half-width">
		<label for="id">Вариант программы</label>
	</div>
	<div class="half-width">
		<select name='programSelector'>
			<?php foreach ($programs as $program) { ?>
			<option value='
			<?=htmlspecialchars($program['program_id']);
			if(isset($_GET['programSelector'])) {
				$Program = ($_GET['programSelector']);
			}
			?>'><?=htmlspecialchars($program['name'])?></option>
			<?php } ?>
		</select>
	</div>

<?



$Agency = ($_GET['agencySelector']);
$Program = ($_GET['programSelector']);
$ProgramCost = ($_GET['program_base_cost']);
$AgencyRegistrationFee = ($_GET['agency_registration_fee']);
$AgencyWorkingFee = ($_GET['agency_working_fee']);
$AgencyAdditionalFee = ($_GET['agency_additional_fee']);
$AgencyDepositFee = ($_GET['agency_deposit_fee']);
$VisaConsularFee = ($_GET['visa_consular_fee']);
$Visa = ($_GET['visaSelector']);
$VisaPeriod = ($_GET['visa_period']);
$Transport = ($_GET['transportSelector']);
$VisaTansfer = ($_GET['visa_tansfer']);
$VisaHousing = ($_GET['visa_housing']);
$VisaCheckHousing = ($_GET['visa_check_housing']);
$VisaMeal = ($_GET['visa_meal']);
$VisaCheckMeal = ($_GET['visa_check_meal']);
$VisaLiving = ($_GET['visa_living']);
$VisaCheckLiving = ($_GET['visa_check_living']);
$Date1 = ($_GET['data1']);
$Date2 = ($_GET['data2']);
$StatePeriod = ($_GET['state_period']);
$State = ($_GET['stateSelector']);
$StateFlight = ($_GET['state_flight']);
$StateTransfer = ($_GET['state_transfer']);
$StateHousing = ($_GET['state_housing']);
$StateMeal = ($_GET['state_meal']);
$StateEntertainment = ($_GET['state_entertainment']);
$StateLiving = ($_GET['state_living']);
$StateCheckTaxes = ($_GET['state_check_taxes']);
$MoneyWith = ($_GET['money_with']);
$Salary1 = ($_GET['salary1']);
$WorkTime1 = ($_GET['worktime1']);
$Salary2 = ($_GET['salary2']);
$WorkTime2 = ($_GET['worktime2']);
$Work2Checked = ($_GET['work2_checked']);
$TaxesBackChecked = ($_GET['taxes_back_checked']);















