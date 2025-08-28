<?php
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

if (!function_exists('replace_shortcodes')) {
    function replace_shortcodes($content) 
    {
        $shortcodes = [
            '[admin-ph-1]'                               => '+358 46 5534360',
            '[admin-email-1]'                            => 'sales@swizchem.com',
            '[email-form-submission-test]'               => 'withzoptal@gmail.com',
            '[email-form-submission]'                    => 'sales@swizchem.com',
            '[admin-address-1]'                          => 'A326, A.I. Virtasen Aukio 1, 00560 Helsinki, Finland.',

            '[admin-ph-1-html]'                          => '<a href="tel:+358 46 5534360">+358 46 5534360</a>',
            '[admin-email-1-html]'                       => '<a href="mailto:sales@swizchem.com">sales@swizchem.com</a>',

            '[working-days-open]'                        => 'Monday',
            '[working-days-close]'                       => 'Thursday',
            '[working-hours-open]'                       => '9:00 AM',
            '[working-hours-close]'                      => '3:30 PM',

            '[exception-day-1]' => 'Friday',
            '[exception-day-1-working-hours-open]'       => '9:00 AM',
            '[exception-day-1-working-hours-close]'      => '1:00 PM',

            '[customer-support-email]'                   => 'manvatt@swizchem.com',
            '[customer-support-email-html]'              => '<a href="mailto:manvatt@swizchem.com">manvatt@swizchem.com</a>',
            
        ];

        return str_replace(array_keys($shortcodes), array_values($shortcodes), $content);
    }
}

if (!function_exists('cart_counter')) {
    function cart_counter(): int
    {
        if (Auth::check()) {
            $userId = Auth::id();

            return CartItem::whereHas('cart', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })->count();
        }

        return count(session('cart', []));
    }
}

if (!function_exists('get_all_countries')) {
    function get_all_countries()
    {
        $countries = [
                        'Afghanistan', 'Albania', 'Algeria', 'Andorra', 'Angola', 'Antigua and Barbuda', 'Argentina', 'Armenia',
                        'Australia', 'Austria', 'Azerbaijan', 'Bahamas', 'Bahrain', 'Bangladesh', 'Barbados', 'Belarus', 'Belgium',
                        'Belize', 'Benin', 'Bhutan', 'Bolivia', 'Bosnia and Herzegovina', 'Botswana', 'Brazil', 'Brunei', 'Bulgaria',
                        'Burkina Faso', 'Burundi', 'Cabo Verde', 'Cambodia', 'Cameroon', 'Canada', 'Central African Republic', 'Chad',
                        'Chile', 'China', 'Colombia', 'Comoros', 'Congo (Congo-Brazzaville)', 'Costa Rica', 'Croatia', 'Cuba', 'Cyprus',
                        'Czech Republic', 'Democratic Republic of the Congo', 'Denmark', 'Djibouti', 'Dominica', 'Dominican Republic',
                        'Ecuador', 'Egypt', 'El Salvador', 'Equatorial Guinea', 'Eritrea', 'Estonia', 'Eswatini (fmr. "Swaziland")',
                        'Ethiopia', 'Fiji', 'Finland', 'France', 'Gabon', 'Gambia', 'Georgia', 'Germany', 'Ghana', 'Greece', 'Grenada',
                        'Guatemala', 'Guinea', 'Guinea-Bissau', 'Guyana', 'Haiti', 'Honduras', 'Hungary', 'Iceland', 'India',
                        'Indonesia', 'Iran', 'Iraq', 'Ireland', 'Israel', 'Italy', 'Ivory Coast', 'Jamaica', 'Japan', 'Jordan',
                        'Kazakhstan', 'Kenya', 'Kiribati', 'Kuwait', 'Kyrgyzstan', 'Laos', 'Latvia', 'Lebanon', 'Lesotho', 'Liberia',
                        'Libya', 'Liechtenstein', 'Lithuania', 'Luxembourg', 'Madagascar', 'Malawi', 'Malaysia', 'Maldives', 'Mali',
                        'Malta', 'Marshall Islands', 'Mauritania', 'Mauritius', 'Mexico', 'Micronesia', 'Moldova', 'Monaco',
                        'Mongolia', 'Montenegro', 'Morocco', 'Mozambique', 'Myanmar (formerly Burma)', 'Namibia', 'Nauru', 'Nepal',
                        'Netherlands', 'New Zealand', 'Nicaragua', 'Niger', 'Nigeria', 'North Korea', 'North Macedonia', 'Norway',
                        'Oman', 'Pakistan', 'Palau', 'Palestine State', 'Panama', 'Papua New Guinea', 'Paraguay', 'Peru', 'Philippines',
                        'Poland', 'Portugal', 'Qatar', 'Romania', 'Russia', 'Rwanda', 'Saint Kitts and Nevis', 'Saint Lucia',
                        'Saint Vincent and the Grenadines', 'Samoa', 'San Marino', 'Sao Tome and Principe', 'Saudi Arabia', 'Senegal',
                        'Serbia', 'Seychelles', 'Sierra Leone', 'Singapore', 'Slovakia', 'Slovenia', 'Solomon Islands', 'Somalia',
                        'South Africa', 'South Korea', 'South Sudan', 'Spain', 'Sri Lanka', 'Sudan', 'Suriname', 'Sweden',
                        'Switzerland', 'Syria', 'Taiwan', 'Tajikistan', 'Tanzania', 'Thailand', 'Timor-Leste', 'Togo', 'Tonga',
                        'Trinidad and Tobago', 'Tunisia', 'Turkey', 'Turkmenistan', 'Tuvalu', 'Uganda', 'Ukraine',
                        'United Arab Emirates', 'United Kingdom', 'United States of America', 'Uruguay', 'Uzbekistan', 'Vanuatu',
                        'Vatican City', 'Venezuela', 'Vietnam', 'Yemen', 'Zambia', 'Zimbabwe'
                    ];
        return $countries;
    }
}