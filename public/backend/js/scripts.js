(function (root, undefined) {
    'use strict';

    /**
     * getSlug
     * @param  {string} input input string
     * @param  {object|string} opts config object or separator string/char
     * @api    public
     * @return {string}  sluggified string
     */
    var getSlug = function getSlug(input, opts) {

        var separator = '-';
        var uricChars = [';', '?', ':', '@', '&', '=', '+', '$', ',', '/'];
        var uricNoSlashChars = [';', '?', ':', '@', '&', '=', '+', '$', ','];
        var markChars = ['.', '!', '~', '*', '\'', '(', ')'];
        var result = '';
        var diatricString = '';
        var convertSymbols = true;
        var customReplacements = {};
        var maintainCase;
        var titleCase;
        var truncate;
        var uricFlag;
        var uricNoSlashFlag;
        var markFlag;
        var symbol;
        var langChar;
        var lucky;
        var i;
        var ch;
        var l;
        var lastCharWasSymbol;
        var lastCharWasDiatric;
        var allowedChars;

        /**
         * charMap
         * @type {Object}
         */
        var charMap = {

            // latin
            'À': 'A',
            'Á': 'A',
            'Â': 'A',
            'Ã': 'A',
            'Ä': 'Ae',
            'Å': 'A',
            'Æ': 'AE',
            'Ç': 'C',
            'È': 'E',
            'É': 'E',
            'Ê': 'E',
            'Ë': 'E',
            'Ì': 'I',
            'Í': 'I',
            'Î': 'I',
            'Ï': 'I',
            'Ð': 'D',
            'Ñ': 'N',
            'Ò': 'O',
            'Ó': 'O',
            'Ô': 'O',
            'Õ': 'O',
            'Ö': 'Oe',
            'Ő': 'O',
            'Ø': 'O',
            'Ù': 'U',
            'Ú': 'U',
            'Û': 'U',
            'Ü': 'Ue',
            'Ű': 'U',
            'Ý': 'Y',
            'Þ': 'TH',
            'ß': 'ss',
            'à': 'a',
            'á': 'a',
            'â': 'a',
            'ã': 'a',
            'ä': 'ae',
            'å': 'a',
            'æ': 'ae',
            'ç': 'c',
            'è': 'e',
            'é': 'e',
            'ê': 'e',
            'ë': 'e',
            'ì': 'i',
            'í': 'i',
            'î': 'i',
            'ï': 'i',
            'ð': 'd',
            'ñ': 'n',
            'ò': 'o',
            'ó': 'o',
            'ô': 'o',
            'õ': 'o',
            'ö': 'oe',
            'ő': 'o',
            'ø': 'o',
            'ù': 'u',
            'ú': 'u',
            'û': 'u',
            'ü': 'ue',
            'ű': 'u',
            'ý': 'y',
            'þ': 'th',
            'ÿ': 'y',
            'ẞ': 'SS',

            // language specific

            // Arabic
            'ا': 'a',
            'أ': 'a',
            'إ': 'i',
            'آ': 'aa',
            'ؤ': 'u',
            'ئ': 'e',
            'ء': 'a',
            'ب': 'b',
            'ت': 't',
            'ث': 'th',
            'ج': 'j',
            'ح': 'h',
            'خ': 'kh',
            'د': 'd',
            'ذ': 'th',
            'ر': 'r',
            'ز': 'z',
            'س': 's',
            'ش': 'sh',
            'ص': 's',
            'ض': 'dh',
            'ط': 't',
            'ظ': 'z',
            'ع': 'a',
            'غ': 'gh',
            'ف': 'f',
            'ق': 'q',
            'ك': 'k',
            'ل': 'l',
            'م': 'm',
            'ن': 'n',
            'ه': 'h',
            'و': 'w',
            'ي': 'y',
            'ى': 'a',
            'ة': 'h',
            'ﻻ': 'la',
            'ﻷ': 'laa',
            'ﻹ': 'lai',
            'ﻵ': 'laa',

            // Arabic diactrics
            'َ': 'a',
            'ً': 'an',
            'ِ': 'e',
            'ٍ': 'en',
            'ُ': 'u',
            'ٌ': 'on',
            'ْ': '',

            // Arabic numbers
            '٠': '0',
            '١': '1',
            '٢': '2',
            '٣': '3',
            '٤': '4',
            '٥': '5',
            '٦': '6',
            '٧': '7',
            '٨': '8',
            '٩': '9',

            // Burmese consonants
            'က': 'k',
            'ခ': 'kh',
            'ဂ': 'g',
            'ဃ': 'ga',
            'င': 'ng',
            'စ': 's',
            'ဆ': 'sa',
            'ဇ': 'z',
            'စျ': 'za',
            'ည': 'ny',
            'ဋ': 't',
            'ဌ': 'ta',
            'ဍ': 'd',
            'ဎ': 'da',
            'ဏ': 'na',
            'တ': 't',
            'ထ': 'ta',
            'ဒ': 'd',
            'ဓ': 'da',
            'န': 'n',
            'ပ': 'p',
            'ဖ': 'pa',
            'ဗ': 'b',
            'ဘ': 'ba',
            'မ': 'm',
            'ယ': 'y',
            'ရ': 'ya',
            'လ': 'l',
            'ဝ': 'w',
            'သ': 'th',
            'ဟ': 'h',
            'ဠ': 'la',
            'အ': 'a',
            // consonant character combos
            'ြ': 'y',
            'ျ': 'ya',
            'ွ': 'w',
            'ြွ': 'yw',
            'ျွ': 'ywa',
            'ှ': 'h',
            // independent vowels
            'ဧ': 'e',
            '၏': '-e',
            'ဣ': 'i',
            'ဤ': '-i',
            'ဉ': 'u',
            'ဦ': '-u',
            'ဩ': 'aw',
            'သြော': 'aw',
            'ဪ': 'aw',
            // numbers
            '၀': '0',
            '၁': '1',
            '၂': '2',
            '၃': '3',
            '၄': '4',
            '၅': '5',
            '၆': '6',
            '၇': '7',
            '၈': '8',
            '၉': '9',
            // virama and tone marks which are silent in transliteration
            '္': '',
            '့': '',
            'း': '',

            // Czech
            'č': 'c',
            'ď': 'd',
            'ě': 'e',
            'ň': 'n',
            'ř': 'r',
            'š': 's',
            'ť': 't',
            'ů': 'u',
            'ž': 'z',
            'Č': 'C',
            'Ď': 'D',
            'Ě': 'E',
            'Ň': 'N',
            'Ř': 'R',
            'Š': 'S',
            'Ť': 'T',
            'Ů': 'U',
            'Ž': 'Z',

            // Dhivehi
            'ހ': 'h',
            'ށ': 'sh',
            'ނ': 'n',
            'ރ': 'r',
            'ބ': 'b',
            'ޅ': 'lh',
            'ކ': 'k',
            'އ': 'a',
            'ވ': 'v',
            'މ': 'm',
            'ފ': 'f',
            'ދ': 'dh',
            'ތ': 'th',
            'ލ': 'l',
            'ގ': 'g',
            'ޏ': 'gn',
            'ސ': 's',
            'ޑ': 'd',
            'ޒ': 'z',
            'ޓ': 't',
            'ޔ': 'y',
            'ޕ': 'p',
            'ޖ': 'j',
            'ޗ': 'ch',
            'ޘ': 'tt',
            'ޙ': 'hh',
            'ޚ': 'kh',
            'ޛ': 'th',
            'ޜ': 'z',
            'ޝ': 'sh',
            'ޞ': 's',
            'ޟ': 'd',
            'ޠ': 't',
            'ޡ': 'z',
            'ޢ': 'a',
            'ޣ': 'gh',
            'ޤ': 'q',
            'ޥ': 'w',
            'ަ': 'a',
            'ާ': 'aa',
            'ި': 'i',
            'ީ': 'ee',
            'ު': 'u',
            'ޫ': 'oo',
            'ެ': 'e',
            'ޭ': 'ey',
            'ޮ': 'o',
            'ޯ': 'oa',
            'ް': '',

            // Greek
            'α': 'a',
            'β': 'v',
            'γ': 'g',
            'δ': 'd',
            'ε': 'e',
            'ζ': 'z',
            'η': 'i',
            'θ': 'th',
            'ι': 'i',
            'κ': 'k',
            'λ': 'l',
            'μ': 'm',
            'ν': 'n',
            'ξ': 'ks',
            'ο': 'o',
            'π': 'p',
            'ρ': 'r',
            'σ': 's',
            'τ': 't',
            'υ': 'y',
            'φ': 'f',
            'χ': 'x',
            'ψ': 'ps',
            'ω': 'o',
            'ά': 'a',
            'έ': 'e',
            'ί': 'i',
            'ό': 'o',
            'ύ': 'y',
            'ή': 'i',
            'ώ': 'o',
            'ς': 's',
            'ϊ': 'i',
            'ΰ': 'y',
            'ϋ': 'y',
            'ΐ': 'i',
            'Α': 'A',
            'Β': 'B',
            'Γ': 'G',
            'Δ': 'D',
            'Ε': 'E',
            'Ζ': 'Z',
            'Η': 'I',
            'Θ': 'TH',
            'Ι': 'I',
            'Κ': 'K',
            'Λ': 'L',
            'Μ': 'M',
            'Ν': 'N',
            'Ξ': 'KS',
            'Ο': 'O',
            'Π': 'P',
            'Ρ': 'R',
            'Σ': 'S',
            'Τ': 'T',
            'Υ': 'Y',
            'Φ': 'F',
            'Χ': 'X',
            'Ψ': 'PS',
            'Ω': 'W',
            'Ά': 'A',
            'Έ': 'E',
            'Ί': 'I',
            'Ό': 'O',
            'Ύ': 'Y',
            'Ή': 'I',
            'Ώ': 'O',
            'Ϊ': 'I',
            'Ϋ': 'Y',

            // Latvian
            'ā': 'a',
            // 'č': 'c', // duplicate
            'ē': 'e',
            'ģ': 'g',
            'ī': 'i',
            'ķ': 'k',
            'ļ': 'l',
            'ņ': 'n',
            // 'š': 's', // duplicate
            'ū': 'u',
            // 'ž': 'z', // duplicate
            'Ā': 'A',
            // 'Č': 'C', // duplicate
            'Ē': 'E',
            'Ģ': 'G',
            'Ī': 'I',
            'Ķ': 'k',
            'Ļ': 'L',
            'Ņ': 'N',
            // 'Š': 'S', // duplicate
            'Ū': 'U',
            // 'Ž': 'Z', // duplicate

            // Macedonian
            'Ќ': 'Kj',
            'ќ': 'kj',
            'Љ': 'Lj',
            'љ': 'lj',
            'Њ': 'Nj',
            'њ': 'nj',
            'Тс': 'Ts',
            'тс': 'ts',

            // Polish
            'ą': 'a',
            'ć': 'c',
            'ę': 'e',
            'ł': 'l',
            'ń': 'n',
            // 'ó': 'o', // duplicate
            'ś': 's',
            'ź': 'z',
            'ż': 'z',
            'Ą': 'A',
            'Ć': 'C',
            'Ę': 'E',
            'Ł': 'L',
            'Ń': 'N',
            'Ś': 'S',
            'Ź': 'Z',
            'Ż': 'Z',

            // Ukranian
            'Є': 'Ye',
            'І': 'I',
            'Ї': 'Yi',
            'Ґ': 'G',
            'є': 'ye',
            'і': 'i',
            'ї': 'yi',
            'ґ': 'g',

            // Romanian
            'ă': 'a',
            'Ă': 'A',
            'ș': 's',
            'Ș': 'S',
            // 'ş': 's', // duplicate
            // 'Ş': 'S', // duplicate
            'ț': 't',
            'Ț': 'T',
            'ţ': 't',
            'Ţ': 'T',

            // Russian https://en.wikipedia.org/wiki/Romanization_of_Russian
            // ICAO

            'а': 'a',
            'б': 'b',
            'в': 'v',
            'г': 'g',
            'д': 'd',
            'е': 'e',
            'ё': 'yo',
            'ж': 'zh',
            'з': 'z',
            'и': 'i',
            'й': 'i',
            'к': 'k',
            'л': 'l',
            'м': 'm',
            'н': 'n',
            'о': 'o',
            'п': 'p',
            'р': 'r',
            'с': 's',
            'т': 't',
            'у': 'u',
            'ф': 'f',
            'х': 'kh',
            'ц': 'c',
            'ч': 'ch',
            'ш': 'sh',
            'щ': 'sh',
            'ъ': '',
            'ы': 'y',
            'ь': '',
            'э': 'e',
            'ю': 'yu',
            'я': 'ya',
            'А': 'A',
            'Б': 'B',
            'В': 'V',
            'Г': 'G',
            'Д': 'D',
            'Е': 'E',
            'Ё': 'Yo',
            'Ж': 'Zh',
            'З': 'Z',
            'И': 'I',
            'Й': 'I',
            'К': 'K',
            'Л': 'L',
            'М': 'M',
            'Н': 'N',
            'О': 'O',
            'П': 'P',
            'Р': 'R',
            'С': 'S',
            'Т': 'T',
            'У': 'U',
            'Ф': 'F',
            'Х': 'Kh',
            'Ц': 'C',
            'Ч': 'Ch',
            'Ш': 'Sh',
            'Щ': 'Sh',
            'Ъ': '',
            'Ы': 'Y',
            'Ь': '',
            'Э': 'E',
            'Ю': 'Yu',
            'Я': 'Ya',

            // Serbian
            'ђ': 'dj',
            'ј': 'j',
            // 'љ': 'lj',  // duplicate
            // 'њ': 'nj', // duplicate
            'ћ': 'c',
            'џ': 'dz',
            'Ђ': 'Dj',
            'Ј': 'j',
            // 'Љ': 'Lj', // duplicate
            // 'Њ': 'Nj', // duplicate
            'Ћ': 'C',
            'Џ': 'Dz',

            // Slovak
            'ľ': 'l',
            'ĺ': 'l',
            'ŕ': 'r',
            'Ľ': 'L',
            'Ĺ': 'L',
            'Ŕ': 'R',

            // Turkish
            'ş': 's',
            'Ş': 'S',
            'ı': 'i',
            'İ': 'I',
            // 'ç': 'c', // duplicate
            // 'Ç': 'C', // duplicate
            // 'ü': 'u', // duplicate, see langCharMap
            // 'Ü': 'U', // duplicate, see langCharMap
            // 'ö': 'o', // duplicate, see langCharMap
            // 'Ö': 'O', // duplicate, see langCharMap
            'ğ': 'g',
            'Ğ': 'G',

            // Vietnamese
            'ả': 'a',
            'Ả': 'A',
            'ẳ': 'a',
            'Ẳ': 'A',
            'ẩ': 'a',
            'Ẩ': 'A',
            'đ': 'd',
            'Đ': 'D',
            'ẹ': 'e',
            'Ẹ': 'E',
            'ẽ': 'e',
            'Ẽ': 'E',
            'ẻ': 'e',
            'Ẻ': 'E',
            'ế': 'e',
            'Ế': 'E',
            'ề': 'e',
            'Ề': 'E',
            'ệ': 'e',
            'Ệ': 'E',
            'ễ': 'e',
            'Ễ': 'E',
            'ể': 'e',
            'Ể': 'E',
            'ọ': 'o',
            'Ọ': 'o',
            'ố': 'o',
            'Ố': 'O',
            'ồ': 'o',
            'Ồ': 'O',
            'ổ': 'o',
            'Ổ': 'O',
            'ộ': 'o',
            'Ộ': 'O',
            'ỗ': 'o',
            'Ỗ': 'O',
            'ơ': 'o',
            'Ơ': 'O',
            'ớ': 'o',
            'Ớ': 'O',
            'ờ': 'o',
            'Ờ': 'O',
            'ợ': 'o',
            'Ợ': 'O',
            'ỡ': 'o',
            'Ỡ': 'O',
            'Ở': 'o',
            'ở': 'o',
            'ị': 'i',
            'Ị': 'I',
            'ĩ': 'i',
            'Ĩ': 'I',
            'ỉ': 'i',
            'Ỉ': 'i',
            'ủ': 'u',
            'Ủ': 'U',
            'ụ': 'u',
            'Ụ': 'U',
            'ũ': 'u',
            'Ũ': 'U',
            'ư': 'u',
            'Ư': 'U',
            'ứ': 'u',
            'Ứ': 'U',
            'ừ': 'u',
            'Ừ': 'U',
            'ự': 'u',
            'Ự': 'U',
            'ữ': 'u',
            'Ữ': 'U',
            'ử': 'u',
            'Ử': 'ư',
            'ỷ': 'y',
            'Ỷ': 'y',
            'ỳ': 'y',
            'Ỳ': 'Y',
            'ỵ': 'y',
            'Ỵ': 'Y',
            'ỹ': 'y',
            'Ỹ': 'Y',
            'ạ': 'a',
            'Ạ': 'A',
            'ấ': 'a',
            'Ấ': 'A',
            'ầ': 'a',
            'Ầ': 'A',
            'ậ': 'a',
            'Ậ': 'A',
            'ẫ': 'a',
            'Ẫ': 'A',
            // 'ă': 'a', // duplicate
            // 'Ă': 'A', // duplicate
            'ắ': 'a',
            'Ắ': 'A',
            'ằ': 'a',
            'Ằ': 'A',
            'ặ': 'a',
            'Ặ': 'A',
            'ẵ': 'a',
            'Ẵ': 'A',

            // symbols
            '“': '"',
            '”': '"',
            '‘': '\'',
            '’': '\'',
            '∂': 'd',
            'ƒ': 'f',
            '™': '(TM)',
            '©': '(C)',
            'œ': 'oe',
            'Œ': 'OE',
            '®': '(R)',
            '†': '+',
            '℠': '(SM)',
            '…': '...',
            '˚': 'o',
            'º': 'o',
            'ª': 'a',
            '•': '*',
            '၊': ',',
            '။': '.',

            // currency
            '$': 'USD',
            '€': 'EUR',
            '₢': 'BRN',
            '₣': 'FRF',
            '£': 'GBP',
            '₤': 'ITL',
            '₦': 'NGN',
            '₧': 'ESP',
            '₩': 'KRW',
            '₪': 'ILS',
            '₫': 'VND',
            '₭': 'LAK',
            '₮': 'MNT',
            '₯': 'GRD',
            '₱': 'ARS',
            '₲': 'PYG',
            '₳': 'ARA',
            '₴': 'UAH',
            '₵': 'GHS',
            '¢': 'cent',
            '¥': 'CNY',
            '元': 'CNY',
            '円': 'YEN',
            '﷼': 'IRR',
            '₠': 'EWE',
            '฿': 'THB',
            '₨': 'INR',
            '₹': 'INR',
            '₰': 'PF'

        };

        /**
         * special look ahead character array
         * These characters form with consonants to become 'single'/consonant combo
         * @type [Array]
         */
        var lookAheadCharArray = [
            // burmese
            '်',

            // Dhivehi
            'ް'
        ];

        /**
         * diatricMap for languages where transliteration changes entirely as more diatrics are added
         * @type {Object}
         */
        var diatricMap = {
            // Burmese
            // dependent vowels
            'ာ': 'a',
            'ါ': 'a',
            'ေ': 'e',
            'ဲ': 'e',
            'ိ': 'i',
            'ီ': 'i',
            'ို': 'o',
            'ု': 'u',
            'ူ': 'u',
            'ေါင်': 'aung',
            'ော': 'aw',
            'ော်': 'aw',
            'ေါ': 'aw',
            'ေါ်': 'aw',
            '်': '်', // this is special case but the character will be converted to latin in the code
            'က်': 'et',
            'ိုက်': 'aik',
            'ောက်': 'auk',
            'င်': 'in',
            'ိုင်': 'aing',
            'ောင်': 'aung',
            'စ်': 'it',
            'ည်': 'i',
            'တ်': 'at',
            'ိတ်': 'eik',
            'ုတ်': 'ok',
            'ွတ်': 'ut',
            'ေတ်': 'it',
            'ဒ်': 'd',
            'ိုဒ်': 'ok',
            'ုဒ်': 'ait',
            'န်': 'an',
            'ာန်': 'an',
            'ိန်': 'ein',
            'ုန်': 'on',
            'ွန်': 'un',
            'ပ်': 'at',
            'ိပ်': 'eik',
            'ုပ်': 'ok',
            'ွပ်': 'ut',
            'န်ုပ်': 'nub',
            'မ်': 'an',
            'ိမ်': 'ein',
            'ုမ်': 'on',
            'ွမ်': 'un',
            'ယ်': 'e',
            'ိုလ်': 'ol',
            'ဉ်': 'in',
            'ံ': 'an',
            'ိံ': 'ein',
            'ုံ': 'on',

            // Dhivehi
            'ައް': 'ah',
            'ަށް': 'ah',
        };

        /**
         * langCharMap language specific characters translations
         * @type   {Object}
         */
        var langCharMap = {

            'en': {}, // default language

            'az': { // Azerbaijani
                'ç': 'c',
                'ə': 'e',
                'ğ': 'g',
                'ı': 'i',
                'ö': 'o',
                'ş': 's',
                'ü': 'u',
                'Ç': 'C',
                'Ə': 'E',
                'Ğ': 'G',
                'İ': 'I',
                'Ö': 'O',
                'Ş': 'S',
                'Ü': 'U'
            },

            'cs': { // Czech
                'č': 'c',
                'ď': 'd',
                'ě': 'e',
                'ň': 'n',
                'ř': 'r',
                'š': 's',
                'ť': 't',
                'ů': 'u',
                'ž': 'z',
                'Č': 'C',
                'Ď': 'D',
                'Ě': 'E',
                'Ň': 'N',
                'Ř': 'R',
                'Š': 'S',
                'Ť': 'T',
                'Ů': 'U',
                'Ž': 'Z'
            },

            'fi': { // Finnish
                // 'å': 'a', duplicate see charMap/latin
                // 'Å': 'A', duplicate see charMap/latin
                'ä': 'a', // ok
                'Ä': 'A', // ok
                'ö': 'o', // ok
                'Ö': 'O' // ok
            },

            'hu': { // Hungarian
                'ä': 'a', // ok
                'Ä': 'A', // ok
                // 'á': 'a', duplicate see charMap/latin
                // 'Á': 'A', duplicate see charMap/latin
                'ö': 'o', // ok
                'Ö': 'O', // ok
                // 'ő': 'o', duplicate see charMap/latin
                // 'Ő': 'O', duplicate see charMap/latin
                'ü': 'u',
                'Ü': 'U',
                'ű': 'u',
                'Ű': 'U'
            },

            'lt': { // Lithuanian
                'ą': 'a',
                'č': 'c',
                'ę': 'e',
                'ė': 'e',
                'į': 'i',
                'š': 's',
                'ų': 'u',
                'ū': 'u',
                'ž': 'z',
                'Ą': 'A',
                'Č': 'C',
                'Ę': 'E',
                'Ė': 'E',
                'Į': 'I',
                'Š': 'S',
                'Ų': 'U',
                'Ū': 'U'
            },

            'lv': { // Latvian
                'ā': 'a',
                'č': 'c',
                'ē': 'e',
                'ģ': 'g',
                'ī': 'i',
                'ķ': 'k',
                'ļ': 'l',
                'ņ': 'n',
                'š': 's',
                'ū': 'u',
                'ž': 'z',
                'Ā': 'A',
                'Č': 'C',
                'Ē': 'E',
                'Ģ': 'G',
                'Ī': 'i',
                'Ķ': 'k',
                'Ļ': 'L',
                'Ņ': 'N',
                'Š': 'S',
                'Ū': 'u',
                'Ž': 'Z'
            },

            'pl': { // Polish
                'ą': 'a',
                'ć': 'c',
                'ę': 'e',
                'ł': 'l',
                'ń': 'n',
                'ó': 'o',
                'ś': 's',
                'ź': 'z',
                'ż': 'z',
                'Ą': 'A',
                'Ć': 'C',
                'Ę': 'e',
                'Ł': 'L',
                'Ń': 'N',
                'Ó': 'O',
                'Ś': 'S',
                'Ź': 'Z',
                'Ż': 'Z'
            },

            'sk': { // Slovak
                'ä': 'a',
                'Ä': 'A'
            },

            'sr': { // Serbian
                'љ': 'lj',
                'њ': 'nj',
                'Љ': 'Lj',
                'Њ': 'Nj',
                'đ': 'dj',
                'Đ': 'Dj'
            },

            'tr': { // Turkish
                'Ü': 'U',
                'Ö': 'O',
                'ü': 'u',
                'ö': 'o'
            }
        };

        /**
         * symbolMap language specific symbol translations
         * translations must be transliterated already
         * @type   {Object}
         */
        var symbolMap = {

            'ar': {
                '∆': 'delta',
                '∞': 'la-nihaya',
                '♥': 'hob',
                '&': 'wa',
                '|': 'aw',
                '<': 'aqal-men',
                '>': 'akbar-men',
                '∑': 'majmou',
                '¤': 'omla'
            },

            'az': {},

            'ca': {
                '∆': 'delta',
                '∞': 'infinit',
                '♥': 'amor',
                '&': 'i',
                '|': 'o',
                '<': 'menys que',
                '>': 'mes que',
                '∑': 'suma dels',
                '¤': 'moneda'
            },

            'cz': {
                '∆': 'delta',
                '∞': 'nekonecno',
                '♥': 'laska',
                '&': 'a',
                '|': 'nebo',
                '<': 'mene jako',
                '>': 'vice jako',
                '∑': 'soucet',
                '¤': 'mena'
            },

            'de': {
                '∆': 'delta',
                '∞': 'unendlich',
                '♥': 'Liebe',
                '&': 'und',
                '|': 'oder',
                '<': 'kleiner als',
                '>': 'groesser als',
                '∑': 'Summe von',
                '¤': 'Waehrung'
            },

            'dv': {
                '∆': 'delta',
                '∞': 'kolunulaa',
                '♥': 'loabi',
                '&': 'aai',
                '|': 'noonee',
                '<': 'ah vure kuda',
                '>': 'ah vure bodu',
                '∑': 'jumula',
                '¤': 'faisaa'
            },

            'en': {
                '∆': 'delta',
                '∞': 'infinity',
                '♥': 'love',
                '&': 'and',
                '|': 'or',
                '<': 'less than',
                '>': 'greater than',
                '∑': 'sum',
                '¤': 'currency'
            },

            'es': {
                '∆': 'delta',
                '∞': 'infinito',
                '♥': 'amor',
                '&': 'y',
                '|': 'u',
                '<': 'menos que',
                '>': 'mas que',
                '∑': 'suma de los',
                '¤': 'moneda'
            },

            'fr': {
                '∆': 'delta',
                '∞': 'infiniment',
                '♥': 'Amour',
                '&': 'et',
                '|': 'ou',
                '<': 'moins que',
                '>': 'superieure a',
                '∑': 'somme des',
                '¤': 'monnaie'
            },

            'gr': {},

            'hu': {
                '∆': 'delta',
                '∞': 'vegtelen',
                '♥': 'szerelem',
                '&': 'es',
                '|': 'vagy',
                '<': 'kisebb mint',
                '>': 'nagyobb mint',
                '∑': 'szumma',
                '¤': 'penznem'
            },

            'it': {
                '∆': 'delta',
                '∞': 'infinito',
                '♥': 'amore',
                '&': 'e',
                '|': 'o',
                '<': 'minore di',
                '>': 'maggiore di',
                '∑': 'somma',
                '¤': 'moneta'
            },

            'lt': {},

            'lv': {
                '∆': 'delta',
                '∞': 'bezgaliba',
                '♥': 'milestiba',
                '&': 'un',
                '|': 'vai',
                '<': 'mazak neka',
                '>': 'lielaks neka',
                '∑': 'summa',
                '¤': 'valuta'
            },

            'my': {
                '∆': 'kwahkhyaet',
                '∞': 'asaonasme',
                '♥': 'akhyait',
                '&': 'nhin',
                '|': 'tho',
                '<': 'ngethaw',
                '>': 'kyithaw',
                '∑': 'paungld',
                '¤': 'ngwekye'
            },

            'mk': {},

            'nl': {
                '∆': 'delta',
                '∞': 'oneindig',
                '♥': 'liefde',
                '&': 'en',
                '|': 'of',
                '<': 'kleiner dan',
                '>': 'groter dan',
                '∑': 'som',
                '¤': 'valuta'
            },

            'pl': {
                '∆': 'delta',
                '∞': 'nieskonczonosc',
                '♥': 'milosc',
                '&': 'i',
                '|': 'lub',
                '<': 'mniejsze niz',
                '>': 'wieksze niz',
                '∑': 'suma',
                '¤': 'waluta'
            },

            'pt': {
                '∆': 'delta',
                '∞': 'infinito',
                '♥': 'amor',
                '&': 'e',
                '|': 'ou',
                '<': 'menor que',
                '>': 'maior que',
                '∑': 'soma',
                '¤': 'moeda'
            },

            'ro': {
                '∆': 'delta',
                '∞': 'infinit',
                '♥': 'dragoste',
                '&': 'si',
                '|': 'sau',
                '<': 'mai mic ca',
                '>': 'mai mare ca',
                '∑': 'suma',
                '¤': 'valuta'
            },

            'ru': {
                '∆': 'delta',
                '∞': 'beskonechno',
                '♥': 'lubov',
                '&': 'i',
                '|': 'ili',
                '<': 'menshe',
                '>': 'bolshe',
                '∑': 'summa',
                '¤': 'valjuta'
            },

            'sk': {
                '∆': 'delta',
                '∞': 'nekonecno',
                '♥': 'laska',
                '&': 'a',
                '|': 'alebo',
                '<': 'menej ako',
                '>': 'viac ako',
                '∑': 'sucet',
                '¤': 'mena'
            },

            'sr': {},

            'tr': {
                '∆': 'delta',
                '∞': 'sonsuzluk',
                '♥': 'ask',
                '&': 've',
                '|': 'veya',
                '<': 'kucuktur',
                '>': 'buyuktur',
                '∑': 'toplam',
                '¤': 'para birimi'
            },

            'uk': {
                '∆': 'delta',
                '∞': 'bezkinechnist',
                '♥': 'lubov',
                '&': 'i',
                '|': 'abo',
                '<': 'menshe',
                '>': 'bilshe',
                '∑': 'suma',
                '¤': 'valjuta'
            },

            'vn': {
                '∆': 'delta',
                '∞': 'vo cuc',
                '♥': 'yeu',
                '&': 'va',
                '|': 'hoac',
                '<': 'nho hon',
                '>': 'lon hon',
                '∑': 'tong',
                '¤': 'tien te'
            }
        };

        if (typeof input !== 'string') {
            return '';
        }

        if (typeof opts === 'string') {
            separator = opts;
        }

        symbol = symbolMap.en;
        langChar = langCharMap.en;

        if (typeof opts === 'object') {

            maintainCase = opts.maintainCase || false;
            customReplacements = (opts.custom && typeof opts.custom === 'object') ? opts.custom : customReplacements;
            truncate = (+opts.truncate > 1 && opts.truncate) || false;
            uricFlag = opts.uric || false;
            uricNoSlashFlag = opts.uricNoSlash || false;
            markFlag = opts.mark || false;
            convertSymbols = (opts.symbols === false || opts.lang === false) ? false : true;
            separator = opts.separator || separator;

            if (uricFlag) {
                allowedChars += uricChars.join('');
            }

            if (uricNoSlashFlag) {
                allowedChars += uricNoSlashChars.join('');
            }

            if (markFlag) {
                allowedChars += markChars.join('');
            }

            symbol = (opts.lang && symbolMap[opts.lang] && convertSymbols) ?
                symbolMap[opts.lang] : (convertSymbols ? symbolMap.en : {});

            langChar = (opts.lang && langCharMap[opts.lang]) ?
                langCharMap[opts.lang] :
                opts.lang === false || opts.lang === true ? {} : langCharMap.en;

            // if titleCase config is an Array, rewrite to object format
            if (opts.titleCase && typeof opts.titleCase.length === "number" && Array.prototype.toString.call(opts.titleCase)) {

                opts.titleCase.forEach(function (v) {
                    customReplacements[v + ""] = v + "";
                });

                titleCase = true;
            } else {
                titleCase = !!opts.titleCase;
            }

            // if custom config is an Array, rewrite to object format
            if (opts.custom && typeof opts.custom.length === "number" && Array.prototype.toString.call(opts.custom)) {

                opts.custom.forEach(function (v) {
                    customReplacements[v + ""] = v + "";
                });
            }

            // custom replacements
            Object.keys(customReplacements).forEach(function (v) {

                var r;

                if (v.length > 1) {
                    r = new RegExp('\\b' + escapeChars(v) + '\\b', 'gi');
                } else {
                    r = new RegExp(escapeChars(v), 'gi');
                }

                input = input.replace(r, customReplacements[v]);
            });

            // add all custom replacement to allowed charlist
            for (ch in customReplacements) {
                allowedChars += ch;
            }

        }

        allowedChars += separator;

        // escape all necessary chars
        allowedChars = escapeChars(allowedChars);

        // trim whitespaces
        input = input.replace(/(^\s+|\s+$)/g, '');

        lastCharWasSymbol = false;
        lastCharWasDiatric = false;

        for (i = 0, l = input.length; i < l; i++) {

            ch = input[i];

            if (isReplacedCustomChar(ch, customReplacements)) {
                // don't convert a already converted char
                lastCharWasSymbol = false;
            } else if (langChar[ch]) {
                // process language specific diactrics chars conversion
                ch = lastCharWasSymbol && langChar[ch].match(/[A-Za-z0-9]/) ? ' ' + langChar[ch] : langChar[ch];

                lastCharWasSymbol = false;
            } else if (ch in charMap) {
                // the transliteration changes entirely when some special characters are added
                if (i + 1 < l && lookAheadCharArray.indexOf(input[i + 1]) >= 0) {
                    diatricString += ch;
                    ch = '';
                } else if (lastCharWasDiatric === true) {
                    ch = diatricMap[diatricString] + charMap[ch];
                    diatricString = '';
                } else {
                    // process diactrics chars
                    ch = lastCharWasSymbol && charMap[ch].match(/[A-Za-z0-9]/) ? ' ' + charMap[ch] : charMap[ch];
                }

                lastCharWasSymbol = false;
                lastCharWasDiatric = false;
            } else
            if (ch in diatricMap) {
                diatricString += ch;
                ch = '';
                // end of string, put the whole meaningful word
                if (i === l - 1) {
                    ch = diatricMap[diatricString];
                }
                lastCharWasDiatric = true;
            } else if (
                // process symbol chars
                symbol[ch] && !(uricFlag && uricChars.join('')
                    .indexOf(ch) !== -1) && !(uricNoSlashFlag && uricNoSlashChars.join('')
                    //.indexOf(ch) !== -1) && !(markFlag && markChars.join('')
                    .indexOf(ch) !== -1)) {

                ch = lastCharWasSymbol || result.substr(-1).match(/[A-Za-z0-9]/) ? separator + symbol[ch] : symbol[ch];
                ch += input[i + 1] !== void 0 && input[i + 1].match(/[A-Za-z0-9]/) ? separator : '';

                lastCharWasSymbol = true;
            } else {
                if (lastCharWasDiatric === true) {
                    ch = diatricMap[diatricString] + ch;
                    diatricString = '';
                    lastCharWasDiatric = false;
                } else if (lastCharWasSymbol && (/[A-Za-z0-9]/.test(ch) || result.substr(-1).match(/A-Za-z0-9]/))) {
                    // process latin chars
                    ch = ' ' + ch;
                }
                lastCharWasSymbol = false;
            }

            // add allowed chars
            result += ch.replace(new RegExp('[^\\w\\s' + allowedChars + '_-]', 'g'), separator);
        }

        if (titleCase) {
            result = result.replace(/(\w)(\S*)/g, function (_, i, r) {
                var j = i.toUpperCase() + (r !== null ? r : "");
                return (Object.keys(customReplacements).indexOf(j.toLowerCase()) < 0) ? j : j.toLowerCase();
            });
        }

        // eliminate duplicate separators
        // add separator
        // trim separators from start and end
        result = result.replace(/\s+/g, separator)
            .replace(new RegExp('\\' + separator + '+', 'g'), separator)
            .replace(new RegExp('(^\\' + separator + '+|\\' + separator + '+$)', 'g'), '');

        if (truncate && result.length > truncate) {

            lucky = result.charAt(truncate) === separator;
            result = result.slice(0, truncate);

            if (!lucky) {
                result = result.slice(0, result.lastIndexOf(separator));
            }
        }

        if (!maintainCase && !titleCase) {
            result = result.toLowerCase();
        }

        return result;
    };

    /**
     * createSlug curried(opts)(input)
     * @param   {object|string} opts config object or input string
     * @return  {Function} function getSlugWithConfig()
     **/
    var createSlug = function createSlug(opts) {

        /**
         * getSlugWithConfig
         * @param   {string} input string
         * @return  {string} slug string
         */
        return function getSlugWithConfig(input) {
            return getSlug(input, opts);
        };
    };

    /**
     * escape Chars
     * @param   {string} input string
     */
    var escapeChars = function escapeChars(input) {

        return input.replace(/[-\\^$*+?.()|[\]{}\/]/g, '\\$&');
    };

    /**
     * check if the char is an already converted char from custom list
     * @param   {char} ch character to check
     * @param   {object} customReplacements custom translation map
     */
    var isReplacedCustomChar = function (ch, customReplacements) {

        for (var c in customReplacements) {
            if (customReplacements[c] === ch) {
                return true;
            }
        }
    };

    if (typeof module !== 'undefined' && module.exports) {

        // export functions for use in Node
        module.exports = getSlug;
        module.exports.createSlug = createSlug;

    } else if (typeof define !== 'undefined' && define.amd) {

        // export function for use in AMD
        define([], function () {
            return getSlug;
        });

    } else {

        // don't overwrite global if exists
        try {
            if (root.getSlug || root.createSlug) {
                throw 'speakingurl: globals exists /(getSlug|createSlug)/';
            } else {
                root.getSlug = getSlug;
                root.createSlug = createSlug;
            }
        } catch (e) {}

    }
})(this);

