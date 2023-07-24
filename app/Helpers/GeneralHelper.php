<?php

use App\Models\BackgroundVerification;
use App\Models\EmergencyContact;
use App\Models\Employee;
use App\Models\EmployeeDepartment;
use App\Models\EmployeeDesignation;
use App\Models\EmployeeDocument;
use App\Models\EmployeeEmploymentType;
use App\Models\EmployeeSkill;
use App\Models\EmployeeTemporaryAddress;
use Illuminate\Support\Facades\DB;

class GeneralHelper{

    public static function getTimeZone(){
        $timezone_identifiers = DateTimeZone::listIdentifiers();
        $continent = "";
        $i = "";
        $timezones = array();
        foreach( $timezone_identifiers as $key=>$value ){
            if ( preg_match( '/^(Africa|America|Antarctica|Arctic|Asia|Atlantic|Australia|Europe|Indian|Pacific|Others)\//', $value ) ){
                $ex=explode("/",$value); //obtain continent,city
                if ($continent!=$ex[0]){
                    $i = $ex[0];
                }
                $timezones[$i][] = $value;
            }
        }
        return $timezones;
    }

    public static function getCurrencyList(){
        return array(
            array("name" => "Afghan Afghani", "code" => "AFA", "symbol" => "؋"),
            array("name" => "Albanian Lek", "code" => "ALL", "symbol" => "Lek"),
            array("name" => "Algerian Dinar", "code" => "DZD", "symbol" => "دج"),
            array("name" => "Angolan Kwanza", "code" => "AOA", "symbol" => "Kz"),
            array("name" => "Argentine Peso", "code" => "ARS", "symbol" => "$"),
            array("name" => "Armenian Dram", "code" => "AMD", "symbol" => "֏"),
            array("name" => "Aruban Florin", "code" => "AWG", "symbol" => "ƒ"),
            array("name" => "Australian Dollar", "code" => "AUD", "symbol" => "$"),
            array("name" => "Azerbaijani Manat", "code" => "AZN", "symbol" => "m"),
            array("name" => "Bahamian Dollar", "code" => "BSD", "symbol" => "B$"),
            array("name" => "Bahraini Dinar", "code" => "BHD", "symbol" => ".د.ب"),
            array("name" => "Bangladeshi Taka", "code" => "BDT", "symbol" => "৳"),
            array("name" => "Barbadian Dollar", "code" => "BBD", "symbol" => "Bds$"),
            array("name" => "Belarusian Ruble", "code" => "BYR", "symbol" => "Br"),
            array("name" => "Belgian Franc", "code" => "BEF", "symbol" => "fr"),
            array("name" => "Belize Dollar", "code" => "BZD", "symbol" => "$"),
            array("name" => "Bermudan Dollar", "code" => "BMD", "symbol" => "$"),
            array("name" => "Bhutanese Ngultrum", "code" => "BTN", "symbol" => "Nu."),
            array("name" => "Bitcoin", "code" => "BTC", "symbol" => "฿"),
            array("name" => "Bolivian Boliviano", "code" => "BOB", "symbol" => "Bs."),
            array("name" => "Bosnia", "code" => "BAM", "symbol" => "KM"),
            array("name" => "Botswanan Pula", "code" => "BWP", "symbol" => "P"),
            array("name" => "Brazilian Real", "code" => "BRL", "symbol" => "R$"),
            array("name" => "British Pound Sterling", "code" => "GBP", "symbol" => "£"),
            array("name" => "Brunei Dollar", "code" => "BND", "symbol" => "B$"),
            array("name" => "Bulgarian Lev", "code" => "BGN", "symbol" => "Лв."),
            array("name" => "Burundian Franc", "code" => "BIF", "symbol" => "FBu"),
            array("name" => "Cambodian Riel", "code" => "KHR", "symbol" => "KHR"),
            array("name" => "Canadian Dollar", "code" => "CAD", "symbol" => "$"),
            array("name" => "Cape Verdean Escudo", "code" => "CVE", "symbol" => "$"),
            array("name" => "Cayman Islands Dollar", "code" => "KYD", "symbol" => "$"),
            array("name" => "CFA Franc BCEAO", "code" => "XOF", "symbol" => "CFA"),
            array("name" => "CFA Franc BEAC", "code" => "XAF", "symbol" => "FCFA"),
            array("name" => "CFP Franc", "code" => "XPF", "symbol" => "₣"),
            array("name" => "Chilean Peso", "code" => "CLP", "symbol" => "$"),
            array("name" => "Chinese Yuan", "code" => "CNY", "symbol" => "¥"),
            array("name" => "Colombian Peso", "code" => "COP", "symbol" => "$"),
            array("name" => "Comorian Franc", "code" => "KMF", "symbol" => "CF"),
            array("name" => "Congolese Franc", "code" => "CDF", "symbol" => "FC"),
            array("name" => "Costa Rican ColÃ³n", "code" => "CRC", "symbol" => "₡"),
            array("name" => "Croatian Kuna", "code" => "HRK", "symbol" => "kn"),
            array("name" => "Cuban Convertible Peso", "code" => "CUC", "symbol" => "$, CUC"),
            array("name" => "Czech Republic Koruna", "code" => "CZK", "symbol" => "Kč"),
            array("name" => "Danish Krone", "code" => "DKK", "symbol" => "Kr."),
            array("name" => "Djiboutian Franc", "code" => "DJF", "symbol" => "Fdj"),
            array("name" => "Dominican Peso", "code" => "DOP", "symbol" => "$"),
            array("name" => "East Caribbean Dollar", "code" => "XCD", "symbol" => "$"),
            array("name" => "Egyptian Pound", "code" => "EGP", "symbol" => "ج.م"),
            array("name" => "Eritrean Nakfa", "code" => "ERN", "symbol" => "Nfk"),
            array("name" => "Estonian Kroon", "code" => "EEK", "symbol" => "kr"),
            array("name" => "Ethiopian Birr", "code" => "ETB", "symbol" => "Nkf"),
            array("name" => "Euro", "code" => "EUR", "symbol" => "€"),
            array("name" => "Falkland Islands Pound", "code" => "FKP", "symbol" => "£"),
            array("name" => "Fijian Dollar", "code" => "FJD", "symbol" => "FJ$"),
            array("name" => "Gambian Dalasi", "code" => "GMD", "symbol" => "D"),
            array("name" => "Georgian Lari", "code" => "GEL", "symbol" => "ლ"),
            array("name" => "German Mark", "code" => "DEM", "symbol" => "DM"),
            array("name" => "Ghanaian Cedi", "code" => "GHS", "symbol" => "GH₵"),
            array("name" => "Gibraltar Pound", "code" => "GIP", "symbol" => "£"),
            array("name" => "Greek Drachma", "code" => "GRD", "symbol" => "₯, Δρχ, Δρ"),
            array("name" => "Guatemalan Quetzal", "code" => "GTQ", "symbol" => "Q"),
            array("name" => "Guinean Franc", "code" => "GNF", "symbol" => "FG"),
            array("name" => "Guyanaese Dollar", "code" => "GYD", "symbol" => "$"),
            array("name" => "Haitian Gourde", "code" => "HTG", "symbol" => "G"),
            array("name" => "Honduran Lempira", "code" => "HNL", "symbol" => "L"),
            array("name" => "Hong Kong Dollar", "code" => "HKD", "symbol" => "$"),
            array("name" => "Hungarian Forint", "code" => "HUF", "symbol" => "Ft"),
            array("name" => "Icelandic KrÃ³na", "code" => "ISK", "symbol" => "kr"),
            array("name" => "Indian Rupee", "code" => "INR", "symbol" => "₹"),
            array("name" => "Indonesian Rupiah", "code" => "IDR", "symbol" => "Rp"),
            array("name" => "Iranian Rial", "code" => "IRR", "symbol" => "﷼"),
            array("name" => "Iraqi Dinar", "code" => "IQD", "symbol" => "د.ع"),
            array("name" => "Israeli New Sheqel", "code" => "ILS", "symbol" => "₪"),
            array("name" => "Italian Lira", "code" => "ITL", "symbol" => "L,£"),
            array("name" => "Jamaican Dollar", "code" => "JMD", "symbol" => "J$"),
            array("name" => "Japanese Yen", "code" => "JPY", "symbol" => "¥"),
            array("name" => "Jordanian Dinar", "code" => "JOD", "symbol" => "ا.د"),
            array("name" => "Kazakhstani Tenge", "code" => "KZT", "symbol" => "лв"),
            array("name" => "Kenyan Shilling", "code" => "KES", "symbol" => "KSh"),
            array("name" => "Kuwaiti Dinar", "code" => "KWD", "symbol" => "ك.د"),
            array("name" => "Kyrgystani Som", "code" => "KGS", "symbol" => "лв"),
            array("name" => "Laotian Kip", "code" => "LAK", "symbol" => "₭"),
            array("name" => "Latvian Lats", "code" => "LVL", "symbol" => "Ls"),
            array("name" => "Lebanese Pound", "code" => "LBP", "symbol" => "£"),
            array("name" => "Lesotho Loti", "code" => "LSL", "symbol" => "L"),
            array("name" => "Liberian Dollar", "code" => "LRD", "symbol" => "$"),
            array("name" => "Libyan Dinar", "code" => "LYD", "symbol" => "د.ل"),
            array("name" => "Lithuanian Litas", "code" => "LTL", "symbol" => "Lt"),
            array("name" => "Macanese Pataca", "code" => "MOP", "symbol" => "$"),
            array("name" => "Macedonian Denar", "code" => "MKD", "symbol" => "ден"),
            array("name" => "Malagasy Ariary", "code" => "MGA", "symbol" => "Ar"),
            array("name" => "Malawian Kwacha", "code" => "MWK", "symbol" => "MK"),
            array("name" => "Malaysian Ringgit", "code" => "MYR", "symbol" => "RM"),
            array("name" => "Maldivian Rufiyaa", "code" => "MVR", "symbol" => "Rf"),
            array("name" => "Mauritanian Ouguiya", "code" => "MRO", "symbol" => "MRU"),
            array("name" => "Mauritian Rupee", "code" => "MUR", "symbol" => "₨"),
            array("name" => "Mexican Peso", "code" => "MXN", "symbol" => "$"),
            array("name" => "Moldovan Leu", "code" => "MDL", "symbol" => "L"),
            array("name" => "Mongolian Tugrik", "code" => "MNT", "symbol" => "₮"),
            array("name" => "Moroccan Dirham", "code" => "MAD", "symbol" => "MAD"),
            array("name" => "Mozambican Metical", "code" => "MZM", "symbol" => "MT"),
            array("name" => "Myanmar Kyat", "code" => "MMK", "symbol" => "K"),
            array("name" => "Namibian Dollar", "code" => "NAD", "symbol" => "$"),
            array("name" => "Nepalese Rupee", "code" => "NPR", "symbol" => "₨"),
            array("name" => "Netherlands Antillean Guilder", "code" => "ANG", "symbol" => "ƒ"),
            array("name" => "New Taiwan Dollar", "code" => "TWD", "symbol" => "$"),
            array("name" => "New Zealand Dollar", "code" => "NZD", "symbol" => "$"),
            array("name" => "Nicaraguan CÃ³rdoba", "code" => "NIO", "symbol" => "C$"),
            array("name" => "Nigerian Naira", "code" => "NGN", "symbol" => "₦"),
            array("name" => "North Korean Won", "code" => "KPW", "symbol" => "₩"),
            array("name" => "Norwegian Krone", "code" => "NOK", "symbol" => "kr"),
            array("name" => "Omani Rial", "code" => "OMR", "symbol" => ".ع.ر"),
            array("name" => "Pakistani Rupee", "code" => "PKR", "symbol" => "₨"),
            array("name" => "Panamanian Balboa", "code" => "PAB", "symbol" => "B/."),
            array("name" => "Papua New Guinean Kina", "code" => "PGK", "symbol" => "K"),
            array("name" => "Paraguayan Guarani", "code" => "PYG", "symbol" => "₲"),
            array("name" => "Peruvian Nuevo Sol", "code" => "PEN", "symbol" => "S/."),
            array("name" => "Philippine Peso", "code" => "PHP", "symbol" => "₱"),
            array("name" => "Polish Zloty", "code" => "PLN", "symbol" => "zł"),
            array("name" => "Qatari Rial", "code" => "QAR", "symbol" => "ق.ر"),
            array("name" => "Romanian Leu", "code" => "RON", "symbol" => "lei"),
            array("name" => "Russian Ruble", "code" => "RUB", "symbol" => "₽"),
            array("name" => "Rwandan Franc", "code" => "RWF", "symbol" => "FRw"),
            array("name" => "Salvadoran ColÃ³n", "code" => "SVC", "symbol" => "₡"),
            array("name" => "Samoan Tala", "code" => "WST", "symbol" => "SAT"),
            array("name" => "Saudi Riyal", "code" => "SAR", "symbol" => "﷼"),
            array("name" => "Serbian Dinar", "code" => "RSD", "symbol" => "din"),
            array("name" => "Seychellois Rupee", "code" => "SCR", "symbol" => "SRe"),
            array("name" => "Sierra Leonean Leone", "code" => "SLL", "symbol" => "Le"),
            array("name" => "Singapore Dollar", "code" => "SGD", "symbol" => "$"),
            array("name" => "Slovak Koruna", "code" => "SKK", "symbol" => "Sk"),
            array("name" => "Solomon Islands Dollar", "code" => "SBD", "symbol" => "Si$"),
            array("name" => "Somali Shilling", "code" => "SOS", "symbol" => "Sh.so."),
            array("name" => "South African Rand", "code" => "ZAR", "symbol" => "R"),
            array("name" => "South Korean Won", "code" => "KRW", "symbol" => "₩"),
            array("name" => "Special Drawing Rights", "code" => "XDR", "symbol" => "SDR"),
            array("name" => "Sri Lankan Rupee", "code" => "LKR", "symbol" => "Rs"),
            array("name" => "St. Helena Pound", "code" => "SHP", "symbol" => "£"),
            array("name" => "Sudanese Pound", "code" => "SDG", "symbol" => ".س.ج"),
            array("name" => "Surinamese Dollar", "code" => "SRD", "symbol" => "$"),
            array("name" => "Swazi Lilangeni", "code" => "SZL", "symbol" => "E"),
            array("name" => "Swedish Krona", "code" => "SEK", "symbol" => "kr"),
            array("name" => "Swiss Franc", "code" => "CHF", "symbol" => "CHf"),
            array("name" => "Syrian Pound", "code" => "SYP", "symbol" => "LS"),
            array("name" => "São Tomé and Príncipe Dobra", "code" => "STD", "symbol" => "Db"),
            array("name" => "Tajikistani Somoni", "code" => "TJS", "symbol" => "SM"),
            array("name" => "Tanzanian Shilling", "code" => "TZS", "symbol" => "TSh"),
            array("name" => "Thai Baht", "code" => "THB", "symbol" => "฿"),
            array("name" => "Tongan pa'anga", "code" => "TOP", "symbol" => "$"),
            array("name" => "Trinidad & Tobago Dollar", "code" => "TTD", "symbol" => "$"),
            array("name" => "Tunisian Dinar", "code" => "TND", "symbol" => "ت.د"),
            array("name" => "Turkish Lira", "code" => "TRY", "symbol" => "₺"),
            array("name" => "Turkmenistani Manat", "code" => "TMT", "symbol" => "T"),
            array("name" => "Ugandan Shilling", "code" => "UGX", "symbol" => "USh"),
            array("name" => "Ukrainian Hryvnia", "code" => "UAH", "symbol" => "₴"),
            array("name" => "United Arab Emirates Dirham", "code" => "AED", "symbol" => "إ.د"),
            array("name" => "Uruguayan Peso", "code" => "UYU", "symbol" => "$"),
            array("name" => "US Dollar", "code" => "USD", "symbol" => "$"),
            array("name" => "Uzbekistan Som", "code" => "UZS", "symbol" => "лв"),
            array("name" => "Vanuatu Vatu", "code" => "VUV", "symbol" => "VT"),
            array("name" => "Venezuelan BolÃvar", "code" => "VEF", "symbol" => "Bs"),
            array("name" => "Vietnamese Dong", "code" => "VND", "symbol" => "₫"),
            array("name" => "Yemeni Rial", "code" => "YER", "symbol" => "﷼"),
            array("name" => "Zambian Kwacha", "code" => "ZMK", "symbol" => "ZK")
        );
    }

