<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DtBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banks = [
            ['id' => 1, 'nama' => 'PT. BANK RAKYAT INDONESIA (PERSERO), TBK (BRI)', 'kode' => '002'],
            ['id' => 2, 'nama' => 'PT. BANK CENTRAL ASIA, TBK - (BCA)', 'kode' => '014'],
            ['id' => 3, 'nama' => 'PT. BANK MANDIRI (PERSERO), TBK', 'kode' => '008'],
            ['id' => 4, 'nama' => 'PT. BANK NEGARA INDONESIA (PERSERO), TBK (BNI)', 'kode' => '009'],
            ['id' => 5, 'nama' => 'PT. BNI SYARIAH', 'kode' => '427'],
            [
                'id' => 6,
                'nama' => 'PT. BANK SYARIAH MANDIRI',
                'kode' => '451'
            ],
            [
                'id' => 7,
                'nama' => 'PT. BANK CIMB NIAGA - (CIMB)',
                'kode' => '022'
            ],
            [
                'id' => 8,
                'nama' => 'PT. BANK CIMB NIAGA - (CIMB)',
                'kode' => '022'
            ],
            [
                'id' => 9,
                'nama' => 'PT. BANK MUAMALAT INDONESIA, TBK',
                'kode' => '147'
            ],
            [
                'id' => 10,
                'nama' => 'PT. BANK TABUNGAN PENSIUNAN NASIONAL - (BTPN)',
                'kode' => '213'
            ],
            [
                'id' => 11,
                'nama' => 'PT. BANK TABUNGAN PENSIUNAN NASIONAL SYARIAH - (BTPN Syariah)',
                'kode' => '547'
            ],
            [
                'id' => 12,
                'nama' => 'PT. BANK TABUNGAN PENSIUNAN NASIONAL - (BTPN)',
                'kode' => '213'
            ],
            [
                'id' => 13,
                'nama' => 'PT. BANK SYARIAH BRI - (BRI SYARIAH)',
                'kode' => '422'
            ],
            [
                'id' => 14,
                'nama' => 'PT. BANK TABUNGAN NEGARA (PERSERO), TBK (BTN)',
                'kode' => '200'
            ],
            [
                'id' => 15,
                'nama' => 'PT. BANK PERMATA, TBK',
                'kode' => '013'
            ],
            [
                'id' => 16,
                'nama' => 'PT. BANK DANAMON INDONESIA',
                'kode' => '011'
            ],
            [
                'id' => 17,
                'nama' => 'PT. BANK MAYBANK INDONESIA, TBK',
                'kode' => '016'
            ],
            [
                'id' => 18,
                'nama' => 'PT. BANK MEGA, TBK',
                'kode' => '426'
            ],
            [
                'id' => 19,
                'nama' => 'BANK SINARMAS',
                'kode' => '153'
            ],
            [
                'id' => 20,
                'nama' => 'BANK COMMONWEALTH',
                'kode' => '950'
            ],
            [
                'id' => 21,
                'nama' => 'PT. BANK OCBC NISP, TBK',
                'kode' => '028'
            ],
            [
                'id' => 22,
                'nama' => 'PT. BANK BUKOPIN',
                'kode' => '441'
            ],
            [
                'id' => 23,
                'nama' => 'PT. BANK SYARIAH BUKOPIN',
                'kode' => '521'
            ],
            [
                'id' => 24,
                'nama' => 'PT. BANK BCA SYARIAH',
                'kode' => '536'
            ],
            [
                'id' => 25,
                'nama' => 'BANK LIPPO',
                'kode' => '026'
            ],
            [
                'id' => 26,
                'nama' => 'CITIBANK',
                'kode' => '031'
            ],
            [
                'id' => 27,
                'nama' => 'INDOSAT DOMPETKU',
                'kode' => '789'
            ],
            [
                'id' => 28,
                'nama' => 'TELKOMSEL TCASH',
                'kode' => '911'
            ],
            [
                'id' => 29,
                'nama' => 'LINKAJA',
                'kode' => '911'
            ],
            [
                'id' => 30,
                'nama' => 'BANK JABAR',
                'kode' => '110'
            ],
            [
                'id' => 31,
                'nama' => 'PT. BANK DKI',
                'kode' => '111'
            ],
            [
                'id' => 32,
                'nama' => 'BPD DIY (YOGYAKARTA)',
                'kode' => '112'
            ],
            [
                'id' => 33,
                'nama' => 'BANK JATENG (JAWA TENGAH)',
                'kode' => '113'
            ],
            [
                'id' => 34,
                'nama' => 'BANK JATIM (JAWA BARAT)',
                'kode' => '114'
            ],
            [
                'id' => 35,
                'nama' => 'BPD JAMBI',
                'kode' => '115'
            ],
            [
                'id' => 36,
                'nama' => 'BPD ACEH',
                'kode' => '116'
            ],
            [
                'id' => 37,
                'nama' => 'BPD ACEH SYARIAH',
                'kode' => '116'
            ],
            [
                'id' => 38,
                'nama' => 'BANK SUMUT',
                'kode' => '117'
            ],
            [
                'id' => 39,
                'nama' => 'BANK NAGARI (BANK SUMBAR)',
                'kode' => '118'
            ],
            [
                'id' => 40,
                'nama' => 'BANK RIAU KEPRI',
                'kode' => '119'
            ],
            [
                'id' => 41,
                'nama' => 'BANK SUMSEL BABEL',
                'kode' => '120'
            ],
            [
                'id' => 42,
                'nama' => 'BANK LAMPUNG',
                'kode' => '121'
            ],
            [
                'id' => 43,
                'nama' => 'BANK KALSEL (BANK KALIMANTAN SELATAN)',
                'kode' => '122'
            ],
            [
                'id' => 44,
                'nama' => 'BANK KALBAR (BANK KALIMANTAN BARAT)',
                'kode' => '123'
            ],
            [
                'id' => 45,
                'nama' => 'BANK KALTIMTARA (BANK KALIMANTAN TIMUR DAN UTARA)',
                'kode' => '124'
            ],
            [
                'id' => 46,
                'nama' => 'BANK KALTENG (BANK KALIMANTAN TENGAH)',
                'kode' => '125'
            ],
            [
                'id' => 47,
                'nama' => 'BANK SULSELBAR (BANK SULAWESI SELATAN DAN BARAT)',
                'kode' => '126'
            ],
            [
                'id' => 48,
                'nama' => 'BANK SULUTGO (BANK SULAWESI UTARA DAN GORONTALO)',
                'kode' => '127'
            ],
            [
                'id' => 49,
                'nama' => 'BANK NTB',
                'kode' => '128'
            ],
            [
                'id' => 50,
                'nama' => 'BANK NTB SYARIAH',
                'kode' => '128'
            ],
            [
                'id' => 51,
                'nama' => 'BANK BPD BALI',
                'kode' => '129'
            ],
            [
                'id' => 52,
                'nama' => 'BANK NTT',
                'kode' => '130'
            ],
            [
                'id' => 53,
                'nama' => 'BANK MALUKU MALUT',
                'kode' => '131'
            ],
            [
                'id' => 54,
                'nama' => 'BANK PAPUA',
                'kode' => '132'
            ],
            [
                'id' => 55,
                'nama' => 'BANK BENGKULU',
                'kode' => '133'
            ],
            [
                'id' => 56,
                'nama' => 'BANK SULTENG (BANK SULAWESI TENGAH)',
                'kode' => '134'
            ],
            [
                'id' => 57,
                'nama' => 'BANK SULTRA',
                'kode' => '135'
            ],
            [
                'id' => 58,
                'nama' => 'PT. BANK PEMBANGUNAN DAERAH BANTEN',
                'kode' => '137'
            ],
            [
                'id' => 59,
                'nama' => 'BANK EKSPOR INDONESIA',
                'kode' => '003'
            ],
            [
                'id' => 60,
                'nama' => 'BANK PANIN',
                'kode' => '019'
            ],
            [
                'id' => 61,
                'nama' => 'BANK PANIN DUBAI SYARIAH',
                'kode' => '517'
            ],
            [
                'id' => 62,
                'nama' => 'BANK ARTA NIAGA KENCANA',
                'kode' => '020'
            ],
            [
                'id' => 63,
                'nama' => 'BANK UOB INDONESIA (BANK BUANA INDONESIA)',
                'kode' => '023'
            ],
            [
                'id' => 64,
                'nama' => 'AMERICAN EXPRESS BANK LTD',
                'kode' => '030'
            ],
            [
                'id' => 65,
                'nama' => 'CITIBANK N.A.',
                'kode' => '031'
            ],
            [
                'id' => 66,
                'nama' => 'JP. MORGAN CHASE BANK, N.A.',
                'kode' => '032'
            ],
            [
                'id' => 67,
                'nama' => 'BANK OF AMERICA, N.A',
                'kode' => '033'
            ],
            [
                'id' => 68,
                'nama' => 'ING INDONESIA BANK',
                'kode' => '034'
            ],
            [
                'id' => 69,
                'nama' => 'BANK MULTICOR',
                'kode' => '036'
            ],
            [
                'id' => 70,
                'nama' => 'BANK ARTHA GRAHA INTERNASIONAL',
                'kode' => '037'
            ],
            [
                'id' => 71,
                'nama' => 'BANK CREDIT AGRICOLE INDOSUEZ',
                'kode' => '039'
            ],
            [
                'id' => 72,
                'nama' => 'THE BANGKOK BANK COMP. LTD',
                'kode' => '040'
            ],
            [
                'id' => 73,
                'nama' => 'BANK HSBC',
                'kode' => '041'
            ],
            [
                'id' => 74,
                'nama' => 'THE BANK OF TOKYO MITSUBISHI UFJ LTD',
                'kode' => '042'
            ],
            [
                'id' => 75,
                'nama' => 'BANK SUMITOMO MITSUI INDONESIA',
                'kode' => '045'
            ],
            [
                'id' => 76,
                'nama' => 'PT. BANK DBS INDONESIA',
                'kode' => '046'
            ],
            [
                'id' => 77,
                'nama' => 'PT. BANK DBS INDONESIA',
                'kode' => '046'
            ],
            [
                'id' => 78,
                'nama' => 'BANK RESONA PERDANIA',
                'kode' => '047'
            ],
            [
                'id' => 79,
                'nama' => 'BANK MIZUHO INDONESIA',
                'kode' => '048'
            ],
            [
                'id' => 80,
                'nama' => 'STANDARD CHARTERED BANK',
                'kode' => '050'
            ],
            [
                'id' => 81,
                'nama' => 'BANK ABN AMRO',
                'kode' => '052'
            ],
            [
                'id' => 82,
                'nama' => 'BANK KEPPEL TATLEE BUANA',
                'kode' => '053'
            ],
            [
                'id' => 83,
                'nama' => 'PT. BANK CAPITAL INDONESIA',
                'kode' => '054'
            ],
            [
                'id' => 84,
                'nama' => 'BANK BNP PARIBAS INDONESIA',
                'kode' => '057'
            ],
            [
                'id' => 85,
                'nama' => 'BANK UOB INDONESIA',
                'kode' => '023'
            ],
            [
                'id' => 86,
                'nama' => 'KOREA EXCHANGE BANK DANAMON',
                'kode' => '059'
            ],
            [
                'id' => 87,
                'nama' => 'RABOBANK INTERNASIONAL INDONESIA',
                'kode' => '060'
            ],
            [
                'id' => 88,
                'nama' => 'BANK ANZ INDONESIA',
                'kode' => '061'
            ],
            [
                'id' => 89,
                'nama' => 'BANK WOORI SAUDARA',
                'kode' => '068'
            ],
            [
                'id' => 90,
                'nama' => 'BANK OF CHINA',
                'kode' => '069'
            ],
            [
                'id' => 91,
                'nama' => 'BANK BUMI ARTA',
                'kode' => '076'
            ],
            [
                'id' => 92,
                'nama' => 'PT. BANK HSBC INDONESIA',
                'kode' => '087'
            ],
            [
                'id' => 93,
                'nama' => 'BANK ANTARDAERAH',
                'kode' => '088'
            ],
            [
                'id' => 94,
                'nama' => 'BANK HAGA',
                'kode' => '089'
            ],
            [
                'id' => 95,
                'nama' => 'BANK IFI',
                'kode' => '093'
            ],
            [
                'id' => 96,
                'nama' => 'PT. BANK JTRUST INDONESIA, TBK',
                'kode' => '095'
            ],
            [
                'id' => 97,
                'nama' => 'BANK MAYAPADA',
                'kode' => '097'
            ],
            [
                'id' => 98,
                'nama' => 'BANK NUSANTARA PARAHYANGAN',
                'kode' => '145'
            ],
            [
                'id' => 99,
                'nama' => 'BANK SWADESI (BANK OF INDIA INDONESIA)',
                'kode' => '146'
            ],
            [
                'id' => 100,
                'nama' => 'BANK MESTIKA DHARMA',
                'kode' => '151'
            ],
            [
                'id' => 101,
                'nama' => 'BANK SHINHAN INDONESIA (BANK METRO EXPRESS)',
                'kode' => '152'
            ],
            [
                'id' => 102,
                'nama' => 'BANK MASPION INDONESIA',
                'kode' => '157'
            ],
            [
                'id' => 103,
                'nama' => 'BANK HAGAKITA',
                'kode' => '159'
            ],
            [
                'id' => 104,
                'nama' => 'BANK GANESHA',
                'kode' => '161'
            ],
            [
                'id' => 105,
                'nama' => 'BANK WINDU KENTJANA',
                'kode' => '162'
            ],
            [
                'id' => 106,
                'nama' => 'PT. BANK ICBC INDONESIA',
                'kode' => '164'
            ],
            [
                'id' => 107,
                'nama' => 'BANK HARMONI INTERNATIONAL',
                'kode' => '166'
            ],
            [
                'id' => 108,
                'nama' => 'BANK QNB KESAWAN (BANK QNB INDONESIA)',
                'kode' => '167'
            ],
            [
                'id' => 109,
                'nama' => 'PT. BANK WOORI SAUDARA INDONESIA 1906, TBK (BWS)',
                'kode' => '212'
            ],
            [
                'id' => 110,
                'nama' => 'BANK SWAGUNA',
                'kode' => '405'
            ],
            [
                'id' => 111,
                'nama' => 'BANK BISNIS INTERNASIONAL',
                'kode' => '459'
            ],
            [
                'id' => 112,
                'nama' => 'BANK SRI PARTHA',
                'kode' => '466'
            ],
            [
                'id' => 113,
                'nama' => 'BANK JASA JAKARTA',
                'kode' => '472'
            ],
            [
                'id' => 114,
                'nama' => 'BANK BINTANG MANUNGGAL',
                'kode' => '484'
            ],
            [
                'id' => 115,
                'nama' => 'BANK MNC INTERNASIONAL (BANK BUMIPUTERA)',
                'kode' => '485'
            ],
            [
                'id' => 116,
                'nama' => 'BANK YUDHA BHAKTI',
                'kode' => '490'
            ],
            [
                'id' => 117,
                'nama' => 'BANK MITRANIAGA',
                'kode' => '491'
            ],
            [
                'id' => 118,
                'nama' => 'PT. BANK RAKYAT INDONESIA AGRONIAGA, TBK',
                'kode' => '494'
            ],
            [
                'id' => 119,
                'nama' => 'BANK SBI INDONESIA (BANK INDOMONEX)',
                'kode' => '498'
            ],
            [
                'id' => 120,
                'nama' => 'BANK ROYAL INDONESIA',
                'kode' => '501'
            ],
            [
                'id' => 121,
                'nama' => 'BANK NATIONAL NOBU (BANK ALFINDO)',
                'kode' => '503'
            ],
            [
                'id' => 122,
                'nama' => 'BANK MEGA SYARIAH',
                'kode' => '506'
            ],
            [
                'id' => 123,
                'nama' => 'BANK INA PERDANA',
                'kode' => '513'
            ],
            [
                'id' => 124,
                'nama' => 'BANK HARFA',
                'kode' => '517'
            ],
            [
                'id' => 125,
                'nama' => 'PRIMA MASTER BANK',
                'kode' => '520'
            ],
            [
                'id' => 126,
                'nama' => 'PT. BANK SYARIAH BUKOPIN',
                'kode' => '521'
            ],
            [
                'id' => 127,
                'nama' => 'BANK AKITA',
                'kode' => '525'
            ],
            [
                'id' => 128,
                'nama' => 'LIMAN INTERNATIONAL BANK',
                'kode' => '526'
            ],
            [
                'id' => 129,
                'nama' => 'ANGLOMAS INTERNASIONAL BANK',
                'kode' => '531'
            ],
            [
                'id' => 130,
                'nama' => 'BANK SAHABAT SAMPEORNA (BANK DIPO INTERNATIONAL)',
                'kode' => '523'
            ],
            [
                'id' => 131,
                'nama' => 'BANK KESEJAHTERAAN EKONOMI',
                'kode' => '535'
            ],
            [
                'id' => 132,
                'nama' => 'BANK ARTOS INDONESIA',
                'kode' => '542'
            ],
            [
                'id' => 133,
                'nama' => 'PT. BANK TABUNGAN PENSIUNAN NASIONAL SYARIAH - (BTPN Syariah)',
                'kode' => '547'
            ],
            [
                'id' => 134,
                'nama' => 'BANK MULTI ARTA SENTOSA',
                'kode' => '548'
            ],
            [
                'id' => 135,
                'nama' => 'PT. BANK MAYORA',
                'kode' => '553'
            ],
            [
                'id' => 136,
                'nama' => 'BANK INDEX SELINDO',
                'kode' => '555'
            ],
            [
                'id' => 137,
                'nama' => 'BANK VICTORIA INTERNATIONAL',
                'kode' => '566'
            ],
            [
                'id' => 138,
                'nama' => 'BANK EKSEKUTIF',
                'kode' => '558'
            ],
            [
                'id' => 139,
                'nama' => 'CENTRATAMA NASIONAL BANK',
                'kode' => '559'
            ],
            [
                'id' => 140,
                'nama' => 'BANK FAMA INTERNASIONAL',
                'kode' => '562'
            ],
            [
                'id' => 141,
                'nama' => 'PT. BANK MANDIRI TASPEN POS',
                'kode' => '564'
            ],
            [
                'id' => 142,
                'nama' => 'BANK HARDA',
                'kode' => '567'
            ],
            [
                'id' => 143,
                'nama' => 'BANK AGRIS (BANK FINCONESIA)',
                'kode' => '945'
            ],
            [
                'id' => 144,
                'nama' => 'BANK MERINCORP',
                'kode' => '946'
            ],
            [
                'id' => 145,
                'nama' => 'BANK MAYBANK INDOCORP',
                'kode' => '947'
            ],
            [
                'id' => 146,
                'nama' => 'BANK OCBC – INDONESIA',
                'kode' => '948'
            ],
            [
                'id' => 147,
                'nama' => 'BANK CTBC (CHINA TRUST) INDONESIA',
                'kode' => '949'
            ],
            [
                'id' => 148,
                'nama' => 'PT. BANK JABAR BANTEN SYARIAH',
                'kode' => '425'
            ],
            [
                'id' => 149,
                'nama' => 'BPR KS (KARYAJATNIKA SEDAYA)',
                'kode' => '688'
            ],
            [
                'id' => 150,
                'nama' => 'PT. BANK CIMB NIAGA UNIT USAHA SYARIAH - (CIMB SYARIAH)',
                'kode' => '730'
            ],
            [
                'id' => 151,
                'nama' => 'PT. BANK OCBC NISP, TBK UNIT USAHA SYARIAH',
                'kode' => '731'
            ],
            [
                'id' => 152,
                'nama' => 'PT. BANK PERMATA, TBK UNIT USAHA SYARIAH',
                'kode' => '721'
            ],
            [
                'id' => 153,
                'nama' => 'PT. BANK TABUNGAN NEGARA (PERSERO), TBK UNIT USAHA SYARIAH',
                'kode' => '723'
            ],
            ['id' => 154, 'nama' => 'PT. BANK DKI UNIT USAHA SYARIAH', 'kode' => '724'],
        ];

        // Insert data in chunks if dataset is large to avoid memory issues
        foreach (array_chunk($banks, 50) as $chunk) {
            DB::table('dt_bank')->insert($chunk);
        }
    }
}