/*! jquery-slugify - v1.2.5 - 2017-10-06
* Copyright (c) 2017 madflow; Licensed  */
(function($) {
    $.fn.slugify = function(source, options) {
        return this.each(function() {
            var $target = $(this),
                $source = $(source);

            $target.on('keyup change', function() {
                if ($target.val() !== '' && $target.val() !== undefined) {
                    $target.data('locked', true);
                } else {
                    $target.data('locked', false);
                }
            });

            $source.on('keyup change', function() {
                // If the target is empty - it cannot be locked
                if ($target.val() === '' || $target.val() === undefined) {
                    $target.data('locked', false);
                }

                if (true === $target.data('locked')) {
                    return;
                }
                if ($target.is('input') || $target.is('textarea')) {
                    $target.val($.slugify($source.val(), options));
                } else {
                    $target.text($.slugify($source.val(), options));
                }
            });
        });
    };

    // Static method.
    $.slugify = function(sourceString, options) {
        // Override default options with passed-in options.
        options = $.extend({}, $.slugify.options, options);

        // Guess language specifics from html.lang attribute
        // when options.lang is not defined
        options.lang = options.lang || $('html').prop('lang');

        // Apply preSlug function - if exists
        if (typeof options.preSlug === 'function') {
            sourceString = options.preSlug(sourceString);
        }

        sourceString = options.slugFunc(sourceString, options);

        // Apply postSlug function - if exists
        if (typeof options.postSlug === 'function') {
            sourceString = options.postSlug(sourceString);
        }

        return sourceString;
    };

    // Default plugin options
    $.slugify.options = {
        preSlug: null,
        postSlug: null,
        slugFunc: function(input, opts) {
            return window.getSlug(input, opts);
        }
    };
})(jQuery);