    public static function profileCompletionStat($id){
        $count=0;
        $emp=Employee::find($id);
        $emeg=EmergencyContact::where('employee_id',$id)->first();
        if($emeg){
            $count+=1;
        }
        $bacv=BackgroundVerification::where('employee_id',$id)->first();
        if($bacv){
            $count+=1;
        }
        $empdoc=EmployeeDocument::where('employee_id',$id)->first();
        if($empdoc){
            $count+=1;
        }
        $emptmpaddr=EmployeeTemporaryAddress::where('employee_id',$id)->first();
        if($emptmpaddr){
            $count+=1;
        }
        $employ_type=EmployeeEmploymentType::where('employee_id',$id)->first();
        if($employ_type){
            $count+=1;
        }
        $emp_dept=EmployeeDepartment::where('employee_id',$id)->first();
        if($emp_dept){
            $count+=1;
        }
        $emp_desg=EmployeeDesignation::where('employee_id',$id)->first();
        if($emp_desg){
            $count+=1;
        }
        $emp_skill=EmployeeSkill::where('employee_id',$id)->first();
        if($emp_skill){
            $count+=1;
        }
        if($emp->fname){
           $count+=1;
        }
        if($emp->fname){
           $count+=1;
        }
        if($emp->gender){
            $count+=1;
        }
        if($emp->phone){
            $count+=1;
        }
        if($emp->father_name){
            $count+=1;
        }
        if($emp->permanent_address){
            $count+=1;
        }
        if($emp->dob){
            $count+=1;
        }
        if($emp->joining_date){
            $count+=1;
        }
        if($emp->confirmation_date){
            $count+=1;
        }
        if($emp->marital_status){
            $count+=1;
        }
        return floor(($count*100)/18);
    }
}