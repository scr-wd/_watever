<?php header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set('Asia/Novosibirsk');
setlocale(LC_MONETARY, 'ru_RU');?>
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

//для селектора Агентство/Программа
$agencyQuery = $db
	->prepare('
		SELECT * FROM `program` INNER JOIN `agency` ON `agency`.`agency_id` = `program`.`agency_id`
	');
$agencyQuery
	->execute();
$agencies=$agencyQuery
	->fetchAll(PDO::FETCH_ASSOC);

//для выбора Агентство/Программа
if (isset($_GET['agencySelector'])) {
	$Program = ($_GET['agencySelector']);
}
else
{
	$Program = '1';
}

//для полей Агентство/Программа
$selectedagencyQuery = $db
	->prepare('
		SELECT * FROM `program` INNER JOIN `agency` ON `agency`.`agency_id` = `program`.`agency_id` WHERE `program_id` = '.$Program.'
	');
$selectedagencyQuery
	->execute();
$selectedagencies=$selectedagencyQuery
	->fetchAll(PDO::FETCH_ASSOC);

//для селектора с Городом
$visaQuery =$db
	->prepare('
		SELECT * FROM `visa`
	');
$visaQuery
	->execute();
$visum=$visaQuery
	->fetchAll(PDO::FETCH_ASSOC);

//для выбора Города
if (isset($_GET['visaSelector'])) {
	$Visa = ($_GET['visaSelector']);
}
else
{
	$Visa = '1';
}

//для полей с Городом
$selectedvisaQuery =$db
	->prepare('
		SELECT * FROM `visa` WHERE `visa_id` = '.$Visa.'
	');
$selectedvisaQuery
	->execute();
$selectedvisum=$selectedvisaQuery
	->fetchAll(PDO::FETCH_ASSOC);

//для селектора с Штатом
$stateQuery =$db
	->prepare('
		SELECT * FROM `state`
	');
$stateQuery
	->execute();
$states=$stateQuery
	->fetchAll(PDO::FETCH_ASSOC);

//для выбора Штата
if(isset($_GET['stateSelector'])){
	$State = ($_GET['stateSelector']);
}
else
{
	$State = '29';
}

//для полей со Штатом
$selectedstateQuery =$db
	->prepare('
		SELECT * FROM `state` WHERE `state_id` = '.$State.'
	');
$selectedstateQuery
	->execute();
$selectedstates=$selectedstateQuery
	->fetchAll(PDO::FETCH_ASSOC);






?>

    <body>
        <header class="page-header">
		<h1 align=center>Онлайн калькулятор W&T Program</h1>
		<h2 align=center>Калькулятор предназначен для подсчета <br><i>средне-статистических затрат и возможных доходов</i><br> потенциального участника программы Work And Travel 2019.</h2>
		<h5>Сервис использует для расчетов средние цены/ставки/стоимости на апрель 2018 года. Сервис является бесплатным. Сервис не является публичной офертой.<br>
		Подробнее об источниках вы можете прочесть <a href='#bottom'>ниже</a>.</h5>
		</header>
        <main>
          <form action="app.php" method="GET">
				
				
				<div class="half-width">
					<fieldset>
						<legend>Выбор агентства</legend>
						
						
						<div class="half-width">
							<label for="id">Агентство / Программа</label>
						</div>
						<div class="half-width">
							<select name='agencySelector'>
								<?php foreach ($agencies as $agency) { ?>
								<option <?if(isset($_GET['agencySelector']) and htmlspecialchars($agency['program_id']) == $_GET['agencySelector']):?> selected='selected' <?endif?> value='<?=htmlspecialchars($agency['program_id']);?>'><?=htmlspecialchars ($agency['sponsor']).' / '.htmlspecialchars($agency['name'])?></option>
								<?php } ?>
							</select>
						</div>
						
						
						
						<div class="half-width">
							<label for="id">Базовая стоимость</label>
						</div>
						<div class="half-width">
							<input type="text" name="program_base_cost" title= "Базовая стоимость выбранного варианта программы" value='<?
							foreach ($selectedagencies as $selectedagency) {};
							$ProgramCost = htmlspecialchars($selectedagency['base_cost']);
							print (number_format($ProgramCost, 0, ',', ' ').' руб.');
							?>' disabled>
						</div>
						
						<div class="half-width">
							<label for="id">Регистрационный взнос</label>
						</div>
						<div class="half-width">
							<input type="text" name="agency_registration_fee" title= "Регистрационный взнос агентства" value='<?
							foreach ($selectedagencies as $selectedagency) {};
							$AgencyRegistrationFee = htmlspecialchars($selectedagency['registration_fee']);
							print (number_format($AgencyRegistrationFee, 0, ',', ' ').' руб.');
							?>' disabled>
						</div>
						
						<div class="half-width">
							<label for="id">Поиск работы</label>
						</div>
						<div class="half-width">
							<input type="text" name="agency_working_fee" title= "Стоимость поиска работ агентством" value='<?
							$AgencyWorkingFee = htmlspecialchars($selectedagency['working_fee']);
							print (number_format($AgencyWorkingFee, 0, ',', ' ').' руб.');
							?>' disabled>
						</div>
						
						<div class="half-width">
							<label for="id">Дополнительные услуги</label>
						</div>
						<div class="half-width">
							<input type="text" name="agency_additional_fee" title= "Стоимость дополнительных услуг агентства" value='<?
							$AgencyAdditionalFee = htmlspecialchars($selectedagency['additional_fee']);
							print (number_format($AgencyAdditionalFee, 0, ',', ' ').' руб.');
							?>' disabled>
						</div>
						
						<div class="half-width">
							<label for="id">Депозит</label>
						</div>
						<div class="half-width">
							<input type="text" name="agency_deposit_fee" title= "Возвращаемый депозит агентству" value='<?
							$AgencyDepositFee = htmlspecialchars($selectedagency['deposit_fee']);
							print (number_format($AgencyDepositFee, 0, ',', ' ').' руб.');
							?>' disabled>
						</div>
						
						
						
						<hr>
						<div class="half-width">
						</div>
						<div class="half-width">
							<div class="half-width">
								<label for="id">Итого:</label>
							</div>
							<div class="half-width">
								<?php
								$AgencyTotal = $ProgramCost + $AgencyRegistrationFee + $AgencyWorkingFee + $AgencyAdditionalFee + $AgencyDepositFee;
								?>
								<input type="text" name="" title= "Итог по затратам, связанным с агентством" value='<?php print (number_format($AgencyTotal, 0, ',', ' ').' руб.'); ?>' disabled>
							</div>
						</div>
						
						
					</fieldset>
				</div>
				
				
				
				
				
				<div class="half-width">
					<fieldset>
						<legend>Оформление визы</legend>
						
						<div class="one-third-width">
							<label for="id">Консульский сбор</label>
						</div>
						<div class="two-third-width">
							<input type="text" name="visa_consular_fee" title= "Стоимость консульского сбора" value='<?
							$VisaConsularFee = htmlspecialchars($selectedagency['consular_fee']);
							print number_format($VisaConsularFee, 0, ',', ' ').' руб.';
							?>' disabled>
						</div>
						
						<div class="one-third-width">
							<label for="id">Город</label>
						</div>
						<div class="one-third-width">
							<select name='visaSelector'>
								<?php foreach ($visum as $visa) { ?>
								<option <?if(isset($_GET['visaSelector']) and htmlspecialchars($visa['visa_id']) == $_GET['visaSelector']):?> selected='selected' <?endif?> value='<?=htmlspecialchars($visa['visa_id'])?>'><?=htmlspecialchars($visa['name_of_city'])?></option>
								<?php } ?>
							</select>
						</div>
						<div class="one-third-width">
							<div class="one-third-width">
								<input type="number" name="visa_period" value="<?
								if (isset($_GET['visa_period'])) {
									$VisaPeriod = $_GET['visa_period'];
								}
								else
								{
									$VisaPeriod = 2;
								}
								print $VisaPeriod;
								?>" title= "Количество дней проживания в городе">
							</div>
						</div>


						<div class="one-third-width">
							<label for="id">Транспорт</label>
						</div>
						<div class="one-third-width">
							<select name='transportSelector' disabled>
								<option value='trans_avia' selected>Авиаперелет</option>
								<option value='trans_rail'>Ж/Д</option>
								<option value='trans_auto'>Автомобиль</option>
							</select>
						</div>
						<div class="one-third-width">
							<input type="text" name="visa_tansfer" title= "Стоимость трансфера" value='<?
							foreach ($selectedvisum as $selectedvisa) {};
							$VisaTansfer = htmlspecialchars($selectedvisa['trans_avia']);
							print number_format($VisaTansfer, 0, ',', ' ').' руб.';
							?>' disabled>
						</div>
						
						<div class="one-third-width">
							<label for="id">Жилье</label>
						</div>
						<div class="one-third-width">
							<input type="text" name="visa_housing" title= "Стоимость аренды за день" value='<?
							$VisaHousing = htmlspecialchars($selectedvisa['housing']);
							print number_format($VisaHousing, 0, ',', ' ').' руб.';
							?>' disabled>
						</div>
						<div class="one-third-width">
							<input type="checkbox" name="visa_check_housing" title= "Включить затраты" name="a" value="" checked disabled>
						</div>
						
						<div class="one-third-width">
							<label for="id">Питание</label>
						</div>
						<div class="one-third-width">
							<input type="text" name="visa_meal" title= "Стоимость питания за день" value='<?
							$VisaMeal = htmlspecialchars($selectedvisa['meal']);
							print number_format($VisaMeal, 0, ',', ' ').' руб.';
							?>' disabled>
						</div>
						<div class="one-third-width">
							<input type="checkbox" name="visa_check_meal" title= "Включить затраты" name="a" value="" checked disabled>
						</div>
						
						<div class="one-third-width">
							<label for="id">Остальное</label>
						</div>
						<div class="one-third-width">
							<input type="text" name="visa_living" title= "Включает дополнительные затраты на проживание (транспорт, развлечения и др.)" value='<?
							$VisaLiving = htmlspecialchars($selectedvisa['living']);
							print number_format($VisaLiving, 0, ',', ' ').' руб.';?>' disabled>
						</div>
						<div class="one-third-width">
							<input type="checkbox" name="visa_check_living" title= "Включить затраты" name="a" value="" checked disabled>
						</div>
						
						
						
						
						<hr>
						<div class="half-width">
						</div>
						<div class="half-width">
							<div class="half-width">
							<label for="id">Итого:</label>
							</div>
							<div class="half-width">
								<?php
								$VisaTotal = $VisaConsularFee + $VisaTansfer + (($VisaHousing + $VisaMeal + $VisaLiving) * $VisaPeriod);
								?>
								<input type="text" name="" title= "Итог по затратам, связанным с поездкой за визой" value='<?=number_format($VisaTotal, 0, ',', ' ').' руб.'?>' disabled>
							</div>
						</div>
						
						
						
					</fieldset>
				</div>
				
				
				
				
				
				
				
				
				
				
				
				<fieldset>
					<legend>Поездка</legend>
					
					
					<div class="one-third-width">
						<div class="one-third-width">
							<label for="id">Начало</label>
						</div>
						<div class="two-third-width">
							<input type="date" name="data1" title= "Дата вылета" value="<?php
							if (isset($_GET['data1'])) {
								$Date1 = $_GET['data1'];
							}
							else
							{
								$Date1 = '2018-05-15';
							}
							print $Date1;
							?>">
						</div>
					</div>
					<div class="one-third-width">
						<div class="one-third-width">
							<label for="id">Окончание</label>
						</div>
						<div class="two-third-width">
							<input type="date" name="data2" title= "Дата возвращения" value="<?php
							if (isset($_GET['data2'])) {
								$Date2 = $_GET['data2'];
							}
							else
							{
								$Date2 = '2018-09-15';
							}
							print $Date2;
							?>">
						</div>
					</div>
					<div class="one-third-width">
						<div class="one-third-width">
							<label for="id">Пребывание</label>
						</div>
						<div class="one-third-width">
							<input type="text" name="state_period" title= "Количество дней проживания в штатах" value='<?
							$StatePeriod = (intval(abs(strtotime($Date2) - strtotime($Date1))) / (3600*24) );
							print $StatePeriod;
							?>' disabled>
						</div>
					</div>
					
					<div class="one-third-width">
						<div class="one-third-width">
							<label for="id">Штат*</label>
						</div>
						<div class="two-third-width">
							<select name='stateSelector'>
								<?php foreach ($states as $state) { ?>
								<option <?if(isset($_GET['stateSelector']) and htmlspecialchars($state['state_id']) == $_GET['stateSelector']):?> selected='selected' <?endif?> value='<?=htmlspecialchars($state['state_id']);?>'><?=htmlspecialchars($state['name'])?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="one-third-width">
						<div class="one-third-width">
							<label for="id">Перелет</label>
						</div>
						<div class="two-third-width">
							<input type="text" name="state_flight" title= "Стоимость затрат на перелет в оба конца" value='<?
							foreach ($selectedstates as $selectedstate) {};
							$StateFlight = htmlspecialchars($selectedstate['flight']);
							print number_format($StateFlight, 0, ',', ' ').' руб.';
							?>' disabled>
						</div>
					</div>
					<div class="one-third-width">
						<div class="one-third-width">
							<label for="id">Трансфер</label>
						</div>
						<div class="one-third-width">
							<input type="text" name="state_transfer" title= "Стоимость затрат на трансфер туда и обратно" value='<?
							$StateTransfer = htmlspecialchars($selectedstate['transfer']);
							print number_format($StateTransfer, 0, ',', ' ').' руб.';
							?>' disabled>
						</div>
					</div>
					
					<div class="one-third-width">
						<div class="one-third-width">
							<label for="id">Жилье</label>
						</div>
						<div class="one-third-width">
							<input type="text" name="state_housing" title= "Стоимость жилья за месяц" value='<?
							$StateHousing = htmlspecialchars($selectedstate['housing']);
							print number_format($StateHousing, 0, ',', ' ').' руб.';
							?>' disabled>
						</div>
					</div>
					<div class="one-third-width">
						<div class="one-third-width">
							<label for="id">Питание</label>
						</div>
						<div class="one-third-width">
							<input type="text" name="state_meal" title= "Затраты на питание на один день" value='<?
							$StateMeal = htmlspecialchars($selectedstate['meal']);
							print number_format($StateMeal, 0, ',', ' ').' руб.';
							?>' disabled>
						</div>
					</div>
					<div class="one-third-width">
					</div>
					
					<div class="one-third-width">
						<div class="one-third-width">
							<label for="id">Развлечения</label>
						</div>
						<div class="one-third-width">
							<input type="text" name="state_entertainment" title= "Средние затраты на отдых и развлечения в штате в месяц" value='<?
							$StateEntertainment = htmlspecialchars($selectedstate['entertainment']);
							print number_format($StateEntertainment, 0, ',', ' ').' руб.';
							?>' disabled>
						</div>
					</div>
					<div class="one-third-width">
						<div class="one-third-width">
							<label for="id">Другое</label>
						</div>
						<div class="one-third-width">
							<input type="text" name="state_living" title= "Бытовые затраты в месяц" value='<?
							$StateLiving = htmlspecialchars($selectedstate['living']);
							print number_format($StateLiving, 0, ',', ' ').' руб.';
							?>' disabled>
						</div>
					</div>
					<div class="one-third-width">
					</div>
					
					
					<hr>
					
					
					<div>
						<label for="">Учесть налоги штата <input type="checkbox" name="state_check_taxes" title= "При расчете затрат учитываются налоги относительно штата пребывания" name="a" value="" checked disabled></label>
					</div>
					<div class="half-width">
						<div class="half-width">
							<label for="id">Сумма на первое время</label>
						</div>
						<div class="half-width">
							<input type="number" name="money_with" value="<?
							if (isset($_GET['money_with'])) {
								$MoneyWith = ($_GET['money_with']);
							}
							else
							{
								$MoneyWith = '55000';
							}
							print $MoneyWith;
							?>" title= "Средняя сумма рекомендуемая на первое время">
						</div>
					</div>
					
					
					<hr>
					
					
					<div class="half-width">
					</div>
					<div class="half-width">
						<div class="half-width">
						</div>
						<div class="half-width">
							<div class="half-width">
							<label for="id">Итого:</label>
							</div>
							<div class="half-width">
								<?
								$StateTotal = $StateFlight + $StateTransfer + ($StateMeal * $StatePeriod) + (($StateHousing + $StateEntertainment + $StateLiving) * (round(($StatePeriod/30), 0, PHP_ROUND_HALF_UP)));
								?>
								<input type="text" name="" title= "Итог по затратам, связанным с поездкой за визой" value='<?=number_format($StateTotal, 0, ',', ' ').' руб.'?>' disabled>
							</div>
						</div>
					</div>
					
				</fieldset>
				
				
				
				
				
				
				<div class="half-width">
					<fieldset>
						<legend>Работа</legend>
						
						<table style="border-collapse: collapse; margin: auto;" border="1">
							<tbody>
								<tr>
								<td style="width: 100px; margin-bottom: 0px;">
									<label style="margin-top: 5px;" align="right">№</label>
								</td>
								<td style="width: 120px; margin-bottom: 0px;">
									<label style="margin-top: 5px;" align="center">З/П (в руб.)</label>
								</td>
								<td style="width: 190px; margin-bottom: 0px;">
									<label style="margin-top: 5px;" align="center">Занятость (в часах)</label>
								</td>
								<td style="width: 25px; margin-bottom: 0px;">
									<label style="margin-top: 5px;" align="center">+</label>
								</td>
								</tr>
								
								<tr>
									<td>
										<label style="margin-bottom: 0px;" align="right" for="id">Работа №1</label>
									</td>
									<td>
										<label style="margin-bottom: 0px; margin-top: 5px;" align="center">
											<input type="number" name="salary1" style="width: 40px;" value="<?
											if (isset($_GET['salary1'])) {
												$Salary1 = $_GET['salary1'];
											}
											else
											{
												$Salary1 = htmlspecialchars($state['avg_salary']);
											}
											print $Salary1;
											?>" title= "Ставка дохода за час работы">
										</label>
									</td>
									<td>
										<label style="margin-bottom: 0px; margin-top: 5px;" align="center">
											<input type="number" name="worktime1" style="width: 40px;" value='<?
											if (isset($_GET['worktime1'])) {
												$WorkTime1 = $_GET['worktime1'];
											}
											else
											{
												$WorkTime1 = '40';
											}
											print $WorkTime1;
											?>' title= "Количество часов в неделю">
										</label>
									</td>
									<td>
										<label style="margin-bottom: 0px; margin-top: 7px;" align="center">
											<input type="checkbox" title= "Добавить" name="a" value="" checked disabled>
										</label>
									</td>
								</tr>
								
								<tr>
									<td>
										<label align="right" for="id">Работа №2</label>
									</td>
									<td>
										<label style="margin-bottom: 0px; margin-top: 5px;" align="center">
											<input type="number" name="salary2" style="width: 40px;" value="<?
											if (isset($_GET['salary2'])) {
												$Salary2 = $_GET['salary2'];
											}
											else
											{
												$Salary2 = htmlspecialchars($state['avg_salary']);
											}
											print $Salary2;
											?>" title= "Ставка дохода за час работы">
										</label>
									</td>
									<td>
										<label style="margin-bottom: 0px; margin-top: 5px;" align="center">
											<input type="number" name="worktime2" style="width: 40px;" value='<?
											if (isset($_GET['worktime2'])) {
												$WorkTime2 = $_GET['worktime2'];
											}
											else
											{
												$WorkTime2 = '40';
											}
											print $WorkTime2;
											?>' title= "Количество часов в неделю">
										</label>
									</td>
									<td>
										<label style="margin-bottom: 0px; margin-top: 7px;" align="center">
											<input type="checkbox" name="work2_checked"title= "Добавить" name="a" value="" checked disabled>
										</label>
									</td>
								</tr>
							</tbody>
						</table>
						
						
						<hr>
						<div class="half-width">
							<label for="">Учесть возврат налогов <input type="checkbox" name="taxes_back_checked" title= "Учесть возмещение затрат по налогам по приезде" name="a" value="" checked disabled></label>
						</div>
						<div class="half-width">
						</div>
						
						
						<hr>
						
						
						<div>
							<div class="half-width">
							</div>
							<div class="half-width">
								<div class="half-width">
								<label for="id">Итого:</label>
								</div>
								<div class="half-width">
									<?
									$WorkTotal = (($Salary1 * $WorkTime1 + $Salary2 * $WorkTime2) * (round(($StatePeriod/7), 0, PHP_ROUND_HALF_UP)));
									?>
									<input type="text" name="" title= "Итог по затратам, связанным с поездкой за визой" value='<?=number_format($WorkTotal, 0, ',', ' ').' руб.'?>' disabled>
								</div>
							</div>
						</div>
						
					</fieldset>
				</div>
				
				
				
				
				<div class="half-width">
					<fieldset style="border: 2px solid #9b2d30;">
						<legend style="color: #9b2d30;">Результаты расчетов</legend>
						<div>
						</div>
						<div>
						</div>
						<div class="half-width">
							<label for="id">Сумма расходов до поездки</label>
						</div>
						<div class="half-width">
							<input type="text" name="expenses_before" value="<?
							$ExpensesBefore = $AgencyTotal + $VisaTotal + $StateFlight + $MoneyWith;
							print number_format($ExpensesBefore, 0, ',', ' ').' руб.';
							?>" disabled>
						</div>
						
						<div class="half-width">
							<label for="id">Общая сумма расходов</label>
						</div>
						<div class="half-width">
							<input type="text" name="expenses_total" value="<?
							$ExpensesTotal = $ExpensesBefore + $StateTotal - $StateFlight;
							print number_format($ExpensesTotal, 0, ',', ' ').' руб.';
							?>" disabled>
						</div>
						
						<div class="half-width">
							<label for="id">Общая сумма доходов</label>
						</div>
						<div class="half-width">
							<input type="text" name="revenue_total" value="<?
							$RevenueTotal = $WorkTotal;
							print number_format($RevenueTotal, 0, ',', ' ').' руб.';
							?>" disabled>
						</div>
						
						<div class="half-width">
							<label for="id">Прибыль</label>
						</div>
						<div class="half-width">
							<input type="text" name="income_total" value="<?
							$IncomeTotal = $RevenueTotal - $ExpensesTotal;
							print number_format($IncomeTotal, 0, ',', ' ').' руб.';
							?>" disabled>
						</div>
						
						
					</fieldset>
				</div>
				
				
				
                <div class="buttons">
					<input type="submit" name="counting" value="Пересчитать">
					<input type="reset" value="Сбросить">
                </div>
				
            </form>
			
			
			
			<a name='bottom'>
			<h5>
			<p>Для расчетов средней стоимости проживания и питания в различных штатах использовался одноименный ресурс <a name='numbeo' href='https://www.numbeo.com/' target='_blank'>Numbeo / Cost of Living</a>.
			<br>Информация о стоимостях программ и различных этапов оформления была собрана непосредственно с официальных сайтов агентств Новосибирска: <a name='cmo' href='http://travelyoung.ru/' target='_blank'>ЦМО</a>, <a name='star' href='http://kja.startravel.ru/' target='_blank'>StarTravel</a>, <a name='mikcs' href='http://www.mikc.net/' target='_blank'>МИКЦ</a> и <a name='global' href='https://workandtravel.ru/' target='_blank'>Global Vision</a>.</p>
			<p>* Список штатов был составлен на основе статистических данных о подтверждении оферов (приглашений на работу) спонсором <a name='inter' href='https://batchgeo.com/map/iexregions' target='_blank'>InterExchange</a>.</p>
			<p>Разработчики проекта выражают благодарность вышеуказанным сервисам за предоставление информации!</p>
			</h5>
			<hr>
			</a>
			
			
        </main>
        <footer class="page-footer">
		<p align=center>Copyright © 2018 WATeverGettingBy. Your use of this service is subject to our Terms of Use and Privacy Policy</p>
		</footer>
    </body>
</html>