/*!
 * bootstrap-tokenfield
 * https://github.com/sliptree/bootstrap-tokenfield
 * Copyright 2013-2014 Sliptree and other contributors; Licensed MIT
 */

(function (factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define(['jquery'], factory);
  } else if (typeof exports === 'object') {
    // For CommonJS and CommonJS-like environments where a window with jQuery
    // is present, execute the factory with the jQuery instance from the window object
    // For environments that do not inherently posses a window with a document
    // (such as Node.js), expose a Tokenfield-making factory as module.exports
    // This accentuates the need for the creation of a real window or passing in a jQuery instance
    // e.g. require("bootstrap-tokenfield")(window); or require("bootstrap-tokenfield")($);
    module.exports = global.window && global.window.$ ?
      factory( global.window.$ ) :
      function( input ) {
        if ( !input.$ && !input.fn ) {
          throw new Error( "Tokenfield requires a window object with jQuery or a jQuery instance" );
        }
        return factory( input.$ || input );
      };
  } else {
    // Browser globals
    factory(jQuery);
  }
}(function ($, window) {

  "use strict"; // jshint ;_;

 /* TOKENFIELD PUBLIC CLASS DEFINITION
  * ============================== */

  var Tokenfield = function (element, options) {
    var _self = this

    this.$element = $(element)
    this.textDirection = this.$element.css('direction');

    // Extend options
    this.options = $.extend(true, {}, $.fn.tokenfield.defaults, { tokens: this.$element.val() }, this.$element.data(), options)
    
    // Setup delimiters and trigger keys
    this._delimiters = (typeof this.options.delimiter === 'string') ? [this.options.delimiter] : this.options.delimiter
    this._triggerKeys = $.map(this._delimiters, function (delimiter) {
      return delimiter.charCodeAt(0);
    });
    this._firstDelimiter = this._delimiters[0];

    // Check for whitespace, dash and special characters
    var whitespace = $.inArray(' ', this._delimiters)
      , dash = $.inArray('-', this._delimiters)

    if (whitespace >= 0)
      this._delimiters[whitespace] = '\\s'

    if (dash >= 0) {
      delete this._delimiters[dash]
      this._delimiters.unshift('-')
    }

    var specialCharacters = ['\\', '$', '[', '{', '^', '.', '|', '?', '*', '+', '(', ')']
    $.each(this._delimiters, function (index, char) {
      var pos = $.inArray(char, specialCharacters)
      if (pos >= 0) _self._delimiters[index] = '\\' + char;
    });

    // Store original input width
    var elRules = (window && typeof window.getMatchedCSSRules === 'function') ? window.getMatchedCSSRules( element ) : null
      , elStyleWidth = element.style.width
      , elCSSWidth
      , elWidth = this.$element.width()

    if (elRules) {
      $.each( elRules, function (i, rule) {
        if (rule.style.width) {
          elCSSWidth = rule.style.width;
        }
      });
    }

    // Move original input out of the way
    var hidingPosition = $('body').css('direction') === 'rtl' ? 'right' : 'left',
        originalStyles = { position: this.$element.css('position') };
    originalStyles[hidingPosition] = this.$element.css(hidingPosition);
    
    this.$element
      .data('original-styles', originalStyles)
      .data('original-tabindex', this.$element.prop('tabindex'))
      .css('position', 'absolute')
      .css(hidingPosition, '-10000px')
      .prop('tabindex', -1)

    // Create a wrapper
    this.$wrapper = $('<div class="tokenfield form-control" />')
    if (this.$element.hasClass('input-lg')) this.$wrapper.addClass('input-lg')
    if (this.$element.hasClass('input-sm')) this.$wrapper.addClass('input-sm')
    if (this.textDirection === 'rtl') this.$wrapper.addClass('rtl')

    // Create a new input
    var id = this.$element.prop('id') || new Date().getTime() + '' + Math.floor((1 + Math.random()) * 100)
    this.$input = $('<input type="text" class="token-input" autocomplete="off" />')
                    .appendTo( this.$wrapper )
                    .prop( 'placeholder',  this.$element.prop('placeholder') )
                    .prop( 'id', id + '-tokenfield' )
                    .prop( 'tabindex', this.$element.data('original-tabindex') )

    // Re-route original input label to new input
    var $label = $( 'label[for="' + this.$element.prop('id') + '"]' )
    if ( $label.length ) {
      $label.prop( 'for', this.$input.prop('id') )
    }

    // Set up a copy helper to handle copy & paste
    this.$copyHelper = $('<input type="text" />').css('position', 'absolute').css(hidingPosition, '-10000px').prop('tabindex', -1).prependTo( this.$wrapper )
    
    // Set wrapper width
    if (elStyleWidth) {
      this.$wrapper.css('width', elStyleWidth);
    }
    else if (elCSSWidth) {
      this.$wrapper.css('width', elCSSWidth);
    }
    // If input is inside inline-form with no width set, set fixed width
    else if (this.$element.parents('.form-inline').length) {
      this.$wrapper.width( elWidth )
    }

    // Set tokenfield disabled, if original or fieldset input is disabled
    if (this.$element.prop('disabled') || this.$element.parents('fieldset[disabled]').length) {
      this.disable();
    }

    // Set tokenfield readonly, if original input is readonly
    if (this.$element.prop('readonly')) {
      this.readonly();
    }

    // Set up mirror for input auto-sizing
    this.$mirror = $('<span style="position:absolute; top:-999px; left:0; white-space:pre;"/>');
    this.$input.css('min-width', this.options.minWidth + 'px')
    $.each([
        'fontFamily', 
        'fontSize', 
        'fontWeight', 
        'fontStyle', 
        'letterSpacing', 
        'textTransform', 
        'wordSpacing', 
        'textIndent'
    ], function (i, val) {
        _self.$mirror[0].style[val] = _self.$input.css(val);
    });
    this.$mirror.appendTo( 'body' )

    // Insert tokenfield to HTML
    this.$wrapper.insertBefore( this.$element )
    this.$element.prependTo( this.$wrapper )

    // Calculate inner input width
    this.update()
    
    // Create initial tokens, if any
    this.setTokens(this.options.tokens, false, false)

    // Start listening to events
    this.listen()

    // Initialize autocomplete, if necessary
    if ( ! $.isEmptyObject( this.options.autocomplete ) ) {
      var side = this.textDirection === 'rtl' ? 'right' : 'left'
       ,  autocompleteOptions = $.extend({
            minLength: this.options.showAutocompleteOnFocus ? 0 : null,
            position: { my: side + " top", at: side + " bottom", of: this.$wrapper }
          }, this.options.autocomplete )
      
      this.$input.autocomplete( autocompleteOptions )
    }

    // Initialize typeahead, if necessary
    if ( ! $.isEmptyObject( this.options.typeahead ) ) {
      
      var typeaheadOptions = this.options.typeahead
        , defaults = {
            minLength: this.options.showAutocompleteOnFocus ? 0 : null
          }
        , args = $.isArray( typeaheadOptions ) ? typeaheadOptions : [typeaheadOptions, typeaheadOptions]
      
      args[0] = $.extend( {}, defaults, args[0] )

      this.$input.typeahead.apply( this.$input, args )
      this.typeahead = true
    }

    this.$element.trigger('tokenfield:initialize')
  }

  Tokenfield.prototype = {

    constructor: Tokenfield

  , createToken: function (attrs, triggerChange) {
      var _self = this

      if (typeof attrs === 'string') {
        attrs = { value: attrs, label: attrs }
      }

      if (typeof triggerChange === 'undefined') {
         triggerChange = true
      }

      // Normalize label and value
      attrs.value = $.trim(attrs.value);
      attrs.label = attrs.label && attrs.label.length ? $.trim(attrs.label) : attrs.value

      // Bail out if has no value or label, or label is too short
      if (!attrs.value.length || !attrs.label.length || attrs.label.length <= this.options.minLength) return

      // Bail out if maximum number of tokens is reached
      if (this.options.limit && this.getTokens().length >= this.options.limit) return

      // Allow changing token data before creating it
      var createEvent = $.Event('tokenfield:createtoken', { attrs: attrs })
      this.$element.trigger(createEvent)

      // Bail out if there if attributes are empty or event was defaultPrevented
      if (!createEvent.attrs || createEvent.isDefaultPrevented()) return

      var $token = $('<div class="token" />')
            .attr('data-value', attrs.value)
            .append('<span class="token-label" />')
            .append('<a href="#" class="close" tabindex="-1">&times;</a>')

      // Insert token into HTML
      if (this.$input.hasClass('tt-input')) {
        // If the input has typeahead enabled, insert token before it's parent
        this.$input.parent().before( $token )
      } else {
        this.$input.before( $token )
      }

      // Temporarily set input width to minimum
      this.$input.css('width', this.options.minWidth + 'px')

      var $tokenLabel = $token.find('.token-label')
        , $closeButton = $token.find('.close')

      // Determine maximum possible token label width
      if (!this.maxTokenWidth) {
        this.maxTokenWidth =
          this.$wrapper.width() - $closeButton.outerWidth() - 
          parseInt($closeButton.css('margin-left'), 10) -
          parseInt($closeButton.css('margin-right'), 10) -
          parseInt($token.css('border-left-width'), 10) -
          parseInt($token.css('border-right-width'), 10) -
          parseInt($token.css('padding-left'), 10) -
          parseInt($token.css('padding-right'), 10)
          parseInt($tokenLabel.css('border-left-width'), 10) -
          parseInt($tokenLabel.css('border-right-width'), 10) -
          parseInt($tokenLabel.css('padding-left'), 10) -
          parseInt($tokenLabel.css('padding-right'), 10)
          parseInt($tokenLabel.css('margin-left'), 10) -
          parseInt($tokenLabel.css('margin-right'), 10)
      }

      $tokenLabel
        .text(attrs.label)
        .css('max-width', this.maxTokenWidth)

      // Listen to events on token
      $token
        .on('mousedown',  function (e) {
          if (_self._disabled || _self._readonly) return false
          _self.preventDeactivation = true
        })
        .on('click',    function (e) {
          if (_self._disabled || _self._readonly) return false
          _self.preventDeactivation = false

          if (e.ctrlKey || e.metaKey) {
            e.preventDefault()
            return _self.toggle( $token )
          }
          
          _self.activate( $token, e.shiftKey, e.shiftKey )          
        })
        .on('dblclick', function (e) {
          if (_self._disabled || _self._readonly || !_self.options.allowEditing ) return false
          _self.edit( $token )
        })

      $closeButton
          .on('click',  $.proxy(this.remove, this))

      // Trigger createdtoken event on the original field
      // indicating that the token is now in the DOM
      this.$element.trigger($.Event('tokenfield:createdtoken', {
        attrs: attrs,
        relatedTarget: $token.get(0)
      }))

      // Trigger change event on the original field
      if (triggerChange) {
        this.$element.val( this.getTokensList() ).trigger( $.Event('change', { initiator: 'tokenfield' }) )
      }

      // Update tokenfield dimensions
      this.update()

      // Return original element
      return this.$element.get(0)
    }    

  , setTokens: function (tokens, add, triggerChange) {
      if (!tokens) return

      if (!add) this.$wrapper.find('.token').remove()

      if (typeof triggerChange === 'undefined') {
          triggerChange = true
      }

      if (typeof tokens === 'string') {
        if (this._delimiters.length) {
          // Split based on delimiters
          tokens = tokens.split( new RegExp( '[' + this._delimiters.join('') + ']' ) )
        } else {
          tokens = [tokens];
        }
      }

      var _self = this
      $.each(tokens, function (i, attrs) {
        _self.createToken(attrs, triggerChange)
      })

      return this.$element.get(0)
    }

  , getTokenData: function($token) {
      var data = $token.map(function() {
        var $token = $(this);
        return {
          value: $token.attr('data-value'),
          label: $token.find('.token-label').text()
        }
      }).get();

      if (data.length == 1) {
        data = data[0];
      }

      return data;
    }

  , getTokens: function(active) {
      var self = this
        , tokens = []
        , activeClass = active ? '.active' : '' // get active tokens only
      this.$wrapper.find( '.token' + activeClass ).each( function() {
        tokens.push( self.getTokenData( $(this) ) )
      })
      return tokens
  }

  , getTokensList: function(delimiter, beautify, active) {
      delimiter = delimiter || this._firstDelimiter
      beautify = ( typeof beautify !== 'undefined' && beautify !== null ) ? beautify : this.options.beautify
      
      var separator = delimiter + ( beautify && delimiter !== ' ' ? ' ' : '')
      return $.map( this.getTokens(active), function (token) {
        return token.value
      }).join(separator)
  }

  , getInput: function() {
    return this.$input.val()
  }

  , listen: function () {
      var _self = this

      this.$element
        .on('change',   $.proxy(this.change, this))

      this.$wrapper
        .on('mousedown',$.proxy(this.focusInput, this))

      this.$input
        .on('focus',    $.proxy(this.focus, this))
        .on('blur',     $.proxy(this.blur, this))
        .on('paste',    $.proxy(this.paste, this))
        .on('keydown',  $.proxy(this.keydown, this))
        .on('keypress', $.proxy(this.keypress, this))
        .on('keyup',    $.proxy(this.keyup, this))

      this.$copyHelper
        .on('focus',    $.proxy(this.focus, this))
        .on('blur',     $.proxy(this.blur, this))        
        .on('keydown',  $.proxy(this.keydown, this))
        .on('keyup',    $.proxy(this.keyup, this))

      // Secondary listeners for input width calculation
      this.$input
        .on('keypress', $.proxy(this.update, this))
        .on('keyup',    $.proxy(this.update, this))

      this.$input
        .on('autocompletecreate', function() {
          // Set minimum autocomplete menu width
          var $_menuElement = $(this).data('ui-autocomplete').menu.element
          
          var minWidth = _self.$wrapper.outerWidth() -
              parseInt( $_menuElement.css('border-left-width'), 10 ) -
              parseInt( $_menuElement.css('border-right-width'), 10 )

          $_menuElement.css( 'min-width', minWidth + 'px' )
        })
        .on('autocompleteselect', function (e, ui) {
          if (_self.createToken( ui.item )) {
            _self.$input.val('')
            if (_self.$input.data( 'edit' )) {
              _self.unedit(true)
            }
          }
          return false
        })
        .on('typeahead:selected typeahead:autocompleted', function (e, datum, dataset) {
          // Create token
          if (_self.createToken( datum )) {
            _self.$input.typeahead('val', '')
            if (_self.$input.data( 'edit' )) {
              _self.unedit(true)
            }
          }
        })

      // Listen to window resize
      $(window).on('resize', $.proxy(this.update, this ))

    }

  , keydown: function (e) {

      if (!this.focused) return

      var _self = this

      switch(e.keyCode) {
        case 8: // backspace
          if (!this.$input.is(document.activeElement)) break
          this.lastInputValue = this.$input.val()
          break

        case 37: // left arrow
          leftRight( this.textDirection === 'rtl' ? 'next': 'prev' )
          break

        case 38: // up arrow
          upDown('prev')
          break

        case 39: // right arrow
          leftRight( this.textDirection === 'rtl' ? 'prev': 'next' )
          break

        case 40: // down arrow
          upDown('next')
          break        

        case 65: // a (to handle ctrl + a)
          if (this.$input.val().length > 0 || !(e.ctrlKey || e.metaKey)) break
          this.activateAll()
          e.preventDefault()
          break

        case 9: // tab
        case 13: // enter     

          // We will handle creating tokens from autocomplete in autocomplete events
          if (this.$input.data('ui-autocomplete') && this.$input.data('ui-autocomplete').menu.element.find("li:has(a.ui-state-focus)").length) break
          
          // We will handle creating tokens from typeahead in typeahead events
          if (this.$input.hasClass('tt-input') && this.$wrapper.find('.tt-cursor').length ) break
          if (this.$input.hasClass('tt-input') && this.$wrapper.find('.tt-hint').val().length) break
          
          // Create token
          if (this.$input.is(document.activeElement) && this.$input.val().length || this.$input.data('edit')) {
            return this.createTokensFromInput(e, this.$input.data('edit'));
          }

          // Edit token
          if (e.keyCode === 13) {
            if (!this.$copyHelper.is(document.activeElement) || this.$wrapper.find('.token.active').length !== 1) break
            if (!_self.options.allowEditing) break
            this.edit( this.$wrapper.find('.token.active') )
          }
      }

      function leftRight(direction) {
        if (_self.$input.is(document.activeElement)) {
          if (_self.$input.val().length > 0) return

          direction += 'All'
          var $token = _self.$input.hasClass('tt-input') ? _self.$input.parent()[direction]('.token:first') : _self.$input[direction]('.token:first')
          if (!$token.length) return

          _self.preventInputFocus = true
          _self.preventDeactivation = true

          _self.activate( $token )
          e.preventDefault()

        } else {
          _self[direction]( e.shiftKey )
          e.preventDefault()
        }
      }

      function upDown(direction) {
        if (!e.shiftKey) return

        if (_self.$input.is(document.activeElement)) {
          if (_self.$input.val().length > 0) return

          var $token = _self.$input.hasClass('tt-input') ? _self.$input.parent()[direction + 'All']('.token:first') : _self.$input[direction + 'All']('.token:first')
          if (!$token.length) return

          _self.activate( $token )
        }

        var opposite = direction === 'prev' ? 'next' : 'prev'
          , position = direction === 'prev' ? 'first' : 'last'

        _self.firstActiveToken[opposite + 'All']('.token').each(function() {
          _self.deactivate( $(this) )
        })

        _self.activate( _self.$wrapper.find('.token:' + position), true, true )
        e.preventDefault()
      }

      this.lastKeyDown = e.keyCode
    }

  , keypress: function(e) {
      this.lastKeyPressCode = e.keyCode
      this.lastKeyPressCharCode = e.charCode

      // Comma
      if ($.inArray( e.charCode, this._triggerKeys) !== -1 && this.$input.is(document.activeElement)) {
        if (this.$input.val()) {
          this.createTokensFromInput(e)
        }
        return false;
      }
    }

  , keyup: function (e) {
      this.preventInputFocus = false

      if (!this.focused) return

      switch(e.keyCode) {
        case 8: // backspace
          if (this.$input.is(document.activeElement)) {
            if (this.$input.val().length || this.lastInputValue.length && this.lastKeyDown === 8) break
            
            this.preventDeactivation = true
            var $prevToken = this.$input.hasClass('tt-input') ? this.$input.parent().prevAll('.token:first') : this.$input.prevAll('.token:first')

            if (!$prevToken.length) break

            this.activate( $prevToken )
          } else {
            this.remove(e)
          }
          break

        case 46: // delete
          this.remove(e, 'next')
          break
      }
      this.lastKeyUp = e.keyCode
    }

  , focus: function (e) {
      this.focused = true
      this.$wrapper.addClass('focus')

      if (this.$input.is(document.activeElement)) {
        this.$wrapper.find('.active').removeClass('active')
        this.$firstActiveToken = null

        if (this.options.showAutocompleteOnFocus) {
          this.search()
        }
      }
    }

  , blur: function (e) {

      this.focused = false
      this.$wrapper.removeClass('focus')

      if (!this.preventDeactivation && !this.$element.is(document.activeElement)) {
        this.$wrapper.find('.active').removeClass('active')
        this.$firstActiveToken = null
      }

      if (!this.preventCreateTokens && (this.$input.data('edit') && !this.$input.is(document.activeElement) || this.options.createTokensOnBlur )) {
        this.createTokensFromInput(e) 
      }
      
      this.preventDeactivation = false
      this.preventCreateTokens = false
    }

  , paste: function (e) {
      var _self = this
      
      // Add tokens to existing ones
      setTimeout(function () {
        _self.createTokensFromInput(e)
      }, 1)
    }

  , change: function (e) {
      if ( e.initiator === 'tokenfield' ) return // Prevent loops
      
      this.setTokens( this.$element.val() )
    }

  , createTokensFromInput: function (e, focus) {
      if (this.$input.val().length < this.options.minLength)
        return // No input, simply return

      var tokensBefore = this.getTokensList()
      this.setTokens( this.$input.val(), true )
      
      if (tokensBefore == this.getTokensList() && this.$input.val().length)
        return false // No tokens were added, do nothing (prevent form submit)

      if (this.$input.hasClass('tt-input')) {
        // Typeahead acts weird when simply setting input value to empty,
        // so we set the query to empty instead
        this.$input.typeahead('val', '')
      } else {
        this.$input.val('')
      }

      if (this.$input.data( 'edit' )) {
        this.unedit(focus)
      }

      return false // Prevent form being submitted
    }  

  , next: function (add) {
      if (add) {
        var $firstActiveToken = this.$wrapper.find('.active:first')
          , deactivate = $firstActiveToken && this.$firstActiveToken ? $firstActiveToken.index() < this.$firstActiveToken.index() : false

        if (deactivate) return this.deactivate( $firstActiveToken )
      }

      var $lastActiveToken = this.$wrapper.find('.active:last')
        , $nextToken = $lastActiveToken.nextAll('.token:first')

      if (!$nextToken.length) {
        this.$input.focus()
        return
      }

      this.activate($nextToken, add)
    }

  , prev: function (add) {

      if (add) {
        var $lastActiveToken = this.$wrapper.find('.active:last')
          , deactivate = $lastActiveToken && this.$firstActiveToken ? $lastActiveToken.index() > this.$firstActiveToken.index() : false

        if (deactivate) return this.deactivate( $lastActiveToken )
      }

      var $firstActiveToken = this.$wrapper.find('.active:first')
        , $prevToken = $firstActiveToken.prevAll('.token:first')

      if (!$prevToken.length) {
        $prevToken = this.$wrapper.find('.token:first')
      }

      if (!$prevToken.length && !add) {
        this.$input.focus()
        return
      }

      this.activate( $prevToken, add )
    }

  , activate: function ($token, add, multi, remember) {

      if (!$token) return

      if (typeof remember === 'undefined') var remember = true

      if (multi) var add = true

      this.$copyHelper.focus()

      if (!add) {
        this.$wrapper.find('.active').removeClass('active')
        if (remember) {
          this.$firstActiveToken = $token 
        } else {
          delete this.$firstActiveToken
        }
      }

      if (multi && this.$firstActiveToken) {
        // Determine first active token and the current tokens indicies
        // Account for the 1 hidden textarea by subtracting 1 from both
        var i = this.$firstActiveToken.index() - 2
          , a = $token.index() - 2
          , _self = this

        this.$wrapper.find('.token').slice( Math.min(i, a) + 1, Math.max(i, a) ).each( function() {
          _self.activate( $(this), true )
        })
      }

      $token.addClass('active')
      this.$copyHelper.val( this.getTokensList( null, null, true ) ).select()
    }

  , activateAll: function() {
      var _self = this

      this.$wrapper.find('.token').each( function (i) {
        _self.activate($(this), i !== 0, false, false)
      })
    }

  , deactivate: function($token) {
      if (!$token) return

      $token.removeClass('active')
      this.$copyHelper.val( this.getTokensList( null, null, true ) ).select()
    }

  , toggle: function($token) {
      if (!$token) return

      $token.toggleClass('active')
      this.$copyHelper.val( this.getTokensList( null, null, true ) ).select()
    }

  , edit: function ($token) {
      if (!$token) return

      var attrs = {
        value: $token.data('value'),
        label: $token.find('.token-label').text()
      }

      // Allow changing input value before editing
      var options = { attrs: attrs, relatedTarget: $token.get(0) }
      var editEvent = $.Event('tokenfield:edittoken', options)
      this.$element.trigger( editEvent )
      
      // Edit event can be cancelled if default is prevented
      if (editEvent.isDefaultPrevented()) return

      $token.find('.token-label').text(attrs.value)
      var tokenWidth = $token.outerWidth()

      var $_input = this.$input.hasClass('tt-input') ? this.$input.parent() : this.$input

      $token.replaceWith( $_input )

      this.preventCreateTokens = true

      this.$input.val( attrs.value )
                .select()
                .data( 'edit', true )
                .width( tokenWidth )

      this.update();

      // Indicate that token in snow being edited, and is replaced with an input field in the DOM
      this.$element.trigger($.Event('tokenfield:editedtoken', options ))
    }

  , unedit: function (focus) {
      var $_input = this.$input.hasClass('tt-input') ? this.$input.parent() : this.$input
      $_input.appendTo( this.$wrapper )
      
      this.$input.data('edit', false)
      this.$mirror.text('')

      this.update()

      // Because moving the input element around in DOM 
      // will cause it to lose focus, we provide an option
      // to re-focus the input after appending it to the wrapper
      if (focus) {
        var _self = this
        setTimeout(function () {
          _self.$input.focus()
        }, 1)
      }
    }

  , remove: function (e, direction) {
      if (this.$input.is(document.activeElement) || this._disabled || this._readonly) return

      var $token = (e.type === 'click') ? $(e.target).closest('.token') : this.$wrapper.find('.token.active')
      
      if (e.type !== 'click') {
        if (!direction) var direction = 'prev'
        this[direction]()

        // Was it the first token?
        if (direction === 'prev') var firstToken = $token.first().prevAll('.token:first').length === 0
      }

      // Prepare events and their options
      var options = { attrs: this.getTokenData( $token ), relatedTarget: $token.get(0) }
        , removeEvent = $.Event('tokenfield:removetoken', options)
      
      this.$element.trigger(removeEvent);

      // Remove event can be intercepted and cancelled
      if (removeEvent.isDefaultPrevented()) return

      var removedEvent = $.Event('tokenfield:removedtoken', options)
        , changeEvent = $.Event('change', { initiator: 'tokenfield' })

      // Remove token from DOM
      $token.remove()

      // Trigger events
      this.$element.val( this.getTokensList() ).trigger( removedEvent ).trigger( changeEvent )

      // Focus, when necessary:
      // When there are no more tokens, or if this was the first token
      // and it was removed with backspace or it was clicked on
      if (!this.$wrapper.find('.token').length || e.type === 'click' || firstToken) this.$input.focus()

      // Adjust input width
      this.$input.css('width', this.options.minWidth + 'px')
      this.update()

      // Cancel original event handlers
      e.preventDefault()
      e.stopPropagation()
    }

    /**
     * Update tokenfield dimensions
     */
  , update: function (e) {
      var value = this.$input.val()
        , inputPaddingLeft = parseInt(this.$input.css('padding-left'), 10)
        , inputPaddingRight = parseInt(this.$input.css('padding-right'), 10)
        , inputPadding = inputPaddingLeft + inputPaddingRight

      if (this.$input.data('edit')) {

        if (!value) {
          value = this.$input.prop("placeholder")
        }
        if (value === this.$mirror.text()) return

        this.$mirror.text(value)
        
        var mirrorWidth = this.$mirror.width() + 10;
        if ( mirrorWidth > this.$wrapper.width() ) {
          return this.$input.width( this.$wrapper.width() )
        }

        this.$input.width( mirrorWidth )
      }
      else {
        this.$input.css( 'width', this.options.minWidth + 'px' )
        if (this.textDirection === 'rtl') {
          return this.$input.width( this.$input.offset().left + this.$input.outerWidth() - this.$wrapper.offset().left - parseInt(this.$wrapper.css('padding-left'), 10) - inputPadding - 1 )
        }
        this.$input.width( this.$wrapper.offset().left + this.$wrapper.width() + parseInt(this.$wrapper.css('padding-left'), 10) - this.$input.offset().left - inputPadding )
      }
    }

  , focusInput: function (e) {
      if ( $(e.target).closest('.token').length || $(e.target).closest('.token-input').length || $(e.target).closest('.tt-dropdown-menu').length ) return
      // Focus only after the current call stack has cleared,
      // otherwise has no effect.
      // Reason: mousedown is too early - input will lose focus
      // after mousedown. However, since the input may be moved
      // in DOM, there may be no click or mouseup event triggered.
      var _self = this
      setTimeout(function() {
        _self.$input.focus()
      }, 0)
    }

  , search: function () {
      if ( this.$input.data('ui-autocomplete') ) {
        this.$input.autocomplete('search')
      }
    }

  , disable: function () {
      this.setProperty('disabled', true);
    }

  , enable: function () {
      this.setProperty('disabled', false);
    }

  , readonly: function () {
      this.setProperty('readonly', true);
    }

  , writeable: function () {
      this.setProperty('readonly', false);
    }

  , setProperty: function(property, value) {
      this['_' + property] = value;
      this.$input.prop(property, value);
      this.$element.prop(property, value);
      this.$wrapper[ value ? 'addClass' : 'removeClass' ](property);
  }

  , destroy: function() {
      // Set field value
      this.$element.val( this.getTokensList() );
      // Restore styles and properties
      this.$element.css( this.$element.data('original-styles') );
      this.$element.prop( 'tabindex', this.$element.data('original-tabindex') );
      
      // Re-route tokenfield labele to original input
      var $label = $( 'label[for="' + this.$input.prop('id') + '"]' )
      if ( $label.length ) {
        $label.prop( 'for', this.$element.prop('id') )
      }

      // Move original element outside of tokenfield wrapper
      this.$element.insertBefore( this.$wrapper );

      // Remove tokenfield-related data
      this.$element.removeData('original-styles')
                   .removeData('original-tabindex')
                   .removeData('bs.tokenfield');

      // Remove tokenfield from DOM
      this.$wrapper.remove();

      var $_element = this.$element;
      delete this;

      return $_element;
  }

  }


 /* TOKENFIELD PLUGIN DEFINITION
  * ======================== */

  var old = $.fn.tokenfield

  $.fn.tokenfield = function (option, param) {
    var value
      , args = []
    
    Array.prototype.push.apply( args, arguments );

    var elements = this.each(function () {
      var $this = $(this)
        , data = $this.data('bs.tokenfield')
        , options = typeof option == 'object' && option

      if (typeof option === 'string' && data && data[option]) {
        args.shift()
        value = data[option].apply(data, args)
      } else {
        if (!data && typeof option !== 'string' && !param) $this.data('bs.tokenfield', (data = new Tokenfield(this, options)))
      }
    })

    return typeof value !== 'undefined' ? value : elements;
  }

  $.fn.tokenfield.defaults = {
    minWidth: 60,
    minLength: 0,
    allowEditing: true,
    limit: 0,
    autocomplete: {},
    typeahead: {},
    showAutocompleteOnFocus: false,
    createTokensOnBlur: false,
    delimiter: ',',
    beautify: true
  }

  $.fn.tokenfield.Constructor = Tokenfield


 /* TOKENFIELD NO CONFLICT
  * ================== */

  $.fn.tokenfield.noConflict = function () {
    $.fn.tokenfield = old
    return this
  }

  return Tokenfield;

}));
