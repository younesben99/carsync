<?php
//FILES
$debugfile = "/carsync/sync/data/input_query_log_debug.txt";
$errorfilepath = "/carsync/sync/data/input_query_log_error.txt";
$httperrorfilepath = "/carsync/sync/data/input_query_log_http_error.txt" ;
$httperrorfilepathformail = "/wp-content/plugins/carsync/sync/data/input_query_log_http_error.txt" ;
$inputqueryfilepath = "/carsync/sync/data/input_query.json";
$inputquerylog = "/carsync/sync/data/input_query_log.txt";
//ENDFILES
$endpoint = "https://listing-search.api.autoscout24.com/graphql";
$authToken = "Basic YmUtMjE0MjA4NzIxNTpsNjYwb3JMOWVUNHdLRUhKYUpMeXlYcjhadm1ZckI=";

$qry = '{"query":"query ListingsSummaryQuery { search { listings(metadata: {page: 1}) { metadata { totalCount: totalItems pageSize } listings { id details(locale: nl_BE) { publication { state changedTimestamp changedTimestampWithOffset createdTimestamp createdTimestampWithOffset } description vehicle { classification { make { raw formatted } model { raw formatted } modelVersionInput } environment { environmentLabels { norm label } } engine { power { kw { raw formatted } hp { raw formatted } } numberOfGears numberOfCylinders engineDisplacementInCCM { raw formatted } transmissionType { raw formatted } driveTrain { raw formatted } } fuels { primary { type { raw formatted } consumption { combined { raw } urban { raw } extraUrban { raw } } co2emissionInGramPerKm { raw formatted } } additional { type { raw formatted } consumption { combined { raw } urban { raw } extraUrban { raw } } co2emissionInGramPerKm { raw formatted } } allFuelTypes { raw formatted } fuelCategory { raw formatted } } numberOfDoors emptyWeight { raw formatted } bodyColorOriginal maintenance { nextVehicleSafetyInspection { raw formatted } lastBeltServiceDate { raw formatted } hasFullServiceHistory { raw formatted } lastTechnicalServiceDate { raw formatted } } condition { firstRegistrationDate { raw formatted } mileageInKm { raw formatted } carpassMileageUrl numberOfPreviousOwnersExtended { raw formatted } nonSmoking newInspection damage { accidentFree } } interior { numberOfSeats upholstery { raw formatted } upholsteryColor { raw formatted } } equipment { as24 { id { raw formatted } } dat { oem { id text type as24TaxonomyId } generic { id text type as24TaxonomyId } } eurotax { oem { id text type as24TaxonomyId } generic { id text type as24TaxonomyId } } userInput } identifier { vin licensePlate } manufacturerEquipment { raw formatted } usageState originalMarket { raw formatted } bodyColor { raw formatted } bodyType { raw formatted } paintType { raw formatted } legalCategories { raw formatted } } prices { pricepublic: public { amountInEUR { raw formatted } negotiable taxDeductible taxDeductibleNote category } } availability { fromDate { raw formatted } inDays } financing { rate { raw formatted } finalInstallment { raw formatted } debitInterestKind interest { raw formatted } netCreditAmount { raw formatted } serviceFee { raw formatted } duration { raw formatted } grossCreditAmount { raw formatted } debitInterest { raw formatted } bankId rateInsurance { raw formatted } bank deposit { raw formatted } } warranty { generic { durationInMonth { raw formatted } } warrantyExists } adProduct { title subTitle has360Image tier } media { basicUrl youtubeLink images { ... on StandardImage { formats { png { size60x45 size640x480 } jpg { size1280x960 } } } } } seals { id name culture thumbnail image info } location { countryCode zip city street } seller { id companyName contactName companyNameAddOn email sellId phones { phoneType formattedNumber callTo } addressTypeId addressId links { cars { href method } motorbikes { href method } imprint { href method } email { href method } infoPage { href method } } logo { big { href method } small { href method } } type } ratings { customerCulture urlName ratingsCount ratingsAverage ratingsEnabled } webPage identifier { offerReference } } } } } }"}';

$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Authorization: '.$authToken;

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $endpoint);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $qry);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//DEBUG
curl_setopt($ch, CURLOPT_VERBOSE, true);
curl_setopt($ch, CURLOPT_STDERR, fopen(WP_PLUGIN_DIR . $debugfile, "w+"));





$result = curl_exec($ch);
var_dump($result);
echo(curl_errno($ch));
curl_close($ch);

/*

$Vdata = file_get_contents(WP_PLUGIN_DIR . '/carsync/sync/data/input_query.json');


$array = json_decode($Vdata, true);
$cars = $array['data']['search']['listings']['listings'];

foreach ($cars as $car)
{
    
    echo  $car['details']['vehicle']['classification']['make']['formatted'] . ' ' .$car['details']['vehicle']['classification']['model']['formatted'];
    echo "<br><br>";
    echo  $car['id'];
    //var_dump($car['details']['vehicle']);
    echo "<br><br>";
    //SET VARS

    $car_uniqid = $car['id'];
    $car_merk = $car['details']['vehicle']['classification']['make']['formatted'];
    $car_model = $car['details']['vehicle']['classification']['model']['formatted'];
    
}
echo("<hr>");

var_dump($cars); 

*/

?>
