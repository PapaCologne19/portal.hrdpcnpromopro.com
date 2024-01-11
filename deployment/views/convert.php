<?php
function convertNumber($num = false)
{
    $num = str_replace(array(',', ''), '', trim($num));
    if (!$num) {
        return false;
    }

    // Separate dollars and cents
    $num_parts = explode('.', $num);
    $dollars = (int) $num_parts[0];
    $cents = isset($num_parts[1]) ? (int) $num_parts[1] : 0;

    $words = array();
    $list1 = array(
        '',
        'one',
        'two',
        'three',
        'four',
        'five',
        'six',
        'seven',
        'eight',
        'nine',
        'ten',
        'eleven',
        'twelve',
        'thirteen',
        'fourteen',
        'fifteen',
        'sixteen',
        'seventeen',
        'eighteen',
        'nineteen'
    );
    $list2 = array('', 'Ten', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety', 'Hundred');
    $list3 = array(
        '',
        'Thousand',
        'Million',
        'Billion',
        'Trillion',
        'Quadrillion',
        'Quintillion',
        'Sextillion',
        'Septillion',
        'Octillion',
        'Nonillion',
        'Decillion',
        'Undecillion',
        'Duodecillion',
        'Tredecillion',
        'Quattuordecillion',
        'Quindecillion',
        'Sexdecillion',
        'Septendecillion',
        'Octodecillion',
        'Novemdecillion',
        'Vigintillion'
    );
    $num_length = strlen($dollars);
    $levels = (int) (($num_length + 2) / 3);
    $max_length = $levels * 3;
    $dollars = substr('00' . $dollars, -$max_length);
    $num_levels = str_split($dollars, 3);
    for ($i = 0; $i < count($num_levels); $i++) {
        $levels--;
        $hundreds = (int) ($num_levels[$i] / 100);
        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ($hundreds == 1 ? '' : '') . ' ' : '');
        $tens = (int) ($num_levels[$i] % 100);
        $singles = '';
        if ($tens < 20) {
            $tens = ($tens ? '' . $list1[$tens] . ' ' : '');
        } elseif ($tens >= 20) {
            $tens = (int) ($tens / 10);
            $tens = ' ' . $list2[$tens];
            $singles = (int) ($num_levels[$i] % 10);
            $singles = ($singles ? '-' . $list1[$singles] : '');
        }

        $words[] = ucwords($hundreds . $tens . $singles . (($levels && (int) ($num_levels[$i])) ? ' ' . $list3[$levels] . ' ' : ''));
    } //end for loop

    // Add currency part for whole numbers
    if (empty($cents)) {
        $words[] = 'Pesos';
    }
    if (!empty($cents)) {
        $words[] = 'Pesos';
    }

    // Process cents
    if ($cents > 0) {
        $centsInWords = convertNumber($cents);
        $centsInWords = str_replace(' Pesos', '', $centsInWords); // Remove 'Pesos' from cents
        $words[] = 'and ' . ucwords($centsInWords) . ' Cents';
    }

    $commas = count($words);
    if ($commas > 1) {
        $commas = $commas - 1;
    }
    $words = implode(' ', $words);
    $words = preg_replace('/^\s\b(and)/', '', $words);
    $words = trim($words);

    return ucfirst($words);

}


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the amount from the form
    $inputAmount = isset($_POST['amount']) ? $_POST['amount'] : '';

    // Validate the input (you may want to add more validation)
    $inputAmount = str_replace(',', '', $inputAmount);
    if (!empty($inputAmount) && is_numeric($inputAmount)) {
        $amountInWords = convertNumber(number_format($inputAmount, 2, '.', ''));
        echo $amountInWords;
    } else {
        echo 'Please enter a valid numeric amount.';
    }
}
?>